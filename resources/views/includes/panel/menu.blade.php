<h6 class="navbar-heading text-muted">
@if (auth()->user())
  Gestionar cuenta </h6>
@else
  Menu
@endif
</h6>
  <ul class="navbar-nav">
      @include('includes.panel.menu.admin')
    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
        <i class="ni ni-button-power text-yellow "></i> Cerrar sesión
      </a>
      <form action="{{ route('logout') }}" method="POST" style="display: none;" id="formLogout">
        @csrf

      </form>
    </li>
  </ul>
  @if (auth()->user())
  {{-- Divider --}}
  <hr class="my-3">
  {{-- Heading --}}
  <h6 class="navbar-heading text-muted">Resportes</h6>
  {{-- Navigation --}}
  <ul class="navbar-nav mb-md-3">
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-collection text-primary"></i> Frecuencia
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <i class="ni ni-folder-17 text-danger"></i> Historial
      </a>
    </li>
  </ul>
  @endif