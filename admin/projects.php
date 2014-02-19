<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");


if (!isset($_POST['per_page'])): $per_page=80; endif;
if (!isset($ACTION)) : $ACTION="LIST"; endif;



$pageNav=""; $heading = "Projects/Developers" ; $tbname = "project_name" ; $ORDER="project_name" ;

if ( ($ACTION=='ADD') and ($_POST['GO']=="SAVE") ):
	$project_name= addslashes($_POST['project_name']);
	$project_desc= addslashes($_POST['project_desc']);
	$q = mysql_query("insert into $tbname (rid,project_name,project_desc) VALUES (0,'$project_name','$project_desc')") or die ( mysql_error() ) ;
	$list_id = mysql_insert_id();
	
	$userfile_name = $_FILES['logo']['name'];
	$type = strtolower( substr(strrchr($userfile_name,"."),1) )  ;
	$userfile_size = $_FILES['logo']['size'];
	$userfile_type = $_FILES['logo']['type'];
	$_tmp  = $_FILES['logo']['tmp_name'];
	
	
	if ( ($type == "jpg") or ($type == "gif") ) :
		$new_logo      = "$list_id.$type" ;
		// delete if file existing....
		if (file_exists("$projectpath/$new_logo")): unlink("$projectpath/$new_logo"); endif;
		if ($type=="jpg"): $x = jpg_logo($_tmp,90,"$projectpath/", $new_logo) ; endif;
		if ($type=="gif"): $x = gif_logo($_tmp,90,"$projectpath/", $new_logo) ; endif;
		$qry = mysql_query("update $tbname set logo='$new_logo' where rid='$list_id'") ;
	endif;

endif;

if ( $ACTION=='DEL'):
	$q = mysql_query("select * from $tbname where rid='$ID' ") or die ( mysql_error() ) ;
	$d = mysql_fetch_array($q) ;
	$logo = $d['logo'];
	$q = mysql_query("DELETE from $tbname where rid='$ID'") or die ( mysql_error() ) ;
	if (file_exists("$projectpath/$ogo")): unlink("$projectpath/$logo"); endif;
	$ACTION='LIST' ;
endif; 

if ( ($ACTION=='EDIT') and ($_POST['GO']=="SAVE") ):
	$project_name= addslashes($_POST['project_name']);
	$project_desc= addslashes($_POST['project_desc']);
	$q = mysql_query("UPDATE $tbname set project_name='$project_name', project_desc='$project_desc' where rid='$ID'") or die ( mysql_error() ) ;

	$userfile_name = $_FILES['logo']['name'];
	$type = strtolower( substr(strrchr($userfile_name,"."),1) )  ;
	$userfile_size = $_FILES['logo']['size'];
	$userfile_type = $_FILES['logo']['type'];
	$_tmp  = $_FILES['logo']['tmp_name'];
	
	if ( ($type == "jpg") or ($type == "gif") ) :
		$new_logo      = "$ID.$type" ;
		// delete if file existing....
		if (file_exists("$projectpath/$new_logo")): unlink("$projectpath/$new_logo"); endif;
		if ($type=="jpg"): $x = jpg_logo($_tmp,90,"$projectpath/", $new_logo) ; endif;
		if ($type=="gif"): $x = gif_logo($_tmp,90,"$projectpath/", $new_logo) ; endif;
		$qry = mysql_query("update $tbname set logo='$new_logo' where rid='$ID'") ;
	endif;

endif;

if ( ($ACTION=='EDIT') or ($ACTION=='DELETE') ):
	$q = mysql_query("select * from $tbname where rid='$ID' ") or die ( mysql_error() ) ;
	$d = mysql_fetch_array($q) ;
endif;




$query="SELECT * from $tbname order by $ORDER";
$result= mysql_query($query) or die( mysql_error() );
$list="";
$number=0;
while ($row = mysql_fetch_array($result) ):
 $number++;

 $del_url="<a href=$PHP_SELF" ;
 $del_url.="?PAGE=$npage&per_page=$per_page&ACTION=DELETE&ID=". $row["rid"] . ">";

 $edit_url="<a href=" . $PHP_SELF;
 $edit_url.="?PAGE=$npage&per_page=$per_page&ACTION=EDIT&ID=". $row["rid"] . ">";

 $rowcol = rowcol($number);
 $list .="<tr>";
 $list .="<td  $rowcol align=\"center\">$number</td>\n\n";
 $list .="<td width='90' $rowcol align=\"left\">" .  show_logo(trim($row["logo"])) . "</td>\n"  ;
 $list .="<td width='80%' $rowcol align=\"left\">" .  trim($row["project_name"]) . "</td>\n"  ;
 $list .="<td $rowcol align=\"center\">". $edit_url . "Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
 $list .= $del_url ."DEL</a>";
 $list .="</td></tr>\n";
endwhile;



?>
<div align="center">


  <table border="0" cellspacing="3" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="0" id="AutoNumber2" bgcolor="#FFFFFF">
	<tr>
	  <td width="40%" valign="top"><p class="pagehd"><? echo $heading?></p>
		  <? echo $pageNav?>
	
	 <A  HREF="<?= $fileurl ?>"></a>
	 <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse" bordercolor="#cccccc" width="100%" id="AutoNumber1">
	  <tr>
		<td width="5%" class="tbhead" align="center"><b>No</b></td>
		<td width="80%" class="tbhead" colspan='2' align="center"><b>Projects/Developers</b></td>
		<td width="15%" class="tbhead" align="center"><b>Options</b></td>
	  </tr>
	  <? echo $list ?>
	
	</table>
<BR>
<BR>

<? //include("navi.ini.php"); ?>

 <td width="60%" valign="top">
	<P><BR>
	<div align="center"><A HREF="<?= "$PHP_SELF?ACTION=ADD" ?>">+ Click here to ADD NEW <?= $heading ?>   </A>
	<P>



<? if ($ACTION<>'LIST') : ?>
<form method="POST" action="<?= $PHP_SELF ?>"enctype="multipart/form-data" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);" style='padding:0;margin:10;'>

	<INPUT TYPE="hidden" name="ID" value="<?= $ID ?>">
	<INPUT TYPE="hidden" name="per_page" value="<?= $per_page ?>">
	<INPUT TYPE="hidden" name="PAGE" value="<?= $npage ?>">
	<INPUT TYPE="hidden" name="ACTION" value="<?= $ACTION ?>">
	<INPUT TYPE="hidden" name="GO" value="SAVE">



	<table border="0" width="95%" id="table1" align="center" cellpadding="4">
		<tr <?= rowcol(1) ?>>
			<td width="20%">Project/Developer</td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="project_name" style='widht:100%' value="<?= $d["project_name"] ?>" alt=length|4 >
			</td>
		</tr>
		<tr <?= rowcol(2) ?>>
			<td width="20%" valign='top'>Logo<br>JPG/GIF only</td>
			<td valign="top" >
				<input type='file' style='width:80%' name='logo'><BR>

				<?
					if ( ($ACTION=='EDIT') or ($ACTION=='DELETE') ):
								echo show_logo($d[logo]);
					endif;
				?>
			</td>
		</tr>
	<tr <?= rowcol(1) ?>>
			<td valign="top" colspan='2'>
			<B>Description</B>
			
			<BR>
				
                
            <?  $CONTENT="project_desc"; $_content= stripslashes(trim($d["project_desc"]));
               $Height="300px";$toolbar=1;
               include("spaw.ini.php"); 
            ?>				
			</td>
		
		</tr>



		<tr <?= rowcol2(1) ?>>
			<td colspan="2" align="center">
			<input type="submit" value="««  Submit  »»" style="width:120px;height:25px;" class="bt">
            </td>
		</tr>
	</table>
</form>

<? 

	if ($ACTION=='DELETE') :
		echo "<div class='err'> " ;
		echo "Are you sure? You wanted to DELETE selected $heading ?" ;
		echo "<br /><br />" ;

		echo "<a href='$PHP_SELF?ACTION=DEL&ID=$ID&per_page=$per_page&PAGE=$npage'>[  Y E S  ]</a>" ;
		
		echo "</div> ";
	endif;

endif; 

?>


 </td>
		 </td>

        </tr>
     </table>
    </center>
</div>
   
<? include("footer.ini.php") ;




?>

