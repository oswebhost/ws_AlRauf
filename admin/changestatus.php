<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");

$heading = "Change Payment Status";

if ($_POST['action']=='SAVE'):
	$q = mysql_query("update orders set pay_status='$_POST[pay_status]' where rid='$_POST[ID]'");
endif;

$q = mysql_query("select rid,orderno,pay_status,paidby from orders where rid='$ID'") or die (mysql_error());
$data = mysql_fetch_array($q);

?>
<p class="pagehd"><? echo $heading?></p>

<center>
<div style='padding:10px;font-size:12px;color:blue;'>
	<? echo $log ;?>
</div>
<form method='post' action='<?echo$PHP_SELF?>' onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);" style='padding:0;margin:10;'> 
 <input type='hidden' name='action' value='SAVE'>
 <input type='hidden' name='ID' value='<? echo $ID;?>'>

 <table border="0" cellspacing="0" style="border-c	ollapse: collapse" bordercolor="#111111" width="50%" cellpadding="3" id="AutoNumber2" bgcolor="#f4f4f4">
  <tr>
	<td height="3" class="tbhead"><font size='+1' color='black'>Change Payment Status</font></td>
  </tr>
 <tr>	
  <td style='font-size:14px;'> 	
		Order No:<BR>
		<input type='text' name='orderno' readonly value='<? echo $data[orderno];?>'>
		
  </td>
</tr>
 <tr>	
  <td style='font-size:14px;'> 	
		Paid By:<BR>
		<input type='text'  readonly value='<? echo $data[paidby];?>'>
		
  </td>
</tr>
 <tr>	
  <td style='font-size:14px;'> 	
		Current Payment Status:<BR>
		<input type='text'  readonly value='<? echo $data[pay_status];?>'>
		
  </td>
</tr>


 <tr>
  <td  style='font-size:14px;'>Change to </br>
		<select name="pay_status" style='width=100%;font-size:16px;' alt='selecti|0' emsg='Select a Ad type'>
			<option value='0'>::::::::::::::Select one::::::::::::::::::</option>
			<option value='Hold'>Hold - so client can NOT post ad</option>
			<option value='VERIFIED'>VERIFIED - so client can post ad</option>
		</select>
  </td>
</tr>


 <tr>
  <td height='30' bgcolor='#cccccc'  style='font-size:14px;' align='center'>
		 <input type="submit" value="  »  Save  «  " name="B1" class="sm_combo">
  </td>
 </tr>

 </table>

</form>

</center>



<? include("footer.ini.php"); ?>