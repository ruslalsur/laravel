@section('menu')
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav  font-weight-bolder mr-auto mt-2 mt-md-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('crud.create') }}">Добавить новость</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('crud.destroy', ['id' => 500]) }}">Убавить новость</a>
            </li>
        </ul>
    </div>

    <div class="collapse navbar-collapse flex justify-content-md-end" id="navbarNavDropdown">
        <ul class="navbar-nav  font-weight-bolder my-2">
            <li class="nav-item">
                <a class="btn btn-secondary font-weight-bolder" href="{{ route('home') }}">На главную</a>
            </li>
        </ul>
    </div>
@endsection

