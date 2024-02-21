
<section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span><i>Beranda</i></span></a></li>
    
    <li class="header">DATA MASTER</li>
    
    
    <li class="{{ (request()->is('superadmin/user*')) ? 'active' : '' }}"><a href="/superadmin/user"><i class="fa fa-arrow-right"></i> <span><i>Data User</i></span></a></li>
    <li class="{{ (request()->is('superadmin/program*')) ? 'active' : '' }}"><a href="/superadmin/program"><i class="fa fa-arrow-right"></i> <span><i>Data Program</i></span></a></li>
    <li class="{{ (request()->is('superadmin/kegiatan*')) ? 'active' : '' }}"><a href="/superadmin/kegiatan"><i class="fa fa-arrow-right"></i> <span><i>Data Kegiatan</i></span></a></li>
    <li class="{{ (request()->is('superadmin/subkegiatan*')) ? 'active' : '' }}"><a href="/superadmin/subkegiatan"><i class="fa fa-arrow-right"></i> <span><i>Data Subkegiatan</i></span></a></li>
    <li class="{{ (request()->is('superadmin/rincian*')) ? 'active' : '' }}"><a href="/superadmin/rincian"><i class="fa fa-arrow-right"></i> <span><i>Data Rincian</i></span></a></li>
    <li class="header">VERIFIKASI DATA</li>
    <li class="{{ (request()->is('superadmin/npd*')) ? 'active' : '' }}"><a href="/superadmin/npd"><i class="fa fa-file"></i> <span><i>NPD Anggaran</i></span></a></li>
    <li class="{{ (request()->is('superadmin/npdp*')) ? 'active' : '' }}"><a href="/superadmin/npdp"><i class="fa fa-file"></i> <span><i>NPD Pencairan</i></span></a></li>
    {{-- <li class="{{ (request()->is('superadmin/tim*')) ? 'active' : '' }}"><a href="/superadmin/tim"><i class="fa fa-arrow-right"></i> <span><i>Tim</i></span></a></li>
    <li class="{{ (request()->is('superadmin/partner*')) ? 'active' : '' }}"><a href="/superadmin/partner"><i class="fa fa-arrow-right"></i> <span><i>Partner</i></span></a></li>
    <li class="{{ (request()->is('superadmin/hubungikami*')) ? 'active' : '' }}"><a href="/superadmin/hubungikami"><i class="fa fa-arrow-right"></i> <span><i>Hubungi Kami</i></span></a></li> --}}
    <li class="header">SETTING</li>
    <li class="{{ (request()->is('superadmin/gp*')) ? 'active' : '' }}"><a href="/superadmin/gp"><i class="fa fa-key"></i> <span><i>Ganti Pass</i></span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span><i>Logout</i></span></a></li>
    @else
        
    <li class="{{ (request()->is('admin')) ? 'active' : '' }}"><a href="/admin"><i class="fa fa-home"></i> <span><i>Dashboard</i></span></a></li>
    <li class="{{ (request()->is('admin/pengajuan*')) ? 'active' : '' }}"><a href="/admin/npd"><i class="fa fa-file"></i> <span><i>NPD</i></span></a></li>
    <li class="{{ (request()->is('admin/gp*')) ? 'active' : '' }}"><a href="/admin/gp"><i class="fa fa-key"></i> <span><i>Ganti Pass</i></span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span><i>Logout</i></span></a></li>
    {{-- <li class="{{ (request()->is('pemohon/daftar-layanan*')) ? 'active' : '' }}"><a href="/pemohon/daftar-layanan"><i class="fa fa-list"></i> <span>Daftar Layanan</span></a></li> --}}
    @endif
    </ul>
    <!-- /.sidebar-menu -->
</section>