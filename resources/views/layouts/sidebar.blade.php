<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tools" style="font-size: 150%"></i>
        </div>
        <div class="sidebar-brand-text mx-3">King <sup>Service</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    @if (Auth::user()->is_admin == 1)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Kendaraan
        </div>
        <li class="nav-item {{ request()->is('admin/tipe-kendaraan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tipe-kendaraan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Kendaraan</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Sparepart
        </div>
        <li class="nav-item {{ request()->is('admin/sparepart-kendaraan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('sparepart-kendaraan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Sparepart</span></a>
        </li>
        <li class="nav-item {{ request()->is('admin/pembelian-sparepart-kendaraan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pembelian-sparepart-kendaraan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Pembelian Sparepart</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Data Keuangan
        </div>
        <li class="nav-item {{ request()->is('admin/pemasukkan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pemasukkan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Pemasukkan</span></a>
        </li>
        <li class="nav-item {{ request()->is('admin/pengeluaran') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pengeluaran.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Pengeluaran</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Booking
        </div>
        <li class="nav-item {{ request()->is('admin/booking-list') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.booking.list') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>List Booking</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Invoice
        </div>
        <li class="nav-item {{ request()->is('admin/invoice') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('invoice.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Invoice</span></a>
        </li>
        <li class="nav-item {{ request()->is('admin/invoice/create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('invoice.create') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Tambah Invoice</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Tips & Tricks
        </div>
        <li class="nav-item {{ request()->is('admin/tips-tricks') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('tips-tricks.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Tips & Tricks</span></a>
        </li>
    @endif

    @if (Auth::user()->is_admin == 0)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Booking
        </div>
        <li class="nav-item {{ request()->is('user/booking') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('booking.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>List Booking Service</span></a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li
            class="nav-item  {{ (request()->is('user/booking/create') ? 'active' : '' || request()->is('user/create-mandiri')) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Booking Service</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Booking Kendaraan:</h6>
                    <a class="collapse-item {{ request()->is('user/booking/create') ? 'active' : '' }}"
                        href="{{ route('booking.create') }}">Rekomendasi</a>
                    <a class="collapse-item {{ request()->is('user/create-mandiri') ? 'active' : '' }} "
                        href="{{ route('booking.create.mandiri') }}">Mandiri</a>
                </div>
            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
