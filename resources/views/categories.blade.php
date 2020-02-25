@extends('layouts.main')

@section('title')@parentкатегорий@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h4 class="mt-3 mb-4">Выберите категорию новостей</h4>
        <div class="shadow p-3 mb-5 bg-white rounded">
            @foreach($categories as $category)
                <a class="nav-link font-weight-bolder"
                   href="{{ route('news.currentCategory', $category->id) }}">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
@endsection
