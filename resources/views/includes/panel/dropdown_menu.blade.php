  <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
    <div class=" dropdown-header noti-title">
      <h6 class="text-overflow m-0">Bienvenido!</h6>
    </div>
    <a href="/user/indexperfil" class="dropdown-item">
      <i class="ni ni-single-02"></i>
      <span>Mi perfil</span>
    </a>
    <a href="#" class="dropdown-item">
      <i class="ni ni-settings-gear-65"></i>
      <span>Configuración</span>
    </a>
    <a href="{{ route('mismembership') }}" class="dropdown-item">
      <i class="ni ni-box-2 "></i>
      <span>Mis membresías</span>
    </a>
    <a href="https://wa.me/573143625063?text=%20Hola! %20Requiero%20de%20su%20ayuda%20para%20un%20soporte%20en%20AR_LUXURY,%20Gracias" class="dropdown-item">
      <i class="ni ni-support-16"></i>
      <span>Ayuda</span>
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
      <i class="ni ni-user-run"></i>
      <span>Cerrar sesion</span>
    </a>
  </div>