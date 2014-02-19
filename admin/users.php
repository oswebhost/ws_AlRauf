<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");


if (!isset($per_page)): $per_page=60; endif;
if (!isset($ACTION)) : $ACTION="LIST"; endif;


$pageNav=""; $heading = "User" ; $tbname = "user" ; $ORDER="userid" ;

if ($_POST['GO']=="SAVE") :

endif;

if ( ($_POST['ACTION']=='ADD') ):
	$query="INSERT INTO user (userid, full_name, email, pwd, utype) VALUES ('$_POST[userid01]','$_POST[full_name]','$_POST[email]','$_POST[pwd]','$group')";
	$result= mysql_query($query) or die( mysql_error() );
endif;

if ($_REQUEST['ACTION']=='DEL') :
	$q = mysql_query("DELETE from $tbname where uid='$_REQUEST[ID]'") or die ( mysql_error() ) ;
	$ACTION='LIST' ;
endif; 

if ( ($ACTION=='EDIT') and ($GO=="SAVE") ):
	$query="UPDATE user set userid='$_POST[userid01]',full_name='$full_name',email='$email',pwd='$pwd',utype='$group' WHERE uid='$ID'";
	$result= mysql_query($query) or die(mysql_error() );
endif;

if ( ($ACTION=='EDIT') or ($ACTION=='DELETE') ):
	$q = mysql_query("select * from $tbname where uid='$ID' ") or die ( mysql_error() ) ;
	$d = mysql_fetch_array($q) ;
endif;



$query="SELECT * from $tbname order by $ORDER";

$result= mysql_query($query) or die( mysql_error() );
$number_rows = mysql_num_rows($result);

mysql_free_result($result); 
if (!isset($PAGE)): $PAGE=0; $npage=1; else:
	$npage=$PAGE;
	$PAGE=($PAGE*$per_page) - ($per_page-1)-1;
endif;
$total_pages = intval($number_rows/$per_page);
if ($number_rows % $per_page): $total_pages++;endif;
if ($total_pages>1): 
   $pageNav="Pages: ";
   for ($i=1; $i<=$total_pages; $i++):
     if ($i!=$npage):
  		$pageNav .= "&nbsp;<a href=$PHP_SELF?PAGE=$i&per_page=$per_page>".$i."</a>";
	 else:
		$pageNav .="&nbsp;".$i;
	 endif;
   endfor;
endif;

$query="SELECT * from $tbname order by $ORDER LIMIT $PAGE,$per_page";
$result= mysql_query($query) or die( mysql_error() );
$list="";
$number=0;
while ($row = mysql_fetch_array($result) ):
 $number++;

 $del_url="<a href=$PHP_SELF" ;
 $del_url.="?PAGE=$npage&per_page=$per_page&ACTION=DELETE&ID=";

 $edit_url="<a href=" . $PHP_SELF;
 $edit_url.="?PAGE=$npage&per_page=$per_page&ACTION=EDIT&ID=";
 $edit_url.= $row["uid"]; 

 $del_url.= $row["uid"];


 $edit_url.= ">";
 $del_url.= ">";

 $rowcol = rowcol($number);
 $list .="<tr>";
 $list .="<td  $rowcol align=\"center\">" . $number ;
 $list .="</td><td  $rowcol align=\"left\">";
 $list.= trim($row["userid"]) ." : " . trim($row["full_name"]) . "</td>\n"  ;


 $list .="<td $rowcol align=\"center\">". $edit_url . "Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
 $list .= $del_url ."DEL</a>";
 $list .="</td></tr>\n";
endwhile;



?>
<div align="center">
      <table border="0" cellspacing="3" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="5" id="AutoNumber2" bgcolor="#FFFFFF">
        <tr>
          <td width="50%" valign="top"><span class="pagehd"><? echo $heading?></span>
		
		 <A  HREF="<?= $fileurl ?>"></a>
		 <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse" bordercolor="#cccccc" width="100%" id="AutoNumber1">
		  <tr>
			<td width="5%" class="tbhead" align="center"><b>No</b></td>
		    <td width="80%" class="tbhead" align="center"><b>Users</b></td>
		    <td width="15%" class="tbhead" align="center"><b>Options</b></td>
		  </tr>
		  <? echo $list ?>
		
		</table>
<BR>
<BR>

<? include("navi.ini.php"); ?>

 <td width="50%" valign="top">
	<P><BR>
	<div align="center"><A HREF="<?= "$PHP_SELF?ACTION=ADD" ?>">+ Click here to ADD NEW <?= $heading ?>   </A>
	<P>



<? if ($ACTION<>'LIST') : ?>
<form method="POST" action="<?echo $url?>" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);">
	<INPUT TYPE="hidden" name="per_page" value="<?= $per_page ?>">
	<INPUT TYPE="hidden" name="PAGE" value="<?= $npage ?>">
	<INPUT TYPE="hidden" name="ACTION" value="<?= $ACTION ?>">
	<INPUT TYPE="hidden" name="GO" value="SAVE">
<table border="0" width="90%" id="table1" align="center">
<tr <?= rowcol(1) ?> >
      <td width="30%" height="25">User Id</td>
      <td width="70%" height="25">
      <input type="text" name="userid01" size="40" alt=length|4 class="text" maxlength=8
	   value="<?= $d["userid"] ?>" ></td>
    </tr>
     <tr <?= rowcol(2) ?>>
      <td width="30%" height="25">Full Name</td>
      <td width="70%" height="25">
      <input type="text" name="full_name" alt=length|4 size="40" class="text"
	   value="<?= $d["full_name"] ?>"></td>
    </tr>
	<tr <?= rowcol(1) ?>>
	 <td width="14%" height="19" valign="top">Email</td>
      <td width="89%" height="19">
      <input type="text" name="email" alt=email size="40" class="text"
	   value="<?= $d["email"] ?>"></td>

	  </td>

	<tr <?= rowcol(2) ?>>
	 <td width="14%" height="19" valign="top">Password</td>
      <td width="89%" height="19">
      <input type="password" name="pwd" alt=length|4 maxlength=8 size="40" class="text"
	   value="<?= $d["pwd"] ?>"> </td>
	  </td>
 <!-- 	<tr <?= rowcol(1) ?>>
	 <td width="14%" height="19" valign="top">Group<BR>
	
	 </td>
      <td width="89%" height="19">
      <input type="radio" value="0" name="group" class="chk" <?= ($d["utype"]=='0') ? "checked" : ""?> > <b>
        Site Admin</b> 
        <input type="radio" value="1" name="group" class="chk" <?= ($d["utype"]=='1') ? "checked" : ""?> ><b>Other User</b><BR><BR>

		 <B>Site Admin</B> = Full Access to all Site Manager Menu<BR><BR>
	 <B>Other User</B> = Only Access to Order Listing Menu
	
	   </td>
	  </tr> -->

    <tr <?= rowcol2(1) ?>>
      <td width="100%" height="35" colspan="2"  valign="Middle">
	  	<div align="center">
      <input type="submit" value="  »  Save  «  " name="B1" class="bt"/></div>
	  </td>
    </tr>
  </table>
</form>
<? 

	if ($ACTION=='DELETE') :
		echo "<div align='cneter'> " ;
		echo "<span class=err>Are you sure? You wanted to DELETE selected $heading ?</span>" ;
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

