<?php
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";

// Baca variabel filter dari URL
$dataAmil 	= isset($_GET['kodeAmil']) ? $_GET['kodeAmil'] : 'Semua';
$dataTahun 		= isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

# MEMBUAT SUB SQL FILTER
if(trim($dataAmil)=="Semua") {
	// Semua Amil
	$filterSQL 	= "WHERE LEFT(peminjaman.tgl_peminjaman,4)='$dataTahun'";
}
else {
	// Amil terpilih, dan Tahun Terpilih
	$filterSQL 	= " WHERE peminjaman.kd_amil ='$dataAmil' AND LEFT(peminjaman.tgl_peminjaman,4)='$dataTahun'";

	# Baca nama Amil
	$infoSql 	= "SELECT * FROM amil WHERE kd_amil='$dataAmil'";
	$infoQry 	= mysql_query($infoSql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$kolomData 	= mysql_fetch_array($infoQry);
	$infoAmil = $kolomData['nm_amil'];
}?>
<html>
<head>
<title>:: Laporan Peminjaman per Amil - Inventory Kantor (Aset Kantor)</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css"></head>
<body onLoad="window.print()">
<h2>LAPORAN PEMINJAMAN PER AMIL </h2>
<table width="500" border="0"  class="table-list">
  <tr>
    <td colspan="3" bgcolor="#F5F5F5"><strong>KETERANGAN</strong></td>
  </tr>
  <tr>
    <td width="138"><strong>Amil</strong></td>
    <td width="15"><strong>:</strong></td>
    <td width="333"><?php echo $infoAmil; ?></td>
  </tr>
  <tr>
    <td><strong>Tahun </strong></td>
    <td><strong>:</strong></td>
    <td><?php echo  $dataTahun; ?></td>
  </tr>
</table>
<br />
<table class="table-list" width="900" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="28" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="86" bgcolor="#F5F5F5"><strong>Tanggal</strong></td>
    <td width="118" bgcolor="#F5F5F5"><strong>No. Peminjaman</strong></td>
    <td width="312" bgcolor="#F5F5F5"><strong>Keterangan</strong></td>
    <td width="166" bgcolor="#F5F5F5"><strong>Amil</strong></td>
    <td width="76" bgcolor="#F5F5F5"><strong>Status</strong></td>
    <td width="78" align="right" bgcolor="#F5F5F5"><strong>Qty Barang</strong></td>
  </tr>
  <?php
	// Skrip untuk menampilkan data Transaksi Peminjaman, dilengkapi informasi Nama Amil
	// Filter data berdasarkan Nama Amil dan Tahun Transaksi
	$mySql = "SELECT peminjaman.*, amil.nm_amil FROM peminjaman 
				LEFT JOIN amil ON peminjaman.kd_amil=amil.kd_amil 
				$filterSQL
				ORDER BY peminjaman.no_peminjaman DESC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		
		// Membaca Kode peminjaman/ Nomor transaksi
		$noNota = $myData['no_peminjaman'];
		
		// Menghitung Total barang yang dipinjam
		$my2Sql = "SELECT COUNT(*) AS total_barang FROM peminjaman_item WHERE no_peminjaman='$noNota'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query 2 salah : ".mysql_error());
		$my2Data = mysql_fetch_array($my2Qry);
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo IndonesiaTgl($myData['tgl_peminjaman']); ?></td>
    <td><?php echo $myData['no_peminjaman']; ?></td>
    <td><?php echo $myData['keterangan']; ?></td>
    <td><?php echo $myData['nm_amil']; ?></td>
    <td><?php echo $myData['status_kembali']; ?></td>
    <td align="right"><?php echo format_angka($my2Data['total_barang']); ?></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>