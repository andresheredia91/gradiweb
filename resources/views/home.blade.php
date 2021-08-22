@extends('layouts.dashboard.dashboard')
@section('content')
<section class="content-header">
  <h1>
    Dashboard
    <small>Panel de Control</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

  <!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3>{{$countUsers}}</h3>
          <p>Usuarios Del Sistema</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-plus"></i>
        </div>
        <a href="{!! URL('user') !!}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$countVehiculos}}</h3>
          <p>Vehiculos Del Sistema</p>
        </div>
        <div class="icon">
          <i class="fa fa-home"></i>
        </div>
        <a href="{!! URL('vehiculos') !!}" class="small-box-footer">Mas Información <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Vehiculos X Marca</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <table id="vehiculos" class="table table-bordered table-striped">
            <!--<table id="tablaBusqueda" class="table table-bordered table-striped">-->
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Marca</th>
                        <th>Cantidad</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
        </div>
    </div>

  </div>
</section>


@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function () {

    $('#vehiculos').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        pageLength: 10,
        lengthChange: false,
        ajax: '{{ env('APP_URL') }}' + '/vehiculos/cantidad',
        columns: [
            {data: 'marca'},
            {data: 'cantidad'}
        ]
    });

    let arrayRespuesta = [
        ["2018-12-01","AM","ID123", 5000],
        ["2018-12-01","AM","ID545", 7000],
        ["2018-12-01","PM","ID545", 3000],
        ["2018-12-02","AM","ID545", 7000]
    ]

    const result = arrayRespuesta.map(value => ({
        'date': value[0],
        'time': value[1],
        'id': value[2],
        'value': value[3],
    }));

    //Creamos un nuevo objeto donde vamos a almacenar por ciudades. 
    let nuevoObjeto = {}
    //Recorremos el arreglo 
    result.forEach( x => {
    //Si la ciudad no existe en nuevoObjeto entonces
    //la creamos e inicializamos el arreglo de profesionales. 
    if( !nuevoObjeto.hasOwnProperty(x.date)){
        nuevoObjeto[x.date] = {
        data: []
        }
    }
    
    //Agregamos los datos de profesionales. 
        nuevoObjeto[x.date].data.push({
            // x.time,
            // x.value
        })
    
    })


    console.log(nuevoObjeto)


});
</script>
@endsection