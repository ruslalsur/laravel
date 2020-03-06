<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav font-weight-bolder mr-auto py-3">
        <li class="nav-item">
            <a class="nav-link"
               data-toggle="tooltip" data-placement="bottom" title="список имеющихся категорий новостей"
               href="{{ route('news.categories') }}">Категории</a>
        </li>

        @if (session('authorizedUserId') === 0)
            <li class="nav-item">
                <a class="nav-link"
                   data-toggle="tooltip" data-placement="bottom" title="добавить новость"
                   href="{{ route('news.create') }}">Создание новости</a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                   data-toggle="tooltip" data-placement="bottom" title="добавить категорию"
                   href="{{ route('category.create') }}">
                    Создание категории
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="{{ route('news.about') }}">Мы</a>
        </li>
    </ul>
</div>


