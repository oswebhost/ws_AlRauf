<? /*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/





require_once("../config.ini.php") ;
require_once("../common.php") ;
require_once("header.ini.php") ;

include("../class.ImageResize.php");

$maxH_size = 600;
$maxW_size = 800;

if ($_POST['action']=="upload"){


	for ($i=0; $i<count($_FILES['photos']); $i++){
		$userfile_name = $_FILES['photos']['name'][$i];
		$main = ($i==0? 1 : 0);
        $ID = $_POST['ID'];
        
		if ($userfile_name != ""){
			$type = strtolower( substr(strrchr($userfile_name,"."),1) )  ;
			$userfile_size = $_FILES['photos']['size'][$i];
			$userfile_type = $_FILES['photos']['type'][$i];
			$userfile_tmp  = $_FILES['photos']['tmp_name'][$i];

		  /*
			echo "$ID -- $userfile_name <br>" ;
			echo "$type <br>" ;
			echo "$userfile_type <br>" ;
			echo "$userfile_tmp <br>" ;
			echo "-----------------<br>";
		 */
            
			$type = strtolower( substr(strrchr($userfile_name,"."),1) )  ;
			if ( ($type == "jpg") or ($type == "gif") ) {
				$xtitle = stripslashes( $title[$i] );
				$old_id = $id_image[$i];
				mysql_query("delete from ads_images where rid='$old_id'");

				$q = mysql_query("insert into ads_images (rid,propertyid,image_title,main) values ('0','$ID','$xtitle','$main')") or die (mysql_error());
				$x = mysql_insert_id();
				$new_img = "$ID-$x.$type";
				
				mysql_query("update ads_images set image_name='$new_img' where rid='$x'");

			    $image = new SimpleImage();
				$image->load($userfile_tmp);
				
				if ($image->getHeight()>$maxH_size or $image->getWidth()>$maxW_size){
				
                	if ($image->getHeight()>$image->getWidth()){
						$image->resizeToHeight($maxH_size);
					}else{
						$image->resizeToWidth($maxW_size);
					}
					$image->save("$abpath/$new_img");
				
                }else{
				
                	@copy($userfile_tmp , "$abpath/$new_img");
				
                }
			
			}
        }
    }
}

if ($_POST['action']=='EDIT'):
	for ($i=0; $i<count($dele); $i++):
		if ($dele[$i] != ""):
			$r_id = $dele[$i];
			
			$q = mysql_query("select image_name from ads_images where rid='$r_id'");
			$d = mysql_fetch_array($q);
			$_img = $d["image_name"];
			
			mysql_query("delete from ads_images where rid='$r_id'");

			if (file_exists("$abpath/$_img")):  unlink("$abpath/$_img"); endif;
		endif;
	endfor;
endif;


$allow_image = 5;



$q = mysql_query("select * from ads_images where propertyid='$ID' order by rid") or die (mysql_error());
while ($d = mysql_fetch_array($q)):
	$cur_img[] = $d["image_name"] ;
	$id_img[] = $d["rid"] ;
endwhile;

?>


<table width='100%'>
<tr>
	<td width='50%'><span class="pagehd">Photos for <?echo gettitle($ID);?></span></td>
	<td width='50%' style='padding-left:250px;'><a href="pro-listing.php?PAGE=<?echo $PAGE?>">Back</A></td>
</tr>
</table>




<div style='padding:5px;'></div>



<form method='post'action='add-images.php' enctype="multipart/form-data">
<input type="hidden" name='ID' value="<? echo $_REQUEST['ID'];?>" />
<input type="hidden" name='action' value="upload" />

<table border='0' cellpadding='3' cellspacing='0' width='98%' align="center">
<tr>
	<td valign='top' width='30%' bgcolor='#F4f4f4'>
	<? 

		for ($i=0; $i<$allow_image; $i++):
			$x=$i+1;
			echo "Image $x ". ($x==1? "<B>Main Property Photo</B>" : "")  .": (gif/jpg) w:800 h:600 max
            <div style='padding:5px;'></div>
            <input type='file' name='photos[]' style='width:100%'>";
			echo "<div style='padding-top:25px;'></div>\n\n";
		endfor;
		echo "<div align='center' style='padding:10px;'>";
		echo '<INPUT TYPE="submit" value="««  Upload  »»" style="width:120px;height:25px;" class="bt">';
		echo "</div>";


	?>
	</form>
	</td>
	<td valign='top' width='70%' align='center'>
	
		<form method="post" action='add-images.php'> 
		<input type='hidden' name='ID' value='<? echo $_REQUEST['ID'];?>' />
		<input type='hidden' name='action' value='EDIT' />

		<table width='100%' border='1' style="border-collapse: collapse" cellpadding='8' bordercolor="#cccccc">
		<tr>
	<?  
	   $x=0;
		$q = mysql_query("select * from ads_images where propertyid='$ID' order by main desc,rid") or die (mysql_error());
		while ($d = mysql_fetch_array($q)):
            $cfile = "../pro_images/". $d[image_name];
             
			echo "<td width=25% align='center'><img src='thumbnail.php?src=$cfile&maxh=140&maxw=160' border='0'>";
			echo "<br><input type='checkbox' class='chk'  name='dele[]' value='".$d['rid']."'>";
			echo ($d['main']=='1'? "<br>Main photo": "");
			echo "</td>";
			$x++;
			if ($x>3): $x=0; echo "</tr><tr>"; endif;
		endwhile;

	?>
		<tr>	
			<td colspan='4' align='center' height='35' bgcolor='#cccccc'>
				<INPUT TYPE="submit" value="««  Delete Selected  »»" style="width:160px;height:25px;" class="bt">
			</td>
		</tr>
		</table>	
		</form>
		
	</td>
</tr>

</table>



<? require_once("footer.ini.php") ; ?>