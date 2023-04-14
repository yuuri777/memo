<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Memo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMemoRequest;
use App\Http\Requests\ProjectUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MemoController extends Controller
{
    /**
     * タイトルに紐づくタイトル一覧
     */
    public function index($id)
    {
        //URLで送られてきたプロジェクトID
        $currentProjectid = $id;
       
        $projects = Auth::user()->projects->all();
//全てを取得


        //プロジェクト取得
        $project = Project::find($currentProjectid);
        //一つだけを取得


// dd($project);
        //取得したプロジェクトに紐づくタスクを取得
        if($project){
        $memos = $project->memos->all();
        // $memosは$projectモデルに関連づけられたメモのEloquentコレクションを指す。EloquentコレクションはEloquentモデルの複数の
        // インスタンスを含むオブジェクトで、さまざまな便利なメソッドを提供する。この場合は$project->$memosは$projectモデルとMemoモデル間の
// リレーションシップを表す関数にアクセスして、$projectに関連づけられたmemoモデルのコレクションを返す。その後に取得されたメモのEloquentコレクションを$memos変数に代入している。
        return view('memo.index',compact(
            'currentProjectid',
            'memos',
            'projects',
            'project',
        ));
        }else{
            return view('projects.index',[
                'id'=>$project,
            ],compact(
                'currentProjectid',
                'projects',
                'project',
    
            ));
        }
    }

    //

    // メモ作成画面
    public function create($id)
    //＄idには選んだメモタイトルIDが入っている
    {
       
        $projects = Auth::user()->projects->all();
        //URLで送られてきたプロジェクトID
        $currentProjectid = $id;
    
        //dd($currentProjectid);
        return view('memo.create',compact(
            'currentProjectid',
            'projects',
        ));
    }



/**
 *メモ作成処理
 */
public function store(StoreMemoRequest $request,$id)
{ 
    //URLで送られてきたプxロジェクトID
    $currentProjectid = $id;
    
    $projects = Auth::user()->projects->all();
    //タスク作成処理
    DB::beginTransaction();

    try{

    $memo = Memo::create([
        'project_id' => $currentProjectid,
        'memo_name' => $request->memo_name,
    ]);
    DB::commit();
    }catch(\Exception $e) {
        //トランザクションロールバック
        DB::rollBack();

        //ログ出力
        Log::debug($e);

        //エラー画面遷移
        abort(500);
    }

    return redirect()->route('memo.index',[
        'id'=> $currentProjectid,
    ]);

}

    /**
     * メモ編集画面を表示する
     */
    public function edit($id)
    {
        $project = Memo::find($id);

        $projects = Auth::user()->projects->all();
        // Auth::user()は現在認証されているユーザーを表すオブジェクトを返す。
        

        return view('memo.edit',compact(
            'project',
            'projects',
        ));
    }

    /**
     * メモ編集処理
     */
    
    public function update(ProjectUpdateRequest $request,$id)
    {

        //トランザクション開始
DB::beginTransaction();
try{



        //渡されてきたメモIDのデータを取得
        $project = Memo::find($id);

        $projectid = $project->project_id;

        //編集する内容をfillメソッドを使用して記述
        $project->fill([
            'memo_name' => $request->content,
        ]);

        //保存処理
        $project->save();
       
        //トランザクションコミット
        DB::commit();

    }catch(\Exception $e) {

        DB::rollback();

        LOG::debug($e);

        abort(500);
    }

    

       return redirect()->route('memo.index',
       $projectid
        );
    }

/**
 * メモ削除処理
 */
    public function delete($id)
    {

        //トランザクション開始
        DB::beginTransaction();
        try{
            
        //渡されてきた記事IDのデータを取得
        $project  = Memo::find($id);
        $projectid = $project->project_id;
        
        //dd($project);
        //記事削除処理
        $project->delete();

        //トランザクションコミット
        DB::commit();
        }catch(\Exception $e) {
            // トランザクションロールバック
            DB::rollBack();
            
            //ログ出力
            Log::debug($e);

            //エラー画面遷移
            abort(500);
        }

        /*return redirect()->route('memo.index',[
            'id'=>$project,
        ]);*/

        return redirect()->route('memo.index',$projectid);

    }
/**
 * メモ検索画面
 */
    public function search()
    {
   

        $projects = Auth::user()->projects->all();
        // Auth::user()は現在認証されているユーザーを表すオブジェクトを返す。
        
        //dd($projects);
        return view('memo.search',
    compact('projects'));
    }
    /** 
     * メモ検索処理
    */
    public function keyword(Request $request)
    //検索フォームから送信された検索キーワードを取得する。検索フォームからPOST,
    // またはGETde送信された検索キーワードをlaravelのrequestクラスを使用して取得する
    {
        $projects = Auth::user()->projects->all();
        $keyword = $request->input('memo_name');
        // HTTPリクエストの中からkeywordというキーを持つ値を取得するためのメソッドがinputメソッド
        // $requestはIlluminate\Http\RequestクラスのインスタンスでHTTPリクエストに関する情報を扱うためのクラス
       // dd($keyword);
  
        $memo = Memo::where('memo_name','like',
    '%' .$keyword. '%')
    ->orWhere('project_name', 'like', '%' . $keyword . '%')
    ->join('projects','memos.project_id','=','projects.id' )
  
    // memosテーブルとprojectsテーブルをproject_id絡むを使って内部結合している。内部結合とは二つのテーブルの共通のレコードを結合することで、新しいテーブルを作成している。
    ->get();
    // dd($posts);
        // Memoモデルに対してwhereメソッドを呼び出して'memo_name'カラムに対してlike条件を出している'％'はワイルカード文字で
        // 、キーワードの前後につけることにより、キーワードに含む任意の文字列を検索対象に含めることができる。
        //次にgetメソッドを呼び出して、検索条件にマッチするすべての記事を取得する。取得した結果は$posts変数に代入される。
//like条件はSQLの条件式の一つで、文字列の一部分を検索するために使用される。例えばlike'%apple%'のようにパターンに含まれる'%'をワイルドカード文字として使用することもできる。
    return view('memo.keyword',['posts' => $memo, 'keyword' => $keyword],compact('projects'));
    // 第二引数にビューで使用する変数を連想配列として指定しているこの場合$postsは検索結果の投稿データを、$keywordは検索に使用したキーワードを格納している。
}
}
