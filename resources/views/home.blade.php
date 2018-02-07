@extends('layouts.default')

@section('content')
    <div class="content">
    @foreach ($posts as $post)
        <div class="content">
            <a href="{{ route('post.show', ['id' => $post->id]) }}">
                <h1 class="title">{{ $post->title }}</h1>
            </a>

            <span>{{ $post->content_preview }}</span>
        </div>
    @endforeach
    </div>
    {{ $posts->render() }}
@endsection