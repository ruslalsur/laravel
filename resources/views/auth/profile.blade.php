@extends('layouts.main')

@section('title'){{ $title }}@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content">
        <h1 class="py-4">{{ $title }}</h1>
        <form enctype="multipart/form-data" action="{{ route($route, $user) }}" method="POST">
            @csrf
            @method($method)

            {{--            кнопки--}}
            <div class="row input-group justify-content-between mb-3 w-auto">
                <div class="col-10 input-group-prepend px-0">
                    <button type="submit" class="btn btn-block btn-primary font-weight-bolder">
                        @if($user->id)
                            применить все изменения
                        @else
                            создать нового пользователя
                        @endif
                    </button>
                </div>
                <div class="col-2 input-group-append pl-0 pr-0">
                    <a href="{{ asset(session('referer')) }}" class="btn btn-block btn-outline-primary font-weight-bolder">
                        отмена
                    </a>
                </div>
            </div>

            {{--                    картинка--}}
            <div class="row mb-3">
                <div class="col-5 pl-0">
                    <img class="border p-1 rounded shadow embed-responsive"
                         src="@if($user->id) {{ asset($user->avatar) }} @else {{ asset('storage/images/user.png') }} @endif"
                         alt="{{ $user->avatar }}">

                    {{--                    загрузить файл--}}
                    <div class="custom-file my-2">
                        <input type="file" class="custom-file-input" id="fileImg" name="image"
                               aria-describedby="fileHelp">
                        <label class="custom-file-label" data-browse="файл" for="fileImg">выберите</label>
                        @if($errors->has('image'))
                            <small id="fileHelp" class="form-text text-danger">
                                @foreach($errors->get('image') as $error)
                                {{ $error }}&NoBreak;
                                @endforeach
                            </small>
                        @endif
                    </div>
                </div>

                {{--            имя--}}
                <div class="col-7 embed-responsive">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="name">пользователь</label>
                        </div>
                        <input name="name" type="text"
                               value="@if($user->id) {{ old('name') ?? $user->name }} @else {{ old('name') }} @endif"
                               class="form-control"
                               id="name"
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
                        <input name="email" type="email"
                               value="@if($user->id) {{ old('email') ?? $user->email }} @else {{ old('email') }} @endif"
                               class="form-control"
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
                            <label class="input-group-text" for="password">пароль</label>
                        </div>
                        <input name="password" type="password" class="form-control"
                               id="password" placeholder="введите пароль"
                               aria-describedby="passwordHelp">
                    </div>
                    @if($errors->has('password'))
                        <small id="passwordHelp" class="form-text text-danger">
                            @foreach($errors->get('password') as $error)
                            {{ $error }}&NoBreak;
                            @endforeach
                        </small>
                    @endif
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="password">повтор</label>
                        </div>
                        <input name="password_confirmation" type="password" class="form-control"
                               id="password" placeholder="повторите пароль"
                               aria-describedby="passwordHelp">
                    </div>
                    @if($errors->has('password_confirmation'))
                        <small id="passwordHelp" class="form-text text-danger">
                            @foreach($errors->get('password_confirmation') as $error)
                            {{ $error }}&NoBreak;
                            @endforeach
                        </small>
                    @endif

                    {{-- администратор, нет ли?--}}
                    @if($showIsAdmin | $user->is_admin)
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
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
