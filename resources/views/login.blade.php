@extends('layouts.main')

@section('content')
    <div class="content py-4">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Адрес электронной почты</label>
                <input type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Мы никадаНикадаНикамуНичего не расскажем про этот адрес.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input type="password" class="form-control" id="LoginPassword">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="loginCheck">
                <label class="form-check-label" for="exampleCheck1">Запомнить</label>
            </div>
            <button type="submit" class="btn btn-primary">Вход</button>
        </form>
    </div>
@endsection
