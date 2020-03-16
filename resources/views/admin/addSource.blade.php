@extends('layouts.main')

@section('title')@parentдобавления источника@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="py-4">Добавление источника новостей</h1>
        <form action="{{ route('admin.source.store') }}" method="post">
            @csrf

            {{--            наименование источника--}}
            <label for="basic-name">Название источника</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Источник</span>
                </div>
                <input type="text" name="name" class="form-control" id="basic-name" aria-label="Sizing example input"
                       value="{{ old('name') }}" aria-describedby="nameValidateBlock">
            </div>
            @if($errors->has('name'))
                <small id="nameValidateBlock" class="form-text text-danger">
                    @foreach($errors->get('name') as $error)
                    {{ $error }}&NoBreak;
                    @endforeach
                </small>
            @endif

            {{--            адрес источника--}}
            <label for="basic-url">Адрес источника</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">https://news.yandex.ru/auto.rss</span>
                </div>
                <input type="text" name="url" class="form-control" id="basic-url"
                       value="{{ old('url') }}" aria-describedby="urlValidateBlock">
            </div>
            @if($errors->has('url'))
                <small id="urlValidateBlock" class="form-text text-danger">
                    @foreach($errors->get('url') as $error)
                    {{ $error }}&NoBreak;
                    @endforeach
                </small>
            @endif

            {{--            кнопка--}}
            <button type="submit" class="btn btn-primary mt-4">Добавить источник</button>
        </form>
    </div>
    <script src={{asset("js/ckeditor4/ckeditor.js")}}></script>
@endsection
