<header>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="{{ asset('/') }}">НОВОСТИ</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="#navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Приветствие</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cat') }}">Категории</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('addNews') }}">Добавить новость</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Мы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Войти</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

