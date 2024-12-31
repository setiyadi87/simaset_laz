<?php
include_once "library/inc.seslogin.php";

# Kategori terpilih
$kodeKategori = isset($_GET['kodeKategori']) ? $_GET['kodeKategori'] : 'Semua';
$dataKategori = isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : $kodeKategori;

#  Tahun Terpilih
$tahun	   	= isset($_GET['tahun']) ? $_GET['tahun'] : date('Y'); // Baca dari URL, jika tidak ada diisi tahun sekarang
$dataTahun 	= isset($_POST['cmbTahun']) ? $_POST['cmbTahun'] : $tahun; // Baca dari form Submit, jika tidak ada diisi dari $tahun

# MEMBUAT SUB SQL FILTER
if(trim($dataKategori)=="Semua") {
	// Semua Kategori
	$filterSQL 	= "AND LEFT(tgl_pengadaan,4)='$dataTahun'";
}
else {
	// Kategori terpilih, dan Tahun Terpilih
	$filterSQL 	= " AND barang.kd_kategori ='$dataKategori' AND LEFT(pengadaan.tgl_pengadaan,4)='$dataTahun'";
}

# TMBOL CETAK DIKLIK
if (isset($_POST['btnCetak'])) {
		// Buka file
		echo "<script>";
		echo "window.open('cetak/pengadaan_barang_kategori.php?kodeKategori=$dataKategori&tahun=$dataTahun')";
		echo "</script>";
}

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$barisData 	= 50;
$halaman 	= isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql 	= "SELECT * FROM pengadaan, pengadaan_item 
				LEFT JOIN barang ON pengadaan_item.kd_barang = barang.kd_barang 
				WHERE pengadaan.no_pengadaan = pengadaan_item.no_pengadaan  $filterSQL";
$pageQry 	= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumData	= mysql_num_rows($pageQry);
$maksData	= ceil($jumData/$barisData);
?>
<div class="table-border">
<h2>  LAPORAN PENGADAAN BARANG PER KATEGORI </h2>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="900" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#F5F5F5"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="111"><strong> Kategori  </strong></td>
      <td width="5"><strong>:</strong></td>
      <td width="770">
	  <select name="cmbKategori">
        <option value="Semua"> .... </option>
        <?php
	  $mySql = "SELECT * FROM kategori ORDER BY kd_kategori";
	  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($myData = mysql_fetch_array($myQry)) {
	  	if ($dataKategori == $myData['kd_kategori']) {
			$cek = " selected";
		} else { $cek=""; }
	  	echo "<option value='$myData[kd_kategori]' $cek> $myData[nm_kategori]</option>";
	  }
	  $mySql ="";
	  ?>
      </select></td>
    </tr>
    <tr>
      <td><strong>Periode Tahun </strong></td>
      <td><strong>:</strong></td>
      <td><select name="cmbTahun">
        <?php
		# Baca tahun terendah(kecil), dan tahun tertinggi(besar) di tabel Transaksi
		$thnSql = "SELECT MIN(LEFT(tgl_pengadaan,4)) As tahun_kecil, MAX(LEFT(tgl_pengadaan,4)) As tahun_besar FROM pengadaan";
		$thnQry	= mysql_query($thnSql, $koneksidb) or die ("Error".mysql_error());
		$thnRow	= mysql_fetch_array($thnQry);
		
		// Membaca tahun
		$thnKecil = $thnRow['tahun_kecil'];
		$thnBesar = $thnRow['tahun_besar'];
		
		// Menampilkan daftar Tahun, dari tahun terkecil sampai Terbesar (tahun sekarang)
		for($thn= $thnKecil; $thn <= $thnBesar; $thn++) {
			if ($thn == $dataTahun) {
				$cek = " selected";
			} else { $cek=""; }
			echo "<option value='$thn' $cek>$thn</option>";
		}
	  ?>
      </select>
        <input name="btnTampil" type="submit" value=" Tampilkan " />
        <input name="btnCetak" type="submit" id="btnCetak" value=" Cetak " /></td>
    </tr>
  </table>
</form>

<br />
<table class="table-list" width="900" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="27" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="54" bgcolor="#CCCCCC"><strong>Tanggal</strong></td>
    <td width="95" bgcolor="#CCCCCC"><strong>No. Pengadaan </strong></td>
    <td width="46" bgcolor="#CCCCCC"><strong>Kode </strong></td>
    <td width="369" bgcolor="#CCCCCC"><b>Nama Barang</b></td>
    <td width="110" align="right" bgcolor="#CCCCCC"><b> Hrg. Beli (Rp)</b></td>
    <td width="48" align="right" bgcolor="#CCCCCC"><b>Jumlah</b></td>
    <td width="110" align="right" bgcolor="#CCCCCC"><strong> Tot. Harga(Rp)</strong></td>
  </tr>
  <?php
  	// deklarasi variabel
	$subTotal 		= 0; 
	$totalHarga 	= 0; 
	$totalBarang 	= 0;  
	
	//  Perintah SQL menampilkan data barang daftar pengadaan
	$mySql ="SELECT pengadaan_item.*, pengadaan.tgl_pengadaan, barang.nm_barang 
			 FROM pengadaan, pengadaan_item
			 	LEFT JOIN barang ON pengadaan_item.kd_barang=barang.kd_barang 
			 WHERE pengadaan.no_pengadaan=pengadaan_item.no_pengadaan
			 $filterSQL
			 ORDER BY pengadaan.tgl_pengadaan LIMIT $halaman, $barisData";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
	$nomor  = $halaman; 
	while($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$subTotal 	= $myData['harga_beli'] * $myData['jumlah'];
		$totalHarga	= $totalHarga + $subTotal;
		$totalBarang= $totalBarang + $myData['jumlah'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
  <tr bgcolor="<?php echo $warna; ?>">
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_pengadaan']); ?></td>
    <td><?php echo $myData['no_pengadaan']; ?></td>
    <td><?php echo $myData['kd_barang']; ?></td>
    <td><?php echo $myData['nm_barang']; ?></td>
    <td align="right"><?php echo format_angka($myData['harga_beli']); ?></td>
    <td align="right"><?php echo $myData['jumlah']; ?></td>
    <td align="right"><?php echo format_angka($subTotal); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="6" align="right"><b> GRAND TOTAL : </b></td>
    <td align="right" bgcolor="#CCCCCC"><strong><?php echo format_angka($totalBarang); ?></strong></td>
    <td align="right" bgcolor="#CCCCCC">Rp. <strong><?php echo format_angka($totalHarga); ?></strong></td>
  </tr>
  <tr>
    <td colspan="4"><b>Jumlah Data :</b> <?php echo $jumData; ?></td>
    <td colspan="4" align="right"><b>Halaman ke :</b>
        <?php
	for ($h = 1; $h <= $maksData; $h++) {
		$list[$h] = $barisData * $h - $barisData;
		echo " <a href='?open=Laporan-Pengadaan-Barang-Kategori&hal=$list[$h]&kodeKategori=$dataKategori&tahun=$dataTahun'>$h</a> ";
	}
	?></td>
  </tr>
</table>
<a href="cetak/pengadaan_barang_kategori.php?kodeKategori=<?php echo $dataKategori; ?>&tahun=<?php echo $dataTahun; ?>" target="_blank"><img src="images/btn_print2.png"  border="0" title="Cetak ke Format HTML"/></a>
</div>