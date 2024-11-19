<!--
    Ce code HTML correspond au contenu du menu de la barre latéral gauche (après authentification)
-->

<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a class="simple-text logo-normal">
      {{ __('Network Manager') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'Tableau De Bord' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Tableau de bord') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'dns' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('dns') }}">
          <i class="material-icons">dns</i>
          <p>{{ __('Service DNS') }}</p>
        </a>
      <li class="nav-item{{ $activePage == 'Services de CUB' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('link') }}">
          <i class="material-icons">language</i>
          <p>{{ __('Services de CUB') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>