<div class="collapse navbar-collapse mr-auto" id="navbarNavDropdown">
    <div class="btn-group navbar-nav" role="group" aria-label="Basic example">
        <ul class="navbar-nav font-weight-bolder mr-auto py-3">
            <li class="nav-item">
                <a class="nav-link"
                   data-toggle="tooltip" data-placement="bottom" title="список имеющихся категорий новостей"
                   href="{{ route('news.categories') }}">
                    Категории
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                   data-toggle="tooltip" data-placement="bottom" title="добавить новость"
                   href="{{ route('admin.add') }}">
                    Создание новости
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                   data-toggle="tooltip" data-placement="bottom" title="добавить категорию"
                   href="{{ route('admin.categoryCreator') }}">
                    Создание категории
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link"
                   data-toggle="tooltip" data-placement="bottom" title="сброс данных сессии"
                   href="{{ route('admin.reset') }}">
                    Сброс сессии
                </a>
            </li>
        </ul>
    </div>
</div>
