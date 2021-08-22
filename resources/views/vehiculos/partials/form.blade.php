<div class="box-body">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
            {{-- @include('partials.errors') --}}
            <div class="row">
                <div class="col-md-12">
                    <h4 class=""><i class="fa fa-book"></i> Informacion Inicial</h4>
                </div>
                <div class="col-md-3">
                    {!! Field::select('usuario', $users  ?? [],
                        $vehiculo->user_id ?? null,
                        ['label'=>'Propietario','class'=> 'select2', 'style'=>'width: 100%', 'required'])
                    !!}
                </div>

                <div class="col-md-3">
                    {!! Field::select('marca', $marcas  ?? [],
                        $vehiculo->marca_id ?? null,
                        ['label'=>'Marca','class'=> 'select2', 'style'=>'width: 100%', 'required'])
                    !!}
                </div>

                <div class="col-md-4">
                    {!! Field::select('tipo', $tipos  ?? [],
                        $vehiculo->tipo_id ?? null,
                        ['label'=>'Tipo','class'=> 'select2', 'style'=>'width: 100%', 'required'])
                    !!}
                </div>

                <div class="col-md-2">
                    {!! Field::text('placa', $vehiculo->placa ?? null,[
                        'label' => 'Placa',
                        'class' => '',
                        'ph' => 'AAA231',
                        'required'
                    ])!!}
                </div>
            </div>
        </div>
        <div class="overlay loading" style="display:none;">
          <i class="fa fa-refresh fa-spin"></i>
        </div>
