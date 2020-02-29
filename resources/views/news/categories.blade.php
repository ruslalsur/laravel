@extends('layouts.main')

@section('title')@parentкатегорий@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h3 class="mt-3 mb-4">Категории новостей</h3>
        <div class="shadow p-3 mb-5 bg-white rounded">
            @foreach($categories as $category)
                <a class="nav-link font-weight-bolder"
                   href="{{ route('news.currentCategory', $category) }}">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
@endsection
