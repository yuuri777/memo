@extends('layouts.memolayout')

@section('title', 'メモ一覧')

@section('content')

  <div class="container-fluid">
    @if ($project)
    <h1 class="mt-4">{{ $project->project_name }}</h1>
    @endif
    <ul>
      @foreach ($memos as $memo)
        <li class ="d-flex justify-content-between">
        <span style="overflow-wrap: break-word; overflow: hidden; display: inline-block; max-width: 100%;">{{ $memo->memo_name }}</span>
          <form action="{{ route('memo.delete', ['id' => $memo->id]) }}" method="POST" style="display: inline;">
          <!-- ['id' => $memo->id]は、配列の形式でidというキーに$memoオブジェクトのidプロパティの値をセットしたもの だからidにはめものidが入っている-->
          @csrf
            @method('DELETE')
            <div class="parent-element">
            <button class="delete-btn"  onclick="return confirm('本当に削除しますか？')">-</button>
           <!-- btn-dangerクラスは赤色のボタンを表示するためのスタイルクラス --> 

</div>
          </form>

        </li>
      @endforeach
      
    </ul>
  </div>
@endsection

  <script>
 window.addEventListener('DOMContentLoaded', event => {
//idが#でクラスが.
// Toggle the side navigation
const editbtn = document.body.querySelector('#edit-btn');
const deletebtn = document.body.querySelectorAll('.delete-btn');

if (editbtn) {
    
  editbtn.addEventListener('click', event => {
        event.preventDefault();// イベント処理において、ブラウザがデフォルトで行うべき動作をキャンセルするためメソッド
        
        for (let i = 0; i < deletebtn.length; i++) {
  deletebtn[i].classList.toggle('none-btn');
}        // sb-sidenav-toggledというクラスが含まれている場合はそのクラスを削除して、含まれていない場合は追加する
        
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('edit-btn'));
        // localStorage.setItemメソッドを使って'sb|sidebar-toggle'というキーにdocument.body.classList.contains('delete-btn')という値を保存するようになっている
        // localStorageはブラウザにデータを保存するためのAPI、ページを閉じたり再読み込みしても保存されたデータが保持される。
    
      });  
}
});
  </script>

