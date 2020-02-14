@extends('layouts.main')

@section('title')@parentадминистрирования@endsection

@section('menu')
    @include('layouts.adminMenu')
@endsection

@section('content')
    <div class="content">
        <h1 class="mt-3 mb-4">Администрирование новости</h1>
        <form>
            {{ csrf_field() }}

            <div class="form-group">
                <label for="exampleFormControlInput1">Здесь можно изменить категорию новости</label>
                <input type="text" name="categoryName" class="form-control" value="{{ $newsCategoryName }}"
                       id="newsHeader"
                       placeholder="Из какой категории новость?">
            </div>


            <div class="form-group">
                <label for="exampleFormControlInput1">Здесь можно изменить заголовок новости</label>
                <input type="text" name="title" class="form-control" value="{{ $newsOne['title'] }}" id="newsHeader"
                       placeholder="Заголовок">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Здесь можно изменить саму новость</label>
                <textarea class="form-control" name="description" id="newsBody" rows="10"
                          placeholder="Текст новости">{{ $newsOne['description'] }}</textarea>
            </div>

            <div class="form-group">
                <div class="form-check-inline">
                    @if($newsOne['isPrivate'])
                        <input type="checkbox" name="isPrivate" class="form-check-input" checked value="true"
                               id="privateCheck" placeholder="Приватность">
                    @else
                        <input type="checkbox" name="isPrivate" class="form-check-label" value="false"
                               id="privateCheck" placeholder="Приватность">
                    @endif
                    <label class="form-check-label col-form-label-lg" for="privateCheck">&nbsp;приватная</label>
                </div>
            </div>
            <button type="submit" value="add" class="btn btn-success">Добавить</button>
            <button type="submit" value="edit" class="btn btn-primary">Изменить</button>
            <button type="submit" value="delete" class="btn btn-danger">Удалить</button>
        </form>
    </div>
@endsection
