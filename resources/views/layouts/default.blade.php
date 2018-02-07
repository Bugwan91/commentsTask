@extends('layouts.app')

@section('body')
    @include('layouts.partials.main_navbar')
    <div class="container">
        @yield('content')
    </div>
@endsection