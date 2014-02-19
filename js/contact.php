<?php

/**
 * @author IM Khan
 * @copyright 2013
 */
 
include("../config.ini.php");
include("../common.php");

$CONTACT_EMAIL = set_val("CONATCT_EMAIL") ;

$info = contact_txt() ;
$info = ereg_replace("%today%",     date("r"),      $info);
$info = ereg_replace("%full_name%", $_POST['name'], $info);
$info = ereg_replace("%phone%",     $_POST['phone'],$info);
$info = ereg_replace("%email%",     $_POST['email'],$info);
 
$info = ereg_replace("%comments%", stripslashes(strip_tags($_POST['msg'])), $info);


$x = send_email($CONTACT_EMAIL,$_POST['email'],$info,"Inquiry") ;

if ($x==1){
    
    echo "<b>Thank You</b><br /><br /> 
           Our staff will be contacting you within next 24hrs.<br /><br />
           Al-Rauf Associates.";
}else{
    echo "<b>Sorry</b><br /><br /> 
           Sending message has been failed. Please try again.<br /><br />
           Al-Rauf Associates.";
}


function contact_txt()
{
return "Date :   %today%
    From : %full_name%  
    Phone: %phone%
    Email: %email%
    Message:%comments% " ; 
}

?>