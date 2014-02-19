<? 
//import_request_variables("gP", "");

extract($_REQUEST);
    



include("config.ini.php") ;
define("EVENROW","#ffffff",TRUE);
define("ODDROW","#f4f4f4",TRUE);

define("even2","#f4f4f4",TRUE);
define("odd2","#e4e4e4",TRUE);

$COMPANY = set_val("COMPANY") ;
$DOMAIN = set_val("DOMAIN") ; 
$DOMAIN_URL = "<a href='http://www.$DOMAIN'>$DOMAIN</a>" ;
$URL_PATH= set_val("URL") ; 

$ADMIN_EMAIL = set_val("ADMIN_EMAIL") ; 
$PROPERTY_EMAIL = set_val("PROPERTY_EMAIL") ; 
$CONTACT_EMAIL = set_val("CONATCT_EMAIL") ;
$NO_ROWS = set_val("NO_ROWS") ;
$PAGE_TITILE = set_val("PAGE_TITILE");

$USEXRATE = set_val("USEXRATE");

function ifimage($ID)
{   global $db; 
	$temp2 = $db->prepare("select image_name from ads_images where propertyid='$ID' order by rand() limit 1");
    $temp2->execute();
    $d = $temp2->fetch();
    if (strlen($d['image_name'])>3){
        return 'pro_images/'. trim($d['image_name']);
    }else{
        return 'pro_images/noimage.gif';
    }
}

function property_type_box($property_type)
{   global $db;
	$content='' ;
	$temp2 = $db->prepare("Select pro_type,menu_cap from property_type order by rank,pro_type");
    $temp2->execute();
	$content = "<SELECT id='property_type' NAME='property_type'>\n" ;
	$content .="<option  value='0'>- - - -Select One- - - -</option>\n";
	while ($d = $temp2->fetch() ){
		$content .= "<option value='" . $d["pro_type"] ."' " ;
			if ($d["pro_type"]==$property_type) : $content .= "selected "; endif;
		$content .=">" . $d["menu_cap"] . "</option>\n" ;
	}
	return $content; 
}


function property_type_box_search()
{   global $db;
	$content='' ;
	$temp2 = $db->prepare("Select pro_type,menu_cap from property_type order by rank,pro_type");
    $temp2->execute();

	$content .= "<SELECT id='property_type' NAME='property_type'" ;
	$content .=">\n" ;

	$content .="<option  value='0'>Any</option>\n";
	while ($d = $temp2->fetch() ){
		$content .= "<option value='" . $d["pro_type"] ."' " ;
			if ($d["pro_type"]==$property_type) : $content .= "selected "; endif;
		$content .=">" . $d["menu_cap"] . "</option>\n" ;
	}
	return $content; 
}


function pro_feature_name($ID)
{   global $db;  
	$temp2 = $db->prepare("select pro_feature from property_features where rid='$ID'");
	$temp2->execute();
    $d = $temp2->fetch();
	return stripslashes($d['pro_feature']) .", ";
}

function com_feature_name($ID)
{   global $db;  
	$temp2 = $db->prepare("select com_feature from community_features where rid='$ID'");
	$temp2->execute();
    $d = $temp2->fetch();
	return stripslashes($d['com_feature']) .", ";
}



function punit($unit){
    switch ($unit){
        case 'M': $chr = "Crore"; break;
        case 'K': $chr = "Lakh"; break;
        case 'H': $chr = "Hazar"; break;
    }
    return $chr;
}
function sm_size($size){
    switch ($size){
        case 'Square Feets': $chr = 'Sq Ft'; break;
        case 'Square Meters': $chr = 'Sq Yd'; break;
        case 'Hectares': $chr = 'Acr'; break;
    }
    return $chr; 
}

function set_val($ID)
{    
     global $db;
     $temp = $db->prepare("select * from config where variable='$ID'");
     $temp->execute();
     $d2 = $temp->fetch();
	 return $d2["var_value"] ;
}

function site_decription()
{
	 global $db;
     $temp = $db->prepare("select page_content from pages where page_key='SED'");
	 $temp->execute();
     $d2 = $temp->fetch();
	return stripslashes( strip_tags($d2['page_content']) );
}

function site_keyword()
{
	global $db;
    $temp = $db->prepare("select page_content from pages where page_key='SEKW'");
	$temp->execute();
    $d2 = $temp->fetch();
	return stripslashes( strip_tags($d2['page_content']) );
}

function page_content($KEY,$characters=0)
{
	global $db;
    $temp = $db->prepare("select page_heading, page_content from pages where page_key='$KEY'");
	$temp->execute();
    $d2 = $temp->fetch();
    $_page = new stdClass();
    $_page->heading=stripslashes($d2['page_heading']);
    $_page->content=stripslashes($d2['page_content']);
    
    if ($characters>0){
	   $_page->content = substr(stripslashes($d2['page_content']),0,$characters) ;
    }
    return $_page;
}


function error_box($msg)
{
echo <<<END
<div class='hypeboxRed' style="margin-top:8px;">
  <div class='div_topRed'></div>
    <div class='div_midRed' style="font-size:11px;text-align:centert;font-weight:bold;padding:5px 8px 5px 8px;"> 
	$msg
	</div>
    <div class='div_bottomRed'></div>
</div>

END;

}

function ym()
{  
  $id = set_val("YMID"); 
  return '<A HREF="ymsgr:sendIM?'. $id .'">
	<IMG SRC="http://202.64.102.142/yahoo/'. $id .'"
	align="absmiddle" border="0" ALT="Yahoo Online Status Indicator"
	onerror="this.onerror=null;this.src=\'http://202.64.102.142/image/yahoounknown.gif\';"></A>' ;
}

function skype()
{
  $id = set_val("SKYPE"); 
  return '<A HREF="skype:'. $id .'?chat">
	<IMG SRC="http://202.64.102.142/skype/' . $id . '"
	align="absmiddle" border="0" ALT="Skype Online Status Indicator"
	onerror="this.onerror=null;this.src=\'http://202.64.102.142/image/skypeunknown.gif\';"></A>';
}

function msn()
{
	$id = set_val("MSNID"); 
	return '<A HREF="http://202.64.102.142/message/msn/'. $id . '">
			<IMG SRC="http://202.64.102.142/msn/' . $id . '"
			align="absmiddle" border="0" ALT="MSN Online Status Indicator"
			onerror="this.onerror=null;this.src=\'http://202.64.102.142/image/msnunknown.gif\';"></A>';
}


function show_boxed_property($status,$x, $bcolor)
{


	$q = mysql_query("select * from ads where $status order by rand() limit 1") or die ("2" . mysql_error());	
	$d2 = mysql_fetch_array($q) ;	

	$content="<table width='100%' cellpadding='2' cellspacing='0' border='0' style='border:3px solid $bcolor; background:url($bground) repeat-x;'><tr>";
	
	$content .= "<td colspan='2' bgcolor='$bcolor'><font size='+1' color='white'>" . 	$d2[property_title] . "</font></td></tr>";

	$content.='<tr><td width="100"><div id="link">';
	


	$showid= $d2[rid];
	$url = "<a class='link' href='ad-details.php?ID=$showid&P=HOME'>";
	$content .= "$url\n\n";
	$content .=  "<img src='pro_images/main_" . getimage($showid) . "' height='120' width='100' style='border:1px solid #000000 padding:4px;'></td>";

	$content .= "</td>\n\n";
	$content .= "<td width='100%' valign='top' >\n\n";
	$content .=  "<table width='100%' c>";
	
	if ($d2[offer_type]=='RENT'):

			 if (strlen($d2[location])>0):
				$content .=  "<tr><td id='detail-tds'>Area</td><td id='detail-td2s'>$d2[location]</td></tr>";
			endif;

			if (strlen($d2[floor_area])>0):
				$content .=  "<tr><td id='detail-tds'>Floor</td><td id='detail-td2s'>". num0($d2['floor_area']) ." <font size='1'>$d2[floor_sqft]</font></td></tr>";
			endif;

			if (strlen($d2[area])>0):
				$content .=  "<tr><td id='detail-tds'>Covered Area</td><td id='detail-td2s'>". num0($d2['area']) ." <font size='1'>$d2[sq_ft]</font></td></tr>";
			endif;


		 $content .=  "<tr><td id='detail-tds'>Demand</td><td id='detail-td2s'>". num2($d2['price']) ." <font color='blue'>$d2[price_in]</font> $d2[price_unit]</td></tr>";

		else:

		 if (strlen($d2[address])>0):
		  $content .=  "<tr><td id='detail-tds'>Address</td><td id='detail-td2s'>$d2[address]</td></tr>";
		endif;

			if (strlen($d2[location])>0):
				$content .=  "<tr><td id='detail-tds'>Area</td><td id='detail-td2s'>$d2[location]</td></tr>";
			endif;


			if (strlen($d2[floor_area])>0):
				$content .=  "<tr><td id='detail-tds'>Floor area</td><td id='detail-td2s'>". num0($d2['floor_area']) ." <font size='1' style='font-weight:normal'>$d2[floor_sqft]</font></td></tr>";
			endif;

			if (strlen($d2[area])>0):
				$content .=  "<tr><td id='detail-tds'>Lot/Land</td><td id='detail-td2s'>". num0($d2['area']) ." <font size='1' style='font-weight:normal'>$d2[sq_ft]</font></td></tr>";
			endif;
			
			$content .=  "<tr><td id='detail-tds'>Demand</td><td id='detail-td2s'>". num2($d2['price']) . " <font color='blue'>$d2[price_in]</font> $d2[price_unit]</td></tr>";

		endif;
	
	$content .= "<tr><td colspan='2' align='center'>". $url . "view details</a></td></tr>";

	$content .= "</table></td></tr></table>\n\n";

	return $content;

}

function show_side_property_list($status,$count)
{
	$content="<table cellpadding='2' cellspacing='0' border='0' width='185'>" ;

	$q = mysql_query("select rid,property_title from ads where $status order by rand() limit $count") or die ("2" . mysql_error());	
	
	$n=0;
	while ($d2 = mysql_fetch_array($q) ):
		$showid= $d2[rid];
		$rowcol = rowcol($n++);
		
		$url = "<a class='black' href='ad-details.php?ID=$showid&P=HOME'>";

		$content .= "<tr $rowcol><td width='40'><a href='ad-details.php?ID=$showid&P=HOME'>\n\n";
		$content .=  "$url<img src='pro_images/main_" . getimage($showid) . "' height='40' width='35' style='border:1px solid #000000 padding:4px;'></a></td>";

		$content .= "<td>$url" . stripslashes($d2['property_title']) ;
		
		$content .= "</a></td></tr>\n\n";
	endwhile;
	$content .= "</table>";
	return $content;
}


function ex_rate()
{
	 //get the Exchange Rate 
	$url ="http://www.exchangerate.com/world_rates.html?letter=P";
	$cfile  = fopen($url,"r");
	while (!feof($cfile)):
		$info2 .= fgets($cfile, 1024);
	endwhile;

	$info2 = strip_tags($info2);
	$startingpoint="PHILIPPINESPesoPHP";
	$start= strpos($info2, "$startingpoint");
	$x=substr($info2,$start,31);
	$rate= substr($x,strlen($startingpoint));
	//$rate= round($rate+0.8,2) ;

	$_SESSION['rate']= num2($rate);

	empty($info2);
	fclose($cfile);
}





function getimage($ID)
{
	$q=mysql_query("select image_name from ads_images where main='1' and propertyid='$ID'") or die (mysql_error());
	if (mysql_num_rows($q)>0):
		$d= mysql_fetch_array($q);
		return trim($d["image_name"]);
	else:
		$q=mysql_query("select image_name from ads_images where propertyid='$ID' order by rand() limit 1") or die (mysql_error());
		if (mysql_num_rows($q)>0):
			$d=mysql_fetch_array($q);
			return trim($d["image_name"]) ;
		else:
			return "nophoto.gif" ;
		endif;
	endif;
}

function getimage_id($ID)
{
	$q=mysql_query("select rid from ads_images where main='1' and propertyid='$ID'") or die (mysql_error());
	if (mysql_num_rows($q)>0):
		$d= mysql_fetch_array($q);
	else:
		$q=mysql_query("select rid from ads_images where propertyid='$ID' order by rand() limit 1") or die (mysql_error());
		$d=mysql_fetch_array($q);
	endif;
	return $d["rid"] ;
}



function show_logo($file_name)
{	global $projectpath;
	
  if (file_exists("$projectpath/$file_name")):
		return "<img src='../projects/$file_name' border='0'>";
	else:
		return "&nbsp;";
	endif;
}

function show_agent_pic($file_name,$w=160)
{	

  if (file_exists("$file_name")):
		return "<img src='$file_name' border='0' style='border:1px solid #f4f4f4;' width='$w'>";
	else:
		return "&nbsp;";
	endif;
}

function project_by($ID,$item)
{
	$q=mysql_query("select project_name,logo from project_name where rid='$ID'");
	if (mysql_num_rows($q)>0):
		$d=mysql_fetch_array($q);
		if ($item=="LOGO"):
			return "projects/$d[logo]";
		else:
			return $d['project_name'];
		endif;
	endif;
}

function gettitle($ID)
{
	$q=mysql_query("select property_title from ads where rid='$ID'") or die (mysql_error());
	$d=mysql_fetch_array($q);
	return stripslashes($d["property_title"]) ;
}


function getprocat($ID)
{
	$q=mysql_query("select pro_type from property_type where rid='$ID'") or die (mysql_error());
	$d=mysql_fetch_array($q);
	return stripslashes($d["pro_type"]) ;
}
function getprocat_menu($ID)
{
	$q=mysql_query("select menu_cap from property_type where rid='$ID'") or die (mysql_error());
	$d=mysql_fetch_array($q);
	return stripslashes($d["menu_cap"]) ;
}

function selected($string,$saved_data)
{
 if ($string==$saved_data):
	 return " selected"  ;
 endif;
}

function cur_menu($string,$curpage)
{
 if ($string==$curpage):
	 return " class='current' "  ;
 endif;
}

function pro_menu($string,$curpage)
{
 if ($string==$curpage):
	 return " class='procat' "  ;
 endif;
}

function get_expiration_date($days)
{
	$today = getdate();
	return date(mktime (0,0,0, $today[mon], $today[mday]+$days, $today[year]) );
}

function make_renewal_date($today,$days)
{   list($m,$d,$y) = explode("-",$today);
	return date(mktime (0,0,0, $m, $d+$days, $y) );
}




function num0($number)
{
	return number_format($number,0,'.',',');
}

function num1($number)
{	if ($number>0):
		return number_format($number,1,'.',',');
	else:
		return "&nbsp;" ;
	endif;
}
function num2($number)
{	if ($number>0):
		return number_format($number,2,'.',',');
	else:
		return "0.00" ;
	endif;
}

function send_email($email_to,$from_mail,$message,$subject)
{
     $headers  = "MIME-Version: 1.0\r\n";
	 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	 $headers .= "From: $from_mail  \n";
	 $headers .= "Return-path: $from_mail  \n";
	 $headers .= "Reply-To: $from_mail \n";
     $send =  mail($email_to, $subject, $message, $headers);
	 return $send;

}

function send_email_text($email_to,$from_mail,$message,$subject)
{
     $headers  = "MIME-Version: 1.0\r\n";
	 $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
	 $headers .= "From: $from_mail  \n";
	 $headers .= "Return-path: $from_mail  \n";
	 $headers .= "Reply-To: $from_mail \n";
     $send =  mail($email_to, $subject, $message, $headers);
	 return $send;

}



function email_name($email)
{
	$q = mysql_query("select last_name,first_name from customers where userid='$email'");
	$d = mysql_fetch_array($q);
	return trim($d["first_name"]) . " " . trim($d["last_name"]);
}

function rowcol($number)
{

 if (intval($number / 2) == ($number / 2)):
	  return "bgcolor='" . EVENROW ."' " ;
 else:
      return "bgcolor='" . ODDROW . "' " ;
endif;
}

function rowcol2($number)
{

 if (intval($number / 2) == ($number / 2)):
	  return "bgcolor='" . even2 ."' " ;
 else:
      return "bgcolor='" . odd2 . "' " ;
endif;
}

function countryname($code)
{
	$q = mysql_query("select country_name from countries where code_2='$code'") or die (mysql_error());
	$d = mysql_fetch_array($q);
	return $d["country_name"];
}


function countrybox($country,$combo_name)
{
	$content='' ;
	$q = mysql_query("Select country_name,code_2 from countries order by country_name") or die ( mysql_error() );

	$content .= "<SELECT style=\"font-size:13px;font-weight:bold;height:20px;width:80%;\" NAME='$combo_name'  " ;
	$content .= "alt=\"selecti|0\" emsg='Please select a country form the list'" ;
	$content .=">\n" ;

	$content .="<option  class='country' value='0'><---- Select One -----></option>\n" ;
	while ($d = mysql_fetch_array($q) ):
		$content .= "<option class='country' value='" . $d["code_2"] ."' " ;
			if ($d["code_2"]==$country) : $content .= "selected "; endif;
		$content .=">" . $d["country_name"] . "</option>\n" ;
	endwhile;
	return $content; 
}


function project_box($project)
{
	$content='' ;
	$q = mysql_query("Select project_name,rid from project_name order by project_name") or die ( mysql_error() );

	$content .= "<SELECT class='sele' NAME='projectid'" ;
	$content .=">\n" ;

	$content .="<option  value='0'>- - - -Select One- - - -</option>\n" ;
	$content .="<option  value=''></option>\n" ;
	while ($d = mysql_fetch_array($q) ):
		$content .= "<option value='" . $d["rid"] ."' " ;
			if ($d["rid"]==$project) : $content .= "selected "; endif;
		$content .=">" . stripslashes($d["project_name"]) . "</option>\n" ;
	endwhile;
	return $content; 
}

function agent_box($agent_id)
{
	$content='' ;
	$q = mysql_query("Select agent_name,rid from agents order by rank,agent_name") or die ( mysql_error() );

	$content .= "<SELECT class='sele' NAME='agent_id'" ;
	$content .= "alt=\"selecti|0\" emsg='Please select form the list'" ;
	$content .=">\n" ;

	$content .="<option  value='0'>- - - -Select One- - - -</option>\n" ;
	$content .="<option  value=''></option>\n" ;
	while ($d = mysql_fetch_array($q) ):
		$content .= "<option value='" . $d["rid"] ."' " ;
			if ($d["rid"]==$agent_id) : $content .= "selected "; endif;
		$content .=">" . stripslashes($d["agent_name"]) . "</option>\n" ;
	endwhile;
	return $content; 
}

function agent_name($agent_id)
{
	$content='' ;
	$q = mysql_query("Select agent_name from agents where rid='$agent_id'") or die ( mysql_error() );
	$d = mysql_fetch_array($q);
	$content .= "<i>". ucwords(strtolower($d["agent_name"])) . "</i>";

	return $content; 
}

function listing_status($j)
{
	$list_ary= array('', '<b>Featured</b>', 'Hidden', 'Weekly', 'Monthly', 'Newly/upcoming', 'Best Seller');
	return $list_ary[$j];	
}

function location_box($location)
{
	$content='' ;
	$q = mysql_query("Select area from area order by area") or die ( mysql_error() );

	$content .= "<SELECT class='sele' style='width: 250px;' NAME='location'" ;
	$content .= "alt=\"selecti|0\" emsg='Please select form the list'" ;
	$content .=">\n" ;

	$content .="<option  value='0'>- - - -Select One- - - -</option>\n" ;
	while ($d = mysql_fetch_array($q) ):
		$content .= "<option value='" . $d["area"] ."' " ;
			if ($d["area"]==$location) : $content .= "selected "; endif;
		$content .=">" . $d["area"] . "</option>\n" ;
	endwhile;
	return $content; 
}

function location_box_search($w)
{
	$content='' ;
	$q = mysql_query("Select area from area order by area") or die ( mysql_error() );

	$content .= "<SELECT style=\"font-size:13px;height:20px;width:$w;\" NAME='location'" ;
	$content .=">\n" ;

	$content .="<option  value='0'>Any</option>\n" ;
	while ($d = mysql_fetch_array($q) ):
		$content .= "<option value='" . $d["area"] ."' " ;
			if ($d["area"]==$location) : $content .= "selected "; endif;
		$content .=">" . $d["area"] . "</option>\n" ;
	endwhile;
	return $content; 
}

function box_top_square($w)
{
echo <<<END
<center>
<table width="$w" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
<tr>
	<td width="1"></td>
	<td width="99%" </td>
	<td width="1"></td>
</tr>
<tr >
	<td style="background:#ffffff;" > </td>
	<td valign="top" style="padding-left:0px;padding-right:0px;padding-bottom:0px;" >
END;
}

function box_top_round($w)
{
echo <<<END
<center>
<table width="$w" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff" >
<tr>
	<td width="1"></td>
	<td width="99%" style="background:#ffffff;" valign="top"></td>
	<td width="1"></td>
</tr>
<tr >
	<td style="background:#ffffff;" > </td>
	<td style="padding-left:0px;padding-right:0px;padding-bottom:0px;height:10px;" valign="top">
END;
}

function box_top_dark2($w)
{
echo <<<END
<center>
<table width="$w" border="0" cellpadding="0" cellspacing="0"  bgcolor="#DADADA">
<tr >
	<td width="1"><img src="images/top-left-d2.gif" border="0" alt=""></td>
	<td width="99%" style="background:#DADADA;"></td>
	<td width="1"><img src="images/top-right-d2.gif" border="0" alt=""></td>
</tr>
<tr >
	<td > </td>
	<td style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
END;
}

function box_bottom2()
{
echo <<<END
<td ></td>
</tr>
<tr >
	<td align="right"><img src="images/bottom-left-d2.gif"  border="0" alt=""></td>
	<td width="95%" ></td>
	<td align="right"><img src="images/bottom-right-d2.gif" border="0" alt=""></td>
</tr>
</table>
</center>
END;
}



function box_top_blue($w)
{
echo <<<END
<center>
<table width="$w" border="0" cellpadding="1" cellspacing="0"  bgcolor="#c4c4c4">
<tr >
	<td width="1"></td>
	<td width="99%" ></td>
	<td width="1"></td>
</tr>
<tr >
	<td > </td>
	<td style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
END;
}

function box_bottom_blue()
{
echo <<<END
<td ></td>
</tr>
<tr >
	<td align="right"></td>
	<td width="95%" ></td>
	<td align="right"></td>
</tr>
</table>
</center>
END;
}


function box_bottom()
{
echo <<<END
<td style="background:#ffffff;"></td>
</tr>
<tr >
	<td align="right"></td>
	<td width="95%" style="background:#ffffff;"></td>
	<td align="right"></td>
</tr>
</table>
</center>
END;
}

function box_top_square3($w)
{
echo <<<END
<center>
<table width="$w" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
<tr>
	<td width="1"></td>
	<td width="99%" style="background:#ffffff;"></td>
	<td width="1"></td>
</tr>
<tr >
	<td style="background:#ffffff;" > </td>
	<td style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
END;
}

function box_bottom3()
{
echo <<<END
<td style="background:#ffffff;"></td>
</tr>
<tr >
	<td align="right"></td>
	<td width="95%" style="background:#ffffff;"></td>
	<td align="right"></td>
</tr>
</table>
</center>
END;
}

function box_top_round_dark($w)
{
echo <<<END
<center>
<table width="$w" border="0" cellpadding="0" cellspacing="0" bgcolor="#dadada">
<tr >
	<td width="1"><img src="images/top-left-d.gif" border="0" alt=""></td>
	<td width="99%"></td>
	<td width="1"><img src="images/top-right-d.gif" border="0" alt=""></td>
</tr>
<tr >
	<td > </td>
	<td style="padding-left:0px;padding-right:0px;padding-bottom:0px;">
END;
}

function box_bottom_dark()
{
echo <<<END
<td ></td>
</tr>
<tr >
	<td align="right"><img src="images/bottom-left-d.gif"  border="0" alt=""></td>
	<td width="95%" ></td>
	<td align="right"><img src="images/bottom-right-d.gif" border="0" alt=""></td>
</tr>
</table>
</center>
END;
}

function box_bottom_dark_footer()
{
echo <<<END
<td ></td>
</tr>
<tr >
	<td align="right"></td>
	<td width="95%" ></td>
	<td align="right"></td>
</tr>
</table>
</center>
END;
}



function jpg_logo($i,$nw,$p,$nn)
{ 
    $img_0=imagecreatefromjpeg($i); 
    $ow=imagesx($img_0); 
    $oh=imagesy($img_0); 
    $scale=$nw/$ow; 
    $nh=ceil($oh*$scale); 
    $newimg = imagecreatetruecolor($nw,$nh); 
    imagecopyresampled($newimg,$img_0,0,0,0,0,$nw,$nh,$ow,$oh); 
    imagejpeg($newimg, $p.$nn); 
    return true; 
} 

function gif_logo($i,$nw,$p,$nn)
{ 
    $img_0=imagecreatefromgif($i); 
    $ow=imagesx($img_0); 
    $oh=imagesy($img_0); 
    $scale=$nw/$ow; 
    $nh=ceil($oh*$scale); 
    $newimg = imagecreatetruecolor($nw,$nh); 
    imagecopyresampled($newimg,$img_0,0,0,0,0,$nw,$nh,$ow,$oh); 
    imagegif($newimg, $p.$nn); 
    return true; 
} 
function code2_country_name($CODE)
{
	if ($CODE<>'--'):
		$q= mysql_query("select country_name from iptocountry where country_code2='$CODE'") or die (mysql_error());
		$d= mysql_fetch_array($q);
		return ucwords(strtolower($d["country_name"])) ;
	else:
		return "<i>Unknown</i>";
	endif;
}

function ip2_country_code($ip)
{
	list($a,$b,$c,$d) = explode(".",$ip);
	$ip_no = (int) ($a*(256*256*256)) + (int) ($b*(256*256)) + (int)($c*256) + $d ;
	$q= mysql_query("select country_code2 from iptocountry where IP_FROM<='$ip_no' and IP_TO>='$ip_no'") or die (mysql_error());
	if (mysql_num_rows($q)>0):
		$d= mysql_fetch_array($q);
		return $d["country_code2"] ;
	else:
		return "--";
	endif;
}


function email_template()
{
return '<table width="600" cellpadding="4" cellspacing="0" style="border-collapse:collapse;font-size:12px;font-family:verdana;" border="1" bordercolor="#CCCCC">

<tr>
	 <td bgcolor="#f4f4f4" align="right">Date</td>
	 <td >%%TODAY%% </td>
</tr>

<tr>
	 <td width="100" bgcolor="#f4f4f4" align="right">Name</td>
	 <td width="500">%%NAME%% </td>
</tr>

<tr>
	 <td bgcolor="#f4f4f4" align="right">Email</td>
	 <td >%%EMAIL%% </td>
</tr>
<tr>
	 <td bgcolor="#f4f4f4" align="right">Telephone</td>
	 <td >%%PHONE%% </td>
</tr>
<tr>
	 <td bgcolor="#f4f4f4" align="right">IP Address</td>
	 <td >%%IP%% </td>
</tr>

<tr>
	 <td bgcolor="#f4f4f4" colspan="2"><FONT SIZE="+1" >Property</FONT></td>
</tr>


<tr>
	 <td bgcolor="#f4f4f4" align="right">Property Id</td>
	 <td >%%PROPERTYID%% </td>
</tr>

<tr>
	 <td bgcolor="#f4f4f4" align="right">Property Type</td>
	 <td >%%PROPERTY_TYPE%% </td>
</tr>

<tr>
	 <td bgcolor="#f4f4f4" align="right">Property Title</td>
	 <td >%%PROPERTY_TITLE%% </td>
</tr>
<tr>
	 <td bgcolor="#f4f4f4" align="right">Price</td>
	 <td >%%PRICE%% </td>
</tr>


<tr>
	 <td bgcolor="#f4f4f4" valign="top" align="right" height="150">Message</td>
	 <td valign="top" >%%REMARKS%% </td>
</tr>


</table>';

}

?>