
<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";

$Kode	= isset($_GET['Kode']) ? $_GET['Kode'] : '-';
$infoSql= "SELECT barang.*, kategori.nm_kategori FROM barang 
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
			WHERE barang.kd_barang='$Kode'";
$infoQry= mysql_query($infoSql, $koneksidb);
$infoData= mysql_fetch_array($infoQry);
?>
<div class='table-border'>
<table width="800" border="0" cellpadding="2" cellspacing="1" class="table-list">
<tr>
  <td colspan="3" bgcolor="#CCCCCC"><b>DATA BARANG </b></td>
</tr>
<tr>
  <td><strong>Kode</strong></td>
  <td><b>:</b></td>
  <td><?php echo $infoData['kd_barang']; ?></td>
</tr>
<tr>
  <td width="186"><strong>Nama Barang </strong></td>
  <td width="5"><b>:</b></td>
  <td width="1007"><?php echo $infoData['nm_barang']; ?></td>
</tr>
<tr>
  <td><strong>Kategori</strong></td>
  <td><b>:</b></td>
  <td><?php echo $infoData['nm_kategori']; ?></td>
</tr>
<tr>
  <td><strong>Jumlah</strong></td>
  <td><b>:</b></td>
  <td><?php echo format_angka($infoData['jumlah']); ?></td>
</tr>
<tr>
  <td><strong>Merek</strong></td>
  <td><b>:</b></td>
  <td><?php echo $infoData['merek']; ?></td>
</tr>
<tr>
  <td><strong>Satuan</strong></td>
  <td><b>:</b></td>
  <td><?php echo $infoData['satuan']; ?></td>
</tr>

<tr>
  <td><strong>Foto</strong></td>
  <td><b>:</b></td>
  <td><?php
          $ex = explode(';',$infoData['foto']);
          $no = 1;
          for($i=0; $i<count($ex); $i++){
            if ($ex[$i]!=''){
              echo "<a target='_BLANK' href='user_data/".$ex[$i]."'>".$ex[$i]."</a>, ";
            }
            $no++;
          }
            ?></td>
</tr>
</table>

<br>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="5"><strong>DAFTAR INVENTARIS</strong> </td>
  </tr>
  <tr>
    <td width="24" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="170" bgcolor="#F5F5F5"><strong>Kode Label ( Inventaris ) </strong></td>
    <td width="120" bgcolor="#F5F5F5"><strong>Status</strong></td>
    <td width="265" bgcolor="#F5F5F5"><strong>Lokasi</strong></td>
    <td width="65" bgcolor="#F5F5F5"><strong>Kwitansi</strong></td>
  </tr>
  <?php
	# MENJALANKAN QUERY , 
	$mySql = "SELECT * FROM barang_inventaris WHERE kd_barang='$Kode'";  
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$KodeInventory = $myData['kd_inventaris'];
		
		$infoLokasi	= "";
		
		// Mencari lokasi Penempatan Barang
		if($myData['status_barang']=="Ditempatkan") {
			$my2Sql = "SELECT lokasi.nm_lokasi FROM penempatan_item as PI
						LEFT JOIN penempatan ON PI.no_penempatan=penempatan.no_penempatan
						LEFT JOIN lokasi ON penempatan.kd_lokasi=lokasi.kd_lokasi
						WHERE PI.status_aktif='Yes' AND PI.kd_inventaris='$KodeInventory'";  
			$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query salah : ".mysql_error());
			$my2Data = mysql_fetch_array($my2Qry);
			$infoLokasi	= $my2Data['nm_lokasi'];
		}
		
		// Mencari Siapa Penempatan Barang
		if($myData['status_barang']=="Dipinjam") {
			$my3Sql = "SELECT amil.nm_amil FROM peminjaman_item as PI
						LEFT JOIN peminjaman ON PI.no_peminjaman=peminjaman.no_peminjaman
						LEFT JOIN amil ON peminjaman.kd_amil=amil.kd_amil
						WHERE peminjaman.status_kembali='Pinjam' AND PI.kd_inventaris='$KodeInventory'";  
			$my3Qry = mysql_query($my3Sql, $koneksidb)  or die ("Query salah : ".mysql_error());
			$my3Data = mysql_fetch_array($my3Qry);
			$infoLokasi	= $my3Data['nm_amil'];
		}
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
		$kw = mysql_fetch_array(mysql_query("SELECT * FROM pengadaan where no_pengadaan='$myData[no_pengadaan]'"));
	?>
  <tr bgcolor="<?php echo $warna; ?>">
    <td><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_inventaris']; ?></td>
    <td><?php echo $myData['status_barang']; ?></td>
    <td><?php echo $infoLokasi; ?></td>
    <td><?php
          $ex = explode(';',$kw['foto']);
          $no = 1;
          for($i=0; $i<count($ex); $i++){
            if ($ex[$i]!=''){
              echo "<a target='_BLANK' href='user_data/".$ex[$i]."'>".$ex[$i]."</a>, ";
            }
            $no++;
          }
            ?>
        </td>
    </tr>
  <?php } ?>
</table><br>
<center><a href="cetak/barang_view.php?Kode=<?php echo $Kode; ?>" target="_blank"><img src="images/btn_print2.png" border="0" title="Cetak ke Format HTML"/></a></center>
</div>
