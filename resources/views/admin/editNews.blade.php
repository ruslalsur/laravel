@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="py-4">Редактор новостей</h1>
        <form action="{{ route('admin.edit', $newsId) }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="currentCategory">Категория</label>
                </div>
                <select name="categoryId" class="custom-select" id="currentCategory">
                    @foreach($categories as $key=>$category)
                        <option
                            @if($category['name'] == $currentCategoryName) selected @endif
                        value="{{ $key }}">
                            {{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="submit_newCategory"
                            name="submit" value="newCategory"
                            data-toggle="tooltip" data-placement="bottom" title="создание новой категории">
                        Редактор категорий
                    </button>

                </div>
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
            <button id="submit_add" type="submit" name="submit" value="add" class="font-weight-bolder btn btn-primary"
                    data-toggle="tooltip" data-placement="bottom"
                    title="создание новой новости (будет создана новая категория или новость добавиться в указанную существующую)">
                Создать
            </button>

            <button id="submit_edit" type="submit" name="submit" value="edit" class="font-weight-bolder btn btn-success"
                    data-toggle="tooltip" data-placement="bottom"
                    title="изменение текущей новости и/или перенос ее в другую категорию (категория должна существовать)">
                Изменить
            </button>

            <button id="submit_delete" type="submit" name="submit" value="delete"
                    class="font-weight-bolder btn btn-danger"
                    data-toggle="tooltip" data-placement="bottom"
                    title="удаление текущей новости совсем (категория при удалении не затрагивается)">
                Удалить
            </button>
        </form>
    </div>
@endsection
