<?
include("config.ini.php");

$q = "select * from adss";
mysql_query($q) or die (mysql_error());

echo mysql_num_rows($q) ;

echo " records selected Done....";

?>