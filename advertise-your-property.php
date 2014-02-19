<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
 ob_start();
session_start() ;
$userid = $_SESSION['userid'];

$curpage = "submit";

require_once("common.php") ;

$PAGE_TITILE = " Sell or Tolet " . $PAGE_TITILE ;

require_once("header.ini.php") ;



?>

<center>
<table width='100%' cellpadding='0' cellspacing='0' border='0'>
	<tr>
	<td valign='top' width='200' style='padding-left:0px;padding-right:10px;'>
			
			<? include("pro-category-menu.ini.php"); ?>
			
		</td>	
		<td valign='top' width="800" style='padding-right:12px;' >



		<? 

			if ($_POST['go']<>"SAVE"):
				echo "<h3 style='margin-bottom:0px;border:0;'>Sell or Tolet</h3>" ;
				echo "<font color='black' size='2'>&nbsp;&nbsp;&nbsp;We can help you in Your Property needs.</font><BR><BR>";

				include("submit-property-form.ini.php");
			else:
				$q = mysql_query("select * from pages where page_key='THANKYOU'") or die ( mysql_error() ) ;
				$d = mysql_fetch_array($q) ;

				echo "<h3>". stripslashes($d["page_heading"]) . "</h3>" ;
				
				echo "<center><div id='msgdiv'>";
					echo stripslashes($d["page_content"]) ;  
				echo "</div></center>";


				$pro_array = $_POST['pro_feature'];
				$com_array = $_POST['com_feature'];
				
				$pro_fea = "<ul>";
				for ($i=0; $i<count($pro_array); $i++):
					$pro_fea.= "<li>".pro_feature_name($pro_array[$i]) . "</li>" ;
				endfor;
				$pro_fea .="</ul>";
				
				$com_fea ="<ul>";
				for ($i=0; $i<count($com_array); $i++):
					$com_fea .= "<li>". com_feature_name($com_array[$i]) . "</li>" ;
				endfor;
				$com_fea .="</ul>";

				$file = "submit-property-output.ini.php";
				$handle = fopen($file, "r");
				$info = fread($handle, filesize($file));
				while (list($key, $value) = each ($_POST)) 
				{	
					$info = ereg_replace("%%$key%%", stripslashes($value) , $info);		
				}		
				$info = ereg_replace("%%pro_fea%%", $pro_fea , $info);		
				$info = ereg_replace("%%com_fea%%", $com_fea , $info);		
				$info = ereg_replace("%%D_A_T_E%%", date("d-M-Y H:m A") , $info);		
				
				$from_email = $_POST['pname'] . " <". $_POST['pemail'] .">";
				$subject = addslashes($_POST['property_title']);
				echo $info;
				send_email($PROPERTY_EMAIL,$from_email,$info,$subject) ;
			endif;
						
			

		?>

		
		</td>
		


	
	</tr>
</table>
</center>



<? require_once("footer.ini.php") ; ?>