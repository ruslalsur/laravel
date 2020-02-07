@extends('layouts.main')

@section('content')
    <div class="content py-3">


        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4 class="mt-3 mb-5">Категории</h4>

            @foreach($categories as $category)
                <a class="nav-link" href="{{ route('currentCat', $category['id']) }}">{{ $category['name'] }}</a>
            @endforeach
        </div>
    </div>

@endsection
