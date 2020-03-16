@extends('layouts.main')

@section('title')@parentкатегорий@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h3 class="mt-3 mb-4">Список источников
            <small class="">
                <a href="{{ route('admin.source.create') }}"
                   class="nav-justified text-decoration-none font-weight-bolder
                    text-primary" title="создать">
                    пополнить список
                </a>
            </small>
            или
            <small class="">
                <a href="{{ route('admin.parse') }}"
                   class="nav-justified text-decoration-none font-weight-bolder
                    text-primary" title="в очередь на парсинг">
                    распарсить его
                </a>
            </small>
        </h3>

        <div class="shadow p-3 mb-3 bg-white rounded">
            <div class="row d-flex ml-2">
                <div class="col-5"><strong>Название источника</strong></div>
                <div class="col-7 "><strong>Адрес источника</strong></div>
            </div>
            <hr>

            @foreach($sources as $source)
                <div class="row d-flex ml-2 mb-1">
                    <div class="col-5 d-flex">
                        <div class="mr-3">
                            @if(session()->get('confirm') == $source->id)
                                <form style="line-height: 1" action="{{ route('admin.source.destroy', $source) }}"
                                      method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" name="confirmed"
                                            class="py-1 my-0 font-weight-bolder rounded shadow-sm btn
                                btn-sm btn-success" title="подтвердить">
                                        Подтвердить
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.source.destroy', $source) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                            class="font-weight-bolder rounded btn btn-sm btn-danger px-2 shadow-sm"
                                            title="удалить">
                                        X
                                    </button>
                                </form>
                            @endif
                        </div>
                        {{$source->name}}
                    </div>
                    <div class="col-7">
                        {{$source->url}}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $sources->links() }}
        </div>
    </div>
@endsection
