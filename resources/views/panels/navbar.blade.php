@if($configData["mainLayoutType"] === 'horizontal' && isset($configData["mainLayoutType"]))
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}" data-nav="brand-center">
  <div class="navbar-header d-xl-block d-none">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="navbar-brand" href="{{url('/')}}">
          <span class="brand-logo">
            <img src="{{asset('images/logo/logo.png')}}" alt="Logo">
          </span>
          <h2 class="brand-text mb-0">{{ config('app.name') }}</h2>
        </a>
      </li>
    </ul>
  </div>
  @else
  <nav class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }}">
    @endif
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav">
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link nav-link-style">
              <i class="ficon" data-feather="{{($configData['theme'] === 'dark') ? 'sun' : 'moon' }}"></i>
            </a>
          </li>
        </ul>
      </div>
      <ul class="nav navbar-nav align-items-center ml-auto">
        <li class="nav-item dropdown dropdown-language">
          <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="flag-icon flag-icon-us"></i>
            <span class="selected-language">Inglês</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
            <a class="dropdown-item" href="{{url('lang/pt')}}" data-language="pt">
              <i class="flag-icon flag-icon-pt"></i> Português
            </a>
          </div>
        </li>
        <li class="nav-item dropdown dropdown-user">
          <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="user-nav d-sm-flex d-none">
              <span class="user-name font-weight-bolder">{{ $user->fullName }}</span>
              <span class="user-status">{{ __("roles.{$user->role}") }}</span>
            </div>
            <span class="avatar">
              <img class="round" src="{{ route('dashboard.users.avatar.me') }}" alt="avatar" height="40"
                   width="40">
              <span class="avatar-status-online"></span>
            </span>
          </a>

          <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
          </form>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('dashboard.settings') }}">
              <i class="mr-50" data-feather="settings"></i> Configurações
            </a>
            <button form="logout-form" type="submit" style="width: 100%a" class="dropdown-item" href="{{ route('logout') }}">
              <i class="mr-50" data-feather="power"></i> Sair
            </button>
            <div class="dropdown-divider"></div>
          </div>
        </li>
      </ul>
    </div>
  </nav>

    <!-- END: Header-->
</nav>
