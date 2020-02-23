@extends('layouts.main')

@section('title')@parent подробностей@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h4 class="mt-3 mb-3">Новость из категории
            <a class="text-decoration-none"
               href="{{ route('news.currentCategory', $newsOne['category_id']) }}">
                "{{ $categoryName }}"
            </a>
            от {{ $newsOne['date'] }}
            @isset($authorizedUserInfo)
                <a class="btn btn-sm btn-outline-primary"
                   href="{{ route('news.download', $newsOne['id']) }}">
                    скачать в формате json
                </a>
            @endisset
        </h4>

        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <div class="media">
                <img src="{{  $newsOne['image'] ?? asset('img/no-image.png') }}" class="col-3 mr-3" alt="картинка">
                <div class="media-body">
                    <h5 class="mt-0">{{ $newsOne['title'] }}</h5>
                    {{ $newsOne['description'] }}
                </div>
            </div>
        </div>

        @isset($authorizedUserInfo)
            @if($authorizedUserInfo['role'] == 'admin')
                <a class="btn btn-danger shadow" href="{{ route('admin.show', $newsOne['id']) }}">изменить эту
                    новость</a>
            @endif
        @endisset
    </div>
@endsection
