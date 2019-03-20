<?php
		include "barcode39.php";
		header('Content-type: image/gif');
		$ser = $_GET['registration_number'];
		$bc = new barCode();
        $bc->build($ser);
?>