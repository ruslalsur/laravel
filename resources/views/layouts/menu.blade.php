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
            @isset($authorizedUserInfo)
                @if($authorizedUserInfo['role'] == 'admin')
                    <li class="nav-item">
                        <a class="btn btn-outline-primary font-weight-bold ml-3"
                           data-toggle="tooltip" data-placement="bottom"
                           title="произведение изменений в списке новостей"
                           href="{{ route('admin.list') }}">администрирование</a>
                    </li>
                @endif
            @endisset
        </ul>
    </div>

    <div class="collapse navbar-collapse flex justify-content-md-end" id="navbarNavDropdown">
        <ul class="navbar-nav  font-weight-bolder my-2">
            @isset($authorizedUserInfo)
                <li class="nav-item">
                    <h5 class="nav-link pb-0 mb-0 font-weight-bolder text-success pr-4">{{ $authorizedUserInfo['email'] }}</h5>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.logout') }}">Выход</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.reg') }}">Регистрация</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('auth.login') }}">Вход</a>
                </li>
            @endisset
        </ul>
    </div>
@endsection
