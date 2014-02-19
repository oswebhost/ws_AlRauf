<?php

/**
 * @author IM Khan
 * @copyright 2013
 */
 
include("../config.ini.php");
include("../common.php");



$CONTACT_EMAIL = set_val("CONATCT_EMAIL") ;


$file = "property_inquiry.html";
$handle = fopen($file, "r");
$info = fread($handle, filesize($file));

$info = ereg_replace("%logo%",      $URL_PATH . '/images/logo.png',$info);
$info = ereg_replace("%today%",     date("r"),      $info);
$info = ereg_replace("%name%",      $_POST['name'], $info);
$info = ereg_replace("%phone%",     $_POST['phone'],$info);
$info = ereg_replace("%email%",     $_POST['email'],$info);
$info = ereg_replace("%time%",      $_POST['time'],$info);
$info = ereg_replace("%about%",  "<a href='" .$_POST['url']. "'>" . $_POST['about'] . "</a>",$info);

 
$info = ereg_replace("%msg%", stripslashes(strip_tags($_POST['msg'])), $info);






$x = send_email($CONTACT_EMAIL,$_POST['email'],$info,$_POST['about']) ;

if ($x==1){
    
    echo "<b>Thank You</b><br /><br /> 
           Our staff will be contacting you within next 24hrs.<br /><br />
           Al-Rauf Associates.";

}else{

    echo "<b>Sorry</b><br /><br /> 
           Sending message has been failed. Please try again.<br /><br />
           Al-Rauf Associates.";
}

?>