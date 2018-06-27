<?php

namespace App\Rules;

use App\Models\Model;
use App\Models\ProcurementPlan;
use Illuminate\Contracts\Validation\Rule;

class isChanged implements Rule
{
    protected $model;

    /**
     * Create a new rule instance.
     *
     * @param $modelName
     */
    public function __construct($modelName)
    {
        if ($modelName instanceof Model) {
            $this->model = $modelName;
        } else {
            $this->model = app($modelName);
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $model = $this->model::findOrFail(request()->route('id'));
        return $model->$attribute !== $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No change in the  in the :attribute';
    }
}
