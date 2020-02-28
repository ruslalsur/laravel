@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="py-4">{{ $title }} новости</h1>
        <form enctype="multipart/form-data" action="{{ route($rout, $newsOne->id) }}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="currentCategory">Категория</label>
                </div>
                <select name="category_id" class="custom-select" id="currentCategory">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $newsOne->category_id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="newsHeader">Заголовок</label>
                </div>
                <input type="text" name="title" class="form-control" id="newsHeader" placeholder="Заголовок"
                       value="{{ $newsOne->title }}">
            </div>

            <div class="row">
                <div class="d-flex flex-column justify-content-between col-3 mb-1">
                    <img src="@if($newsOne->image === null) {{ asset('img/no-image.png') }} @else {{ asset($newsOne->image) }} @endif"
                         class="embed-responsive card-img" alt="image">
                    <div class="mt-2">
                        <div class="custom-file my-2">
                            <input type="file" class="custom-file-input" id="fileImg" name="image">
                            <label class="custom-file-label file" data-browse="файл" for="fileImg">выбрать</label>
                        </div>
                        <div class="mt-2 form-group">
                            <div class="form-check-inline">
                                <input type="checkbox" name="is_private" class="form-check-label"
                                       @if($newsOne->is_private) checked @endif
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
                                @if($newsOne->id)Применить@elseСоздать@endif
                            </button>
                        </div>
                    </div>

                </div>
                <div class="input-group col-9">
                    <textarea class="form-control" name="description" id="newsBody" rows="10"
                              placeholder="Текст новости">{{ $newsOne->description }}</textarea>
                </div>
            </div>
        </form>
    </div>
@endsection
