<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");


if (!isset($per_page)): $per_page=60; endif;
if (!isset($ACTION)) : $ACTION="LIST"; endif;


$pageNav=""; $heading = "Site Configuration" ; $tbname = "config" ; 


if ( ($_POST['GO']=="SAVE") ):
	mysql_query ("update config set var_value = '" . addslashes($_POST['COMPANY']) . "' where variable='COMPANY'");
	mysql_query ("update config set var_value = '" . addslashes($_POST['PAGE_TITILE']) . "' where variable='PAGE_TITILE'");
	mysql_query ("update config set var_value = '" . $_POST['SITE_EMAIL'] . "' where variable='SITE_EMAIL'");
	mysql_query ("update config set var_value = '" . $_POST['DOMAIN'] . "' where variable='DOMAIN'");
	mysql_query ("update config set var_value = '" . $_POST['CONATCT_EMAIL'] . "' where variable='CONATCT_EMAIL'");
	mysql_query ("update config set var_value = '" . $_POST['PROPERTY_EMAIL'] . "' where variable='PROPERTY_EMAIL'");
	mysql_query ("update config set var_value = '" . $_POST['ADMIN_EMAIL'] . "' where variable='ADMIN_EMAIL'");
	mysql_query ("update config set var_value = '" . $_POST['URL'] . "' where variable='URL'");
	mysql_query ("update config set var_value = '" . $_POST['NO_ROWS'] . "' where variable='NO_ROWS'");

	mysql_query ("update config set var_value = '" . $_POST['YMID'] . "' where variable='YMID'");
	mysql_query ("update config set var_value = '" . $_POST['SKYPE'] . "' where variable='SKYPE'");
	mysql_query ("update config set var_value = '" . $_POST['MSNID'] . "' where variable='MSNID'");

endif;



?>




<p class="pagehd"><? echo $heading?></p>
<form method="POST" action="<?= $PHP_SELF ?>" >

	<INPUT TYPE="hidden" name="GO" value="SAVE">



	<table border="0" width="58%" id="table1" align="center" cellpadding="5">
		
	<? 
		$q = mysql_query("select * from config order by rid") ;
		
		while ($d = mysql_fetch_array($q)):
	?>		
			<tr <?= rowcol(1) ?>>
				<td width="30%"><?= $d["var_caption"]; ?></td>
				<td valign="top">
					<input type="text" class="find" name="<?= trim($d["variable"]); ?>" style="width:80%" value="<?= trim($d["var_value"]); ?>" >
				</td>
			</tr>
	
	<? endwhile; ?>

		
		<tr <?= rowcol2(1) ?>>
			<td colspan="2" align="center">
			<input type="submit" value=" Save " name="B1" class="sm_combo"></td>
		</tr>
	</table>
</form>


   
<? include("footer.ini.php") ;




?>

