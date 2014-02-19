<IMG SRC="images/news.jpg" WIDTH="200" HEIGHT="25" BORDER="0" ALT="News"> <br />
<?
$qry = mysql_query("SELECT * from news  where news='1' order by rank, rid desc LIMIT 5") or die (mysql_error());

echo "<ul style='list-style:none;padding:0;margin:0;'>";
while ($d2 = mysql_fetch_array($qry) ):
	
	echo "<li style='background:url(images/news-sm.gif) no-repeat;padding:0;padding-left:18px;padding-right:5px;text-align:left;padding-bottom:5px;'>";
	echo "<a class='black' href='news.php?ID=$d2[rid]&PAGE=1'>$d2[title]</a></li>";

endwhile;

echo "</ul>";
?>
<div align="right" id='link'><a href='news.php'>more...</a></div>
<img src='images/divbottom.jpg' border='0'>