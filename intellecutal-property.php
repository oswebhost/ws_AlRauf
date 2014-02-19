<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
 ob_start();
session_start() ;
$userid = $_SESSION['userid'];


require_once("common.php") ;
require_once("header.ini.php") ;



$ID="IP";

$imgfile = strtolower($ID); 
$q = mysql_query("select * from pages where page_key='$ID'") or die ( mysql_error() ) ;
$d = mysql_fetch_array($q) ;

box_top_square("100%");

echo "<h3>". stripslashes($d["page_heading"]) . "</h3>" ;
echo stripslashes($d["page_content"]) ;  

box_bottom();




require_once("footer.ini.php") ; 

?>