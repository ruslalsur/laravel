@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="py-4">Параметры новости</h1>
        <form action="{{ route('admin.edit', $id) }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="newsCategory">Категория</label>
                </div>
                <input type="text" name="categoryName" class="form-control" value="{{ $newsCategoryName }}"
                       id="newsCategory"
                       placeholder="Из какой категории новость?">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="newsHeader">Заголовок</label>
                </div>
                <input type="text" name="title" class="form-control" value="{{ $newsOne['title'] }}"
                       id="newsHeader"
                       placeholder="Заголовок">
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Новость</span>
                </div>
                <textarea class="form-control" name="description" id="newsBody" rows="10"
                          placeholder="Текст новости">{{ $newsOne['description'] }}</textarea>
            </div>

            <div class="form-group">
                <div class="form-check-inline">
                    @if($newsOne['isPrivate'])
                        <input type="checkbox" name="isPrivate" class="form-check-input" checked
                               data-toggle="tooltip" data-placement="bottom"
                               title="подробности будут доступны для просмотра только зарегистрированным пользователям"
                               id="privateCheck">
                    @else
                        <input type="checkbox" name="isPrivate" class="form-check-label"
                               data-toggle="tooltip" data-placement="bottom"
                               title="подробности будут доступны для просмотра только зарегистрированным пользователям"
                               id="privateCheck">
                    @endif
                    <label class="form-check-label col-form-label-lg" for="privateCheck">&nbsp;новость
                        приватная</label>
                </div>
            </div>
            <button id="submit_add" type="submit" name="submit" value="add" class="btn btn-success"
                    data-toggle="tooltip" data-placement="bottom"
                    title="создание новой новости (будет создана новая категория или новость добавиться в указанную существующую)">
                Создать
            </button>

            <button id="submit_edit" type="submit" name="submit" value="edit" class="btn btn-primary"
                    data-toggle="tooltip" data-placement="bottom"
                    title="изменение текущей новости и/или перенос ее в другую категорию (категория должна существовать)">
                Изменить
            </button>

            <button id="submit_delete" type="submit" name="submit" value="delete" class="btn btn-danger"
                    data-toggle="tooltip" data-placement="bottom"
                    title="удаление текущей новости совсем (категория при удалении не затрагивается)">
                Удалить
            </button>
        </form>
    </div>
@endsection
