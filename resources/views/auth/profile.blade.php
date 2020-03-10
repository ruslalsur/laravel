@extends('layouts.main')

@section('title')изменения учетных данных пользователя@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content">
        <h1 class="py-4">Личный кабинет пользователя</h1>
        <form enctype="multipart/form-data" action="{{ route('auth.updateProfile', $user) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-5">
{{--                    картинка--}}
                    <img class="border p-1 rounded shadow embed-responsive" src="{{ $user->avatar }}" alt="{{ $user->avatar }}" width="">
{{--                    загрузить файл--}}
                    <div class="custom-file my-2">
                        <input type="file" class="custom-file-input" id="fileImg" name="image" aria-describedby="titleValidateBlock">
                        <label class="custom-file-label" data-browse="файл" for="fileImg">выберите</label>
                        @if($errors->has('image'))
                            <small id="descriptionValidateBlock" class="form-text text-danger">
                                @foreach($errors->get('image') as $error)
                                {{ $error }}&NoBreak;
                                @endforeach
                            </small>
                        @endif
                    </div>
                    {{--            кнопка применить изменения--}}
                    <button type="submit" class="btn btn-primary font-weight-bolder mt-2 embed-responsive">Применить все изменения</button>
                </div>
                <div class="col-7 embed-responsive">
                    {{--            имя--}}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="name">пользователь</label>
                        </div>
                        <input name="name" type="text" value="{{ old('name') ?? $user->name }}" class="form-control"
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

                    {{--            пароль--}}
                    <div class="input-group mt-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="password">новый пароль</label>
                        </div>
                        <input name="password" type="password" class="form-control"
                               id="password" placeholder="оставьте пустым, чтобы сохранить старый"
                               aria-describedby="passwordHelp">
                    </div>
                    @if($errors->has('password'))
                        <small id="passwordHelp" class="form-text text-danger">
                            @foreach($errors->get('password') as $error)
                            {{ $error }}&NoBreak;
                            @endforeach
                        </small>
                    @endif



                    {{--администратор, нет ли?--}}
{{--                    <div class="mt-2 form-group">--}}
{{--                        <div class="form-check-inline">--}}
{{--                            <input type="checkbox" name="is_admin" class="form-check-input form-check"--}}
{{--                                   aria-describedby="isAdminValidateBlock"--}}
{{--                                   @if($user->is_admin) checked @endif--}}
{{--                                   data-toggle="tooltip" data-placement="bottom"--}}
{{--                                   title="а не админимтратор ли часом"--}}
{{--                                   id="isAdminCheck">--}}
{{--                            <label class="form-check-label col-form-label-lg pl-1" for="isAdminCheck">--}}
{{--                                права администратора--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        @if($errors->has('is_admin'))--}}
{{--                            <small id="isAdminValidateBlock" class="form-text text-danger">--}}
{{--                                @foreach($errors->get('is_admin') as $error)--}}
{{--                                {{ $error }}&NoBreak;--}}
{{--                                @endforeach--}}
{{--                            </small>--}}
{{--                        @endif--}}
{{--                    </div>--}}

                </div>

            </div>


        </form>
    </div>
@endsection
