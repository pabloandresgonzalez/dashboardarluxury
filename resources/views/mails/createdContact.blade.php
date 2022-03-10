@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            ¡Hola tienes un nuevo mensaje!
        @endcomponent
    @endslot
{{-- Body --}}
    <p>Hola! Admin,<br> {{ $user->name }} te ha enviado un mensaje.</p>    
    <br><br>
    <p>{{ $message }}</p>
    <br><br>
    Email: {{ $user->email }}<br>
    Phone: {{ $user->cellphone}}
    <br><br>

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