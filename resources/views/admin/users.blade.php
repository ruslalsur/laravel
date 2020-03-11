@extends('layouts.main')

@section('title')@parentкатегорий@endsection

@section('menu')
    @include('layouts.menus.menu')
@endsection

@section('content')
    <div class="content">
        <h3 class="mt-3 mb-4">Список пользователей
            <small class="">
                <a href="{{ route('admin.user.create') }}"
                   class="nav-justified text-decoration-none font-weight-bolder
                    text-primary" title="создать">
                    пополнить список
                </a>
            </small></h3>
        <div class="shadow p-3 mb-3 bg-white rounded">

            @foreach($users as $user)
                <div class="d-flex align-items-baseline ml-2">
                    <form action="{{ route('admin.user.destroy', $user) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" @if($user->id === 1) disabled @endif
                        class="text-decoration-none font-weight-bolder border rounded px-2 shadow text-danger"
                                title="удалить">
                            x
                        </button>
                    </form>

                    <a class="dropdown-item @if($user->is_admin) font-weight-bolder text-danger @endif"
                       data-toggle="tooltip" data-placement="bottom" title="пользователь"
                       href="{{ route('admin.user.edit', $user->id) }}">
                        <img src="{{ asset($user->avatar) }}" class="mr-3" alt="{{ $user->avatar }}" height="25"
                             width="25">
                        {{$user->name}}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
