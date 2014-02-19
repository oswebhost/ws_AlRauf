<?php

$src    = $_GET['src'];
$width  = $_GET['maxw'];
$height = $_GET['maxh'];

require_once('class.ImageResize.php');
header('Content-Type: image/jpeg');
$image = new SimpleImage();
$image->load($src);
if ($height>0):
	$image->resize($width,$height);
else:
	$image->resizeToWidth($width);
endif;
$image->output();
?>