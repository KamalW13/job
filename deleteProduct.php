<?php 

include 'functions.php';

$id = $_GET['id'];

if (deleteData($id, 'product') >= 1) {
	echo "
		<script>
		 	alert('Data berhasil dihapus!');
		 	document.location.href = 'CPanel.php';
 		</script>";
 }

 ?>