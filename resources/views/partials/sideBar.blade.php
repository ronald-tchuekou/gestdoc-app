<div class="main-menu menu-fixed menu-accordion menu-shadow menu-light">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand"
                    href="/">
                    <div class="app-logo"><img src="{{asset('images/logo/logo.png')}}" alt="logo"/></div>
                    <h2 class="brand-text mb-0">GESTDOC</h2>
                </a></li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item  @if($current_action == 'dashboard') active @endif">
                <a href="/"><i class="feather icon-home"></i><span class="menu-title"
                        data-i18n="Dashboard">Dashboard</span></a>
            </li>

            <li class="nav-item @if($current_action == 'profile') active @endif">
                <a href="/{{$current_account}}/profile"><i class="feather icon-user"></i><span class="menu-title"
                        data-i18n="Profile">Profile</span></a>
            </li>

            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Root')
            <li class="nav-item @if($current_action == 'agents') active @endif">
                <a href="/{{$current_account}}/agents"><i class="feather icon-users"></i><span class="menu-title"
                        data-i18n="Agents">Agents</span></a>
            </li>
            @endif

@if(Auth::user()->role != 'Agent')
            <li class="nav-item @if($current_action == 'couriers') active @endif">
                <a href="/{{$current_account}}/couriers">
                    <i class="feather icon-clipboard"></i>
                    <span class="menu-title" data-i18n="Courriers">
                        @if(Auth::user()->role == 'Accueil') Courriers initialisés @else Gestion des courriers @endif
                    </span>
                </a>
            </li>
@endif

@if(Auth::user()->role == 'Admin')
            <li class="nav-item @if($current_action == 'categories') active @endif">
                <a href="/{{$current_account}}/categories">
                    <i class="feather icon-folder"></i>
                    <span class="menu-title" data-i18n="Categories Courrier">
                        Categores Courrier
                    </span>
                </a>
            </li>
@endif
            <!-- <li class="nav-item @if($current_action == 'parametres') active @endif">
                <a href="/{{$current_account}}/parametres"><i class="feather icon-settings"></i><span class="menu-title"
                        data-i18n="Parametres">Parametres</span></a>
            </li> -->

            <li class="nav-item"><a href="/loginOut"><i class="feather icon-log-out"></i><span class="menu-title"
                        data-i18n="Logout">Déconnexion</span></a>
            </li>
        </ul>
    </div>
</div>
