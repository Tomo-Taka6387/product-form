<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'between:0,10000'],
            'seasons' => ['required', 'array'],
            'seasons.*' => ['exists:seasons,id'],
            'description' => ['required', 'string', 'max:120'],
            'image_path' => ['required', 'image', 'mimes:jpeg,png,jpg']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.between' => '0〜10000円以内で入力してください',
            'seasons.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image_path.required' => '商品画像を登録してください',
            'image_path.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
