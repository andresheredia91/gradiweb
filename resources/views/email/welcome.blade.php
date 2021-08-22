@component('mail::message')

# Bienvenido

Es un placer que cuentes con nosotros **{{$name}}**,  {{-- break line --}}

Tu email es: {{$email}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent