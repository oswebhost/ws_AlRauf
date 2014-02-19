<?php

include("config.ini.php"); 
$uvisitor=$REMOTE_ADDR;
$country_code = ip2_country_code($uvisitor);

/*
if ($uvisitor <> gethostbyaddr($uvisitor)){
$uvisitor.="|".gethostbyaddr($uvisitor);
}
*/

$utime=time();
$mydate= date("d-M-Y");
$myMon = date("M-Y");
$exptime=$utime-60000; // (in seconds)


$sql = "select count(id) as nco from online where visitor='$uvisitor' and date_value='$mydate'" ;
$qry = $db->prepare($sql);
$qry->execute();
$data = $qry->fetch();

if ($data['nco']>0){
   $sql = "update online set timevisit='$utime',nvisit=nvisit+1 where visitor='$uvisitor' and date_value='$mydate'";
} else {
   $sql= "insert into online (visitor,timevisit,date_value,month_value,country_code,nvisit) values ('$uvisitor','$utime','$mydate','$myMon','$country_code','1')";
}

$data = $db->prepare($sql);
$data->execute();


?>