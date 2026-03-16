<?php
	$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
	if (!$msg) $msg = "Le site du spipu\r\nhttp://spipu.net/";


	$err = isset($_GET['err']) ? $_GET['err'] : '';
	if (!in_array($err, array('L', 'M', 'Q', 'H'))) $err = 'L';
	
	require_once('qrcode.class.php');
	
	$qrcode = new QRcode(mb_convert_encoding($msg, 'UTF-8', 'ISO-8859-1'), $err);
	$qrcode->disableBorder();
	$qrcode->displayPNG(200);
?>