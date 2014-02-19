<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/

define("USERID","root",TRUE);
define("PWD","",TRUE);
define("DATABASE","condophil",TRUE);
define("SERVER","localhost",TRUE);
//user defined variables



/*
define("DATABASE","alrauf_properties",TRUE);
define("USERID","alrauf_JHHPB",TRUE);
define("PWD","6UsT+i#iX{Ek",TRUE);
*/

define("SERVER","localhost",TRUE);

$hostname = SERVER;
$username=USERID;
$password=PWD;
$mysql = DATABASE;

$db  = new PDO("mysql:host=$hostname;dbname=$mysql", $username, $password); 


$link = mysql_connect(SERVER, USERID, PWD)or die( mysql_error() ); 
mysql_select_db(DATABASE) or die(  mysql_error() ); 


$abpath	 = dirname(__FILE__) . "/pro_images"; 
$agentpath= dirname(__FILE__) . "/agents"; 

?>