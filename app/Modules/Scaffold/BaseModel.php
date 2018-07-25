<?php


namespace App\Modules\Scaffold;


use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $fieldSearchable = [];

    protected $observables = [
        'beforeUpdate',
        'afterUpdate'
    ];

    public static function getFieldsSearchable()
    {
        return (new static)->fieldSearchable;
    }

    public function update(array $attributes = [], array $options = [])
    {
        if ($this->fireModelEvent('beforeUpdate') === false) {
            return false;
        }
        $update = parent::update($attributes, $options);
        if ($this->fireModelEvent('afterUpdate') === false) {
            return false;
        }
        return $update;
    }
}