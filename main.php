<?php
if(isset($_SESSION['SES_ADMIN'])) {
	include "home_admin_row1.php";
	include "home_admin_row2.php";
}
else if(isset($_SESSION['SES_PETUGAS'])) {
	include "home_admin_row2.php";
}
?>