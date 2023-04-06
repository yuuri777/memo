@extends('layouts.memolayout')
@section('title')
    プロジェクト作成
@endsection

@section('content')
<div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">メモ</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('memo.store', $currentProjectid) }}">
                            @csrf
                            <div class="form-group d-flex flex-column flex-md-row">
                                <label for="memo_name" class="col-md-4 col-form-label text-md-right">メモ：</label>
                                <div class="col-md-6">
                                <textarea id="memo_name" class="form-control @error('memo_name') is-invalid @enderror" name="memo_name" required autocomplete="memo_name" autofocus rows="5" cols="5" style="word-wrap: break-word; white-space: pre-wrap; " >{{ old('memo_name') }}</textarea>

                                    @error('memo_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                           

                            <div class="form-group d-flex mt-3 mb-0">
                                <div class="col-md-10 col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">作成</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection