@extends('layouts.main')

@section('title')@parentприветствия@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content" xmlns="http://www.w3.org/1999/html">
        <h1 class="mt-3 mb-5">Добро пожаловать!</h1>

        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <h4>
                <small>логин</small>
                <small class="text-danger">(пароль)</small>
                admin@admin.com
                <small class="text-danger">(123)</small>
            </h4>
        </div>
    </div>
@endsection
