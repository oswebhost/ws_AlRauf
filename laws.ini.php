<IMG SRC="images/law.jpg" WIDTH="200" HEIGHT="25" BORDER="0" ALT="News">
<?
$qry = mysql_query("SELECT * from news  where news='0' order by rid desc LIMIT 5") or die (mysql_error());

echo "<ul style='list-style:none;padding:0;margin:0;'>";
while ($d2 = mysql_fetch_array($qry) ):
	
	echo "<li  style='background:url(images/news-sm.gif) no-repeat;padding:0;padding-left:16px;padding-right:2px;text-align:left;'>";
	echo "<a class='black' href='articles.php?ID=$d2[rid]&PAGE=1'>$d2[title]</a></li>";

endwhile;

echo "</ul>";
?>
<div align="right" id='link'><a href='articles.php'>more...</a></div>
<img src='images/divbottom.jpg' border='0'>