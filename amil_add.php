<?php
include_once "library/inc.seslogin.php";

# Tombol Simpan diklik
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNama		= $_POST['txtNama'];
	$cmbKelamin		= $_POST['cmbKelamin'];
	$txtAlamat		= $_POST['txtAlamat'];
	$txtTelepon		= $_POST['txtTelepon'];
	
	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Amil</b> tidak boleh kosong, silahkan dilengkapi !";		
	}
	if (trim($cmbKelamin)=="Kosong") {
		$pesanError[] = "Data <b>Kelamin</b> belum dipilih, silahkan pilih pada Combo !";		
	}
	if (trim($txtAlamat)=="") {
		$pesanError[] = "Data <b>Alamat Lengkap</b> tidak boleh kosong, silahkan dilengkapi !";		
	}
	if (trim($txtTelepon)=="") {
		$pesanError[] = "Data <b>No. Telepon</b> tidak boleh kosong, silahkan dilengkapi !";		
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
		# SIMPAN DATA KE DATABASE. 
		// Jika tidak menemukan error, simpan data ke database	
		$kodeBaru	= buatKode("amil", "A");
		$mySql	= "INSERT INTO amil (kd_amil, nm_amil, jns_kelamin, alamat, no_telepon) 
					VALUES ('$kodeBaru',
							'$txtNama',
							'$cmbKelamin',
							'$txtAlamat',
							'$txtTelepon')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Amil-Data'>";
		}
		exit;
	}	
} // Penutup Tombol Simpan
	
# MASUKKAN DATA DARI FORM KE VARIABEL TEMPORARY (SEMENTARA)
$dataKode	= buatKode("amil", "A");
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataKelamin= isset($_POST['cmbKelamin']) ? $_POST['cmbKelamin'] : '';
$dataAlamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
$dataTelepon= isset($_POST['txtTelepon']) ? $_POST['txtTelepon'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
<table width="100%" cellpadding="2" cellspacing="1" class="table-list">
	<tr>
	  <th colspan="3">TAMBAH DATA AMIL </th>
	</tr>
	<tr>
	  <td width="15%"><b>Kode</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="84%"><input name="textfield" value="<?php echo $dataKode; ?>" size="16" maxlength="4" /></td></tr>
	<tr>
	  <td><b>Nama Amil </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td>
	</tr>
	<tr>
      <td><b>Kelamin</b></td>
	  <td><b>:</b></td>
	  <td><b>
        <select name="cmbKelamin">
          <option value="Kosong">....</option>
          <?php
		  $pilihan	= array("Laki-laki", "Perempuan");
          foreach ($pilihan as $nilai) {
            if ($dataKelamin==$nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
      </b></td>
    </tr>
	<tr>
      <td><b>Alamat Lengkap </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtAlamat" value="<?php echo $dataAlamat; ?>" size="80" maxlength="200" /></td>
    </tr>
	<tr>
      <td><b>No Telepon </b></td>
	  <td><b>:</b></td>
	  <td><input name="txtTelepon" value="<?php echo $dataTelepon; ?>" size="20" maxlength="20" /></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN "></td>
    </tr>
</table>
</form>
