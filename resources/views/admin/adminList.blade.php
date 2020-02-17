@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="mt-3 mb-3">Администрирование новостей</h1>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Выберите новость для внесения изменений</h4>
            <hr>
            <p class="mb-0">Вместе с <strong>созданием</strong> новой новости можно, также, создать новую категорию, если ввести несуществующую</p>
            <p class="py-0 mb-0">При <strong>изменении существующей</strong> новости категорию можно изменить только на одну из уже имеющихся</p>
            <p class="py-0 mb-0"><strong>Удаление</strong> новости не приводит к удалению ее категории</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

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
