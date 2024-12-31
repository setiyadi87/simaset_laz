<?php
include_once "library/inc.seslogin.php";
?>
<div class="table-border">
<h2> LAPORAN DATA AMIL </h2>
<table class="table-list" width="800" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="23" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="50" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="210" bgcolor="#CCCCCC"><strong>Nama Amil </strong></td>
    <td width="90" bgcolor="#CCCCCC"><strong>Jns Kelamin</strong></td>
    <td width="296" bgcolor="#CCCCCC"><strong>Alamat Tinggal  </strong></td>  
    <td width="100" bgcolor="#CCCCCC"><strong>No. Telepon </strong></td>
  </tr>
<?php
	// Menampilkan data Amil
	$mySql = "SELECT * FROM amil ORDER BY kd_amil ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
  <tr bgcolor="<?php echo $warna; ?>">
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kd_amil']; ?></td>
    <td><?php echo $myData['nm_amil']; ?></td>
    <td><?php echo $myData['jns_kelamin']; ?></td>
    <td><?php echo $myData['alamat']; ?></td>
    <td><?php echo $myData['no_telepon']; ?></td>
  </tr>
<?php } ?>
</table>
<br />
<a href="cetak/amil.php" target="_blank"><img src="images/btn_print2.png"  border="0" title="Cetak ke Format HTML"/></a>
</div>