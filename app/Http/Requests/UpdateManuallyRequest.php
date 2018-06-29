<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class UpdateManuallyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'warehouse_id'=>'required|exists:warehouses,id',
            'user_id'=>'sometimes|required|integer', // todo exists:users,id
            'comment.*.text'=>'sometimes|required',
            'status'=>'sometimes|in:uncommitted,pending,cancel',
//            'variants.*'=>'sometimes|exists:product_variants,id',
            'variants.*.price'=>'sometimes|integer',
            'variants.*.pcs'=>'sometimes|integer',
            'variants.*.user_id'=>'sometimes|integer', // todo exists:users,id
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
