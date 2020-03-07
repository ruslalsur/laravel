@extends('layouts.main')

@section('title')изменения учетных данных пользователя@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content">
        <h1 class="py-4">Изменение учетных данных пользователя</h1>
        <form action="{{ route('admin.updateProfile', $user) }}" method="post">
            @csrf

            {{--            имя--}}
            <div class="input-group mt-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="name">пользователь</label>
                </div>
                <input name="name" type="text" value="{{ old('name') ?? $user->name }}" class="form-control" id="name"
                       placeholder="как звать то"
                       aria-describedby="nameHelp">
            </div>
            @if($errors->has('name'))
                <small id="nameHelp" class="form-text text-danger">
                    @foreach($errors->get('name') as $error)
                    {{ $error }}&NoBreak;
                    @endforeach
                </small>
            @endif

            {{--            почта--}}
            <div class="input-group mt-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="email">@email</label>
                </div>
                <input name="email" type="email" value="{{ old('email') ?? $user->email }}" class="form-control"
                       id="email"
                       placeholder="адрес электронной почты"
                       aria-describedby="emailHelp">
            </div>
            @if($errors->has('email'))
                <small id="emailHelp" class="form-text text-danger">
                    @foreach($errors->get('email') as $error)
                    {{ $error }}&NoBreak;
                    @endforeach
                </small>
            @endif

            {{--            пароли--}}
            <div class="input-group mt-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="password">новый пароль</label>
                </div>
                <input name="password" type="password" class="form-control"
                       id="password" placeholder="оставьте пустым, чтобы сохранить старый" aria-describedby="passwordHelp">
            </div>
            @if($errors->has('password'))
                <small id="passwordHelp" class="form-text text-danger">
                    @foreach($errors->get('password') as $error)
                    {{ $error }}&NoBreak;
                    @endforeach
                </small>
            @endif

            {{--администратор, нет ли?--}}
            <div class="mt-2 form-group">
                <div class="form-check-inline">
                    <input type="checkbox" name="is_admin" class="form-check-input form-check"
                           aria-describedby="isAdminValidateBlock"
                           @if($user->is_admin) checked @endif
                           data-toggle="tooltip" data-placement="bottom"
                           title="а не админимтратор ли часом"
                           id="isAdminCheck">
                    <label class="form-check-label col-form-label-lg pl-1" for="isAdminCheck">
                        права администратора
                    </label>
                </div>
                @if($errors->has('is_admin'))
                    <small id="isAdminValidateBlock" class="form-text text-danger">
                        @foreach($errors->get('is_admin') as $error)
                        {{ $error }}&NoBreak;
                        @endforeach
                    </small>
                @endif
            </div>

{{--            кнопка применить изменения--}}
            <button type="submit" class="btn btn-primary font-weight-bolder mt-2">Применить</button>
        </form>
    </div>
@endsection
