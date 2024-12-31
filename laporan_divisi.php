<?php
include_once "library/inc.seslogin.php";
?>
<div class="table-border">
<h2> LAPORAN DATA DIVISI </h2>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="26" align="center" bgcolor="#CCCCCC"><b>No</b></td>
    <td width="50" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="251" bgcolor="#CCCCCC"><b>Nama Divisi </b></td>
    <td width="372" bgcolor="#CCCCCC"><strong>Keterangan</strong></td>
    <td width="75" align="right" bgcolor="#CCCCCC"><b>Qty Lokasi </b> </td>  
  </tr>
  <?php
	  // Menampilkan data Divisi
	$mySql = "SELECT * FROM divisi ORDER BY kd_divisi ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query 1 salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_divisi'];
		
		// Menghitung jumlah lokasi/lokasi per divisi
		$my2Sql = "SELECT COUNT(*) As qty_lokasi FROM lokasi WHERE kd_divisi='$Kode'";
		$my2Qry = mysql_query($my2Sql, $koneksidb)  or die ("Query salah : ".mysql_error());
		$my2Data = mysql_fetch_array($my2Qry);
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
  <tr bgcolor="<?php echo $warna; ?>">
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_divisi']; ?></td>
    <td><?php echo $myData['nm_divisi']; ?></td>
    <td><?php echo $myData['keterangan']; ?></td>
    <td align="right" bgcolor="<?php echo $warna; ?>"><?php echo $my2Data['qty_lokasi']; ?></td>
  </tr>
  <?php } ?>
</table>
<br />
<a href="cetak/divisi.php" target="_blank"><img src="images/btn_print2.png"  border="0" title="Cetak ke Format HTML"/></a>
</div>