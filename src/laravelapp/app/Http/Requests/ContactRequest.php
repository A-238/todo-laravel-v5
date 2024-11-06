<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        //ラジオボタンやチェックボックスのように選択された項目が配列の中にあるか確認する場合はin:を使用
        return [
            'category' => 'required',
            'category.*' => 'in:製品について,サービスについて,採用について,その他',
            'name' => 'required|max:10',
            'email' => 'nullable|email',
            'gender' => 'required|in:男性,女性',
            'pref' => 'required',
            'pref.*' => 'in:北海道,東北,関東,中部,近畿,中国,四国,九州・沖縄',
            'body' => 'required|max:1000',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function attributes() {
        return [
            'category' => 'お問い合わせカテゴリ',
            'name' => 'お名前',
            'email' => 'メールアドレス',
            'gender' => '性別',
            'pref' => 'お住まい',
            'body' => 'メッセージ',
            'image' => '添付ファイル'
        ];
    }
}
