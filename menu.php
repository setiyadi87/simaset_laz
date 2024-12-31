
<section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['SES_NAMA']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
 
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
          	<?php if(isset($_SESSION['SES_ADMIN'])){ ?>
	            <li class="header" style='color:#fff; text-transform:uppercase; border-bottom:2px solid #00c0ef'>MENU <?php echo $_SESSION['level']; ?></li>
	            <li><a href="?open"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
	            <li><a href="?open=Petugas-Data"><i class="fa fa-user"></i> <span>Data Pengguna</span></a></li>
	            <li class="treeview">
	              <a href="#"><i class="fa fa-th"></i> <span>Data Master</span><i class="fa fa-angle-left pull-right"></i></a>
	              <ul class="treeview-menu">
	                <li><a href="?open=Amil-Data"><i class="fa fa-circle-o"></i> Data Amil</a></li>
	                <li><a href="?open=Supplier-Data"><i class="fa fa-circle-o"></i> Data Supplier</a></li>
	                <li><a href="?open=Divisi-Data"><i class="fa fa-circle-o"></i> Data Divisi</a></li>
	                <li><a href="?open=Lokasi-Data"><i class="fa fa-circle-o"></i> Data Lokasi</a></li>
	                <li><a href="?open=Kategori-Data"><i class="fa fa-circle-o"></i> Data Kategori</a></li>
	                <li><a href="?open=Barang-Data"><i class="fa fa-circle-o"></i> Data Barang</a></li>
	              </ul>
	            </li>
	            
	            <li class="treeview">
	              <a href="#"><i class="fa fa-search"></i> <span>Data Pencarian</span><i class="fa fa-angle-left pull-right"></i></a>
	              <ul class="treeview-menu">
	                <li><a href="?open=Pencarian-1"><i class="fa fa-circle-o"></i> Pencarian Barang 1</a></li>
	                <li><a href="?open=Pencarian-2"><i class="fa fa-circle-o"></i> Pencarian Barang 2</a></li>
	              </ul>
	            </li>

	            <li class="treeview">
	              <a href="#"><i class="fa fa-shopping-cart"></i> <span>Data Transaksi</span><i class="fa fa-angle-left pull-right"></i></a>
	              <ul class="treeview-menu">
	                <li><a href="?open=Pengadaan-Tampil"><i class="fa fa-circle-o"></i> Transaksi Pengadaan</a></li>
	                <li><a href="?open=Penempatan-Tampil"><i class="fa fa-circle-o"></i> Transaksi Penempatan</a></li>
	                <li><a href="?open=Mutasi-Tampil"><i class="fa fa-circle-o"></i> Transaksi Mutasi</a></li>
	                <li><a href="?open=Peminjaman-Tampil"><i class="fa fa-circle-o"></i> Transaksi Peminjaman</a></li>
	              </ul>
	            </li>
	            <li class="treeview">
	              <a href="#"><i class="fa fa-calendar"></i> <span>Data Laporan</span><i class="fa fa-angle-left pull-right"></i></a>
	              <ul class="treeview-menu">
	                <li><a href="?open=Laporan-Petugas"><i class="fa fa-circle-o"></i> Data Petugas</a></li>
					<li><a href="?open=Laporan-Supplier"><i class="fa fa-circle-o"></i> Data Supplier</a></li>
					<li><a href="?open=Laporan-Amil"><i class="fa fa-circle-o"></i> Data Amil</a></li>
					<li><a href="?open=Laporan-Divisi"><i class="fa fa-circle-o"></i> Data Divisi</a></li>
					<li><a href="?open=Laporan-Lokasi"><i class="fa fa-circle-o"></i> Data Lokasi</a></li>
					<li><a href="?open=Laporan-Kategori"><i class="fa fa-circle-o"></i> Data Kategori</a></li>
					<li class="treeview">
	                  <a href="#"><i class="fa fa-circle-o"></i> Lap. Barang <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
	                  <ul class="treeview-menu">
	                    <li><a href="?open=Laporan-Barang"><i class="fa fa-circle-o"></i> List Barang</a></li>
						<li><a href="?open=Laporan-Barang-Kategori"><i class="fa fa-circle-o"></i> perKategori</a></li>
						<li><a href="?open=Laporan-Barang-Lokasi"><i class="fa fa-circle-o"></i> perLokasi</a></li>
	                  </ul>
	                </li>
					<li class="treeview">
	                  <a href="#"><i class="fa fa-circle-o"></i> Lap. Pengadaan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
	                  <ul class="treeview-menu">
	                    <li><a href="?open=Laporan-Pengadaan-Periode"><i class="fa fa-circle-o"></i> perPeriode</a></li>
						<li><a href="?open=Laporan-Pengadaan-Bulan"><i class="fa fa-circle-o"></i> perBulan</a></li>
						<li><a href="?open=Laporan-Pengadaan-Supplier"><i class="fa fa-circle-o"></i> perSupplier</a></li>
						<li><a href="?open=Laporan-Pengadaan-Barang-Periode"><i class="fa fa-circle-o"></i> Brg. PerPeriode </a></li>
						<li><a href="?open=Laporan-Pengadaan-Barang-Bulan"><i class="fa fa-circle-o"></i> Brg. PerBulan </a></li>
					    <li><a href="?open=Laporan-Pengadaan-Barang-Kategori"><i class="fa fa-circle-o"></i> Brg. PerKategori</a></li>
					    <li><a href="?open=Laporan-Pengadaan-Barang-Supplier"><i class="fa fa-circle-o"></i> Brg.  PerSupplier </a></li>
	                  </ul>
	                </li>

					<li class="treeview">
	                  <a href="#"><i class="fa fa-circle-o"></i> Lap. Penempatan <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
	                  <ul class="treeview-menu">
	                    <li><a href="?open=Laporan-Penempatan-Periode"><i class="fa fa-circle-o"></i> perPeriode</a></li>
						<li><a href="?open=Laporan-Penempatan-Bulan"><i class="fa fa-circle-o"></i> perBulan</a></li>
						<li><a href="?open=Laporan-Penempatan-Lokasi"><i class="fa fa-circle-o"></i> perLokasi</a></li>
	                  </ul>
	                </li>

	                <li class="treeview">
	                  <a href="#"><i class="fa fa-circle-o"></i> Lap. Peminjaman <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
	                  <ul class="treeview-menu">
	                    <li><a href="?open=Laporan-Peminjaman-Periode"><i class="fa fa-circle-o"></i> perPeriode</a></li>
						<li><a href="?open=Laporan-Peminjaman-Bulan"><i class="fa fa-circle-o"></i> perBulan</a></li>
						<li><a href="?open=Laporan-Peminjaman-Amil"><i class="fa fa-circle-o"></i> perAmil</a></li>
	                  </ul>
	                </li>
					
					<!--<li><a href="?open=Laporan-Mutasi-Periode"><i class="fa fa-circle-o"></i> Mutasi perPeriode</a></li>
					<li><a href="?open=Laporan-Mutasi-Bulan"><i class="fa fa-circle-o"></i> Mutasi perBulan</a></li>
				    <li><a href="?open=Laporan-Mutasi-Barang-Lokasi"><i class="fa fa-circle-o"></i> Mutasi Barang PerLokasi </a></li>-->

	              </ul>
	            </li>
	            <li><a href="?open=Cetak-Barcode"><i class="fa fa-print"></i> <span>Cetak Label Barang</span></a></li>
	            <li><a href="?open=Logout"><i class="fa fa-power-off"></i> <span>Logout</span></a></li>

			<?php }elseif(isset($_SESSION['SES_PETUGAS'])){ ?>
				<li class="header" style='color:#fff; text-transform:uppercase; border-bottom:2px solid #00c0ef'>MENU <?php echo $_SESSION['level']; ?></li>
				<li><a href="?open"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
				<li class="treeview">
	              <a href="#"><i class="fa fa-search"></i> <span>Data Pencarian</span><i class="fa fa-angle-left pull-right"></i></a>
	              <ul class="treeview-menu">
	                <li><a href="?open=Pencarian-1"><i class="fa fa-circle-o"></i> Pencarian Barang 1</a></li>
	                <li><a href="?open=Pencarian-2"><i class="fa fa-circle-o"></i> Pencarian Barang 2</a></li>
	              </ul>
	            </li>
				<li><a href="?open=Laporan-Barang"><i class="fa fa-circle-o"></i> List Barang</a></li>
						<li><a href="?open=Laporan-Barang-Kategori"><i class="fa fa-circle-o"></i> Barang perKategori</a></li>
						<li><a href="?open=Laporan-Barang-Lokasi"><i class="fa fa-circle-o"></i> Barang perLokasi</a></li>
				<!--<li><a href="?open=Pengadaan-Tampil"><i class="fa fa-circle-o"></i> Transaksi Pengadaan</a></li>
	            <li><a href="?open=Penempatan-Tampil"><i class="fa fa-circle-o"></i> Transaksi Penempatan</a></li>
	            <li><a href="?open=Mutasi-Tampil"><i class="fa fa-circle-o"></i> Transaksi Mutasi</a></li>
	            <li><a href="?open=Peminjaman-Tampil"><i class="fa fa-circle-o"></i> Transaksi Peminjaman</a></li>-->
			<?php } ?>
          </ul>
        </section>