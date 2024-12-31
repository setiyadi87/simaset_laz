<?php
include_once "library/inc.seslogin.php";

# MEMBACA TOMBOL SIMPAN
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNama		= $_POST['txtNama'];
	$txtNama		= str_replace("'","&acute;",$txtNama); // menghalangi penulisan tanda petik satu (')
	$cmbDivisi	= $_POST['cmbDivisi'];
	
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Lokasi</b> tidak boleh kosong !";		
	}
	if (trim($cmbDivisi)=="Kosong") {
		$pesanError[] = "Data <b>Divisi</b> belum dipilih, silahkan pilih pada Combo !";		
	}
	
	# Validasi Nama lokasi, jika sudah ada akan ditolak
	$Kode	= $_POST['txtKode'];
	$cekSql="SELECT * FROM lokasi WHERE kd_divisi='$cmbDivisi' AND nm_lokasi='$txtNama' AND NOT(kd_lokasi='$Kode')";
	$cekQry=mysql_query($cekSql, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($cekQry)>=1){
		$pesanError[] = "Maaf, Nama Lokasi : <b> $txtNama </b> sudah ada, ganti dengan yang lain";
	}
	
	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='mssgBox'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
				$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
	}
	else {
		# SIMPAN PERUBAHAN DATA, Jika jumlah error pesanError tidak ada, simpan datanya
		$Kode	= $_POST['txtKode'];
		$mySql	= "UPDATE lokasi SET nm_lokasi='$txtNama', kd_divisi='$cmbDivisi' WHERE kd_lokasi ='$Kode'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Lokasi-Data'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan

# TAMPILKAN DATA LOGIN UNTUK DIEDIT
$Kode	 = $_GET['Kode']; 
$mySql	 = "SELECT * FROM lokasi WHERE kd_lokasi='$Kode'";
$myQry	 = mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData	 = mysql_fetch_array($myQry);

	// Menyimpan data ke variabel temporary (sementara)
	$dataKode		= $myData['kd_lokasi'];
	$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_lokasi'];
	$dataDivisi	= isset($_POST['cmbDivisi']) ? $_POST['cmbDivisi'] : $myData['kd_divisi'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
<table class="table-list" width="100%">
	<tr>
	  <th colspan="3">UBAH DATA LOKASI </th>
	</tr>
	<tr>
	  <td width="15%"><b>Kode</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="textfield" value="<?php echo $dataKode; ?>" size="8" maxlength="4"  readonly="readonly"/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td></tr>
	<tr>
	  <td><b>Nama Lokasi </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td></tr>
	<tr>
      <td><strong>Divisi </strong></td>
	  <td><strong>:</strong></td>
	  <td><select name="cmbDivisi">
          <option value="Kosong">....</option>
          <?php
		  // Menampilkan data Divisi
		$mySql = "SELECT * FROM divisi ORDER BY kd_divisi";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		while ($myData = mysql_fetch_array($myQry)) {
		if ($myData['kd_divisi']== $dataDivisi) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$myData[kd_divisi]' $cek>$myData[nm_divisi] </option>";
		}
		?>
      </select></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN "></td>
    </tr>
</table>
</form>

