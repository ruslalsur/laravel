@extends('layouts.main')

@section('title')Идентификация@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h1 class="py-4">Авторизация пользователя</h1>
        <form action="{{ route('auth.login') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="regEmail">@email</label>
                </div>
                <input name="logEmail" value="{{ old('logEmail') }}" type="email" class="form-control" id="regEmail" placeholder="адрес электронной почты"
                       aria-describedby="emailHelp">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="loginPassword">пароль</label>
                </div>
                <input name="logPassword" value="{{ old('logPassword') }}" type="password" class="form-control" id="loginPassword" placeholder="введите пароль">
            </div>

            <div class="mb-3 form-group form-check">
                <input name="logRememberMe" value="{{ old('logPassword2') }}" type="checkbox" class="form-check-input" id="loginCheck">
                <label class="form-check-label" for="exampleCheck1">Запомнить</label>
            </div>

            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
@endsection
