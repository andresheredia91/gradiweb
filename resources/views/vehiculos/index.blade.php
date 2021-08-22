@extends('layouts.dashboard.dashboard')
@section('content')
<section class="content">
	<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Vehiculos</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <table id="vehiculos" class="table table-bordered table-striped">
            <!--<table id="tablaBusqueda" class="table table-bordered table-striped">-->
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>Propietario</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Acciones</th>
                        <th>Propietario</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Tipo</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            <div class="col-md-3">
                <a href="{!! URL('vehiculos/create') !!}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo Vehiculo</a>
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

        $('#vehiculos').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthChange: false,
            ajax: '{{ env('APP_URL') }}' + '/vehiculos/ajax',
            columns: [
                {data: 'actions'},
                {data: 'user.name'},
                {data: 'placa'},
                {data: 'marca.description'},
                {data: 'tipo.description'}
            ]
        });


       $('#vehiculos').on('click', '#delete', function (e) {
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
                $('#cities').DataTable().ajax.reload();
            })
            .fail(function(data, textStatus, jqXHR) {
                alert(data.message);
            })
        });

    });

</script>
@endsection
