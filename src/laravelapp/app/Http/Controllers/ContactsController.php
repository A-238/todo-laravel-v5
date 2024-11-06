<?php
namespace App\Http\Controllers;

use App\Http\Requests\ContactCompleteRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use App\Contact;
use Illuminate\Support\Facades\Storage;

class ContactsController extends Controller
{
    public function index()
    {
        $categories = Contact::$categories;
        $prefs = Contact::$prefs;
        $genders = Contact::$genders;


        return view('contacts.index', compact('categories', 'prefs', 'genders'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = new Contact($request->all());

        // 「お問い合わせ種類（checkbox）」を配列から文字列に
        $category = '';
        if (isset($request->category)) {
            $category = implode(', ',$request->category);
        }
        $tmp_path = '';
        if (session()->has('tmp_path')) {
            session()->forget('tmp_path');
        }

        if ($request->file('image')){
            $tmp_path = $request->file('image')->store('tmp','public'); //store・・・画像一時保存
            $request->session()->put('tmp_path',$tmp_path);
        }
        return view('contacts.confirm', compact('contact', 'category'));
    }

    public function complete(ContactCompleteRequest $request)
    {
        $input = $request->except('action');

        if ($request->action === 'back') {
            return redirect()->action('ContactsController@index')->withInput($input);
        }

        // チェックボックス（配列）を「,」区切りの文字列に
        if (isset($request->category)) {
            $request->merge(['category' => implode(', ', $request->category)]);
        }

        $tmp_path = $request->session()->get('tmp_path');
        if (!empty($tmp_path)) {
            // 一時ファイルを本番保存に移動
            $fileName = time() . '_' . basename($tmp_path);
            Storage::disk('public')->move($tmp_path, 'images/' . $fileName);
            $request->merge(['image' => $fileName]);
            session()->forget('tmp_path');
        }

        // データを保存
        Contact::create($request->all());

        return view('contacts.complete');
    }
}























// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Http\Requests\ContactFormRequest;
// use App\Mail\ContactSendmail;

// class ContactController extends Controller
// {
//     //viewファイルを返している
//     public function index()
//     {
//         return view('contact.index');
//     }

//     //POSTで送られてきたデータを受け取ってviewに渡す
//     public function confirm(ContactFormRequest $request)
//     {
//         $contact = $request->all();
//         return view('contact.confirm',compact('contact'));
//     }

//     //POSTで送られたデータを受け取り、生成したMailableクラスを使って、メール送信処理を行なっている
//     public function send(ContactFormRequest $request)
//     {
//         $contact = $request->all();
//         \Mail::to('your_address@example.com')->send(new ContactSendmail($contact));
//         $request->session()->regenerateToken();
//         return view('contact.thanks');
//     }
// }
