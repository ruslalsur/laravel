@extends('layouts.main')

@section('content')
    <div class="content">
        <h1 class="mt-3 mb-4">Добавление новой новости</h1>
        <form>
            {{ csrf_field() }}

            <div class="form-group">
                <label for="exampleFormControlInput1">Сюда добавьте категорию для новости</label>
                <input type="text" class="form-control" id="newsHeader" placeholder="Из какой категории новость?">
            </div>


            <div class="form-group">
                <label for="exampleFormControlInput1">Сюда добавьте заголовок для новости</label>
                <input type="text" class="form-control" id="newsHeader" placeholder="Заголовок">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">А сюда добавьте саму новость</label>
                <textarea class="form-control" id="newsBody" rows="10" placeholder="Текст новости"></textarea>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-inline" id="privateCheck" placeholder="Приватность">
                <label class="form-check-label col-form-label-lg" for="privateCheck">Приватность новости</label>
            </div>
            <button type="submit" class="btn btn-primary">Добавить новость</button>
        </form>
    </div>
@endsection
