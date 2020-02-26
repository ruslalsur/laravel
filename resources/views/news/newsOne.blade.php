@extends('layouts.main')

@section('title')@parent подробностей@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h4 class="my-4">Новость из категории
            <a class="text-decoration-none"
               href="{{ route('news.currentCategory', $newsOne->category_id) }}">
                "{{ $categoryName }}"
            </a>
            от <small>{{ date("d.m.Y", strtotime($newsOne->date)) }}</small>
        </h4>

        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <h3 class="mt-0 mb-3 ml-2">{{ $newsOne->title }}</h3>
            <div class="row">
                <div class="d-flex flex-column justify-content-between col-3 mb-1">
                    <img src="{{  $newsOne->image ? asset($newsOne->image) : asset('img/no-image.png') }}" alt="image" class="embed-responsive mt-2 card-img">
                    <div class="mt-2">
                        @isset($authorizedUserInfo)
                            <a class="embed-responsive btn btn-sm btn-outline-primary mb-2 "
                               href="{{ route('news.download', $newsOne->id) }}">
                                Скачать
                            </a>
                        @endisset
                        @isset($authorizedUserInfo)
                            @if($authorizedUserInfo['role'] == 'admin')
                                <a class="embed-responsive btn btn-primary shadow"
                                   href="{{ route('admin.show', $newsOne->id) }}">Редактор</a>
                            @endif
                        @endisset
                    </div>
                </div>
                <div class="col-9">
                    {{ $newsOne->description }}
                </div>
            </div>


        </div>
    </div>
@endsection
