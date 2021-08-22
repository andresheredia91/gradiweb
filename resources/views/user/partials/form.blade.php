<div class="box-body">
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif
    {{-- @include('partials.errors') --}}
    <div class="row">
        <div class="col-md-12">
            <h4 class=""><i class="fa fa-book"></i> Información Del Usuario</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            {!! Field::text('name', $user->name ?? null,[
                'label' => 'Nombre de Usuario',
                'class' => '',
                'ph' => 'jhon.doe',
            ])!!}
        </div>
        <div class="col-md-4">
            {!! Field::text('email',$user->email ?? null,[
                'label' => 'Email',
                'class' => '',
                'ph' => 'jhon@gmail.com',
            ])!!}
        </div>
        <div class="col-md-4">
            {!! Field::password('password',[
                'label' => 'Password',
                'class' => '',
            ])!!}
        </div>
    </div>
</div>
<div class="overlay loading" style="display:none;">
    <i class="fa fa-refresh fa-spin"></i>
</div>