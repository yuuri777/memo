<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//Eloquentはlaravelに含まれるデータ用操作ライブラリ。

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        //データ内容を変えたいカラムを$fillableで指定
        'user_id',
        'project_name',
    ];

    /**
     * Usersテーブルとのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
        //belongsTo   一つの投稿に対してユーザーは一人
        // User::class  はuser.phpのuserクラスのこと
        // データ内容を変えたカラムをこのコードにて一つのユーザーに対して一つ変える

    }
    public function memos()
    {
        return $this->hasMany(Memo::class);
        //$thisはモデル自身を表している。hasmanyメソッドを使って、このモデルが複数のMemoモデルを持つことを定義している。
        // Memo::classは関連づけられたモデルのクラスを指定している
        // ここのモデルprojectga複数のmemoモデルを持つことを定義している
        //レコードとはデータベース内にある一つの行のこと
        //レコードのコレクションとはデータベースから取得した複数のレコードを表すオブジェクトのこと。
    }
}
