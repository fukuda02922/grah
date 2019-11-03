@extends('layouts.default')

@section('title', 'Blog 詳細')

@section('content')
    <h2>
        <div class="row">
            <div class="col-md-12">
                {{ $post->title }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <a href="#{{ $post->image_url }}"><img style="width: 100px; height: auto;"
                                                       src="{{ url($post->image_url) }}"></a>
                <a id="{{$post->image_url}}" href="#close" class="lb"><img src="{{ url($post->image_url) }}"></a>
            </div>
            <div class="col-md-2" style="position: relative;">
                <input type="button" style="position:absolute;bottom: 0;"
                       onClick="location.href='{{ Auth::check()?url('/mypage') : url('/') }}'"
                       class="btn fs12 font-weight-bold" value="戻る">
            </div>
        </div>
    </h2>
    <p>{!! nl2br(e($post->body)) !!}</p>
    <div class="row">
        <div class="col-md-10" style="padding-top: 30px;">
            <div class="comment" style="margin-bottom: 0px; border-top-left-radius: 10px;border-top-right-radius: 10px">
                <h5>コメント</h5>
            </div>
            <div class="comment pre-scrollable"
                 style="margin-top: 0px;margin-bottom: 5px; border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
                <ul>
                    @forelse($post->comments as $comment)
                        @if(Auth::user()->user_id != $comment->user_id)
                            <div class="baloon6">
                                <div class="faceicon">
                                    {{ $comment->user_id }}
                                </div>
                                <div class="chatting">
                                    <div class="says">
                                        <p>{{ $comment->body }}</p>
                                    </div>
                                </div>
                            </div>
                        @elseif(Auth::user()->user_id == $comment->user_id)
                            <div class="baloon6">
                                <div class="mycomment">
                                    <form action="{{ action('CommentsController@destroy', [$post->id, $comment->id]) }}"
                                          id="form_{{$comment->id}}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <p data-id="{{ $comment->id }}"
                                           onclick="deleteComment(this);">{{ $comment->body }}</p>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @empty
                        <li>コメントはありません</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    新規コメント
                </div>
                <div class="panel-body">
                    @if(Auth::check())
                        <form method="post" action="{{ action('CommentsController@store', $post->id) }}"
                              onsubmit="disableSubmit(this)">
                            {{ csrf_field() }}
                            <p>
                                <textarea class="form-control" name="body" placeholder="コメント"
                                          value="{{ old('body') }}"></textarea>
                                @if ($errors->has('body'))
                                    <span class="error">{{ $errors->first('body') }}</span>
                                @endif
                            </p>
                            <p>
                                <input class="form-control btn btn-sm btn-block btn-primary" type="submit"
                                       value="コメント送信">
                            </p>
                        </form>
                    @else
                        <a href="{{ url('login') }}"><span
                                    class="text-info">コメントを入力するにはログインを行ってください。</span></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteComment(e) {
            'use strict';

            if (confirm('are you sure ?')) {
                document.getElementById('form_' + e.dataset.id).submit();
            }
        }
    </script>

@endsection
