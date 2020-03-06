@extends('layouts.main')

@section('title')изменения учетных данных пользователя@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content">
        <h1 class="py-4">Изменение учетных данных пользователя</h1>
        <form action="{{ route('admin.updateProfile') }}" method="post">
            @csrf

{{--            имя--}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="name">имя</label>
                </div>
                <input name="name" type="text" value="{{ old('name') }}" class="form-control" id="name" placeholder="как звать то"
                       aria-describedby="nameHelp">
                @if($errors->has('name'))
                    <small id="nameHelp" class="form-text text-danger">
                        @foreach($errors->get('name') as $error)
                        {{ $error }}&NoBreak;
                        @endforeach
                    </small>
                @endif
            </div>

{{--            почта--}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="email">@email</label>
                </div>
                <input name="email" type="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="адрес электронной почты"
                       aria-describedby="emailHelp">
                @if($errors->has('email'))
                    <small id="emailHelp" class="form-text text-danger">
                        @foreach($errors->get('email') as $error)
                        {{ $error }}&NoBreak;
                        @endforeach
                    </small>
                @endif
            </div>

{{--            пароли--}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="password">пароль</label>
                </div>
                <input name="oldPassword" value="{{ old('oldPassword') }}" type="password" class="form-control" id="oldPassword" placeholder="старый"
                       aria-describedby="oldPasswordHelp">

                <input name="newPassword" value="{{ old('newPassword') }}" type="password" class="form-control" id="newPassword" placeholder="новый"
                       aria-describedby="newPasswordHelp">
            </div>
            @if($errors->has('oldPassword') | $errors->has('newPassword'))
                <small id="oldPasswordHelp" class="form-text text-danger">
                    @foreach($errors->get('oldPassword') as $error)
                    {{ $error }}&NoBreak;
                    @endforeach
                    @foreach($errors->get('newPassword') as $error)
                    {{ $error }}&NoBreak;
                    @endforeach
                </small>
            @endif

            <button type="submit" class="btn btn-primary font-weight-bolder">Применить</button>
        </form>
    </div>
@endsection
