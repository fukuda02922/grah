@extends('layouts.default')

@section('title', '新規登録')

@section('content')
    <h2 class="border-bottom-0">
        <input type="button" onClick="location.href='{{ url('/') }}'"
               class="btn btn-sm pull-right fs12 font-weight-bold" value="戻る">
        新規登録
    </h2>

    <form action="{{url('/posts/signup/registration')}}" method="post">
        <p>
            <input class="form-control" type="text" name="user_id" placeholder="user_id" value="{{ old('user_id') }}">
            @if ($errors->has('title'))
                <span class="text-danger">{{ $errors->first('title') }}</span>
            @endif
        </p>

        <p>
            <textarea class="form-control" name="body" placeholder="body" value="{{ old('body') }}"></textarea>
            @if ($errors->has('body'))
                <span class="text-danger">{{ $errors->first('body') }}</span>
            @endif
        </p>

        <p>
            <input class="btn btn-sm btn-block btn-primary" type="submit" value="新規作成">
        </p>

    </form>


@endsection