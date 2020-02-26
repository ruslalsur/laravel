@extends('layouts.main')

@section('title')@parentпро нас@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h4 class="my-3">мы</h4>

        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h5>команда <strong>web</strong>-разработчиков состоящая из одного студента geekbrains и двух электронно-вычислительных машин, тихоханько агрегирующих новости в соответствии с домашним заданием</h5>
        </div>
    </div>
@endsection
