<?
	require_once "common.php" ;
	
	$r = mysql_query("select * from ads_images where rid='$_GET[ID]'") or die( mysql_error() );
	$d = mysql_fetch_array($r) ;
	$PIC = $d['image_name'];
	$cap = $d['image_title'];

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?= $DOMAIN ?>  </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script language="javascript"><!--
var i=0;
function resize() {
   if (navigator.appName == 'Netscape') i=40;
  h= document.images[0].height ;  w= document.images[0].width ;
  if (document.images[0].width>700) w = 800;
  if (document.images[0].height>500) h = 600;
  if (document.images[0]) window.resizeTo(w+70, h+120);
  self.focus();
}

settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'

//--></script>

</head>

<body topmargin=0 leftmargin=0 onload="resize();" bgcolor="#3366CC">
<div align='center' style='background:#3366CC;padding:10px;'>


<? echo  "<IMG SRC='watermark.php?src=pro_images/act_$PIC' style='border: 10px solid #ffffff' ><br />" ;
	

?>


	<div id='footer' style='background:#212526;padding:10px;margin-top:10px;'>
	<A HREF="javascript:close()">x Close this window x</A></div>
</div>
</body>
</html>

