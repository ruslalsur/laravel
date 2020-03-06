@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-2">
        <h1 class="py-4">Редактор категорий</h1>

        <table class="table table-borderless">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Название</th>
                <th class="text-center" scope="col">Идентификатор</th>
                <th class="text-center" scope="col">Содержит новостей</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td><h6 class="font-weight-bolder">{{ $category->name }}</h6></td>
                    <td class="text-center">{{ $category->id }}</td>
                    <td class="text-center">{{ $category->news()->count() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="input-group-prepend">
            <form class="input-group mr-2" action="{{ route('admin.category.destroy', $category) }}" method="post">
                @csrf
                @method('DELETE')

                <button class="input-group-prepend font-weight-bolder btn btn-danger"
                        id="submit_delCategory"
                        type="submit"
                        data-toggle="tooltip" data-placement="bottom" title="удаление старой категории">
                    x
                </button>
                <select name="id" class="custom-select" id="currentCategory">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </form>

            <form class="input-group" action="{{ route('admin.category.store') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" name="name" class="form-control"
                           id="newCategory" value="{{ old('name') }}"
                           placeholder="Введите название категории">

                    <button class="input-group-append font-weight-bolder btn btn-primary"
                            id="submit_newCategory"
                            type="submit"
                            data-toggle="tooltip" data-placement="bottom" title="создание новой категории">
                        +
                    </button>
                </div>
            </form>

        </div>
        <div class="mt-3 d-flex justify-content-center">{{ $categories->links() }}</div>
    </div>

    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Внимание!</h4>
        <p class="mb-0">Можно
            <span class="text-danger">
                <strong>
                    удалить только пустую
                </strong>
            </span>
            существующую категорию
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endsection
