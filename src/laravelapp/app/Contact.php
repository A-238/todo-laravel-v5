<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'gender',
        'category',
        'pref',
        'body',
        'image'
    ];

    static $genders = [
        '男性', '女性'
    ];

    static $categories = [
        '製品について',
        'サービスについて',
        '採用について',
        'その他'
    ];

    static $prefs = [
        '北海道',
        '東北',
        '関東',
        '中部',
        '近畿',
        '中国',
        '四国',
        '九州・沖縄'
    ];
}
