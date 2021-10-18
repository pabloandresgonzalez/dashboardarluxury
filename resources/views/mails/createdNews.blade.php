@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            ¡Nuevas Noticias en {{ config('app.name') }}!
        @endcomponent
    @endslot
{{-- Body --}}
    <p>Hola! apreciad@ usuari@,<br> Mira la nueva noticia "{{ $news->title }}".</p>
    <ul style="list-style-type: none;">
        <li>{{ $news->intro }}...</li>
        <li>{{ $news->created_at }}</li>
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