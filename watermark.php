<?



header('content-type: image/jpeg; ');  



$watermark = imagecreatefrompng('watermark.png');  

$watermark_width = imagesx($watermark);  

$watermark_height = imagesy($watermark);  

$image = imagecreatetruecolor($watermark_width, $watermark_height);  

$image = imagecreatefromjpeg($_GET['src']);  

$size = getimagesize($_GET['src']);  

$dest_x = $size[0] - $watermark_width - 0;  

$dest_y = $size[1] - $watermark_height - 0;  

imagecopymerge($image, $watermark, 0, 0, 0, 0, $watermark_width, $watermark_height, 30);  

imagejpeg($image);  

imagedestroy($image);  

imagedestroy($watermark);  



?>

