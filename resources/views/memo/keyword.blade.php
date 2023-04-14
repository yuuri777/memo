@extends('layouts.layout')
@section('title')
    メモ検索結果
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>検索結果一覧</h2>
        <div class="table-responsive px-5">
            <table class="table table-bordered table-hover mx-auto">
                <thead class="bg-info text-light">
                    <tr>
                        <th scope="col">タイトル</th>
                        <th scope="col">内容</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td><a href="{{ route('memo.index',$post->id) }}">{{ $post->project_name }}</a></td>
                            <td>{{ $post->memo_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection