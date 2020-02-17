@section('menu')
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav font-weight-bolder mr-auto py-3">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Приветствие</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   data-toggle="tooltip" data-placement="bottom" title="список имеющихся категорий новостей"
                   href="{{ route('categories') }}">Категории</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('about') }}">Мы</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-primary font-weight-bold ml-3"
                   data-toggle="tooltip" data-placement="bottom" title="произведение изменений в списке новостей"
                   href="{{ route('admin.list') }}">Администрирование</a>
            </li>
        </ul>
    </div>

    <div class="collapse navbar-collapse flex justify-content-md-end" id="navbarNavDropdown">
        <ul class="navbar-nav  font-weight-bolder my-2">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Вход</a>
            </li>
        </ul>
    </div>
@endsection
