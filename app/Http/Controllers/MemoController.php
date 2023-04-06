<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Memo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMemoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MemoController extends Controller
{
    /**
     * タイトルに紐づくタスク一覧
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



        //取得したプロジェクトに紐づくタスクを取得
        if($project){
        $memos = $project->memos->all();
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

    // タスク作成画面
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
 * メモ削除処理
 */
    public function delete($id)
    {

        //トランザクション開始
        DB::beginTransaction();
        try{
        //渡されてきた記事IDのデータを取得
        $project  = Memo::find($id);

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

        return redirect()->route('memo.index',[
            'id'=>$project,
        ]);

    }
}
