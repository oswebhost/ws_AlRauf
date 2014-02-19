<?

include("config.ini.php");
echo "Start:...<BR>";

$q = "update ads set sq_ft='Square Yards' where sq_ft='Square Meters';" ;
$q  = mysql_query($q) or die (mysql_error() );

$q = "update ads set floor_sqft='Square Yards' where floor_sqft='Square Meters';" ;
$q  = mysql_query($q) or die (mysql_error() );



echo "<BR>Done -----------";


?>

<?



			

			if ($_POST['go']<>"SAVE"):
			
				include("submit-property-form.ini.php");
			else:
				$q = mysql_query("select * from pages where page_key='THANKYOU'") or die ( mysql_error() ) ;
				$d = mysql_fetch_array($q) ;

			
				
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



		
			