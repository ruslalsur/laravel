@extends('layouts.main')

@section('title')@parent подробностей@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h4 class="mt-3 mb-3">Новость из категории
            <a class="btn btn-secondary btn" href="{{ route('currentCategory', $newsOne['category_id']) }}">
                <span class="font-weight-bolder lead">{{ $categoryName }}</span>
            </a> от {{ $newsOne['date'] }}
            @isset($authorizedUserInfo)
                <a class="ml-3 btn btn-sm btn-outline-primary btn"
                   href="{{ route('download', $newsOne['id']) }}">
                    скачать новость
                </a>
            @endisset
        </h4>

        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <h5><strong>{{ $newsOne['title'] }}</strong></h5>
            <h6> {{ $newsOne['description'] }} </h6>
        </div>
    </div>
@endsection
