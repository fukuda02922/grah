@extends('layouts.default')

@section('title', 'Post編集')

@section('content')
    <h2>
        <input type="button" onClick="location.href='{{ url('/mypage') }}'"
               class="btn btn-sm pull-right fs12 font-weight-bold" value="戻る">
        Post編集
    </h2>
    <form method="post" action="{{ url('/posts', $post->id) }}" onsubmit="disableSubmit(this)">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <p>
            <input class="form-control" type="text" name="title" placeholder="title"
                   value="{{ old('title', $post->title) }}">
            @if ($errors->has('title'))
                <span class="error">{{ $errors->first('title') }}</span>
            @endif
        </p>

        <p>
            <textarea class="form-control" name="body" placeholder="body">{{ old('body', $post->body) }}</textarea>
            @if ($errors->has('body'))
                <span class="error">{{ $errors->first('body') }}</span>
            @endif
        </p>

        <p>
            <input class="btn btn-sm btn-block btn-primary" type="submit" value="更新">
        </p>
    </form>
@endsection
