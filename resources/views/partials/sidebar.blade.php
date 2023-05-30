<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark dash-sidebar">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-4">Menù</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link  text-white @if(Route::currentRouteName() == 'admin.dashboard') active @endif " aria-current="page">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Dashboard
        </a>
      </li>

      <li>
        <a href="{{ route('admin.projects.index') }}" class="nav-link text-white @if(Route::currentRouteName() == 'admin.projects.index') active @endif">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Progetti
        </a>
      </li>

      <li>
        <a href="{{ route('admin.projects.create') }}" class="nav-link text-white @if(Route::currentRouteName() == 'admin.projects.create') active @endif">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Crea nuovo progetto
        </a>
      </li>

      <li>
        <a href="{{ route('admin.types.index') }}" class="nav-link text-white @if(Route::currentRouteName() == 'admin.types.index') active @endif">
          <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Tipologie
        </a>
      </li>

      
    </ul>
  </div>