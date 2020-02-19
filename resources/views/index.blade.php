@extends('layouts.main')

@section('title')@parentприветствия@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h1 class="mt-3 mb-5">Новости глубокого погружения</h1>

        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <h4>Глубокое</h4>
        </div>
        <div class="shadow p-3 mb-4 bg-white rounded">
            <h4>Погружение</h4>
        </div>

        <div class="shadow-lg p-3 mb-4 bg-white rounded">
            <a class="nav-link p-0" href="https://laravel.su"><h3 class="font-weight-bolder text-danger m-0">в laraveL</h3></a>
        </div>
        <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <h4>Приветствует </h4>
        </div>
        <div class="shadow-lg p-3 bg-white rounded">
            <h4>Вас!</h4>
        </div>
    </div>
@endsection
