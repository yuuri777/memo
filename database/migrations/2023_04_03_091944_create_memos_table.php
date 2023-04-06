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
        Schema::create('memos', function (Blueprint $table) {
            $table->id();
            $table->biginteger('project_id')->unsigned();
            // unsigned()は符号なし整数を表す絡む属性で、負の値を表すことができないため、正の値の範囲がより大きくなる。
            $table->string('memo_name',100);
            $table->timestamps();

            //外部キー制約の設定
            $table->foreign('project_id')->references('id')->on('projects');
            //このコードを実行すると、'project_id'カラムには'projects'テーブルのidカラムに存在する値しか保存できなくなる。
            // projectsテーブルのid絡むの値が削除されると、それに紐付くレコードも自動的に削除されるようになる。
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memos');
        //このこーどはmemosテーブルが既に存在する場合は削除する
    }
};
