@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-2">
        <h1 class="py-4">Редактор категорий</h1>

{{--        предупреждение--}}
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

        <div class="row py-4">

{{--            удалить--}}
            <div class="col-6 pr-1">
                <form action="{{ route('admin.category.destroy', 1) }} " method="post">
                    @csrf
                    @method('delete')
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="input-group-prepend font-weight-bolder btn btn-danger"
                                    id="submit_delCategory"
                                    type="submit"
                                    data-toggle="tooltip" data-placement="bottom" title="удаление старой категории">
                                удалить
                            </button>
                        </div>
                        <select name="name" class="custom-select" id="currentCategory"
                                aria-describedby="categoryDelValidateBlock">
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($errors->has('name'))
                        <small id="categoryDelValidateBlock" class="form-text text-danger">
                            @foreach($errors->get('name') as $error)
                            @if($error == 'Можно удалить только пустую категорию.') {{ $error }}&NoBreak; @endif
                            @endforeach
                        </small>
                    @endif
                </form>
            </div>

            {{--                        добавить--}}
            <div class=" col-6 pl-1">
                <form class="input-group" action="{{ route('admin.category.store') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" class="form-control"
                               id="newCategory" value="{{ old('name') }}"
                               placeholder="Введите название категории"
                               aria-describedby="categoryValidateBlock">

                        <div class="input-group-append">
                            <button class="input-group-append font-weight-bolder btn btn-primary"
                                    id="submit_newCategory"
                                    type="submit"
                                    data-toggle="tooltip" data-placement="bottom" title="создание новой категории">
                                добавить
                            </button>
                        </div>
                    </div>
                    @if($errors->has('name'))
                        <small id="categoryValidateBlock" class="form-text text-danger">
                            @foreach($errors->get('name') as $error)
                            @if($error != 'Можно удалить только пустую категорию.') {{ $error }}&NoBreak; @endif
                            @endforeach
                        </small>
                    @endif
                </form>

            </div>
        </div>
    </div>

{{--    список категорий--}}
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
                <td><a href="{{ route('news.currentCategory', $category->id) }}"
                       class="text-decoration-none font-weight-bolder">
                        <img class="w-40 h-20 mr-2" src="{{ asset($category->image) }}" width="40" alt="{{ $category->image }}">
                        {{ $category->name }}
                    </a>
                </td>
                <td class="text-center">{{ $category->id }}</td>
                <td class="text-center">{{ $category->news()->count() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    <div class="mt-3 d-flex justify-content-center">{{ $categories->links() }}</div>
@endsection
