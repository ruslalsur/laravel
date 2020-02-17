@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="mt-3 mb-5">Выберите новость для внесения изменений</h1>
        <div class="shadow p-3 mb-3 bg-white rounded">
            @forelse($news as $key=>$newsOne)
                <a class="nav-link text-secondary font-weight-bolder" href="{{ route('admin.show', $key) }}">
                    {{ $newsOne['title'] }}
                </a>
            @empty
                <h4>Ничего новенького</h4>
            @endforelse
        </div>
    </div>
@endsection
