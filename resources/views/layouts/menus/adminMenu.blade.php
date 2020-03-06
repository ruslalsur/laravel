<div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav font-weight-bolder mr-auto py-3">
        <li class="nav-item">
            <a class="nav-link"
               data-toggle="tooltip" data-placement="bottom" title="список имеющихся категорий новостей"
               href="{{ route('news.categories') }}">Категории</a>
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
                           data-toggle="tooltip" data-placement="bottom" title="редактор новостей"
                           href="{{ route('news.create') }}">Создать новость</a>

                        <a class="dropdown-item"
                           data-toggle="tooltip" data-placement="bottom" title="редактор категорий"
                           href="{{ route('category.create') }}">
                            Редактор категорий
                        </a>


                        <div class="dropdown-divider"></div>
                        <h5 class="card-header">Пользователи</h5>
                        @foreach(\App\User::all() as $user)
                            <a class="dropdown-item"
                               data-toggle="tooltip" data-placement="bottom" title="пользователь"
                               href="{{ route('admin.updateProfile', $user) }}">
                                {{$user->name}}
                            </a>
                        @endforeach
                    </div>
                </li>
            @endif
        @endif
    </ul>
</div>
