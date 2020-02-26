@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="py-4">Редактор новостей</h1>
        <form enctype="multipart/form-data" action="{{ route('admin.edit', $newsOne->id) }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="currentCategory">Категория</label>
                </div>
                <select name="categoryId" class="custom-select" id="currentCategory">
                    @foreach($categories as $category)
                        <option
                            @if($category->name == $currentCategoryName) selected @endif
                        value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
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
                <input type="text" name="title" class="form-control" value="{{ $newsOne->title }}"
                       id="newsHeader"
                       placeholder="Заголовок">
            </div>

            <div class="row">
                <div class="d-flex flex-column justify-content-between col-3 mb-1">
                    <img src="{{  $newsOne->image ? asset($newsOne->image) : asset('img/no-image.png') }}"
                         class="embed-responsive card-img" alt="image">
                    <div class="mt-2">
                        <div class="custom-file my-2">
                            <input type="file" class="custom-file-input" id="fileImg" name="image">
                            <label class="custom-file-label file" data-browse="файл" for="fileImg">выбрать</label>
                        </div>
                        <div class="mt-2 form-group">
                            <div class="form-check-inline">
                                @if($newsOne->isPrivate)
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
                                <label class="form-check-label col-form-label-lg pl-1" for="privateCheck">
                                    приватная
                                </label>
                            </div>
                        </div>
                        <div class="d-flex flex-column ">
                            <button id="submit_edit" type="submit" name="submit" value="edit"
                                    class="my-3 font-weight-bolder btn btn-sm btn-success shadow-sm"
                                    data-toggle="tooltip" data-placement="bottom"
                                    title="изменение текущей новости и/или перенос ее в другую категорию (категория должна существовать)">
                                Изменить
                            </button>

                            <button id="submit_delete" type="submit" name="submit" value="delete"
                                    class="font-weight-bolder btn btn-sm btn-danger shadow-sm"
                                    data-toggle="tooltip" data-placement="bottom"
                                    title="удаление текущей новости совсем (категория при удалении не затрагивается)">
                                Удалить
                            </button>
                        </div>
                    </div>

                </div>
                <div class="input-group col-9">
                    <textarea class="form-control" name="description" id="newsBody" rows="10"
                              placeholder="Текст новости">{{ $newsOne->description }}
                    </textarea>
                </div>
            </div>
        </form>
    </div>
@endsection
