  <div class="main-sidebar">
      <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
              <a href="#">Test</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
              <a href="#">Test</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item dropdown {{ set_active('home') }} ">
                  <a href="{{ route('home') }}" class="nav-link"><i
                          class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Fitur</li>
              <li class="nav-item {{ set_active('customer.*') }} ">
                  <a href="{{ route('customer.index') }}" class="nav-link"><i class="fas fa-users"></i>
                      <span>Customer</span></a>
              </li>
          </ul>
      </aside>
  </div>
