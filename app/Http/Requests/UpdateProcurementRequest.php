<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class UpdateProcurementRequest extends FormRequest
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

        ];
    }

    public function messages()
    {
        return [
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->quantityDetection()) {
                $validator->errors()->add('field', '已收到货品数量|良品数量|不良品数量|丢失数量 不合法!');
            }
        });
    }

    /**
     * 数量检测
     * @return bool
     */
    private function quantityDetection(): bool
    {
        if ( !request()->has('plan_info')) {
            return true;
        }
        return !collect($this->plan_info)->every(function ($info) {
            $arrivedPcs = $info['arrived_pcs'];
            $pcs = $info['pcs'];
            $total = $info['good'] + $info['bad'];
            $totalWithLost = $total + $info['lost'];
            return ($arrivedPcs <= $pcs) && ($arrivedPcs == $total) && ($totalWithLost <= $pcs);
        });
    }

}
