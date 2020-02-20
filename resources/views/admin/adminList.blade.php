@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="mt-3 mb-3">Администрирование новостей</h1>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Выберите новость для внесения изменений</h4>
            <hr>
            <p class="mb-0">Вместе с <strong>созданием</strong> новой новости можно, также, создать новую категорию,
                если ввести несуществующую</p>
            <p class="py-0 mb-0">При <strong>изменении существующей</strong> новости категорию можно изменить только на
                одну из уже имеющихся</p>
            <p class="py-0 mb-0"><strong>Удаление</strong> новости не приводит к удалению ее категории</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="shadow p-3 mb-3 bg-white rounded">
            @foreach($categories as $category)
                <h6 class="text-dark font-weight-bolder">{{ $category['name'] }}</h6>
                    @forelse(\App\News::getCurrentCategoryNews($category['id']) as $newsOne)

                        <a class="nav-link font-weight-bolder" href="{{ route('admin.show', $newsOne['id']) }}">
                            {{ $newsOne['title'] }}
                        </a>
                    @empty
                        <a class="nav-link text-danger font-weight-bolder" href="{{ route('admin.show', $newsOne['id']) }}">
                            пустая категория <span class="text-black-50">(нажать для перехода в редактор)</span>
                        </a>
                    @endforelse
                @endforeach
            </div>
        </div>
    @endsection
