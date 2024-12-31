<?php
include_once "library/inc.seslogin.php";

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM amil";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b>DATA AMIL </b><a href="?open=Amil-Add" target="_self"><img src="images/btn_add_data.png" border="0" /></a></h1></td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="21" align="center">No</th>
        <th width="49">Kode</th>
        <th width="204">Nama Amil </th>
        <th width="85">Kelamin</th>
        <th width="419">Alamat</th>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        </tr>
      <?php
	  // Skrip menampilkan data Amil
	$mySql = "SELECT * FROM amil ORDER BY kd_amil ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_amil'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_amil']; ?></td>
        <td><?php echo $myData['nm_amil']; ?></td>
        <td><?php echo $myData['jns_kelamin']; ?></td>
        <td><?php echo $myData['alamat']; ?></td>
        <td width="40" align="center"><a href="?open=Amil-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" 
				onclick="return confirm('YAKIN AKAN MENGHAPUS DATA AMIL ( <?php echo $Kode; ?> ) INI ... ?')">Delete</a></td>
        <td width="40" align="center"><a href="?open=Amil-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
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
		echo " <a href='?open=Amil-Data&hal=$list[$h]'>$h</a> ";
	}
	?>
	</td>
  </tr>
</table>
