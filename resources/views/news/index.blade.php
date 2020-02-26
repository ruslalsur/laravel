@extends('layouts.main')

@section('title')@parentприветствия@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h1 class="mt-3 mb-5">Добро пожаловать!</h1>

        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <h4><small class="text-primary">логин</small><small class="text-danger">(пароль)</small>
                admin@admin.com(admin)</h4>
        </div>
        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <h4><small class="text-primary">логин</small><small class="text-danger">(пароль)</small>
                user@user.com(user)</h4>
        </div>


    </div>
@endsection
