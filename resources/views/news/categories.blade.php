@extends('layouts.main')

@section('title')@parentкатегорий@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h3 class="mt-3 mb-4">Категории новостей</h3>
        <div class="shadow p-3 mb-5 bg-white rounded">
            @isset($categories)
                @foreach($categories as $category)
                    <a class="nav-link font-weight-bolder d-flex align-items-end"
                       href="{{ route('news.currentCategory', $category) }}">
                        <img src="{{ asset($category->image) }}" class="mr-3" alt="{{ $category->image }}" height="25"
                             width="60">
                        {{ $category->name }}</a>
                @endforeach
            @else
                <h4>В агрегаторе пока отсутствуют новости</h4>
                <p class="text-danger">Необходимо получить новости из источников.</p>
            @endisset
        </div>
    </div>
@endsection
