@extends('layouts.main')

@section('title')@parentприветствия@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h1 class="mt-3 mb-5">Добро пожаловать!</h1>

        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <h4><small class="text-primary">логины:</small> admin@admin.com | user@user.com</h4>
        </div>
        <div class="shadow p-3 mb-4 bg-white rounded">
            <h4><small class="text-danger">пароли:</small> admin | user</h4>
        </div>


    </div>
@endsection
