<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");

if ($action=="DEL"):
	$d = mysql_query("DELETE from order_status where rid='$ID'") or die( mysql_query() ) ;
	echo '<div align=center>';
	echo '<br>';
	echo '<h2>Status recorded deleted.</h2><BR><BR><BR>';
	echo '<A class=link HREF="javascript:close()">close window</A>';
	echo '</div>';
	exit() ;
endif;

if (isset($ID)): $action="EDIT"; else: $action="ADD"; endif;


if ($submitted=="EDIT") :
	$mon   = substr($status_date,5,1);
	$day   = substr($status_date,8,2); //0123-56-89
	$year  = substr($status_date,0,4); //YYYY-MM-DD
	 $yesterday = date('Y-m-d H:i:s', mktime(0,0,0, date('m') , $day , $year   ));
	$r = mysql_query("update order_status set order_status='$order_status', status_date=now() where rid='$ID'") or die( mysql_error() );
endif;

if ($action=='EDIT'):
	$r = mysql_query("select * from order_status where rid='$ID'") or die( mysql_error() ) ;
	$d = mysql_fetch_array($r) ;
	$order = $d["order_no"] ;
	$status = stripslashes(trim($d["order_status"])) ;
	$date = $d["status_date"] ;
endif;

if ($submitted=="ADD") :
	$r = mysql_query("INSERT INTO order_status VALUES (0,'$ORDERNO','$order_status',now())") or die( mysql_error());
	$ID= mysql_insert_id() ;
	$r = mysql_query("select * from order_status where rid='$ID'") or die( mysql_error() ) ;
	$d = mysql_fetch_array($r) ;
	$order = $d["order_no"] ;
	$status = stripslashes(trim($d["order_status"])) ;
	$date = $d["status_date"] ;
endif;


?>
<HTML>
<HEAD>
<TITLE> Order Status  </TITLE>

<link rel="stylesheet" type="text/css" href="style.css">
<script language="javascript" src="cal2.js"></script>
<script language="javascript" src="cal_conf2.js"></script>

<script language="JavaScript">
<!--
function refreshParent() {
  window.opener.location.href = window.opener.location.href;

  if (window.opener.progressWindow)
		
 {
    window.opener.progressWindow.close()
  }
  window.close();
}
//-->
</script>

</HEAD>
<body topmargin=5 leftmargin=0 onunload="window.opener.location.reload()">

<div align="center">

<table class=form border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" bgcolor="#FFFFFF" height=280>
  <tr>
    <td width="100%" valign=top><span class="feat">Add/Edit Order Status -- ORDER NO: <?= $order ?>
</span></td>

  <tr>
    <td width="100%" valign=top>
	
	
	<BR><div align=center>

	<form method=POST action=status.php name='myform'>
	
	<INPUT TYPE="hidden" value="<? echo $ID ?>" name="ID">
	<INPUT TYPE="hidden" value="<? echo $order ?>" name="ORDERNO"">
	<TABLE border=0>
	Status:<input type=text name=order_status size=30  value="<?= $status ?>"><BR>
	</TD>
	</tr>
	<tr><td height=30 align=center></td></tr>
	</TABLE>
	<BR>
	<input type="hidden" name="submitted" value="<?=$action?>">
	<input type="submit" name="submit" class="sm_combo" value="Save" style="width:180;"> 
</form>

<form method=POST action=status.php name='myform'>
	<INPUT TYPE="hidden" value="<? echo $order ?>" name="order">
	<input type="submit" name="submit"  class="sm_combo" value="Add new status"  style="width:180;"> 
</form>
<a href="status.php?action=DEL&ID=<?=$ID?>">Delete this Status</a>
<BR><BR>
<A class=link HREF="javascript:close()">Close window</A>
</div>

  </tr>

</table>




</div>


<?

function dele($SID,$pic_file,$url) 
{
 $x = "<FORM METHOD=POST ACTION=\"$url\"> ";
 $x .= "<INPUT TYPE=hidden name=SID value=$SID>\n ";
 $x .= "<INPUT TYPE=hidden name=DEL value=$pic_file>\n ";
 $x .= "<input type=\"submit\" name=\"submit\" value=\" Delete \" class=\"bt\"> ";
 $x .=	"</FORM>" ;
 return $x;
}

?>