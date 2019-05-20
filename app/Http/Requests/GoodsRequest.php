<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodsRequest extends FormRequest
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
            'gname' => 'required',
            'company' => 'required',
            'descr' => 'required',
            'price' => 'required',
            'status' => 'required',
            'stock' => 'required',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'gname.required' => '商品名称名称不能为空',
                'company.required' => '生产厂家不能为空',
                'descr.required' => '简介不能为空',
                'price.required' => '单价不能为空',
                'status.required' => '请选择商品状态',
                'stock.required' => '库存量不能为空'
        ];
    }
}
