@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            ¡Solicitud de transaccion!
        @endcomponent
    @endslot
{{-- Body --}}
    <p>Hola! Admin,<br> Se realizo una solicitud de transaccion en {{ config('app.name') }}.</p>
    <ul style="list-style-type: none;">
        <li>Valor: {{ $Wallet->value }}</li>
        <li>Divisa: {{ $Wallet->currency }}</li>
        <li>Detalle: {{ $Wallet->detail }}</li>
        <li>Id de  usuario: {{ $Wallet->user }}</li>
        <li>Fecha: {{ $Wallet->created_at }}</li>
    </ul>

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