<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('dashboard')}}" class="brand-link">
    <img src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Laraveille</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{auth()->user()->name}}</a>
      </div>
    </div>
    
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-header">CATEGORIES</li>
        @foreach($categories as $category)
        <li class="nav-item menu-close">
          <a href="#" class="nav-link ">
            @if($category->icon == null)
              <i class="fas fa-circle nav-icon"></i>
              {{-- <i class="fab fa-joomla nav-icon"></i> --}}
            @else
              <i class="fas {{ $category->icon }} nav-icon"></i>
            @endif
            <p>
              {{ $category->name }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if($category->children)
              @foreach($category->children as $child)
                <li class="nav-item">
                  <a href="{{route('category.show', $child->id)}}" class="nav-link">
                    @if($child->icon == null)
                      <i class="far fa-circle nav-icon"></i>
                      {{-- <i class="fab fa-joomla nav-icon"></i> --}}
                    @else
                      <i class="fas {{ $child->icon }} nav-icon"></i>
                    @endif
                    <p>{{ $child->name }}</p>
                  </a>
                </li>
              @endforeach
            @endif
          </ul>
        </li>
        @endforeach
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->  
</aside>