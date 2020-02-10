@extends('layouts.main')

@section('content')
    <div class="content">
        <h4 class="mb-3">Новости по категории <strong>{{ $categoryName }} </strong></h4>

        <div class="shadow p-3 mb-3 bg-white rounded">
            @forelse($currentCatNews as $news)
                <a class="nav-link font-weight-bolder" href="{{ route('newsOne', $news['id']) }}">
                    <span class="text-secondary ">{{ $news['date'] }}</span>
                    {{ $news['title'] }}
                </a>
            @empty
                <h5>в категории пока нет новостей</h5>
            @endforelse
        </div>
    </div>
@endsection
