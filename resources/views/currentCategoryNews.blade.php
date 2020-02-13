@extends('layouts.main')

@section('title'){{ $currentCategoryName }}@endsection

@section('content')
    <div class="content">
        <h4 class="mb-3">Новости по категории <strong>{{ $currentCategoryName }} </strong></h4>

        <div class="shadow p-3 mb-3 bg-white rounded">
            @forelse($currentCategoryNews as $newsOne)
                @if($newsOne['isPrivate'])
                    <a class="nav-link text-danger font-weight-bolder" href="{{ route('login') }}">
                        <span class="text-secondary ">{{ $newsOne['date'] }}</span>
                        {{ $newsOne['title'] }}
                        <span class="badge badge-secondary">приватная</span>
                    </a>
                @else
                    <a class="nav-link font-weight-bolder" href="{{ route('newsOne', $newsOne['id']) }}">
                        <span class="text-secondary ">{{ $newsOne['date'] }}</span>
                        {{ $newsOne['title'] }}
                    </a>
                @endif
            @empty
                <h4>Ничего новенького</h4>
            @endforelse
        </div>
    </div>
@endsection
