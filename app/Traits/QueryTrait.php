<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Builder;

trait QueryTrait
{


    public function apply(Builder $builder)
    {
        $fieldsSearchable = $builder->getModel()->getFieldsSearchable();
        $search = request()->input('search', null);
        $searchFields = request()->input('search_fields', null);
        $filter = request()->input('filter', null);
        $orderBy = request()->input('sort_by', 'id');
        $sortedBy = request()->input('order', 'desc');
        $with = request()->input('with', null);
        $searchJoin = request()->input('search_join', null);

        if ($search && is_array($fieldsSearchable) && count($fieldsSearchable)) {
            $searchFields = is_array($searchFields) || is_null($searchFields) ? $searchFields : explode(';', $searchFields);
            $fields = $this->parserFieldsSearch($fieldsSearchable, $searchFields);
            $isFirstField = true;
            $searchData = $this->parserSearchData($search);
            $search = $this->parserSearchValue($search);

            $modelForceAndWhere = strtolower($searchJoin) === 'and';
            $builder = $builder->where(function ($query) use ($fields, $search, $searchData, $isFirstField, $modelForceAndWhere) {
                /** @var Builder $query */
                foreach ($fields as $field => $condition) {
                    if (is_numeric($field)) {
                        $field = $condition;
                        $condition = "=";
                    }
                    $value = null;
                    $condition = trim(strtolower($condition));
                    if (isset($searchData[$field])) {
                        $value = ($condition == "like" || $condition == "ilike") ? "%{$searchData[$field]}%" : $searchData[$field];
                    } else {
                        if ( !is_null($search)) {
                            $value = ($condition == "like" || $condition == "ilike") ? "%{$search}%" : $search;
                        }
                    }
                    $relation = null;
                    if (stripos($field, '.')) {
                        $explode = explode('.', $field);
                        $field = array_pop($explode);
                        $relation = implode('.', $explode);
                    }
                    $modelTableName = $query->getModel()->getTable();
                    if ($isFirstField || $modelForceAndWhere) {
                        if ( !is_null($value)) {
                            if ( !is_null($relation)) {
                                $query->whereHas($relation, function ($query) use ($field, $condition, $value) {
                                    $query->where($field, $condition, $value);
                                });
                            } else {
                                $query->where($modelTableName . '.' . $field, $condition, $value);
                            }
                            $isFirstField = false;
                        }
                    } else {
                        if ( !is_null($value)) {
                            if ( !is_null($relation)) {
                                $query->orWhereHas($relation, function ($query) use ($field, $condition, $value) {
                                    $query->where($field, $condition, $value);
                                });
                            } else {
                                $query->orWhere($modelTableName . '.' . $field, $condition, $value);
                            }
                        }
                    }
                }
            });
        }
        if (isset($orderBy) && !empty($orderBy)) {
            $split = explode('|', $orderBy);
            if (count($split) > 1) {
                /*
                 * ex.
                 * products|description -> join products on current_table.product_id = products.id order by description
                 *
                 * products:custom_id|products.description -> join products on current_table.custom_id = products.id order
                 * by products.description (in case both tables have same column name)
                 */
                $table = $builder->getModel()->getTable();
                $sortTable = $split[0];
                $sortColumn = $split[1];
                $split = explode(':', $sortTable);
                if (count($split) > 1) {
                    $sortTable = $split[0];
                    $keyName = $table . '.' . $split[1];
                } else {
                    /*
                     * If you do not define which column to use as a joining column on current table, it will
                     * use a singular of a join table appended with _id
                     *
                     * ex.
                     * products -> product_id
                     */
                    $prefix = str_singular($sortTable);
                    $keyName = $table . '.' . $prefix . '_id';
                }
                $builder = $builder
                    ->leftJoin($sortTable, $keyName, '=', $sortTable . '.id')
                    ->orderBy($sortColumn, $sortedBy)
                    ->addSelect($table . '.*');
            } else {
                $builder = $builder->orderBy($orderBy, $sortedBy);
            }
        }
        if (isset($filter) && !empty($filter)) {
            if (is_string($filter)) {
                $filter = explode(';', $filter);
            }
            $builder = $builder->select($filter);
        }
        if ($with) {
            $with = explode(';', $with);
            $builder = $builder->with($with);
        }
        return $builder;
    }

    /**
     * @param $search
     *
     * @return array
     */
    private function parserSearchData($search)
    {
        $searchData = [];
        if (stripos($search, ':')) {
            $fields = explode(';', $search);
            foreach ($fields as $row) {
                try {
                    list($field, $value) = explode(':', $row);
                    $searchData[$field] = $value;
                } catch (Exception $e) {
                    //Surround offset error
                }
            }
        }
        return $searchData;
    }

    /**
     * @param $search
     *
     * @return null
     */
    private function parserSearchValue($search)
    {
        if (stripos($search, ';') || stripos($search, ':')) {
            $values = explode(';', $search);
            foreach ($values as $value) {
                $s = explode(':', $value);
                if (count($s) == 1) {
                    return $s[0];
                }
            }
            return null;
        }
        return $search;
    }

    private function parserFieldsSearch(array $fields = [], array $searchFields = null)
    {
        if ( !is_null($searchFields) && count($searchFields)) {
            $acceptedConditions = [ '=', 'like' ];
            $originalFields = $fields;
            $fields = [];
            foreach ($searchFields as $index => $field) {
                $field_parts = explode(':', $field);
                $temporaryIndex = array_search($field_parts[0], $originalFields);
                if (count($field_parts) == 2) {
                    if (in_array($field_parts[1], $acceptedConditions)) {
                        unset($originalFields[$temporaryIndex]);
                        $field = $field_parts[0];
                        $condition = $field_parts[1];
                        $originalFields[$field] = $condition;
                        $searchFields[$index] = $field;
                    }
                }
            }
            foreach ($originalFields as $field => $condition) {
                if (is_numeric($field)) {
                    $field = $condition;
                    $condition = "=";
                }
                if (in_array($field, $searchFields)) {
                    $fields[$field] = $condition;
                }
            }
            if (count($fields) == 0) {
                throw new Exception('fields_not_accepted');
            }
        }
        return $fields;
    }
}