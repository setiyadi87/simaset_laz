<?php
include_once "library/inc.seslogin.php";
include_once "library/inc.library.php";

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
	$Kode	= $_POST['txtKode'];
	$sqlCek	= "SELECT * FROM barang WHERE nm_barang='$txtNama' AND NOT(kd_barang='$Kode')";
	$qryCek	= mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
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
    		$cek = mysql_fetch_array(mysql_query("SELECT * FROM barang where kd_barang='$_POST[txtKode]'"));
    		$fileName = $cek['foto'];
    	}
		# TIDAK ADA ERROR, Jika jumlah error message tidak ada, simpan datanya
		$Kode	= $_POST['txtKode'];
		$mySql	= "UPDATE barang SET  nm_barang='$txtNama',
									keterangan='$txtKeterangan',
									merek='$txtMerek',
									satuan='$cmbSatuan',
									kd_kategori='$cmbKategori',
									foto='$fileName' WHERE kd_barang ='$Kode'";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=?open=Barang-Data'>";
		}
		exit;
	}	
} // Penutup POST

# TAMPILKAN DATA UNTUK DIEDIT
$Kode	 = $_GET['Kode']; 
$mySql = "SELECT * FROM barang WHERE kd_barang='$Kode'";
$myQry = mysql_query($mySql, $koneksidb)  or die ("Query ambil data salah : ".mysql_error());
$myData= mysql_fetch_array($myQry);

	# MASUKKAN DATA KE VARIABEL
	$dataKode	= $myData['kd_barang'];
	$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : $myData['nm_barang'];
	$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : $myData['keterangan'];
	$dataMerek		= isset($_POST['txtMerek']) ? $_POST['txtMerek'] : $myData['merek'];
	$dataSatuan		= isset($_POST['cmbSatuan']) ? $_POST['cmbSatuan'] : $myData['satuan'];
	$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : $myData['kd_kategori'];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmedit" enctype="multipart/form-data">
<table class="table-list" width="100%" style="margin-top:0px;">
	<tr>
	  <th colspan="3">LENGKAPI DATA ASET BARANG </th>
	</tr>
	<tr>
	  <td width="17%"><strong>Kode </strong></td>
	  <td width="1%"><strong>:</strong></td>
	  <td width="82%"><input name="textfield" value="<?php echo $dataKode; ?>" size="14" maxlength="10"  style='background:#cecece; color:red'/>
    <input name="txtKode" type="hidden" value="<?php echo $dataKode; ?>" /></td></tr>
	<tr>
	  <td><b>Nama Barang</b></td>
      <td><strong>:</strong></td>
	  <td><input name="txtNama" value="<?php echo $dataNama; ?>" size="80" maxlength="100" />
	    <input name="txtLama" type="hidden" value="<?php echo $myData['nm_barang']; ?>" /></td>
    </tr>
	<tr>
	  <td><b>Keterangan</b></td>
	  <td><strong>:</strong></td>
	  <td><textarea name="txtKeterangan" cols="60" rows="3"><?php echo $dataKeterangan; ?></textarea></td>
	</tr>
	<tr>
      <td><b>Merek</b></td>
	  <td><b>:</b></td>
	  <td><input name="txtMerek" value="<?php echo $dataMerek; ?>" size="60" maxlength="100" /></td>
    </tr>
	<tr>
      <td><strong>Satuan</strong></td>
	  <td><strong>:</strong></td>
	  <td><b>
        <select name="cmbSatuan">
          <option value="Kosong">....</option>
          <?php
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
		$mySql = "SELECT * FROM kategori ORDER BY nm_kategori";
		$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal Query".mysql_error());
		while ($myDataa = mysql_fetch_array($myQry)) {
		if ($myDataa['kd_kategori']== $dataKategori) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$myDataa[kd_kategori]' $cek>$myDataa[nm_kategori] </option>";
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td><b>Foto (Multiple Upload)</b></td>
	  <td><b>:</b></td>
	  <td><input type='file' name="files[]" multiple/>
	  	  <?php
	  	  	$ex = explode(';',$myData['foto']);
	  	  	$no = 1;
			for($i=0; $i<count($ex); $i++){
				if ($ex[$i]!=''){
					echo "<a target='_BLANK' href='user_data/".$ex[$i]."'><img style='margin-right:5px' width='100px' src='user_data/".$ex[$i]."'></a>";
				}
				$no++;
			}
	  	  ?>
	  </td>
    </tr>
	<tr><td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;"></td>
    </tr>
</table>
</form>

