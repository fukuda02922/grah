@extends('layouts.default')

@section('title', 'トップページ')

@section('content')
    <h2 style="position: relative">
        Posts
        <form style="font-size: 15px;position: absolute; bottom: 5px;right: 0;" id="size" method="post"
              action="{{ url('/posts/size') }}" onsubmit="disableSubmit(this)">
            {{ csrf_field() }}
            <label>表示件数</label>
            <select data-id="size" name="size" required onchange="submit()">
                <option value=""></option>
                <option value="10">１０件</option>
                <option value="50">５０件</option>
                <option value="100">１００件</option>
                <option value="all">全件</option>
            </select>
        </form>
    </h2>
    <table class="table table-inverse">
        <thead>
        <tr>
            <th>サムネイル</th>
            <th>ユーザー名</th>
            <th>タイトル</th>
        </tr>
        </thead>
        <tbody>
        <div>

            @forelse($posts as $post)
                <tr>
                    @if($post->image_url)
                        <td><img class="img-thumbnail" style="width: 100px; height: auto;"
                                 src="{{ url($post->image_url) }}" alt="logo"></td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{$post->user_id}}</td>
                    <td><a class="text-light" href="{{action('PostsController@show', $post->id)}}">
                            {{$post->title}}</a></td>
                </tr>
            @empty
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            @endforelse
        </div>
        </tbody>
    </table>
    {{ $posts->fragment('foo')->links() }}
    <script>
        function submit(e) {
            'use strict';
            document.getElementsByClassName(e.dataset.id).submit;
        }
    </script>
@endsection