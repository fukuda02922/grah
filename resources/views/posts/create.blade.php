@extends('layouts.default')

@section('title', '新規作成')

@section('content')
    <h2>
        <input type="button" onClick="location.href='{{ url('/mypage') }}'"
               class="btn btn-sm pull-right fs12 font-weight-bold" value="戻る">
        新規作成
    </h2>
    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ url('/posts') }}"
          onsubmit="disableSubmit(this)">
        {{ csrf_field() }}
        <p>
            <input class="form-control" type="text" name="title" placeholder="タイトル" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif
        </p>

        <p>
            <textarea class="form-control" name="body" placeholder="内容" value="{{ old('body') }}"></textarea>
            @if ($errors->has('body'))
                <span class="help-block">{{ $errors->first('body') }}</span>
            @endif
        </p>
            <div id="drag-drop-area">
                <div class="drag-drop-inside">
                    <p class="drag-drop-info">ここにファイルをドロップ</p>
                </div>
            </div>
        <input id="fileInput" type="file" value="ファイルを選択" name="image">

        <input class="btn btn-sm btn-block btn-primary" type="submit" value="新規作成">
    </form>
@endsection
