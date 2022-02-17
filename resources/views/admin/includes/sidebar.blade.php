<div class="layoutNav shadow" id="#navDesktop">
    <div class="nav-items">
        <div class="sidenav-menu-heading">Dashboard</div>
        <a class="nav-link @if(Route::currentRouteName()=="admin") active @endif" 
        href="{{ route('admin') }}">
            <i class="fas fa-tachometer-alt text-gray pr-1"></i> Dashboard
        </a>

        <div class="sidenav-menu-heading">Bingo</div>
        <a class="nav-link @if(Route::currentRouteName()=="users.index" || Route::currentRouteName()=="users.edit" || Route::currentRouteName()=="users.create") active @endif" 
        href="{{ route('users.index') }}">
            <i class="fas fa-user-shield text-gray pr-1"></i> Usuarios
        </a>
        <a class="nav-link @if(Route::currentRouteName()=="bingo.index" || Route::currentRouteName()=="bingo.edit" || Route::currentRouteName()=="bingo.create") active @endif" 
        href="{{ route('bingo.index') }}">
            <i class="fas fa-gamepad text-gray pr-1"></i> Bingo
        </a>
        <a class="nav-link @if(Route::currentRouteName()=="winners.index" || Route::currentRouteName()=="winners.edit" || Route::currentRouteName()=="winners.create") active @endif" 
        href="{{ route('winners.index') }}">
            <i class="fas fa-trophy text-gray pr-1"></i> Ganadores
        </a>


    </div>
    <div class="nav-footer py-4">
        <p>Logueado como:</p>
        <p>{{ ucwords(Auth::user()->name) }} {{ ucwords(Auth::user()->lastname) }}</p>
        <p>{{ getRole(Auth::user()->role) }}</p>
    </div>
</div>