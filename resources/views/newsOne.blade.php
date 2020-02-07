@extends('layouts.main')

@section('content')
    <div class="content py-3">
        <h4 class="mt-3 mb-5">Новость из категории <strong>{{ $category }}</strong></h4>

        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h5>{{ $newsOne['title'] }}</h5>
            <h6><?= $newsOne['description'] ?></h6>
        </div>
    </div>
@endsection
