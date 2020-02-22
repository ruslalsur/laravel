<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav font-weight-bolder mr-auto py-3">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : "" }}" href="{{ route('home') }}">Приветствие</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               data-toggle="tooltip" data-placement="bottom" title="список имеющихся категорий новостей"
               href="{{ route('categories') }}">Категории</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">Мы</a>
        </li>
    </ul>
</div>


