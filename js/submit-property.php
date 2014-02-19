<?php

/**
 * @author IM Khan
 * @copyright 2013
 */
 
include("../config.ini.php");
include("../common.php");



$CONTACT_EMAIL = set_val("CONATCT_EMAIL") ;


$file = "submit-property-output.ini.php";
$handle = fopen($file, "r");
$info = fread($handle, filesize($file));

for ($i=0; $i<count($_POST['pro_feature']); $i++){
	$pro_fea .= $_POST['pro_feature'][$i] . ", " ;
}

for ($i=0; $i<count($_POST['com_feature']); $i++){
	$com_fea .= $_POST['com_feature'][$i] . ", " ;
}
                
while (list($key, $value) = each ($_POST)) 
{	
	$info = ereg_replace("%%$key%%", stripslashes($value) , $info);		
}		

$info = ereg_replace("%%pro_fea%%", $pro_fea , $info);		
$info = ereg_replace("%%com_fea%%", $com_fea , $info);		
$info = ereg_replace("%%D_A_T_E%%", date("d-M-Y H:m A") , $info);		

$from_email = $_POST['pname'] . " <". $_POST['pemail'] .">";
$subject = addslashes($_POST['property_title']); 





$x = send_email($CONTACT_EMAIL,$from_email,$info,$from_email) ;

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