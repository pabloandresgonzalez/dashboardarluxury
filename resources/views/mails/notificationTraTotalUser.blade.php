@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            ¡Solicitud de traslado total!
        @endcomponent
    @endslot
{{-- Body --}}
    <p>Hola! {{ $user->name }},<br> haz enviado una solicitud de traslado total.</p>    
    <br>
    <div>
        <p>Datos de la solicitud</p>
        <ul>
          <p><strong>Informacion usuario</strong></p>
          <li style="list-style:none;"> &nbsp;Usario: {{ $user->name }} - {{ $user->lastname }}</li>
          <li style="list-style:none;"> &nbsp;Email: {{ $user->email}}</li>
          <li style="list-style:none;"> &nbsp;Phone: {{ $user->cellphone}}</li>
          <hr style="height:0px;width:60%;display:inline-block;">
          <p><strong>Datos del traslado</strong></p>
          <li style="list-style:none;"> &nbsp;Tipo de movimiento: {{ $type }}</li>
          <li style="list-style:none;"> &nbsp;Valor total traslado: <strong>{{ $valotTotal }}</strong></li>
          <li style="list-style:none;"> &nbsp;Detalle: {{ $message }}</li>
          <hr style="height:0px;width:60%;display:inline-block;">
          <p><strong>Balance general del usuario</strong></p>          
          <li style="list-style:none;"> &nbsp;Balance: {{ $balance }}</li>
          <li style="list-style:none;"> &nbsp;En canje: {{ $encanje }}</li>
          <li style="list-style:none;"> &nbsp;Traslados: {{ $traslados }}</li>
          <li style="list-style:none;"> &nbsp;Saldo: {{ $valotTotal }}</li>
        </ul>
        <h5>Este traslado está sujeto a validación por parte del administrador de portal.</h5>
    </div>
    <br>
    Email: {{ $user->email }}<br>
    Phone: {{ $user->cellphone}}
    <br>

    Mas informacion en {{ route('login') }}

    Este es un correo automatico por favor no responder.

    
{{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset
{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}.
        @endcomponent
    @endslot
@endcomponent