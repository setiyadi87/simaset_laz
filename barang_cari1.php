<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";

// Set variabel SQL
$SQL = "";
$SQLPage = "";

# BACA VARIABEL KATEGORI
$kodeKategori = isset($_GET['kodeKategori']) ? $_GET['kodeKategori'] : 'Semua';
$kodeKategori = isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : $kodeKategori;

# PENCARIAN DATA BERDASARKAN FILTER DATA (Kode Type Kamar)
if(isset($_POST['btnCari'])) {
	$txtKataKunci	= trim($_POST['txtKataKunci']);

	// Pencarian Multi String (beberapa kata)
	$keyWord 		= explode(" ", $txtKataKunci);
	$cariSQL		= " AND barang_inventaris.kd_inventaris='$txtKataKunci' OR barang.nm_barang LIKE '%$txtKataKunci%' ";
	if(count($keyWord) > 1) {
		foreach($keyWord as $kata) {
			$cariSQL	.= " OR barang.nm_barang LIKE'%$kata%'";
		}
	}
	
	if (trim($_POST['cmbKategori'])=="Semua") {
		//Query #1 (all)
		$filterSQL 	= $cariSQL;
	}
	else {
		//Query #2 (filter)
		$filterSQL 	= $cariSQL." AND barang.kd_kategori ='$kodeKategori'";
	}
}
else {
	//Query #1 (all)
	$filterSQL 	= "";
}

# Simpan Variabel TMP
$dataKataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$row = 50;  // Jumlah baris data
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT barang.*, kategori.nm_kategori FROM barang_inventaris
					LEFT JOIN barang ON barang_inventaris.kd_barang=barang.kd_barang
					LEFT JOIN kategori ON  barang.kd_barang=kategori.kd_kategori 
				WHERE barang.kd_kategori !='' $filterSQL
				GROUP BY barang.kd_barang";
$pageQry = mysql_query($pageSql, $koneksidb) or die("error paging:".mysql_error());
$jml	 = mysql_num_rows($pageQry);
$max	 = ceil($jml/$row);
?>
<form style='padding-top:0px !important' action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
<table width="900" border="0" cellpadding="2" cellspacing="1" class="table-border">
  <tr>
    <td colspan="2"><h1><b>PENCARIAN BARANG </b></h1></td>
  </tr>
  <tr>
    <td colspan="2">
	  <table width="100%" border="0"  class="table-list">
		<tr>
		  <td colspan="3" bgcolor="#F5F5F5"><strong>FILTER DATA  </strong></td>
		</tr>
		<tr>
		  <td width="134"><strong>  Kategori </strong></td>
		  <td width="5"><strong>:</strong></td>
		  <td width="741">
		  <select name="cmbKategori">
            <option value="Semua">....</option>
            <?php
		  $mySql = "SELECT * FROM kategori ORDER BY kd_kategori";
		  $myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		  while ($myData = mysql_fetch_array($myQry)) {
			if ($kodeKategori == $myData['kd_kategori']) {
				$cek = " selected";
			} else { $cek=""; }
			echo "<option value='$myData[kd_kategori]' $cek>$myData[nm_kategori]</option>";
		  }
		  $mySql ="";
		  ?>
          </select></td>
		</tr>
		<tr>
		  <td><strong>Cari Nama </strong></td>
		  <td><strong>:</strong></td>
		  <td><input name="txtKataKunci" type="text" value="<?php echo $dataKataKunci; ?>" size="45" maxlength="100" autofocus/>
		    <input name="btnCari" type="submit" value="Cari " /></td>
		  </tr>
	  </table>	</td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <th width="20"><b>No</b></th>
        <th width="50"><strong>Kode</strong></th>
        <th width="369"><b>Nama Barang </b></th>
        <th width="185">Kategori</th>
        <th width="49" align="center"><strong>Jumlah</strong></th>
        <th width="49"><strong>Satuan</strong></th>
        <th><strong>Foto</strong></th>
        <td colspan="3" align="center" bgcolor="#CCCCCC"><b>Tools</b><strong></strong></td>
        </tr>
      <?php
	# Skrip menampilkan data Barang dari tabel Barang Inventaris
	$mySql 	= "SELECT barang.*, kategori.nm_kategori FROM  barang_inventaris
					LEFT JOIN barang ON barang_inventaris.kd_barang=barang.kd_barang
					LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori
				WHERE barang.kd_kategori !=''
				$filterSQL
				GROUP BY barang.kd_barang
				ORDER BY barang.kd_barang DESC LIMIT $hal, $row";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = $hal; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kd_barang'];

		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['kd_barang']; ?></td>
        <td><?php echo $myData['nm_barang']; ?></td>
        <td><?php echo $myData['nm_kategori']; ?></td>
        <td align="center"><?php echo format_angka($myData['jumlah']); ?></td>
        <td bgcolor="<?php echo $warna; ?>"><?php echo $myData['satuan']; ?></td>
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
        <td width="46" align="center"><a href="?open=Barang-Delete&amp;Kode=<?php echo $Kode; ?>" target="_blank" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA BARANG INI ... ?')">Delete</a></td>
        <td width="40" align="center"><a href="?open=Barang-Edit&amp;Kode=<?php echo $Kode; ?>" target="_blank" alt="Edit Data">Edit</a></td>
        <?php } ?>
        <td width="40" align="center"><a href="?open=Barang-View&Kode=<?php echo $Kode; ?>" target="_blank" alt="Edit Data">View</a></td>
        </tr>
      <?php } ?>
      <tr>
        <td colspan="3" bgcolor="#F5F5F5"><b>Jumlah Data :</b> <?php echo $jml; ?> </td>
        <td colspan="6" align="right" bgcolor="#F5F5F5"><b>Halaman ke :</b>
            <?php
	for ($h = 1; $h <= $max; $h++) {
		$list[$h] = $row * $h - $row;
		echo " <a href='?open=Pencarian-Barang&hal=$list[$h]&kodeKategori=$kodeKategori'>$h</a> ";
	}
	?></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
