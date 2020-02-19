@extends('layouts.main')

@section('title')Регистрация@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h1 class="py-4">Регистрация пользователя</h1>
        <form action="{{ route('auth.reg') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="regEmail">@email</label>
                </div>
                <input name="regEmail" type="email" class="form-control" id="regEmail" placeholder="адрес электронной почты"
                       aria-describedby="emailHelp">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="loginPassword">пароль</label>
                </div>
                <input name="regPass1" type="password" class="form-control" id="loginPassword" placeholder="введите пароль">

                <input name="regPass2" type="password" class="form-control" id="loginPassword2" placeholder="повторите пароль">
            </div>

            <button type="submit" class="btn btn-danger font-weight-bolder">Зарегистрировать</button>
        </form>
    </div>
@endsection
