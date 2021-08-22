@extends('layouts.dashboard.dashboard')
@section('content')
    <section class="content">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Listado de Usuarios</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <table id="usuario" class="table table-bordered table-striped">
                    <!--<table id="tablaBusqueda" class="table table-bordered table-striped">-->
                    <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Fecha Creación</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Acciones</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Fecha Creación</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="box-footer">
                <div class="col-md-3">
                    <a href="{!! URL('users/create') !!}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Usuario</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            /*
            |--------------------------------------------------------------------------
            | Datatable de busqueda
            |--------------------------------------------------------------------------
            */
            $('#usuario').DataTable({
                serverSide: true,
                processing: true,
                ajax: '{{ env('APP_URL') }}' + '/users/ajax',
                columns: [
                    {data: 'actions',orderable: false, searchable: false},
                    {data: 'name',orderable: true, searchable: true},
                    {data: 'email',orderable: true, searchable: true},
                    {data: 'created_at',orderable: true, searchable: true},
                ]
            });

            /*
            |--------------------------------------------------------------------------
            | Delete User
            |--------------------------------------------------------------------------
            */
            $('#usuario').on('click', '#delete', function (e) {
            e.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ env('APP_URL') }}'+$(this).data('url'),
                type: 'DELETE',
                dataType: 'json',
                data: {
                    method: '_DELETE',
                    submit: true,
                }
            })
            .done(function(data, textStatus, jqXHR) {
                toastr["error"](data.message)
                $('#usuario').DataTable().ajax.reload();
            })
            .fail(function(data, textStatus, jqXHR) {
                alert(data.message);
            })
        });
        });

    </script>
@endsection