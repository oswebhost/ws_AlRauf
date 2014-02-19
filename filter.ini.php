<?
$qry01 = mysql_query("select code_2 as country from countries order by country_name");
$ch_combo = "<option value='0'></option>";

while ($ch = mysql_fetch_array($qry01)):
	$ch_combo.="<option". selected("$C",$ch["country"]) ." value='". $ch["country"]. "'>".countryname($ch[country]) . "</option>";
endwhile;
?>
<div align="right" style="font-size:10px;padding-right:6px;" >

<FORM METHOD=POST ACTION="<?= $PHP_SELF?>?ACTION=LIST" style="margin:0;padding:0;" >
	Filter By: <SELECT  NAME="bizcategory" style="width:170px;height:18px;font-size:12px;" onChange="this.form.submit();"> 
	<? echo list_category($bizcategory,'biz_category'); ?>	
	</SELECT><BR>
	<font style='font-size:10px;'>Country: </font><select name='C' style='font-size:10;width:170' onChange='this.form.submit();'><? echo $ch_combo; ?>
</FORM>
</div>