<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tools" style="font-size: 150%"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Motto <sup>Buddies</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
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
        <li class="nav-item">
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
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sparepart-kendaraan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Sparepart</span></a>
        </li>
        <li class="nav-item">
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
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pemasukkan.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Pemasukkan</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pengeluaran.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Pengeluaran</span></a>
        </li>
    @endif

    @if (Auth::user()->is_admin == 1)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Booking
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('booking.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>List Booking Service</span></a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Booking Service</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Booking Kendaraan:</h6>
                    <a class="collapse-item" href="{{ route('booking.create') }}">Rekomendasi</a>
                    <a class="collapse-item" href="{{ route('booking.create.mandiri') }}">Mandiri</a>
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
