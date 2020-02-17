@section('menu')
    <div class="collapse navbar-collapse mr-auto py-3" id="navbarNavDropdown">
        <div class="btn-group navbar-nav" role="group" aria-label="Basic example">
            <a class="btn btn-outline-primary font-weight-bolder" data-toggle="tooltip"
               data-placement="bottom" title="произведение изменений в списке новостей"
               href="{{ route('admin.list') }}">Административный список</a>

            <a class="btn btn-danger font-weight-bolder"
               data-toggle="tooltip" data-placement="bottom" title="отменить все произведенные изменения в списке новостей"
               href="{{ route('admin.reset') }}">Сброс данных сессии</a>

            <a class="btn btn-outline-success font-weight-bolder"
               data-toggle="tooltip" data-toggle="tooltip" data-placement="bottom" title="возврат к категориям"
               href="{{ route('categories') }}">К списку категорий</a>
        </div>
    </div>
@endsection

