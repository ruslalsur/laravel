@extends('layouts.main')

@section('title')@parent{{ $title }}@endsection

@section('menu')
    @include('layouts.menus.adminMenu')
@endsection

@section('content')
    <div class="content pb-5">
        <h1 class="py-4">{{ $title }} новости</h1>
        <form enctype="multipart/form-data" action="{{ route($rout, $newsOne) }}" method="post">
            @csrf
            @method($method)

            {{--категория--}}
            <div class="form-group mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="currentCategory">Категория</label>
                    </div>

                    <select name="category_id" class="custom-select" id="currentCategory"
                            aria-describedby="titleValidateBlock">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($category->id == $newsOne->category_id | $category->id == session()->get('currentCategory'))
                                    selected
                                    @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <a href="{{ route('admin.category.create') }}"
                           class="font-weight-bolder btn btn-secondary">+</a>
                    </div>

                </div>
                @if($errors->has('category_id'))
                    <small id="descriptionValidateBlock" class="form-text text-danger">
                        @foreach($errors->get('category_id') as $error)
                        {{ $error }}&NoBreak;
                        @endforeach
                    </small>
                @endif
            </div>

            {{--заголовок--}}
            <div class="form-group mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="newsHeader">Заголовок</label>
                    </div>
                    <input type="text" name="title" class="form-control" id="newsHeader" placeholder="Заголовок"
                           aria-describedby="titleValidateBlock" value="{{ $newsOne->title }}">
                </div>
                @if($errors->has('title'))
                    <small id="titleValidateBlock" class="form-text text-danger">
                        @foreach($errors->get('title') as $error)
                        {{ $error }}&NoBreak;
                        @endforeach
                    </small>
                @endif
            </div>

            {{--картинка--}}
            <div class="row">
                <div class="d-flex flex-column justify-content-between col-4">
                    <div class="form-group">
                        <img
                            src="@if($newsOne->image === null) {{ asset('img/no-image.png') }} @else {{ asset($newsOne->image) }} @endif"
                            class="embed-responsive card-img" alt="image">
                        <div class="mt-2">
                            <div class="custom-file my-2">
                                <input type="file" class="custom-file-input" id="fileImg" name="image"
                                       aria-describedby="titleValidateBlock">
                                <label class="custom-file-label" data-browse="файл" for="fileImg">выберите</label>
                                @if($errors->has('image'))
                                    <small id="descriptionValidateBlock" class="form-text text-danger">
                                        @foreach($errors->get('image') as $error)
                                        {{ $error }}&NoBreak;
                                        @endforeach
                                    </small>
                                @endif
                            </div>

                            {{--приватность--}}
                            <div class="mt-2 form-group">
                                <div class="form-check-inline">
                                    <input type="checkbox" name="is_private" class="form-check-label"
                                           aria-describedby="titleValidateBlock"
                                           @if($newsOne->is_private) checked @endif
                                           data-toggle="tooltip" data-placement="bottom"
                                           title="подробности будут доступны для просмотра только зарегистрированным пользователям"
                                           id="privateCheck">
                                    <label class="form-check-label col-form-label-lg pl-1" for="privateCheck">
                                        приватная
                                    </label>
                                </div>
                                @if($errors->has('is_private'))
                                    <small id="descriptionValidateBlock" class="form-text text-danger">
                                        @foreach($errors->get('is_private') as $error)
                                        {{ $error }}&NoBreak;
                                        @endforeach
                                    </small>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{--кнопка submit--}}
                    <div class="input-group mb-0">
                        <div class="col-8 input-group-prepend px-0">
                            <button id="submit_add" type="submit" value="add"
                                    class="font-weight-bolder btn btn-block btn-primary"
                                    data-toggle="tooltip" data-placement="bottom"
                                    title="создание новой новости (будет создана новая категория или новость добавиться в указанную существующую)">
                                @if($newsOne->id)
                                    применить
                                @else
                                    создать
                                @endif
                            </button>
                        </div>
                        <div class="col-4 input-group-append pl-0 pr-0">
                            <a href="{{ asset(session('referer')) }}"
                               class="btn btn-block btn-outline-primary font-weight-bolder">
                                отмена
                            </a>
                        </div>
                    </div>
                </div>

                {{--текст новости--}}
                <div class="form-group col-8 mb-0 pl-0">
                    <div class="d-flex input-group">
                            <textarea class="form-control" name="description" id="newsBody" rows="17"
                                      placeholder="Текст новости"
                                      aria-describedby="descriptionValidateBlock">{!! $newsOne->description !!}</textarea>
                    </div>
                    @if($errors->has('description'))
                        <small id="descriptionValidateBlock" class="form-text text-danger">
                            @foreach($errors->get('description') as $error)
                            {{ $error }}&NoBreak;
                            @endforeach
                        </small>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <script src={{asset("js/ckeditor4/ckeditor.js")}}></script>
@endsection
