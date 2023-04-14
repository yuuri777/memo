@extends('layouts.layout')
@section('title')
    メモ作内容更新
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>メモ編集フォーム</h2>
            <form method="POST" action="{{ route('memo.update', $project->id) }}">
                @csrf
                <div class="form-group">
                    <label for="title">
                        メモ
                    </label>
                </div>
                <div class="form-group mt-3">
                    <textarea id="content" name="content" class="form-control" rows="4">{{ old('content', $project->memo_name) }}</textarea>
                    <!-- old関数の第一引数にはフォームフィールドの名前を指定、代位に引数には以前のリクエストで値が見つからなかった場合にデフォルト値として使用する値 -->
                    @if ($errors->has('content'))
                        <div class="text-danger">
                            {{ $errors->first('content') }}
                        </div>
                    @endif
                </div>
                <div class="mt-3">
                    <a class="btn btn-secondary mr-2" href="{{ route('memo.index',$project->id) }}">
                        キャンセル
                    </a>

                    
                    <button type="submit" class="btn btn-primary"  data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        目次
                    </button>
                    <button type="submit" class="btn btn-primary">
                        更新
                    </button>
                    
 
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="position: absolute; top: 100%;">
                    <a class="dropdown-item" id="h1btn" >h1の見出し</a>
                    <a class="dropdown-item" id="h2btn" href="{{ route('memo.index',$project->project_id) }}">h2の見出し</a>
                    <a class="dropdown-item" id="h3btn" href="#">h3の見出し</a>
                </div>


                </div>
            </form>
        </div>
    </div>
@endsection
<script>
    
    window.addEventListener('DOMContentLoaded',event =>{
        let textareaValue = document.querySelector('#content').value;
        console.log(textareaValue);
        const h2Element = document.createElement('h2');
        console.log(h2Element);
        const h1btn = document.getElementById('h2btn');
        
        
        h1btn.addEventListener('click',event => {
            console.log(h2Element);

        h2Element.textContent = textareaValue.textContent;
        // h2elementを作成して新しいh2タグを作る。変数spanelementに文章内のspanタグを参照する
        // h2elementのテキストコンテンツをspanelementのテキストコンテンツに設定する。spanelement脳やノードにアクセスして、h2elementでspanelementを置き換える。
        textareaValue.parentNode.replaceChild(h2Element,spanElement);
        // replaceChildメソッドは指定した要素を別の要素で置き換えるために使用される。
        // このメソッドは親要素のメソッドで親要素に対して呼び出される。第一引数には新しい要素、第二引数には置き換える古い要素が指定される。
    });
    })
</script>