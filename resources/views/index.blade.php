@extends('layouts.main')

@section('title')@parentприветствия@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h1 class="mt-3 mb-5">Агрегатор новостей глубокого погружения</h1>

        <div class="row container vw-100 justify-content-between">
            <div class="col-6 shadow-sm p-3 mb-3 bg-white rounded">
                <h4>
                    <small>логин</small>
                    <small class="text-danger">(пароль)</small>
                    admin@admin.com
                    <small class="text-danger">(123)</small>
                </h4>
                <h4>
                    <small>логин</small>
                    <small class="text-danger">(пароль)</small>
                    user@user.com
                    <small class="text-danger">(123)</small>
                </h4>
            </div>

            <div class="d-flex flex-column align-items-center px-auto col-2 shadow-sm p-3 mb-3 bg-white rounded">
                <h4>
                    <small>новостей</small>
                </h4>
                <h4>
                    {{ \App\News::all()->count() }}
                </h4>
            </div>
            <div class="col-3 pr-0">
                <img class="embed-responsive rounded" src="{{ asset('storage/images/img1.jpg') }}" alt="img1.jpg" width="100vh" height="100vh">
            </div>
        </div>

        <div class="shadow-sm p-3 my-3 bg-white rounded shadow">
            <h4>Реализованный функционал</h4>
            <hr>
            <div class="pl-4">
                <p>- CRUD новостей</p>
                <p>- CRUD категорий</p>
                <p>- CRUD пользователей</p>
                <p>- CRUD источников</p>
                <p>- личный кабинет авторизовавшегося пользователя</p>
                <p>- парсинг новостей с использованием очередей (проверка на уникальность)</p>
                <p>- авторизация через yandex или github</p>
                <p>- приватные новости доступны только авторизававшимся пользователям</p>
            </div>
        </div>
    </div>
@endsection
