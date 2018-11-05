<nav id="menuLateral" class="fh">
    <ul class="navbar-nav bg-success">
      <li class="nav-item">
          <a class="nav-link" href="{{ route('home')}}"><i class="fas fa-home"></i>Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index')}}"><i class="fas fa-address-book"></i>Usuarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('institution.index')}}"><i class="fas fa-building"></i>Instituicoes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('group.index')}}"><i class="fas fa-users"></i>Grupo</a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('moviments.invest')}}"><i class="far fa-money-bill-alt"></i>Investir</a>
      </li>
      <li class="nav-item">
            <a class="nav-link" href="{{ route('moviments.getBack')}}"><i class="far fa-money-bill-alt"></i>Resgatar</a>
        </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('moviments.index')}}"><i class="fas fa-dollar-sign"></i>Investimentos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('moviments.all')}}"><i class="fas fa-dollar-sign"></i>Extrato</a>
    </li>

    </ul>  
</nav>