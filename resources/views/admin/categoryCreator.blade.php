@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="py-4">Редактор категорий</h1>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Внимание!</h4>
            <p class="mb-0">Вместе с <strong>удалением</strong> существующей категории будут удалены все содержащиеся в ней новости</p>
            <p class="mb-0"><strong>Присвойте новостям </strong> другую категорию, при возникновении такой необходимости,
                пред удалением категории</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Идентификатор категории</th>
                <th scope="col">Название категории</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $key => $category)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>{{ $category['name'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <form action="{{ route('admin.edit', 1) }}" method="post">
            @csrf

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="font-weight-bolder btn btn-primary" type="submit" id="submit_newCategory"
                            name="submit" value="addCategory"
                            data-toggle="tooltip" data-placement="bottom" title="создание новой категории">
                        Добавить
                    </button>
                </div>

                <input type="text" name="newCategoryName" class="form-control"
                       id="newCategory"
                       placeholder="Введите название категории">

                <div class="input-group-append">
                    <button class="font-weight-bolder btn btn-danger" type="submit" id="submit_delCategory"
                            name="submit" value="delCategory"
                            data-toggle="tooltip" data-placement="bottom" title="удаление старой категории">
                        Удалить
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection
