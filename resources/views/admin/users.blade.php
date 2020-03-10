@extends('layouts.main')

@section('title')@parentкатегорий@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h3 class="mt-3 mb-4">Список пользователей</h3>
        <div class="shadow p-3 mb-5 bg-white rounded">
            @foreach(\App\User::all() as $user)
                <a class="dropdown-item"
                   data-toggle="tooltip" data-placement="bottom" title="пользователь"
                   href="{{ route('auth.updateProfile') }}">
                    <img src="{{ asset($user->avatar) }}" class="mr-3" alt="{{ $user->avatar }}" height="25" width="25">
                    {{$user->name}}
                    @if($user->is_admin)<span class="mx-2 px-1 font-weight-bold badge-danger rounded-pill">А</span>@endif
                </a>
            @endforeach
        </div>
    </div>
@endsection
