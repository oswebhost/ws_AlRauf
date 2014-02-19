<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");


if (!isset($_POST['per_page'])): $per_page=80; endif;
if (!isset($_POST['ACTION'])) : $_POST['ACTION']="LIST"; endif;



$pageNav=""; $heading = "Team" ; $tbname = "agents" ; $ORDER="rank, agent_name" ;


if  ($_POST['GO']=="SAVE") :
	$agent_name = addslashes($_POST['agent_name']);
	$position = addslashes($_POST['position']);
	$address1 = addslashes($_POST['address1']);
	$address2 = addslashes($_POST['address2']);
	$city = addslashes($_POST['city']);
	$country = addslashes($_POST['country']);
	$contact_no = addslashes($_POST['contact_no']);
	$email = addslashes($_POST['email']);
	$rank = addslashes($_POST['rank']);
	$cell_no = addslashes($_POST['cell_no']);
	$fax = addslashes($_POST['fax']);
	
	$ID = $_POST['ID'];

endif;




if ( ($_POST['ACTION']=='ADD')):

	$q = mysql_query("insert into $tbname values (0,'$agent_name','$position', '$address1', '$address2', '$city', '$country', '$contact_no', '$fax','$cell_no', '$email', '', '$rank') ") or die ( mysql_error() ) ;
	$list_id = mysql_insert_id();
	
	$userfile_name = $_FILES['logo']['name'];
	$type = strtolower( substr(strrchr($userfile_name,"."),1) )  ;
	$userfile_size = $_FILES['logo']['size'];
	$userfile_type = $_FILES['logo']['type'];
	$_tmp  = $_FILES['logo']['tmp_name'];
	
	
	if ( ($type == "jpg") or ($type == "gif") ) :
		$new_logo      = "$list_id.$type" ;
		if (file_exists("$agentpath/$new_logo")): unlink("$agentpath/$new_logo"); endif;
		@copy($_tmp, "$agentpath/" . $new_logo) ;
		$qry = mysql_query("update $tbname set pic='$new_logo' where rid='$list_id'") ;
	endif;

endif;


if ( $_REQUEST['ACTION']=='DEL'):
	$q = mysql_query("select * from $tbname where rid='$_REQUEST[ID]' ") or die ( mysql_error() ) ;
	$d = mysql_fetch_array($q) ;
	$logo = $d['pic'];
	$q = mysql_query("DELETE from $tbname where rid='$_REQUEST[ID]'") or die ( mysql_error() ) ;
	if (file_exists("$agentpath/$logo")): unlink("$agentpath/$logo"); endif;
	$_POST['ACTION']='LIST' ;
endif; 

if ( ($_POST['ACTION']=='EDIT')  ):
	
	$q = mysql_query("UPDATE $tbname set agent_name='$agent_name', position='$position', address1='$address1', address2='$address2', city='$city', country='$country', contact_no='$contact_no', fax='$fax', cell_no='$cell_no', email='$email', rank='$rank'  where rid='$_REQUEST[ID]'") or die ( mysql_error() ) ;

	$userfile_name = $_FILES['logo']['name'];
	$type = strtolower( substr(strrchr($userfile_name,"."),1) )  ;
	$userfile_size = $_FILES['logo']['size'];
	$userfile_type = $_FILES['logo']['type'];
	$_tmp  = $_FILES['logo']['tmp_name'];
	

	echo $userfile_name  . "<br/>";
	echo $type  . "<br/>";
	echo $_tmp  . "<br/>";


	if ( ($type == "jpg") or ($type == "gif") ) :
		$new_logo      = "$ID.$type" ;
		if (file_exists("$agentpath/$new_logo")): unlink("$agentpath/$new_logo"); endif;
		copy($_tmp, "$agentpath/" . $new_logo) ;
		$qry = mysql_query("update $tbname set pic='$new_logo' where rid='$_REQUEST[ID]'") ;
	endif;

endif;

if ( ($_REQUEST['ACTION']=='EDIT') or ($_REQUEST['ACTION']=='DELETE') ):
	$q = mysql_query("select * from $tbname where rid='$_REQUEST[ID]'") or die ( mysql_error() ) ;
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
 $list .="<td $rowcol align=\"center\">". $number . "</td>\n\n";
 $list .="<td width='90' $rowcol align=\"left\">" .  show_agent_pic("../agents/" .trim($row["pic"])) . "</td>\n"  ;
 $list .="<td width='80%' $rowcol valign=\"top\"><b>" .  trim($row["agent_name"]) . "</b><br>" . $row["position"]. "</td>\n"  ;
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
		<td width="80%" class="tbhead" colspan='2' align="center"><b>team</b></td>
		<td width="15%" class="tbhead" align="center"><b>Options</b></td>
	  </tr>
	  <? echo $list ?>
	
	</table>
<BR>
<BR>

<? //include("navi.ini.php"); ?>

 <td width="50%" valign="top">
	<P><BR>
	<div align="center"><A HREF="<?= "$PHP_SELF?ACTION=ADD" ?>">+ Click here to ADD NEW <?= $heading ?>   </A>
	<P>



<? if ($_REQUEST['ACTION']<>'LIST') : ?>

<? 

	if ($_REQUEST['ACTION']=='DELETE') :
		echo "<div class='err'> " ;
		echo "Are you sure? You wanted to DELETE selected $heading ?" ;
		echo "<br /><br />" ;

		echo "<a href='$PHP_SELF?ACTION=DEL&ID=$_REQUEST[ID]&per_page=$per_page&PAGE=$npage'>[  Y E S  ]</a>" ;
		
		echo "</div> ";
	endif;

endif; 

?>

<form method="POST" action="<?= $PHP_SELF ?>"enctype="multipart/form-data" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);" style='padding:0;margin:10;'>

	<input type="hidden" name="ID" value="<?= $_REQUEST['ID'] ?>">
    <input type="hidden" name="ACTION" value="<?= $_REQUEST['ACTION']; ?>">
	<input type="hidden" name="GO" value="SAVE">



	<table border="0" width="95%" id="table1" align="center" cellpadding="4">
		<tr <?= rowcol(1) ?>>
			<td width="20%">Name</td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="agent_name" style='width:100%' value="<?= $d["agent_name"] ?>" alt=length|4 >
			</td>
		</tr>
		<tr <?= rowcol(2) ?>>
			<td width="20%" valign='top'>Pic<br>JPG/GIF only</td>
			<td valign="top" >
				<input type='file' style='width:80%' name='logo'><BR>

				<?
					if ( ($_POST['ACTION']=='EDIT') or ($_POST['ACTION']=='DELETE') ):
								echo show_agent_pic("../agents/". $d['pic']);
					endif;
				?>
			</td>
		</tr>

		<tr <?= rowcol(1) ?>>
			<td width="20%">Designation</td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="position" style='width:100%' value="<?= $d["position"] ?>" alt=length|4 >
			</td>
		</tr>

		<tr <?= rowcol(2) ?>>
			<td width="20%">Address </td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="address1" style='width:100%' value="<?= $d["address1"] ?>" alt=length|4 >
				<input type="text" class="find" name="address2" style='width:100%' value="<?= $d["address2"] ?>" >

			</td>
		</tr>
		
		<tr <?= rowcol(1) ?>>
			<td width="20%">City</td>
			<td valign="top" style='width:80%' >
			<input type="text" class="find" name="city" style='width:60%' value="<?= $d["city"] ?>" alt=length|4 >
			</td>
		</tr>

		<tr <?= rowcol(2) ?>>
			<td width="20%">Country</td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="country" style='width:60%' value="<?= $d["country"] ?>" alt=length|4 >
			</td>
		</tr>

		<tr <?= rowcol(1) ?>>
			<td width="20%">Telephone Nos.</td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="contact_no" style='width:60%' value="<?= $d["contact_no"] ?>" alt=length|4 >
			</td>
		</tr>

		<tr <?= rowcol(2) ?>>
			<td width="20%">Fax Nos.</td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="fax" style='width:60%' value="<?= $d["fax"] ?>" alt=length|4 >
			</td>
		</tr>

		<tr <?= rowcol(1) ?>>
			<td width="20%">Cell Nos.</td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="cell_no" style='width:60%' value="<?= $d["cell_no"] ?>" alt=length|4 >
			</td>
		</tr>

		<tr <?= rowcol(2) ?>>
			<td width="20%">Email</td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="email" style='width:100%' value="<?= $d["email"] ?>" alt=email >
			</td>
		</tr>
	
		<tr <?= rowcol(1) ?>>
			<td width="20%">Display Order</td>
			<td valign="top" style='width:80%' >
				<input type="text" class="find" name="rank" style='width:10%' value="<?= $d["rank"] ?>" >
			</td>
		</tr>
	



		<tr <?= rowcol2(1) ?>>
			<td colspan="2" align="center">
			<input type="submit" value="««  Submit  »»" style="width:120px;height:25px;" class="bt"/>
            </td>
		</tr>
	</table>
</form>



 </td>
		 </td>

        </tr>
     </table>
    </center>
</div>
   
<? include("footer.ini.php") ;




?>

