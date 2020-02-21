@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="py-4">Редактор категорий</h1>

        <table class="table table-borderless">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Название</th>
                <th class="text-center" scope="col">Идентификатор</th>
                <th class="text-center"  scope="col">Содержит новостей</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $key => $category)
                <tr>
                    <td><h6 class="font-weight-bolder">{{ $category['name'] }}</h6></td>
                    <td class="text-center">{{ $key }}</td>
                    <td class="text-center">{{ count(\App\News::getCurrentCategoryNews($key)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <form class="pb-3" action="{{ route('admin.edit', $newsId) }}" method="post">
            @csrf

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="font-weight-bolder btn btn-danger" type="submit" id="submit_delCategory"
                            name="submit" value="delCategory"
                            data-toggle="tooltip" data-placement="bottom" title="удаление старой категории">
                        Удалить
                    </button>
                </div>

                <input type="text" name="newCategoryName" class="form-control"
                       id="newCategory"
                       placeholder="Введите название категории">

                <div class="input-group-append">
                    <button class="font-weight-bolder btn btn-primary" type="submit" id="submit_newCategory"
                            name="submit" value="addCategory"
                            data-toggle="tooltip" data-placement="bottom" title="создание новой категории">
                        Добавить
                    </button>
                </div>

            </div>
        </form>

        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Внимание!</h4>
            <p class="mb-0">Можно <span class="text-danger"><strong>удалить только пустую</strong></span> существующую категорию</p>
            <p class="mb-0 mt-2">В <a class="font-weight-bold card-link" href="{{ route('admin.show', $newsId) }}"> редакторе новостей</a> можно присвоить новостям другую категорию или же удалить все новости из этой категории</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endsection
