@extends('layouts.main')

@section('title'){{ $currentCategoryName }}@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h4 class="my-4">Новости из категории <span class="text-primary">{{ $currentCategoryName }} </span></h4>

        <div class="shadow p-3 mb-3 bg-white rounded">
            @forelse($currentCategoryNews as $newsOne)
                @isset($authorizedUserInfo)
                    <a class="nav-link font-weight-bolder" href="{{ route('news.newsOne', $newsOne->id) }}">
                        <small class="mr-2 text-secondary">{{ date("d.m.Y", strtotime($newsOne->event_date)) }}</small> {{ $newsOne->title }}</a>
                @else
                    @if($newsOne->isPrivate)
                        <a class="nav-link font-weight-bolder" href="{{ route('auth.login') }}">
                            <small class="mr-2 text-secondary ">{{ date("d.m.Y", strtotime($newsOne->event_date)) }}</small>
                            {{ $newsOne->title }} <span class="badge badge-danger">приватная</span></a>
                    @else
                        <a class="nav-link font-weight-bolder" href="{{ route('news.newsOne', $newsOne->id) }}">
                            <small class="mr-2 text-secondary ">{{ date("d.m.Y", strtotime($newsOne->event_date)) }}</small>
                            {{ $newsOne->title }}</a>
                    @endif
                @endisset
            @empty
                <h4>Ничего новенького</h4>
            @endforelse
        </div>
    </div>
@endsection
