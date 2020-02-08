@extends('layouts.main')

@section('content')
    <div class="content py-3">
        <h4 class="mt-3 mb-5">Новость из категории <strong>{{ $categoryName }}</strong></h4>

        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h5><strong>{{ $newsOne['title'] }}</strong></h5>
            <h6><?= $newsOne['description'] ?></h6>
        </div>
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('currentCat', $newsOne['category_id']) }}">Вернуться в категорию <strong>{{ $categoryName }}</strong></a>
    </div>
@endsection
