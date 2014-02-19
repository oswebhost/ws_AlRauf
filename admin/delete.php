<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php") ;
$refpage='';

if ($ACTION=='DELETE' and $GO=='YES') :
	$url ="orders.php?PAGE=$PAGE&per_page=$per_page" ;	
	$q = mysql_query("delete from order_status where order_no='$ID'") or die ( mysql_error() );
	$q = mysql_query("delete from order_items where order_no='$ID'") or die ( mysql_error() );
	$q = mysql_query("delete from orders where order_no='$ID'") or die ( mysql_error() );
	header ("Location: orders.php" ) ;
	exit ;
endif;

header("Location: $refpage");
exit;

?>