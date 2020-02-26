@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="py-4">Создание новой новости</h1>
        <form enctype="multipart/form-data" action="{{ route('admin.add') }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="currentCategory">Категория</label>
                </div>
                <select name="categoryId" class="custom-select" id="currentCategory" placeholder="укажите категорию">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <a class="btn btn-secondary"
                            href="{{ route('admin.categoryCreator') }}"
                            data-toggle="tooltip" data-placement="bottom" title="редактор категорий">
                        Редактор категорий
                    </a>
                </div>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="newsHeader">Заголовок</label>
                </div>
                <input type="text" name="title" class="form-control" id="newsHeader" placeholder="Заголовок">
            </div>

            <div class="row">
                <div class="d-flex flex-column justify-content-between col-3 mb-1">
                    <img src="{{  asset('img/no-image.png') }}"
                         class="embed-responsive card-img" alt="image">
                    <div class="mt-2">
                        <div class="custom-file my-2">
                            <input type="file" class="custom-file-input" id="fileImg" name="image">
                            <label class="custom-file-label file" data-browse="файл" for="fileImg">выбрать</label>
                        </div>
                        <div class="mt-2 form-group">
                            <div class="form-check-inline">
                                <input type="checkbox" name="isPrivate" class="form-check-label"
                                       data-toggle="tooltip" data-placement="bottom"
                                       title="подробности будут доступны для просмотра только зарегистрированным пользователям"
                                       id="privateCheck">
                                <label class="form-check-label col-form-label-lg pl-1" for="privateCheck">
                                    приватная
                                </label>
                            </div>
                        </div>
                        <div class="d-flex flex-column ">
                            <button id="submit_add" type="submit" value="add"
                                    class="font-weight-bolder btn btn-sm btn-primary shadow-sm"
                                    data-toggle="tooltip" data-placement="bottom"
                                    title="создание новой новости (будет создана новая категория или новость добавиться в указанную существующую)">
                                Создать
                            </button>
                        </div>
                    </div>

                </div>
                <div class="input-group col-9">
                    <textarea class="form-control" name="description" id="newsBody" rows="10"
                              placeholder="Текст новости"></textarea>
                </div>
            </div>
        </form>
    </div>
@endsection
