@extends('layouts.main')

@section('title'){{ $currentCategoryName }}@endsection

@section('content')
    <div class="content">
        <h4 class="mb-3">Новости по категории <strong>{{ $currentCategoryName }} </strong></h4>

        <div class="shadow p-3 mb-3 bg-white rounded">
            @forelse($currentCategoryNews as $newsOne)
                @isset($authorizedUserInfo)
                    <a class="nav-link font-weight-bolder" href="{{ route('newsOne', $newsOne['id']) }}">
                        <span class="text-secondary">{{ $newsOne['date'] }}</span> {{ $newsOne['title'] }}</a>
                @else
                    @if($newsOne['isPrivate'])
                        <a class="nav-link font-weight-bolder" href="{{ route('auth.login') }}">
                            <span class="text-secondary ">{{ $newsOne['date'] }}</span>
                            {{ $newsOne['title'] }}<span class="badge badge-danger">приватная</span></a>
                    @else
                        <a class="nav-link font-weight-bolder" href="{{ route('newsOne', $newsOne['id']) }}">
                            <span class="text-secondary ">{{ $newsOne['date'] }}</span>
                            {{ $newsOne['title'] }}</a>
                    @endif
                @endisset
            @empty
                <h4>Ничего новенького</h4>
            @endforelse
        </div>
    </div>
@endsection
