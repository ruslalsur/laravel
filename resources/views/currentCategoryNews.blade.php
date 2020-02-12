@extends('layouts.main')

@section('content')
    <div class="content">
        <h4 class="mb-3">Новости по категории <strong>{{ $categoryName }} </strong></h4>

        <div class="shadow p-3 mb-3 bg-white rounded">
            @foreach($news as $key => $newsOne)
                @if($newsOne['category_id'] == $category_id)
                    <a class="nav-link font-weight-bolder" href="{{ route('newsOne', $key) }}">
                        <span class="text-secondary ">{{ $newsOne['date'] }}</span>
                        {{ $newsOne['title'] }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@endsection
