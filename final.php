<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/

ob_start();
session_start() ;
$osID = session_id() ;	

if (!isset($_SESSION['userid'])):
	header("Location: login.php") ;
	exit;
endif;
$userid = $_SESSION['userid'];


if (!$_POST['aid']):
	header("location:payment.php");
	exit;
endif;

require_once("config.ini.php") ;
require_once("common.php") ;

$_aid      =  $_POST['aid'];
$_cost     = getadcost($_aid);
$_featured =  getadcost($_POST['featured']) ;
$title = getadname($_aid);
if ($_featured>0):
	$title .= " with " . getadname($_POST['featured']) ; 
endif;


$stamp = strtotime ("now"); 
$orderid = "$stamp"; 
$orderid = str_replace(".", "", "$orderid"); 
$order_time = time();



$q = "insert into orders (rid, orderno, order_date, ad_id, ad_cost, featured, paidby, pay_status, ad_status, pay_by) values ('0','0','$order_time', '$_aid', '$_cost', '$_featured', '$_SESSION[userid]','','0','$_POST[pay]')";
mysql_query($q) or die ( mysql_error());
$new_row = mysql_insert_id();

$new_id= "$new_row-$orderid";

mysql_query("update orders set orderno='$new_id' where rid='$new_row'");


if ($_cost+$_featured<1):
	mysql_query("update orders set pay_status='FREE' where rid='$new_row'");
	header("Location: member-home.php");
	exit;
endif;


if ($_POST['pay']=='PAYPAL') :
	$site2go = 'onload="paypal.submit();"' ;

elseif ($_POST['pay']=='PAYMATE'):
	$site2go = 'onload="paymate.submit();"' ;
endif;




$subject = "Order No. " . $new_id . " -- $DOMAIN" ;





?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" href="style.css">


<TITLE> <?= $DOMAIN ?> </TITLE>

</HEAD>

 <BODY <?  echo $site2go; ?> >
<?


   $q = mysql_query("select * from orders where orderno='$new_id'" ) or die (mysql_error() ) ;
   $d = mysql_fetch_array($q) ;

   if ($_POST['pay']=='PAYPAL') :
		echo  paypal(num2($d["ad_cost"]+$d["featured"]),trim($d["paidby"]),$d["orderno"],"AUD","$title","paypal.php") ;
  
   elseif ($_POST['pay']=='PAYMATE') :
		echo  paymate(num2($d["ad_cost"]+$d["featured"]),trim($d["paidby"]),$d["orderno"],"AUD","$title","paymate.php") ;
	
   endif;

  
?>

<div align="center">
	<table width="100%" border="0">
		<tr height="300"> 
		 <td align="center">
			<span id="head"> Please wait. Processing request...</span><BR>

		 </td>
		</tr>
	</table>

</div>

</BODY>
</HTML>
