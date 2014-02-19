<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");


if (!isset($ACTION)) : $ACTION="LIST"; endif;


$heading = "Vendor" ; $tbname = "vender" ; $ORDER="vender_id" ;

if ($ACTION=='CAT' and $GO='SAVE'):
	
	$foo = $_POST['cat'];
	if (count($foo)>0):
		mysql_query("delete from vender_cat where vender_id='$vender_id'") or die (mysql_error());
	endif;

	for ($i=0;$i<count($foo);$i++):
		$cat_value = $foo[$i] ;
		mysql_query("insert into vender_cat (vender_id,cat_id) values ('$vender_id', '$cat_value')") or die (mysql_error()) ;	
	endfor;

endif;

if ( ($ACTION=='ADD') and ($GO=="SAVE") ):
	$query="INSERT INTO $tbname (rid,vender_name,vender_type,biz_line,address1,address2,city, zipcode,tel,fax,email,url,contact_person,vender_id,vender_pass,date_reg) VALUES (0,'". addslashes($_POST['vender_name']) . "','" . addslashes($_POST['vender_type']). "','" . addslashes($_POST['biz_line']). "','" . addslashes($_POST['address1']). "','" . addslashes($_POST['address2']). "','" . addslashes($_POST['city']). "','" . addslashes($_POST['zipcode']). "','". addslashes($_POST['tel']). "','" . addslashes($_POST['fax']). "','". addslashes($_POST['email']). "','". addslashes($_POST['url']). "','". addslashes($_POST['contact_person']). "','". addslashes($_POST['vender_id']). "','". addslashes($_POST['vender_pass']). "',NOW() )";
	
	$result= mysql_query($query) or die( mysql_error() );
endif;

if ( $ACTION=='DEL') :
	$q = mysql_query("DELETE from $tbname where rid='$ID'") or die ( mysql_error() ) ;
	$q = mysql_query("delete from vender_cat where vender_id='$ID'") or die ( mysql_error() );
	$ACTION='LIST' ;
endif; 

if ( ($ACTION=='EDIT') and ($GO=="SAVE") ):

	$query="update $tbname set vender_name='". addslashes($_POST['vender_name']) . "', vender_type='" . addslashes($_POST['vender_type']). "', biz_line='" . addslashes($_POST['biz_line']). "',address1='" . addslashes($_POST['address1']). "',address2='" . addslashes($_POST['address2']). "',city='" . addslashes($_POST['city']). "',zipcode='" . addslashes($_POST['zipcode']). "',tel='". addslashes($_POST['tel']). "',fax='" . addslashes($_POST['fax']). "',email='". addslashes($_POST['email']). "',url='". addslashes($_POST['url']). "',contact_person='". addslashes($_POST['contact_person']). "',vender_id='". addslashes($_POST['vender_id']). "',vender_pass='". addslashes($_POST['vender_pass']). "' where rid='$ID'";
	$result= mysql_query($query) or die(mysql_error() );
endif;

$q = mysql_query("select * from $tbname where rid='$ID' ") or die ( mysql_error() ) ;
$d = mysql_fetch_array($q) ;






?>
<span class="pagehd"><? echo $heading?></span>
<div align="center"><A HREF="<?= "$PHP_SELF?ACTION=ADD#b" ?>">+ Click here to ADD NEW <?= $heading ?></A>

<div align="center">

<br><br>
 <table border="1" cellspacing="0" cellpadding="2" style="border-collapse: collapse" bordercolor="#0057C1" width="100%" id="AutoNumber1">
  <tr>
	<td width="2%" class="tbhead" align="center"><b>No</b></td>
	<td width="15%" class="tbhead" align="center"><b>Vendor ID</b></td>
	<td width="20%" class="tbhead" align="center"><b>Vendor Name</b></td>
	<td width="20%" class="tbhead" align="center"><b>Vendor Address</b></td>
	<td width="5%" class="tbhead" align="center"><b>Tel.</b></td>
	<td width="5%" class="tbhead" align="center"><b>Fax.</b></td>
	<td width="15%" class="tbhead" align="center"><b>Allowed Categories</b></td>
	<td width="10%" class="tbhead" align="center"><b>Options</b></td>
  </tr>

<?
$query="SELECT * from $tbname order by $ORDER";
$result= mysql_query($query) or die( mysql_error() );
$list="";
$number=0;

while ($row = mysql_fetch_array($result) ):
 $number++;
 $del_url="<a href=$PHP_SELF?ACTION=DELETE&ID=" . $row["rid"] ."#b>" ;  
 $edit_url="<a href=$PHP_SELF?ACTION=EDIT&ID=". $row["rid"] ."#b>" ;  
 $cat_url="<a href=$PHP_SELF?ACTION=CAT&ID=". $row["rid"] ."#b>" ;  

 $rowcol = rowcol($number);
 echo "<tr>";
 echo "<td $rowcol align=\"center\">" . $number  . "</td>" ;
 echo "<td $rowcol align=\"left\">" . trim($row["vender_id"]) ." : " . trim($row["vender_pass"])."</td>\n"  ;
 echo "<td $rowcol align=\"left\">" . trim($row["vender_name"]) ."<br>" . $row['email'] . "</td>\n"  ;
 echo "<td $rowcol align=\"left\">" . trim($row["address1"] ."<br>". $row["address2"]) . ", " . $row["city"] ." " . $row['zipcode'] ."</td>\n"  ;
 echo "<td $rowcol align=\"center\">" . trim($row["tel"]) ."</td>\n"  ;
 echo "<td $rowcol align=\"center\">" . trim($row["fax"]) ."</td>\n"  ;
 echo "<td $rowcol align=\"center\">" ;
 $id = $row['vender_id'] ;

 $catQ = mysql_query("select * from vender_cat where vender_id='$id'") or die (mysql_error());
 while ($dQ = mysql_fetch_array($catQ) ):
	echo prodname($dQ["cat_id"]) . "<br />";
 endwhile;
 echo "</td>\n"  ;
 echo "<td $rowcol align=\"center\">". $edit_url . "Edit</a>&nbsp;|&nbsp;".$del_url."DEL</a>&nbsp;|&nbsp;" ;
 echo $cat_url. "Cats</a>";
 echo "</td>";
 echo "</tr>\n";
endwhile;


?>

</table>

<BR>

<BR>




<a name='b'></a>

<? if ($ACTION=='CAT') : ?>

<form method="POST" action="<? echo $PHP_SELF; ?>" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);">
	<INPUT TYPE="hidden" name="ACTION" value="CAT">
	<INPUT TYPE="hidden" name="ID" value="<?= $ID ?>">
	<INPUT TYPE="hidden" name="vender_id" value="<?= $d["vender_id"]; ?>">
	<INPUT TYPE="hidden" name="GO" value="SAVE">

<table border="0" width="50%" id="table1" align="center" cellpadding="0">
	<tr> <td colspan='2' height='2' bgcolor='#000ff'></td></tr>
	<tr> <td colspan='2' height='25' bgcolor='#f4f4f4'><b>Categories Vender can post items</b></td></tr>

	<?
		$x=0;
		$qq = mysql_query("select rid,product_name from products where category='99999999' order by product_name") or die ( mysql_error() );
		echo "<tr>";	
		while ($dd = mysql_fetch_array($qq) ):
			$x++;
			echo "<td width='50%'><input class='chk' type='checkbox' name=cat[] value='". $dd['rid'] . "'" ;
			echo vender_cat($d["vender_id"], $dd["rid"]) . " >" . $dd["product_name"] . "</td>";
			if ($x>1): $x = 0; echo "</tr><tr>"; endif;
		endwhile;
		
	?>
	<tr> <td colspan='2' height='25' bgcolor='#f4f4f4'><b>No Access</b><input class='chk' type='checkbox' name=cat[] value='0'></td></tr>

	<tr> <td colspan='2' height='25' bgcolor='#f4f4f4' align='center'>
		<input type="submit" value="  »  Save  «  " name="B1" class="sm_combo">
	</td></tr>
</table>


<? endif; ?>


<? if ($ACTION=='ADD' or $ACTION=='EDIT' or $ACTION=='DELETE') : ?>

<form method="POST" action="<? echo $PHP_SELF; ?>" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);">
	<INPUT TYPE="hidden" name="ACTION" value="<?= $ACTION ?>">
	<INPUT TYPE="hidden" name="ID" value="<?= $ID ?>">
	<INPUT TYPE="hidden" name="GO" value="SAVE">

<table border="0" width="70%" id="table1" align="center" cellpadding="4">

     <tr <?= rowcol(2) ?>>
      <td height="25">Vendor Name</td>
      <td  height="25">
      <input type="text" name="vender_name" alt=length|4 style='width:80%' class="text"
	   value="<?= $d["vender_name"] ?>"></td>
    </tr>

	<tr <?= rowcol(1) ?>>
		 <td width="14%" >Vendor Type</td>
		 <td width="89%" >
	      <input type="text" name="vender_type" style='width:80%' class="text"
		   value="<?= $d["vender_type"] ?>"></td>
    </tr>

	<tr <?= rowcol(2) ?>>
		 <td width="14%" >Line of Business</td>
		 <td width="89%" >
	      <input type="text" name="biz_line" style='width:80%' class="text"
		   value="<?= $d["biz_line"] ?>"></td>
    </tr>
	
	<tr <?= rowcol(1) ?>>
		 <td width="14%" >Address</td>
		 <td width="89%" >
	     <input type="text" name="address1" style='width:80%' class="text" value="<?= $d["address1"]?>"><br>
		 <input type="text" name="address2" style='width:80%' class="text" value="<?= $d["address2"]?>"><br>
    	 </td>
    </tr>

	<tr <?= rowcol(2) ?>>
		 <td width="14%" >City</td>
		 <td width="89%" >
	     <input type="text" name="city" style='width:30%' class="text" value="<?= $d["city"]?>"></td>
    </tr>
	<tr <?= rowcol(1) ?>>
		 <td width="14%" >Postal Code</td>
		 <td width="89%" >
	     <input type="text" name="zipcode" style='width:30%' class="text" value="<?= $d["zipcode"]?>"></td>
    </tr>

	<tr <?= rowcol(2) ?>>
		 <td width="14%" >Telephone</td>
		 <td width="89%" >
	     <input type="text" name="tel" style='width:30%' class="text" value="<?= $d["tel"]?>"></td>
    </tr>
	<tr <?= rowcol(1) ?>>
		 <td width="14%" >Fax</td>
		 <td width="89%" >
	     <input type="text" name="fax" style='width:30%' class="text" value="<?= $d["fax"]?>"></td>
    </tr>

	<tr <?= rowcol(2) ?>>
		 <td width="14%" >Contact Person</td>
		 <td width="89%" >
	     <input type="text" name="contact_person" style='width:30%' class="text" value="<?= $d["contact_person"]?>"></td>
    </tr>
	<tr <?= rowcol(1) ?>>
		 <td width="14%" >Email</td>
		 <td width="89%" >
	     <input type="text" name="email" style='width:80%' class="text" value="<?= $d["email"]?>"></td>
    </tr>
	<tr <?= rowcol(2) ?>>
		 <td width="14%" >URL</td>
		 <td width="89%" >
	     <input type="text" name="url" style='width:80%' class="text" value="<?= $d["url"]?>"></td>
    </tr>

	<tr <?= rowcol(1) ?> >
      <td width="20%" height="25">Vendor Id</td>
      <td width="80%" height="25">
      <input type="text" name="vender_id" style='width:30%' alt=length|4 class="text" maxlength=8
	   value="<?= $d["vender_id"] ?>" ></td>
    </tr>

	<tr <?= rowcol(2) ?>>
	 <td width="14%"  valign="top">Password</td>
      <td width="89%" >
      <input type="text" name="vender_pass" alt=length|4 maxlength="15" style='width:30%' class="text"
	   value="<?= $d["vender_pass"] ?>"> </td>
	  </td>

	<tr <?= rowcol2(1) ?>>
      <td width="100%" height="35" colspan="2"  valign="Middle">
	  	<div align="center">
      <input type="submit" value="  »  Save  «  " name="B1" class="sm_combo"></div>
	  </td>
    </tr>
  </table>
</form>

<? 

	if ($ACTION=='DELETE') :
		echo "<div align='cneter'> " ;
		echo "<span class=err><font size='+1'>Are you sure? You wanted to DELETE selected $heading ?</font></span>" ;
		echo "<br /><br />" ;

		echo "<a href='$PHP_SELF?ACTION=DEL&ID=$ID'>[  Y E S  ]</a>" ;
		
		echo "</div> <P>&nbsp;<P>";
	endif;

endif; 


?>


</div>
   
<? include("footer.ini.php") ;




?>

