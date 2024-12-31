<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM divisi";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b>DATA DIVISI</b><a href="?open=Divisi-Add" target="_self"><img src="images/btn_add_data.png"  border="0" /></a></h1></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="20" align="center"><b>No</b></th>
        <th width="49">Kode</th>
        <th width="279"><b>Nama Divisi </b></th>
        <th width="333">Keterangan</th>
        <th width="96" align="right"><b>Qty Lokasi </b> </th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b></td>
        </tr>
      <?php
	  // Menampilkan data divisi
	$mySql = "SELECT * FROM divisi ORDER BY kd_divisi ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
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
        <td align="right"><?php echo $my2Data['qty_lokasi']; ?></td>
        <td width="41" align="center">
		<a href="?open=Divisi-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return 
				confirm('YAKIN AKAN MENGHAPUS DATA DIVISI ( <?php echo $Kode; ?> ) INI ... ?')"> Delete</a></td>
        <td width="40" align="center">
		<a href="?open=Divisi-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data"> Edit</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
    <td align="right"> <b>Halaman ke :</b> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?open=Divisi-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
	</td>
  </tr>
</table>
