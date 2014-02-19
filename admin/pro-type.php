<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");


if (!isset($per_page)): $per_page=60; endif;
if (!isset($ACTION)) : $ACTION="LIST"; endif;


$pageNav=""; $heading = "Property Types" ; $tbname = "property_type" ; $ORDER="rank, pro_type" ;

if ($_POST['GO']=="SAVE") :
    $d_answer = addslashes(trim($_POST['answer'])) ;
    $menu_cap = addslashes(trim($_POST['menu_cap']));
endif;

if ( ($_POST['ACTION']=='ADD') ):
	$q = mysql_query("insert into $tbname (rid,pro_type,menu_cap,rank) VALUES (0, '$d_answer','$menu_cap','$rank') ") or die ( mysql_error() ) ;
endif;

if ($_REQUEST['ACTION']=='DEL') :
	$q = mysql_query("DELETE from $tbname where rid='$_REQUEST[ID]'") or die ( mysql_error() ) ;
	$ACTION='LIST' ;
endif; 

if ( ($_POST['ACTION']=='EDIT')):
	$q = mysql_query("UPDATE $tbname set pro_type='$d_answer',rank='$rank',menu_cap='$menu_cap' where rid='$_REQUEST[ID]'") or die ( mysql_error() ) ;
endif;

if ( ($_REQUEST['ACTION']=='EDIT') or ($_REQUEST['ACTION']=='DELETE') ):
	$q = mysql_query("select * from $tbname where rid='$_REQUEST[ID]' ") or die ( mysql_error() ) ;
	$d = mysql_fetch_array($q) ;
endif;



$query="SELECT * from $tbname order by $ORDER";


$query="SELECT * from $tbname order by $ORDER";
$result= mysql_query($query) or die( mysql_error() );
$list="";
$number=0;

while ($row = mysql_fetch_array($result) ):
 $number++;

 $del_url = "<a href=$PHP_SELF" . "?ACTION=DELETE&ID=" . $row["rid"] . ">\n"; 
 $edit_url= "<a href=$PHP_SELF" . "?ACTION=EDIT&ID=" . $row["rid"] . ">\n"; 

 $rowcol = rowcol($number);
 $list .="<tr>";
 $list .="<td  $rowcol align=\"center\">$number</td>" ;
 $list .="<td  $rowcol align=\"left\">" . trim($row["menu_cap"]) ."</td>\n"  ;
 $list .="<td  $rowcol align=\"left\">" . trim($row["pro_type"]) ."</td>\n"  ;
 $list .="<td $rowcol align=\"center\">". $edit_url . "Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
 $list .= $del_url ."DEL</a>";
 $list .="</td></tr>\n";
endwhile;



?>
<div align="center">
      <table border="0" cellspacing="2" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="4" id="AutoNumber2" bgcolor="#FFFFFF">
        <tr>
          <td width="50%" valign="top"><p class="pagehd"><? echo $heading?></p>
		 <table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse" bordercolor="#cccccc" width="100%" id="AutoNumber1">
		  <tr>
			<td width="5%" class="tbhead" align="center"><b>No</b></td>
		    <td width="30%" class="tbhead" align="center"><b>Menu Caption</b></td>
			 <td width="30%" class="tbhead" align="center"><b>Property Type</b></td>
		    <td width="20%" class="tbhead" align="center"><b>Options</b></td>
		  </tr>
		  <? echo $list ?>
		
		</table>
<br />
<br />


 <td width="50%" valign="top">
	<P><br />
	<div align="center"><A HREF="<?= "$PHP_SELF?ACTION=ADD" ?>">+ Click here to ADD NEW <?= $heading ?>   </A>
	<P>



<? if ($_REQUEST['ACTION']<>'LIST') : ?>
<form method="POST" action="<?= $PHP_SELF ?>" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);">
	<input type="hidden" name="ID" value="<?= $_REQUEST[ID]  ?>"/>
	<input type="hidden" name="ACTION" value="<?= $_REQUEST['ACTION'] ?>"/>
	<input type="hidden" name="GO" value="SAVE"/>



	<table border="0" width="98%" id="table1" align="center" cellpadding="4">
		<tr <?= rowcol(1) ?>>
			<td width="20%">Property Type</td>
			<td valign="top">
				<input type="text" class="find" name="answer" size="20" value="<?= $d["pro_type"] ?>" alt=length|2 >
			</td>
		</tr>
		<tr <?= rowcol(2) ?>>
			<td width="20%">Menu Caption</td>
			<td valign="top">
				<input type="text" class="find" name="menu_cap" size="20" value="<?= $d["menu_cap"] ?>" alt=length|2 >
			</td>
		</tr>
		<tr <?= rowcol(1) ?>>
			<td width="20%">Display Order</td>
			<td valign="top">
				<input type="text" class="find" name="rank" style='width:60px' value="<?= $d["rank"] ?>"  >
			</td>
		</tr>

		<tr <?= rowcol2(1) ?>>
			<td colspan="2" align="center">
			 <input type="submit" value="««  Submit  »»" style="width:120px;height:25px;" class="bt"/>
            </td>
		</tr>
	</table>
</form>

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


 </td>
		 </td>

        </tr>
     </table>
    </center>
</div>
   
<? include("footer.ini.php") ;




?>

