<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav font-weight-bolder mr-auto py-3">
        <li class="nav-item">
            <a class="nav-link"
               data-toggle="tooltip" data-placement="bottom" title="список имеющихся категорий новостей"
               href="{{ route('news.categories') }}">Категории</a>
        </li>

        <li class="nav-item">
            <a class="nav-link"
               data-toggle="tooltip" data-placement="bottom" title="список имеющихся категорий новостей"
               href="{{ route('news.about') }}">мЫ</a>
        </li>

        @if (!\Auth::guest())
            @if (\Auth::user()->is_admin)
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" v-pre>
                        Aдминистрирование <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           data-toggle="tooltip" data-placement="bottom" title="редактор категорий"
                           href="{{ route('admin.parse') }}">
                            Загрузить новости (RSS)
                        </a>

                        <a class="dropdown-item"
                           data-toggle="tooltip" data-placement="bottom" title="редактор новостей"
                           href="{{ route('admin.news.create') }}">Создать новость</a>

                        <a class="dropdown-item"
                           data-toggle="tooltip" data-placement="bottom" title="редактор категорий"
                           href="{{ route('admin.user.index') }}">
                            Список пользователей
                        </a>
                    </div>
                </li>
            @endif
        @endif
    </ul>
</div>


