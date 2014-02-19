<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/

require_once("common.php") ;

echo '<link rel="stylesheet" type="text/css" href="style.css" />';


$ID="TOC";

$imgfile = strtolower($ID); 
$q = mysql_query("select * from pages where page_key='$ID'") or die ( mysql_error() ) ;
$d = mysql_fetch_array($q) ;


echo "<h3>". stripslashes($d["page_heading"]) . "</h3>" ;
echo stripslashes($d["page_content"]) ;  

?>