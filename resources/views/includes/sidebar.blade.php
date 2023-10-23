@php $user = auth()->user() @endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard') }}" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <span class="center brand-text font-weight-light">Ticket Support System</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('profile.edit') }}" class="d-block">{{ $user->name }} @if($user->role == 1) (Admin) @elseif($user->role == 3) (User) @elseif($user->role == 2) (Agent) @endif</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Manage
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if($user->role == 1)
            <li class="nav-item">
              <a href="{{ route('category.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('ticket.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tickets</p>
              </a>
            </li>
            @elseif($user->role == 3)
            <li class="nav-item">
              <a href="{{ route('ticket.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tickets</p>
              </a>
            </li>
            @elseif($user->role == 2)
            <li class="nav-item">
              <a href="{{ route('ticket.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tickets</p>
              </a>
            </li>
            @endif
          </ul>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>