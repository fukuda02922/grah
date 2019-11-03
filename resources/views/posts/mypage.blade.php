@extends('layouts.default')

@section('title', 'マイページ')

@section('content')
    <h2>
        <input type="button" onClick="location.href='{{ url('/posts/create') }}'"
               class="btn btn-sm pull-right fs12 font-weight-bold" value="新規作成">
        Posts
    </h2>
    <table class="table table-inverse">
        <thead>
        <tr>
            <th>サムネイル</th>
            <th>タイトル</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                @if($post->image_url)
                    <td><a href="#{{ $post->image_url }}"><img style="width: 100px; height: auto;"
                                                               src="{{ url($post->image_url) }}"></a>
                        <a id="{{$post->image_url}}" href="#close" class="lb"><img
                                    src="{{ url($post->image_url) }}"></a></td>
                @else
                    <td>-</td>
                @endif
                <td><a class="text-light" href="{{action('PostsController@show', $post->id)}}">
                        {{$post->title}}</a></td>
                <td><img src="{{ asset('image/editicon.png') }}"
                         onclick="location.href='{{action('PostsController@edit', $post->id)}}'"></td>
                <td>
                    <form action="{{ action('PostsController@destroy', $post->id) }}"
                          id="form_{{$post->id}}" method="post" style="display:inline">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <img src="{{ asset('image/deleteicon.png') }}" href="#" data-id="{{ $post->id }}"
                             onclick="deletePost(this);">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
            @endforelse
            </div>
        </tbody>
    </table>
    <script>
        function deletePost(e) {
            'use strict';

            if (confirm('are you sure ?')) {
                document.getElementById('form_' + e.dataset.id).submit();
            }
        }
    </script>
@endsection

@section('subContent')


@endsection