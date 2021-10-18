@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            ¡Enviaste un hash para la membresía {{ $membership->membership }}!
        @endcomponent
    @endslot
{{-- Body --}}
    <p>Hola! {{ $membership->user_name }},<br> Solicitaste la membresía {{ $membership->membership }}, Felicidades¡.</p>
    <ul style="list-style-type: none;">
        <li>Nombre: {{ $membership->membership }}</li>
        <li>Tipo hash: {{ $membership->typeHash }}</li>
        <li>Estado: {{ $membership->status }}</li>
        <li>Adquirida: {{ $membership->created_at }}</li>
        <li>Email de usuario: {{ $membership->user_email }}</li>
        <li>Id de usuario: {{ $membership->user }}</li>
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