@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.adminMenu')
@endsection

@section('content')
    <div class="content">
        <h1 class="mt-3 mb-5">Администрирование</h1>

        <div class="shadow-sm p-3 mb-3 bg-white rounded">
            <h4>admin content</h4>
        </div>
    </div>
@endsection
