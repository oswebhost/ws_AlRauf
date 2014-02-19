<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
 ob_start();
session_start() ;
$userid = $_SESSION['userid'];

$curpage = "faq";
require_once("common.php") ;
require_once("header.ini.php") ;





?>

<center>
<table width='980' cellpadding='0' cellspacing='0' border='0'>
	<tr>
		<td valign='top' width='730' style='padding-right:12px;' >
		<? box_top_square("100%");

			echo "<h3 style='margin-bottom:0'>Frequently Asked Questions</h3>" ;

			$q = mysql_query("select * from faq order by rank") or die( mysql_error() ) ;
			while ($r = mysql_fetch_array($q) ):
				 echo '<p><IMG SRC="images/red.gif"  BORDER="0" ALT="">' . "\n"; 
				 echo "<span id='question'>" . stripslashes(trim($r["question"])) . "</span>\n";
				 echo "<br>";		
				 echo stripslashes(strip_tags($r["answer"] )) . "</p>\n"; 
			endwhile;	

			box_bottom();

		?>

		
		</td>
		


		<td valign='top' width='230' style='padding-top:0px;'>
			
				<? include("pro-category-menu.ini.php"); ?>
			
		</td>	
	</tr>
</table>
</center>



<? require_once("footer.ini.php") ; ?>