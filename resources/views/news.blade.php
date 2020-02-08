@extends('layouts.main')

@section('content')
    <div class="content py-3">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4 class="mt-3 mb-5">Новости по категории <strong>{{ $categoryName }}</strong></h4>

            @forelse($currentCatNews as $news)
                <a class="nav-link" href="{{ route('newsOne', $news['id']) }}">{{ $news['title'] }}</a>
            @empty
                <h5>в категории пока нет новостей</h5>
            @endforelse

        </div>
    </div>
@endsection
