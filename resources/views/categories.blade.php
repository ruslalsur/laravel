@extends('layouts.main')

@section('content')
    <div class="content">
        <h4 class="mt-3 mb-4">Категории</h4>

        <div class="shadow p-3 mb-5 bg-white rounded">
            @foreach($categories as $key => $category)
                <a class="nav-link font-weight-bolder"
                   href="{{ route('currentCategory', $key) }}">{{ $category['name'] }}</a>
            @endforeach
        </div>
    </div>
@endsection
