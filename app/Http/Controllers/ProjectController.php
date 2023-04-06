<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Memo;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ProjectController extends Controller
{
    
    /**
     * プロジェクト一覧画面
     */
    public function index()
        {
            //ログインユーザーが作成した全てのプロジェクトを取得
            // Auth::user()と記述することによりログインユーザー情報を取得できる
            $projects = Auth::user()->projects->all();
            // projectsテーブルの情報を取得できる。ここでuserモデルに定義したprojectsメソッドを使用できる。
        
            return view('projects.index',compact('projects'));
            //取得したプロジェクトじょうほうをcompact関数を使用してビューに渡している。
        }
        /**
         * プロジェクト作成画面
         */
        public function create()
        {
            $projects = Auth::user()->projects->all();
            return view('projects.create',compact('projects'));
        }
        /**
         * プロジェクト作成処理
         */
        public function store(StoreProjectRequest $request)
        // フォームで入力された値は$requestという引数で受け取っている。
        {
            //トランザクション
            DB::beginTransaction();

            try{
            //プロジェクト作成処理
            $project = Project::create([
                'project_name' => $request->project_name,
                //フォームで入力された値をproject_nameというカラムに入れる
                //’project_name’にはフォームで入力された値を入れている
                'user_id' => Auth::id(),
                // 'user_id'には現在ログインしているユーザーIDを入れている
                //Auth::idと記述することでログインしているユーザーのIDを取得することができる
          
            ]);
            //トランザクションコミット
            DB::commit();
        }catch(\Exception $e) {
            // トランザクションロールバック
            DB::rollback();

            //ログ出力
            Log::debug($e);

            //エラー画面遷移
            abort(500);

        }
            return redirect()->route('projects.index');
        }
        public function delete($id)
    {

        //トランザクション開始
        DB::beginTransaction();
        try{
            $memos = Memo::where('project_id', $id)->get();
           
            if($memos){
                foreach ($memos as $memo){
                $memo->delete();
                }
                    }else{
                        dd($memos);
                        /*ずっとタイトルを削除するには子テーブルのメモデータも消さないといけませんよと出ていた。
                        なんとか小テーブルも消そうとしたけど500エラーが出てしまっていた。
                        結論としては小テーブルのデータは一つではないため、foreach文を使って小テーブルのデータをすべて消した後に
                        親テーブルも消すということだった*/
                        
                    }
        //渡されてきた記事IDのデータを取得
        $project  = Project::find($id);
        
            
        //記事削除処理
        $project->delete();
        //記事削除処理
      

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

        return redirect()->route('projects.index');

    }
}
