<?php

use App\Http\Controllers\ProjectController;
// ProjectControllerクラスを使っている。
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Models\Memo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //ここにログイン後しかできないルートを記述する。
    Route::get('projects',[ProjectController::class,'index'])->name('projects.index');
    
    //タイトル作成画面
    Route::get('projects/create',[ProjectController::class,'create'])->name('projects.create');


    //タイトル作成処理
    Route::post('projects/store',[ProjectController::class,'store'])->name('projects.store');
//postで受け取った値でprojectControllerのstoreメソッドの処理を実装する。

    Route::get('projects/{id}/memo',[MemoController::class,'index'])->name('memo.index');

    //めも作成画面
    Route::get('projects/{id}/memo/create',[MemoController::class,'create'])->name('memo.create');


    //メモ作成処理
    Route::post('projects/{id}/memo/store',[MemoController::class,'store'])->name('memo.store');
    
    //メモ編集フォームを表示
    Route::post('projects/{id}/memo/edit',[MemoController::class,'edit'])->name('memo.edit');

    //メモ編集処理
    Route::post('projects/{id}/memo/update',[MemoController::class,'update'])->name('memo.update');

    //タイトル削除処理
    Route::delete('{id}/delete',[ProjectController::class,'delete'])->name('project.delete');

    //メモ削除処理
    Route::delete('memo/{id}/delete',[MemoController::class,'delete'])->name('memo.delete');
    /*Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');*/

    //メモ検索画面
    Route::get('memo/search',[MemoController::class,'search'])->name('memo.search');

    //メモ検索処理
    Route::post('memo/keyword',[MemoController::class,'keyword'])->name('memo.keyword');
    
});

require __DIR__.'/auth.php';
//ミドルウェアとはルートごとの処理に移る前に実行
