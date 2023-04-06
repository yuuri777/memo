<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->unsigned();
            $table->string('project_name',30);
            $table->timestamps();

            //外部キーの設定
            $table->foreign('user_id')->references('id')->on('users');
            //2つのテーブル間でデータの整合性を保つために設定される誓約。
            //必須の設定ではないがusesテーブルとprojectsテーブルのデータの生合成を保つために記述。
            //データの整合性を保つ例としてはユーザー情報が削除されると、削除されたユーザーに紐づいたプロジェクト情報も削除される。
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
