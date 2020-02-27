@extends('layouts.main')

@section('title')@parent подробностей@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h4 class="my-4">Новость из категории
            <a class="text-decoration-none"
{{--               href="{{ route('news.currentCategory', $newsOne->category_id) }}">--}}
                >"{{ $categoryName }}"
            </a>
            от <small>{{ date("d.m.Y", strtotime($newsOne->event_date)) }}</small>
        </h4>
{{--@dd($newsOne);--}}
        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <h3 class="mt-0 mb-3 ml-2">{{ $newsOne->title }}</h3>
            <div class="row">
                <div class="d-flex flex-column justify-content-between col-3 mb-1">
                    <img src="{{  $newsOne->image ? asset($newsOne->image) : asset('img/no-image.png') }}" alt="image"
                         class="embed-responsive mt-2 card-img">
                    <div class="mt-2">
                        @isset($authorizedUserInfo)
                            <a class="embed-responsive btn btn-outline-primary"
                               href="{{ route('news.download', $newsOne->id) }}">
                                Скачать
                            </a>
                        @endisset
                        @isset($authorizedUserInfo)
                            @if($authorizedUserInfo['role'] == 'admin')
                                <a class="mb-2 mt-4 embed-responsive btn btn-primary shadow"
                                   href="{{ route('admin.edit', $newsOne->id) }}">
                                    Изменить
                                </a>
                                <a class="embed-responsive font-weight-bolder btn btn-danger shadow-sm"
                                   href="{{ route('admin.delete', $newsOne->id) }}"
                                   data-toggle="tooltip" data-placement="bottom"
                                   title="удаление текущей новости совсем (категория при удалении не затрагивается)">
                                    Удалить
                                </a>
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
