
	
<table width='1' cellpadding='0' cellspacing='0' border='0' bgcolor="#F8FCF3">
<tr>
	<td><img src="images/pro-category.jpg" border="0" alt=""></td>
</tr>
<tr>
	<td style='background:url(images/middle-white.gif) repeat-y;'></td>
</tr>
		<?
		$qry=mysql_query("select * from property_type order by rank,pro_type");
		echo "<tr ><td id='mm'><a class='rightMenu'";
		echo "href='property-list.php'>All Properties</a></td></tr>";
		while ($dd = mysql_fetch_array($qry)):
			echo "<tr ><td id='mm'><a class='rightMenu'";
			echo "href='cat" . $dd['rid'] . "-". add_hypen($dd['menu_cap']). ".html'>";
			//echo "href='property-list.php?CAT=" . $dd['rid'] . "'>";
			echo $dd[menu_cap] ;
			echo "</a></td></tr>";
		endwhile;					
		?>



</table>

<?
function add_hypen($string)
{
	$string = ereg_replace(" ","-", $string);

	return $string;

}



?>
