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

$PAGE_TITILE = "Disclaimer " . $PAGE_TITILE ;

require_once("header.ini.php") ;



$ID="DISCLAIMER";

$imgfile = strtolower($ID); 
$q = mysql_query("select * from pages where page_key='$ID'") or die ( mysql_error() ) ;
$d = mysql_fetch_array($q) ;


?>
<center>



<table width='100%' cellpadding='0' cellspacing='0' border='0'>
	<tr>
	<td valign='top' width='200' style='padding-left:0px;padding-right:10px;'>
			
			<? include("pro-category-menu.ini.php"); ?>
			
		</td>	
		<td valign='top' width="800" style='padding-right:12px;' >
	
	<?
	
		echo "<h3>". stripslashes($d["page_heading"]) . "</h3>" ;
		echo stripslashes($d["page_content"]) ;  

	?>

		
		</td>
		
	
	</tr>
</table>




</center>

<? require_once("footer.ini.php") ;  ?>