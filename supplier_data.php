<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM supplier";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b>DATA SUPPLIER </b><a href="?open=Supplier-Add" target="_self"><img src="images/btn_add_data.png"  border="0" /></a></h1></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="21" align="center">No</th>
        <th width="45">Kode</th>
        <th width="180">Nama Supplier </th>
        <th width="412">Alamat</th>
        <th width="120">No. Telepon </th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b><b></b></td>
        </tr>
      <?php
	  // Skrip menampilkan data Supplier
	$mySql = "SELECT * FROM supplier ORDER BY kd_supplier ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_supplier'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_supplier']; ?></td>
        <td><?php echo $myData['nm_supplier']; ?></td>
        <td><?php echo $myData['alamat']; ?></td>
        <td><?php echo $myData['no_telepon']; ?></td>
        <td width="40" align="center"><a href="?open=Supplier-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA SUPPLIER ( <?php echo $Kode; ?> ) INI ... ?')">Delete</a></td>
        <td width="40" align="center"><a href="?open=Supplier-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
    <td align="right"><b>Halaman ke :</b> 
	<?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?open=Supplier-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
	</td>
  </tr>
</table>
