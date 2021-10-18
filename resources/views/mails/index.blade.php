@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            ¡La membresia {{ $membership->membership }} Cambio de estado!
        @endcomponent
    @endslot
{{-- Body --}}
    <p>Hola! {{ $membership->user_name }},<br> Se ha modificado el estado de la membresia {{ $membership->membership }}.</p>
    <ul style="list-style-type: none;">
        <li>Tipo: {{ $membership->typeHash }}</li>
        <li>Estado: {{ $membership->status }}</li>
        <li>Actualizada: {{ $membership->updated_at }}</li>
        <li>Email de usuario: {{ $membership->user_email }}</li>
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