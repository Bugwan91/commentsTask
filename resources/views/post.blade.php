@extends('layouts.default')

@section('content')
    <div>
        <h1 class="title">{{ $post->title }}</h1>
        <div class="content">
            {{ $post->content }}
        </div>
        <hr>
        <div id="comments_wrapper">
            <comments_wrapper post-id="{{ $post->id }}"></comments_wrapper>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let user = {
        @if (Auth::id())
            id: '{{ Auth::id() }}',
            name: '{{ Auth::user()->name }}',
        @endif
        };
    </script>
    <script src="/js/post.js"></script>
@endsection