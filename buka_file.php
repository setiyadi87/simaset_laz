<?php
# KONTROL MENU PROGRAM
if($_GET) {
	// Jika mendapatkan variabel URL ?page
	switch($_GET['open']){
		case '' :
			if(!file_exists ("main.php")) die ("File tidak ditemukan !"); 
			include "main.php";	break;

		case 'Halaman-Utama' :
			if(!file_exists ("main.php")) die ("File tidak ditemukan !"); 
			include "main.php";	break;
			
		case 'Login' :
			if(!file_exists ("login.php")) die ("File tidak ditemukan !"); 
			include "login.php"; break;
			
		case 'Logout' :
			if(!file_exists ("login_out.php")) die ("File tidak ditemukan !"); 
			include "login_out.php"; break;		

		# PETUGAS / USER LOGIN (Admin, Petugas)
		case 'Petugas-Data' :
			if(!file_exists ("petugas_data.php")) die ("File tidak ditemukan !"); 
			include "petugas_data.php";	 break;		
		case 'Petugas-Add' :
			if(!file_exists ("petugas_add.php")) die ("File tidak ditemukan !"); 
			include "petugas_add.php";	 break;		
		case 'Petugas-Delete' :
			if(!file_exists ("petugas_delete.php")) die ("File tidak ditemukan !"); 
			include "petugas_delete.php"; break;		
		case 'Petugas-Edit' :
			if(!file_exists ("petugas_edit.php")) die ("File tidak ditemukan !"); 
			include "petugas_edit.php"; break;	
			
		# AMIL
		case 'Amil-Data' :
			if(!file_exists ("amil_data.php")) die ("File tidak ditemukan !"); 
			include "amil_data.php";	 break;
		case 'Amil-Add' :
			if(!file_exists ("amil_add.php")) die ("File tidak ditemukan !"); 
			include "amil_add.php";	 break;
		case 'Amil-Delete' :
			if(!file_exists ("amil_delete.php")) die ("File tidak ditemukan !"); 
			include "amil_delete.php"; break;
		case 'Amil-Edit' :
			if(!file_exists ("amil_edit.php")) die ("File tidak ditemukan !"); 
			include "amil_edit.php"; break;

		# DIVISI
		case 'Divisi-Data' :
			if(!file_exists ("divisi_data.php")) die ("File tidak ditemukan !"); 
			include "divisi_data.php"; break;		
		case 'Divisi-Add' :
			if(!file_exists ("divisi_add.php")) die ("File tidak ditemukan !"); 
			include "divisi_add.php";	break;		
		case 'Divisi-Delete' :
			if(!file_exists ("divisi_delete.php")) die ("File tidak ditemukan !"); 
			include "divisi_delete.php"; break;		
		case 'Divisi-Edit' :
			if(!file_exists ("divisi_edit.php")) die ("File tidak ditemukan !"); 
			include "divisi_edit.php"; break;	
			
		# LOKASI / RUANG
		case 'Lokasi-Data' :
			if(!file_exists ("lokasi_data.php")) die ("File tidak ditemukan !"); 
			include "lokasi_data.php"; break;		
		case 'Lokasi-Add' :
			if(!file_exists ("lokasi_add.php")) die ("File tidak ditemukan !"); 
			include "lokasi_add.php";	break;		
		case 'Lokasi-Delete' :
			if(!file_exists ("lokasi_delete.php")) die ("File tidak ditemukan !"); 
			include "lokasi_delete.php"; break;		
		case 'Lokasi-Edit' :
			if(!file_exists ("lokasi_edit.php")) die ("File tidak ditemukan !"); 
			include "lokasi_edit.php"; break;	

		# KATEGORI / PENGELOMPOKAN JENIS BARANG
		case 'Kategori-Data' :
			if(!file_exists ("kategori_data.php")) die ("File tidak ditemukan !"); 
			include "kategori_data.php"; break;		
		case 'Kategori-Add' :
			if(!file_exists ("kategori_add.php")) die ("File tidak ditemukan !"); 
			include "kategori_add.php";	break;		
		case 'Kategori-Delete' :
			if(!file_exists ("kategori_delete.php")) die ("File tidak ditemukan !"); 
			include "kategori_delete.php"; break;		
		case 'Kategori-Edit' :
			if(!file_exists ("kategori_edit.php")) die ("File tidak ditemukan !"); 
			include "kategori_edit.php"; break;	
			
		# BARANG / PRODUK YANG DIJUAL
		case 'Barang-Data' :
			if(!file_exists ("barang_data.php")) die ("File tidak ditemukan !"); 
			include "barang_data.php"; break;		
		case 'Barang-Add' :
			if(!file_exists ("barang_add.php")) die ("File tidak ditemukan !"); 
			include "barang_add.php"; break;		
		case 'Barang-Delete' :
			if(!file_exists ("barang_delete.php")) die ("File tidak ditemukan !"); 
			include "barang_delete.php"; break;		
		case 'Barang-Edit' :
			if(!file_exists ("barang_edit.php")) die ("File tidak ditemukan !"); 
			include "barang_edit.php"; break;	
			
		case 'Pencarian-1' :
			if(!file_exists ("barang_cari1.php")) die ("File tidak ditemukan !"); 
			include "barang_cari1.php"; break;		
			
		case 'Pencarian-2' :
			if(!file_exists ("barang_cari2.php")) die ("File tidak ditemukan !"); 
			include "barang_cari2.php"; break;		
		case 'Barang-View' :
			if(!file_exists ("barang_view.php")) die ("File tidak ditemukan !"); 
			include "barang_view.php"; break;	

		# CETAK BARCODE
		case 'Cetak-Barcode' :
			if(!file_exists ("cetak_barcode.php")) die ("File tidak ditemukan !"); 
			include "cetak_barcode.php"; break;		
		case 'Cetak-Barcode-View' :
			if(!file_exists ("cetak_barcode_view.php")) die ("File tidak ditemukan !"); 
			include "cetak_barcode_view.php"; break;		
			

		# SUPPLIER (PEMASOK)
		case 'Supplier-Data' :
			if(!file_exists ("supplier_data.php")) die ("File tidak ditemukan !"); 
			include "supplier_data.php";	 break;		
		case 'Supplier-Add' :
			if(!file_exists ("supplier_add.php")) die ("File tidak ditemukan !"); 
			include "supplier_add.php";	 break;		
		case 'Supplier-Delete' :
			if(!file_exists ("supplier_delete.php")) die ("File tidak ditemukan !"); 
			include "supplier_delete.php"; break;		
		case 'Supplier-Edit' :				
			if(!file_exists ("supplier_edit.php")) die ("File tidak ditemukan !"); 
			include "supplier_edit.php"; break;	

		# REPORT INFORMASI / LAPORAN DATA
		case 'Laporan-Cetak' :
				if(!file_exists ("menu_laporan.php")) die ("File tidak ditemukan !"); 
				include "menu_laporan.php"; break;

			# LAPORAN MASTER DATA (petugas, Supplier, Pelanggan, Kategori dan Barang)
			case 'Laporan-Petugas' :
				if(!file_exists ("laporan_petugas.php")) die ("File tidak ditemukan !"); 
				include "laporan_petugas.php"; break;
	
			case 'Laporan-Supplier' :
				if(!file_exists ("laporan_supplier.php")) die ("File tidak ditemukan !"); 
				include "laporan_supplier.php"; break;
				
			case 'Laporan-Amil' :
				if(!file_exists ("laporan_amil.php")) die ("File tidak ditemukan !"); 
				include "laporan_amil.php"; break;
				
			case 'Laporan-Pelanggan' :
				if(!file_exists ("laporan_pelanggan.php")) die ("File tidak ditemukan !"); 
				include "laporan_pelanggan.php"; break;

			case 'Laporan-Divisi' :
				if(!file_exists ("laporan_divisi.php")) die ("File tidak ditemukan !"); 
				include "laporan_divisi.php"; break;
				
			case 'Laporan-Lokasi' :
				if(!file_exists ("laporan_lokasi.php")) die ("File tidak ditemukan !"); 
				include "laporan_lokasi.php"; break;

			case 'Laporan-Kategori' :
				if(!file_exists ("laporan_kategori.php")) die ("File tidak ditemukan !"); 
				include "laporan_kategori.php"; break;

			case 'Laporan-Barang' :
				if(!file_exists ("laporan_barang.php")) die ("File tidak ditemukan !"); 
				include "laporan_barang.php"; break;
					
			case 'Laporan-Barang-Kategori' :
				if(!file_exists ("laporan_barang_kategori.php")) die ("File tidak ditemukan !"); 
				include "laporan_barang_kategori.php"; break;
				
			case 'Laporan-Barang-Lokasi' :
				if(!file_exists ("laporan_barang_lokasi.php")) die ("File tidak ditemukan !"); 
				include "laporan_barang_lokasi.php"; break;
				
			# LAPORAN TRANSAKSI PENGADAAN
			case 'Laporan-Pengadaan-Periode' :
				if(!file_exists ("laporan_pengadaan_periode.php")) die ("File tidak ditemukan !"); 
				include "laporan_pengadaan_periode.php"; break;
				
			case 'Laporan-Pengadaan-Bulan' :
				if(!file_exists ("laporan_pengadaan_bulan.php")) die ("File tidak ditemukan !"); 
				include "laporan_pengadaan_bulan.php"; break;
				
			case 'Laporan-Pengadaan-Supplier' :
				if(!file_exists ("laporan_pengadaan_supplier.php")) die ("File tidak ditemukan !"); 
				include "laporan_pengadaan_supplier.php"; break;
			
			// PENGADAAN BARANG 
			case 'Laporan-Pengadaan-Barang-Bulan' :				
				if(!file_exists ("laporan_pengadaan_barang_bulan.php")) die ("File tidak ditemukan !"); 
				include "laporan_pengadaan_barang_bulan.php"; break;
								
			case 'Laporan-Pengadaan-Barang-Periode' :
				if(!file_exists ("laporan_pengadaan_barang_periode.php")) die ("File tidak ditemukan !"); 
				include "laporan_pengadaan_barang_periode.php"; break;

			case 'Laporan-Pengadaan-Barang-Kategori' :				
				if(!file_exists ("laporan_pengadaan_barang_kategori.php")) die ("File tidak ditemukan !"); 
				include "laporan_pengadaan_barang_kategori.php"; break;

			case 'Laporan-Pengadaan-Barang-Supplier' :				
				if(!file_exists ("laporan_pengadaan_barang_supplier.php")) die ("File tidak ditemukan !"); 
				include "laporan_pengadaan_barang_supplier.php"; break;
				
			# LAPORAN TRANSAKSI PENEMPATAN
			case 'Laporan-Penempatan-Periode' :
				if(!file_exists ("laporan_penempatan_periode.php")) die ("File tidak ditemukan !"); 
				include "laporan_penempatan_periode.php"; break;
				
			case 'Laporan-Penempatan-Bulan' :
				if(!file_exists ("laporan_penempatan_bulan.php")) die ("File tidak ditemukan !"); 
				include "laporan_penempatan_bulan.php"; break;
				
			case 'Laporan-Penempatan-Lokasi' :
				if(!file_exists ("laporan_penempatan_lokasi.php")) die ("File tidak ditemukan !"); 
				include "laporan_penempatan_lokasi.php"; break;

			# LAPORAN TRANSAKSI MUTASI (PEMINDAHAN TEMPAT)
			case 'Laporan-Mutasi-Periode' :
				if(!file_exists ("laporan_mutasi_periode.php")) die ("File tidak ditemukan !"); 
				include "laporan_mutasi_periode.php"; break;
				
			case 'Laporan-Mutasi-Bulan' :
				if(!file_exists ("laporan_mutasi_bulan.php")) die ("File tidak ditemukan !"); 
				include "laporan_mutasi_bulan.php"; break;

			case 'Laporan-Mutasi-Barang-Lokasi' :				
				if(!file_exists ("laporan_mutasi_barang_lokasi.php")) die ("File tidak ditemukan !"); 
				include "laporan_mutasi_barang_lokasi.php"; break;

			# LAPORAN TRANSAKSI PEMINJAMAN
			case 'Laporan-Peminjaman-Periode' :
				if(!file_exists ("laporan_peminjaman_periode.php")) die ("File tidak ditemukan !"); 
				include "laporan_peminjaman_periode.php"; break;
				
			case 'Laporan-Peminjaman-Bulan' :
				if(!file_exists ("laporan_peminjaman_bulan.php")) die ("File tidak ditemukan !"); 
				include "laporan_peminjaman_bulan.php"; break;
				
			case 'Laporan-Peminjaman-Amil' :
				if(!file_exists ("laporan_peminjaman_amil.php")) die ("File tidak ditemukan !"); 
				include "laporan_peminjaman_amil.php"; break;



			case 'Pengadaan-Baru' :
				if(!file_exists ("pengadaan_baru.php")) die ("Empty Main Page!"); 
				include "pengadaan_baru.php";	break;
			case 'Pengadaan-Tampil' : 
				if(!file_exists ("pengadaan_tampil.php")) die ("Empty Main Page!"); 
				include "pengadaan_tampil.php";	break;
			case 'Pengadaan-Hapus' : 
				if(!file_exists ("pengadaan_hapus.php")) die ("Empty Main Page!"); 
				include "pengadaan_hapus.php";	break;

			case 'Penempatan-Baru' :
				if(!file_exists ("penempatan_baru.php")) die ("File tidak ada !"); 
				include "penempatan_baru.php";	break;
			case 'Penempatan-Tampil' : 
				if(!file_exists ("penempatan_tampil.php")) die ("File tidak ada !"); 
				include "penempatan_tampil.php";	break;
			case 'Penempatan-Hapus' : 
				if(!file_exists ("penempatan_hapus.php")) die ("File tidak ada !"); 
				include "penempatan_hapus.php";	break;

			case 'Mutasi-Baru' :
				if(!file_exists ("mutasi_baru.php")) die ("File tidak tersedia !"); 
				include "mutasi_baru.php";	break;
			case 'Mutasi-Tampil' : 
				if(!file_exists ("mutasi_tampil.php")) die ("File tidak tersedia !"); 
				include "mutasi_tampil.php";	break;
			case 'Mutasi-Hapus' : 
				if(!file_exists ("mutasi_hapus.php")) die ("File tidak tersedia !"); 
				include "mutasi_hapus.php";	break;

			case 'Peminjaman-Baru' :
				if(!file_exists ("peminjaman_baru.php")) die ("File tidak ditemukan !"); 
				include "peminjaman_baru.php";	break;
			case 'Pengembalian' :
				if(!file_exists ("pengembalian.php")) die ("File tidak ditemukan !"); 
				include "pengembalian.php";	break;
			case 'Peminjaman-Tampil' : 
				if(!file_exists ("peminjaman_tampil.php")) die ("File tidak ditemukan !"); 
				include "peminjaman_tampil.php";	break;
			case 'Peminjaman-Hapus' : 
				if(!file_exists ("peminjaman_hapus.php")) die ("File tidak ditemukan !"); 
				include "peminjaman_hapus.php";	break;



	}
}
?>