<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url('dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">FT UDINUS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo site_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Program Studi -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'program_studi') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo site_url('program_studi'); ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Program Studi</span></a>
    </li>

    <!-- Nav Item - CPL -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'cpl') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo site_url('cpl'); ?>">
            <i class="fas fa-fw fa-graduation-cap"></i>
            <span>CPL</span></a>
    </li>

    <!-- Nav Item - PI -->
    <li class="nav-item <?php echo ($this->uri->segment(1) == 'performa_index') ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo site_url('performa_index'); ?>">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Performa Index</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>