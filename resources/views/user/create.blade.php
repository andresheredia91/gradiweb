@extends('layouts.dashboard.dashboard')
@section('content')
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h2 class="box-title">Creacion de Usuario</h2>
        </div>
        {!! Form::open($ruta) !!}
            @include('user.partials.form')
        <div class="box-footer">
            {!! Form::submit('Guardar', ['class' => 'btn btn-primary pull-right']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('.select2').select2({
            placeholder: 'Seleccione una opcion'
        });

    });
</script>
@endsection