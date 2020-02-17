@section('menu')
    <div class="collapse navbar-collapse mr-auto py-3" id="navbarNavDropdown">
        <div class="btn-group navbar-nav" role="group" aria-label="Basic example">
            <a class="btn btn-primary font-weight-bolder" data-toggle="tooltip"
               data-placement="bottom" title="произведение изменений в списке новостей"
               href="{{ route('admin.list') }}">список администратора</a>

            <a class="btn btn-danger font-weight-bolder"
               data-toggle="tooltip" data-placement="bottom" title="сброс данных сессии"
               href="{{ route('admin.reset') }}">сброс</a>

            <a class="btn btn-success font-weight-bolder"
               data-toggle="tooltip" data-toggle="tooltip" data-placement="bottom" title="возврат к категориям"
               href="{{ route('categories') }}">список пользователя</a>
        </div>
    </div>
@endsection

