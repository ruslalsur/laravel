@extends('layouts.main')

@section('content')
    <div class="content py-4">
        <form>
            <div class="form-group">
                <label for="exampleFormControlInput1">Сюда добавьте заголовок новости</label>
                <input type="text" class="form-control" id="newsHeader" placeholder="Заголовок">
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">А сюда добавьте саму новость</label>
                <textarea class="form-control" id="newsBody" rows="10" placeholder="Текст новости"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Добавить новость</button>
        </form>
    </div>
@endsection
