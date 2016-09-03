<ul class="sidebar-menu">
    <li class="header">Menu</li>
    <li class="{{ (Request::is('admin/users*') ? 'active' : '') }}"><a href="/admin/users"><i class="fa fa-book"></i> <span>Users</span></a></li>
    <li class="{{ (Request::is('admin/employees*') ? 'active' : '') }}"><a href="/admin/employees"><i class="fa fa-book"></i> <span>Employees</span></a></li>
    <li class="{{ (Request::is('admin/roles*') ? 'active' : '') }}"><a href="/admin/roles"><i class="fa fa-book"></i> <span>Permissions</span></a></li>
</ul>