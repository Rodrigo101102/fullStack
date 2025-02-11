<aside style="background: rgb(0, 0, 0)" class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- User Info --}}  <!-- Aquí agregamos los datos del usuario -->
    <div class="user-info p-3">
        <div class="d-flex align-items-center">
            <!-- Imagen del perfil -->
            <img src="{{ asset(Auth::user()->images ?? 'path/to/default-image.jpg') }}" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px; object-fit: cover;">
            <!-- Nombre del usuario -->
            <span class="ms-2 text-white" style="font-weight: bold;">{{ Auth::user()->name }}</span>
        </div>
    </div>

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>
