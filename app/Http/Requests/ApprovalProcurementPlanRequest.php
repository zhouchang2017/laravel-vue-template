<?php

namespace App\Http\Requests;

use App\Models\ProcurementPlan;
use App\Rules\isChanged;
use Carbon\Carbon;
use Dingo\Api\Http\FormRequest;

class ApprovalProcurementPlanRequest extends FormRequest
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
            'comment.*.text' => 'sometimes|required',
            'status'         => [ 'required', new isChanged(ProcurementPlan::class), 'in:return,already,cancel,3,4,5' ],
            'info'           => 'sometimes|string|nullable|max:100',
        ];
    }

    public function messages()
    {
        return [
        ];
    }

    /**
     *  配置验证器实例。
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
    }

    public function genHistory($attributes = [])
    {
        // todo user_id暂时写死
        return array_merge([ 'user_id' => 1, 'action' => $this->status, 'info' => $this->info, 'created_at' => Carbon::now()->format('Y-m-d H:i:s') ], $attributes);
    }

}
