<? 
include("../common.php");
include("header.ini.php"); 

?>

<table width='100%' cellpadding='8' border='0'>
<tr>

<td width='33%' valign='top'>
<?
$utime=time();
$mydate= date("d-M-Y");
$myMon = date("M-Y");
$exptime=$utime-60000; // (in seconds)

$rs=@mysql_query("select * from online where date_value='$mydate' order by timevisit desc") or die (mysql_error());

$dw=mysql_query("select count(date_value) as cNo,sum(nvisit) as nvisit, date_value from online where month_value='$myMon' group by date_value order by date_value desc");

$Mw=mysql_query("select count(month_value) as cNo, month_value from online group by month_value order by month_value desc");

$ByCode=mysql_query("select count(country_code) as cNo, sum(nvisit) as nvisit, country_code from online group by country_code order by cNo desc");

echo '<table border="1" cellspacing="0" style="border-collapse: collapse" cellpadding="3" bordercolor="#cccccc" width="100%" >';

	$nTotal = 0; $n=1 ; $h=0;
	echo "<tr><td colspan='4' class='tbhead'><B>Daily Visitor's Count</B></td></tr>";
	echo "<tr bgcolor='#f4f4f4'><td></td><td><b>Date</b></td><td align='center'><b>Hits</b></td><td  align='center'><b>Unique</b></td></tr>\n\n";
	while ($dwr = mysql_fetch_array($dw)):
		$url = "<a class='link' href='stats.php?dateid=$dwr[date_value]'>";
		echo "<tr>" ;
		echo "<td width='5%' align='center'>" . $n++ . "</td>" ;
		echo "<td width='25%'>$url" . $dwr["date_value"] . "</a></td>" ;
		echo "<td align='center' width='30%'>" . num0($dwr["nvisit"]) . "</td>" ;
		echo "<td align='center' width='30%'>" . num0($dwr["cNo"]) . "</td>" ;
		echo "</tr>";
		$nTotal += $dwr['cNo'] ;
		$h+= $dwr['nvisit'] ;
	endwhile;
	echo "<tr bgcolor='#f4f4f4'><td colspan='2'><B>Total Count</B></td>";
	echo "<td align='center' ><b>" . num0($h) . "</b></td>";
	echo "<td align='center' ><b>" . num0($nTotal) . "</b></td>";
	echo "</tr>" ;
	
	echo "</table>";

echo "<br>";

if (isset($_GET['dateid'])):
	
	echo '<table border="1" cellspacing="0" style="border-collapse: collapse" cellpadding="3" bordercolor="#cccccc" width="100%" >';
	
	$query = mysql_query("select * from online where date_value='$_GET[dateid]' order by id");
	$nTotal = 0; $n=1;$h=0; ;
	echo "<tr><td colspan='4' bgcolor='#f4f4f4'><B><FONT COLOR='red'>$_GET[dateid]</FONT> Unique Visitor's List</B></td></tr>";
	echo "<tr bgcolor='#f4f4f4'><td></td><td ><b>IP</b></td><td align='center'><b>Hits</b></td><td ><b>Country</b></td></tr>\n\n";

	while ($daily = mysql_fetch_array($query)):
		list($IP,$ipname) = explode("|",$daily['visitor']);
		$url = "<a href='http://www.whois.sc/$IP' class='link' target='_blank'>$IP</a>";
		echo "<tr>" ;
		echo "<td width='10%' align='center'>" . $n++ . "</td>" ;
		echo "<td width='30%'>" . $url . "</td>" ;
		echo "<td width='20%' align='center'>" . $daily[nvisit] . "</td>" ;
		echo "<td align='left' width='50%'>". code2_country_name($daily['country_code']) ."</td>" ;
		echo "</tr>";
		$nTotal++ ;
		$h+= $daily[nvisit];
		$n++;
	endwhile;
	echo "<tr  bgcolor='#f4f4f4'><td colspan='2'><B>Total Count</B></td>";
	echo "<td align='center'><B>$h</B></td>";
	echo "<td align='center'><b>" . num0($nTotal) . "</b></td> </tr>" ;
	
	echo "</table>";

endif;




?>


</td>

<td width='33%' valign='top'>

<table border="1" cellspacing="0" style="border-collapse: collapse" cellpadding="4" bordercolor="#cccccc" width="100%" >
<tr height="25" class="tbhead"><td colspan='2'><strong>Listing Count</strong> </td> </tr>

<? 
	$Today=time();


	$q=mysql_query("select count(*) as cno,property_type from ads group by property_type order by property_type") 
			or die (mysql_error());
	$x=0;
	while ($d=mysql_fetch_array($q) ):
		echo "<tr >";
		echo "<td width='70%'>" . $d[property_type] ."</td>";
		echo "<td width='30%' align='right'>" . num0($d['cno']) ."</td>";
		$x += $d['cno'] ;
	endwhile;
	echo "<tr bgcolor='#f4f4f4'>";
	echo "<td width='70%'><b>Total Ads</b></td>";
	echo "<td width='30%' align='right'><b>" . num0($x) ."</b></td>";
	echo "</tr>\n\n";

?>
</table>

&nbsp;
<table border="1" cellspacing="0" style="border-collapse: collapse" cellpadding="4" bordercolor="#cccccc" width="100%" >
<tr class='tbhead'></tr><td colspan='2'  class="tbhead"><strong>Property View Count</strong> </td> </tr>

<? 
	$q=mysql_query("select sum(viewed) as cno, property_title,posted_date from ads group by rid order by cno desc, property_title") 
			or die (mysql_error());
	$x=0;
	while ($d=mysql_fetch_array($q) ):
		echo "<tr bgcolor='#ffffff'>";
		echo "<td width='80%'>" . $d[property_title] . "  <font size='1'>posted:" . date('d-m-y', $d['posted_date']) ."</font></td>";
		echo "<td width='10%' align='right'>" . num0($d['cno']) ."</td>";
		$x += $d['cno'] ;
	endwhile;

?>
</table>

</td>

<td width='33%' valign='top'> 
<?

echo '<table border="1" cellspacing="0" style="border-collapse: collapse" cellpadding="4" bordercolor="#cccccc" width="100%" >';

	$nTotal = 0; $n=1 ; $h=0;
	echo "<tr  class='tbhead'><td colspan='4' ><B>Visitor By Country</B></td></tr>";
	echo "<tr bgcolor='#f4f4f4'><td></td><td><b>Country</b></td><td align='center'><b>Hits</b></td><td  align='center'><b>Unique</b></td></tr>\n\n";

	while ($Byc = mysql_fetch_array($ByCode)):
		echo "<tr>" ;
		echo "<td width='5%' align='center'>" . $n++ . "</td>" ;
		echo "<td width='45%'>" .code2_country_name($Byc["country_code"]) . "</td>" ;
		echo "<td align='center' width='20%'>" . num0($Byc["nvisit"]) ;
		echo "<td align='right' width='20%'>" . num0($Byc["cNo"]) ;
		echo "</td>" ;
		echo "</tr>";
		$nTotal += $Byc['cNo'] ;
		$h+= $Byc[nvisit];
	endwhile;
	echo "<tr  bgcolor='#f4f4f4'><td colspan='2' ><B>Total Count</B></td>";
	echo "<td align='center'><b>" . num0($h) . "</b></td>";
	echo "<td align='right'><b>" . num0($nTotal) . "</b></td>";
	echo "</tr>" ;
	
	echo "</table>";	

echo "<br/>";

echo '<table border="1" cellspacing="0" style="border-collapse: collapse" cellpadding="4" bordercolor="#cccccc" width="100%" >';

	$nTotal = 0; $n=1 ;
	echo "<tr  class='tbhead'><td colspan='3' ><B>Monthly Count</B></td></tr>";
	while ($dwr = mysql_fetch_array($Mw)):
		echo "<tr>" ;
		echo "<td width='10%' align='center'>" . $n++ . "</td>" ;
		echo "<td width='30%'>" . $dwr["month_value"] . "</td>" ;
		echo "<td align='right' width='60%'>" . num0($dwr["cNo"]) ;
		echo "/ avg daily " . num2($dwr["cNo"]/30) ;
		echo "</td>" ;
		echo "</tr>";
		$nTotal += $dwr['cNo'] ;
	endwhile;
	echo "<tr  bgcolor='#f4f4f4'><td colspan='2' ><B>Total Count</B></td>";
	echo "<td align='right'><b>" . num0($nTotal) . "</b>";
	echo "/ avg monthly " . num2($nTotal/$n) ;
	echo "</td> </tr>" ;
	
	echo "</table>";	

?>

</td>

</table>


</center>


<!-- end of User Status --->       
<? include("footer.ini.php") ;?>      