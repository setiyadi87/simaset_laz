<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";

# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNama		= $_POST['txtNama'];
	$txtNama		= str_replace("'","&acute;",$txtNama); // menghalangi penulisan tanda petik satu (')
	
	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtKeterangan	= str_replace("'","&acute;",$txtKeterangan); // menghalangi penulisan tanda petik satu (')
	
	$txtMerek		= $_POST['txtMerek'];
	$txtMerek		= str_replace("'","&acute;",$txtMerek); // menghalangi penulisan tanda petik satu (')
	
	$cmbSatuan		= $_POST['cmbSatuan'];
	$cmbKategori	= $_POST['cmbKategori'];

	# Validasi form, jika kosong sampaikan pesan error
	$pesanError = array();
	if (trim($txtNama)=="") {
		$pesanError[] = "Data <b>Nama Barang</b> tidak boleh kosong !";		
	}
	if (trim($txtKeterangan)=="") {
		$pesanError[] = "Data <b>Keterangan</b> tidak boleh kosong !";		
	}
	if (trim($txtMerek)=="") {
		$pesanError[] = "Data <b>Merek</b> tidak boleh kosong !";		
	}
	if (trim($cmbSatuan)=="Kosong") {
		$pesanError[] = "Data <b>Satuan Barang</b> belum dipilih !";		
	}
	if (trim($cmbKategori)=="Kosong") {
		$pesanError[] = "Data <b>Kategori Barang</b> belum dipilih !";		
	}
		
	# Validasi Nama barang, jika sudah ada akan ditolak
	$sqlCek="SELECT * FROM barang WHERE nm_barang='$txtNama'";
	$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($qryCek)>=1){
		$pesanError[] = "Maaf, Nama Barang <b> $txtNama </b> sudah dipakai, ganti dengan yang lain";
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
		$errors= array();
		foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
			$file_name = $key.$_FILES['files']['name'][$key];
			$file_size =$_FILES['files']['size'][$key];
			$file_tmp =$_FILES['files']['tmp_name'][$key];
			$file_type=$_FILES['files']['type'][$key];	
	        if($file_size > 9097152){
				$errors[]='File size must be less than 2 MB';
	        }	
	        $images[] = $file_name;
	        $desired_dir="user_data";
	        if(empty($errors)==true){
	            if(is_dir($desired_dir)==false){
	                mkdir("$desired_dir", 0700);	// Create directory if it does not exist
	            }
	            if(is_dir("$desired_dir/".$file_name)==false){
	                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
	            }else{	
	                $new_dir="$desired_dir/".$file_name.time();
	                 rename($file_tmp,$new_dir) ;				
	            }		
	        }else{
	                print_r($errors);
	        }
	    }
	    
    	if (implode('',$images)!='' OR implode('',$images)!='0'){
    		$fileName = implode(';',$images);
    	}else{
    		$fileName = '';
    	}
		# SIMPAN DATA KE DATABASE. // Jika tidak menemukan error, simpan data ke database
		$kodeBarang	= $_POST['textfield'];
		$mySql	= "INSERT INTO barang (kd_barang, nm_barang, keterangan, merek, satuan, jumlah, kd_kategori, foto) 
							VALUES ('$kodeBarang',
									'$txtNama',
									'$txtKeterangan',
									'$txtMerek',
									'$cmbSatuan',
									'0',
									'$cmbKategori',
									'$fileName')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){		
			echo "<meta http-equiv='refresh' content='0; url=?open=Barang-Add'>";
		}
		exit;
	}

} // Penutup POST
	
# MASUKKAN DATA KE VARIABEL
$dataKode		= buatKode("barang", "B");
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
$dataMerek		= isset($_POST['txtMerek']) ? $_POST['txtMerek'] : '';
$dataSatuan		= isset($_POST['cmbSatuan']) ? $_POST['cmbSatuan'] : '';
$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" target="_self" enctype="multipart/form-data">
<table width="100%" cellpadding="2" cellspacing="1" class="table-list" style="margin-top:0px;">
	<tr>
	  <th colspan="3">TAMBAH DATA ASET BARANG </th>
	</tr>
	<tr>
	  <td width="17%"><b>Kode</b></td>
	  <td width="1%"><b>:</b></td>
	  <td width="82%"><input name="textfield" size="18" maxlength="20"/> <i><small>Kode Barang tidak Boleh sama dengan kode barang yang lain.</small></i></td></tr>
	<tr>
	  <td><b>Nama Barang</b></td>
      <td><b>:</b></td>
	  <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="100" /></td>
    </tr>
	<tr>
	  <td><b>Keterangan</b></td>
	  <td><b>:</b></td>
	  <td><textarea name="txtKeterangan" cols="60" rows="3"><?php echo $dataKeterangan; ?></textarea></td>
	</tr>
	<tr>
      <td><b>Merek</b></td>
	  <td><b>:</b></td>
	  <td><input name="txtMerek" value="<?php echo $dataMerek; ?>" size="60" maxlength="100" /></td>
    </tr>
	<tr>
	  <td><strong>Satuan</strong></td>
	  <td><b>:</b></td>
	  <td><b>
	    <select name="cmbSatuan">
          <option value="Kosong">....</option>
          <?php
		  // Menampilkan data Satuan  ke comboBox, satuan ada pada file library/inc.pilihan.php
		  include_once "library/inc.pilihan.php";
          foreach ($satuan as $nilai) {
            if ($dataSatuan == $nilai) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$nilai' $cek>$nilai</option>";
          }
          ?>
        </select>
	  </b></td>
    </tr>
	<tr>
      <td><strong>Kategori </strong></td>
	  <td><strong>:</strong></td>
	  <td><select name="cmbKategori">
          <option value="Kosong">....</option>
          <?php
		  // Menampilkan data kategori ke comboBox
		$mySql = "SELECT * FROM kategori ORDER BY nm_kategori";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		while ($myData = mysql_fetch_array($myQry)) {
		if ($myData['kd_kategori']== $dataKategori) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$myData[kd_kategori]' $cek>$myData[nm_kategori] </option>";
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td><b>Foto (Multiple Upload)</b></td>
	  <td><b>:</b></td>
	  <td><input type='file' name="files[]" multiple/></td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
<strong># Note:</strong> Jumlah barang akan bertambah dari  <a href="pengadaan/" target="_blank">Transaksi Pembelian / Pengadaan Barang</a>
</form>
