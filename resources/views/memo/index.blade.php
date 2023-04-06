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
            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
          </form>
        </li>
      @endforeach
      
    </ul>
  </div>
@endsection