

<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";

// Variabel SQL
$filterSQL= "";

// Temporary Variabel form
$Kat			= isset($_GET['Kat']) ? $_GET['Kat'] : 'Semua'; // dari URL
$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : $Kat; // dari Form

// Membuat SQL Filter data
if (trim($dataKategori) =="Semua") {
	$filterSQL = "";
}
else {
	$filterSQL = "WHERE barang.kd_kategori='$dataKategori'";
}


# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM barang $filterSQL";
$pageQry = mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
<?php if(isset($_SESSION['SES_ADMIN'])){ ?>
  <tr>
    <td colspan="2"><h1><b>DATA ASET BARANG </b><a href="?open=Barang-Add" target="_self"><img src="images/btn_add_data.png" border="0" /></a></h1></td>
  </tr>
<?php } ?>
  <tr>
    <td colspan="2">
	
	<form style='margin-top:-10px' action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table width="100%" border="0"  class="table-list">
    <tr>
      <td colspan="3" bgcolor="#F5F5F5"><strong>FILTER DATA </strong></td>
    </tr>
    <tr>
      <td width="159"><b>Nama Kategori </b></td>
      <td width="5"><b>:</b></td>
      <td width="716"><select name="cmbKategori">
          <option value="Semua">....</option>
          <?php
		  // Menampilkan data Kategori
	  $dataSql = "SELECT * FROM kategori ORDER BY kd_kategori";
	  $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	  while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kd_kategori'] == $dataKategori) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kd_kategori]' $cek>$dataRow[nm_kategori]</option>";
	  }
	  ?>
      </select>
      <input name="btnTampil" type="submit" value=" Tampilkan " /></td>
    </tr>
  </table>
</form>
	</td>
  </tr>
  <tr>
    <td colspan="2">
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="23" align="center"><strong>No</strong></th>
        <th width="51"><strong>Kode</strong></th>
        <th width="417"><strong>Nama Barang</strong></th>
        <th width="132">Merek</th>
        <th width="70" align="center"><strong>Jumlah</strong></th>
        <th width="80"><strong>Satuan</strong></th>
        <th>Foto</th>
        <?php if(isset($_SESSION['SES_ADMIN'])){ ?>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
        <?php } ?>
        </tr>
      <?php
	  // Menampilkan data Barang
	$mySql = "SELECT * FROM barang $filterSQL ORDER BY kd_barang ASC LIMIT $hal, $row";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_barang'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_barang']; ?></td>
        <td><?php echo $myData['nm_barang']; ?></td>
        <td><?php echo $myData['merek']; ?></td>
        <td align="center"><?php echo format_angka($myData['jumlah']); ?></td>
        <td><?php echo $myData['satuan']; ?></td>
        <td><?php
          $ex = explode(';',$myData['foto']);
          $no = 1;
          for($i=0; $i<count($ex); $i++){
            if ($ex[$i]!=''){
              echo "<a target='_BLANK' href='user_data/".$ex[$i]."'>".$ex[$i]."</a>, ";
            }
            $no++;
          }
            ?>
        </td>
        <?php if(isset($_SESSION['SES_ADMIN'])){ ?>
        <td width="40" align="center"><a href="?open=Barang-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" 
						onclick="return confirm('APAKAH ANDA YAKIN INGIN MENGHAPUS DATA ( <?php echo $Kode; ?> ) INI ... ?')">Delete</a></td>
        <td width="40" align="center"><a href="?open=Barang-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <?php } ?>
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
		echo " <a href='?open=Barang-Data&hal=$list[$h]&Kat=$dataKategori'>$h</a> ";
	}
	?>	</td>
  </tr>
</table>
