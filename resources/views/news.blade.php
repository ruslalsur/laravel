@extends('layouts.main')

@section('content')
    <div class="content py-3">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4 class="mt-3 mb-5">Новости по категории <strong>{{ $category }}</strong></h4>

            @foreach($currentCatNews as $news)
                <a class="nav-link" href="{{ route('home') }}">{{ $news['title'] }}</a>
            @endforeach
        </div>
    </div>
@endsection
