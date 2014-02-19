<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
ob_start();
session_start();
if (!isset($_SESSION['u_type'])):
	header("Location: index.php") ;
	exit;
endif;
$userid = $_SESSION['userid'];


	


?>
<!-- Start of Header -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle.css" />
<script type="text/javascript" src="chromejs/chrome.js"></script>

<title>Site Manager  </title>

<script language="javascript">

var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}
function regpass(url)
{
eval('window.open(url,"","toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=no,scrollbars=yes,width=350,height=150",leftposition=350)')
}

</script>




<script language="Javascript1.2"><!-- // load htmlarea
function checkme(name)
{
	window.close(name);
	//window.location = "orders.php" '
}

function view(url){
	var w=440	
	var h=250
	eval('window.open(url,"","toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=no,scrollbars=yes,left=150,top=100,width=550,height=450")')
}


function question(url)
{
eval('window.open(url,"","toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=no,scrollbars=yes,width=450,height=450",leftposition=350)')
}


_editor_url = "./htmlarea/";                // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
 document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
 document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
// --></script> 
<script src="../fValConfig.js"></script>
<script src="../fValidate.js"></script>




</head>

<body topmargin="0" leftmargin="0">

<div align="center">
  <center>
  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
    <tr>
      <td bgcolor="#000000" valign="top">
      <div align="center">
        <center>
        <table border="0" cellpadding="0" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber2" height="400">
          <tr>
            <td width="100%" bgcolor="#FFFFFF" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber3" height="40">
              <tr>
                <td width="100%"  height="40" align="center" <? echo rowcol2(1) ?>>
					
					<FONT SIZE="+3" COLOR="#000000"><?echo $DOMAIN ?> - Site Manager</FONT>
                </td>
              </tr>
              <tr>
                <td width="100%" valign="top" height="13">
                <table border="0" cellpadding="2" cellspacing="2" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber5" height="10">
                  <tr><td colspan=3 align="left"  height=20>


				  <div class="chromestyle" id="chromemenu" style="text-align:left">
				  <ul>
					<li><a href="stats.php">Home</a></li>
									
					<li><a href="#" rel="pro">Property Listing</a></li>
					<li><a href="#" rel="dropmenu2">Pages</a></li>
					<li><a href="#" rel="dropmenu4">Misc</a></li>	
		  		 </ul>
				</div>
				

				<!--2nd  drop down menu -->                                                   
					<div id="dropmenu2" class="dropmenudiv" style="width:250px;">
						<a href="page.php?ID=HOME">Home Page</a>
						<a href="page.php?ID=ABOUT">About Us</a>
						<a href="news.php">News</a>
						<a href="articles.php">Articles</a>
						<a href="page.php?ID=PRIVACY">Privacy Policy</a>
						<a href="page.php?ID=TOC">Terms of Use</a>
						<a href="page.php?ID=DISCLAIMER">Disclaimer</a>
						<a href="page.php?ID=CONTACT">Contact Us</a>
						<a href="page.php?ID=THANKYOU">Thank you for Submit Property</a>
					</div>  
					
					<div id="pro" class="dropmenudiv" style="width:250px;">
						<a href="post-property.php">Post New Property</a>
						<a href="pro-listing.php">Property Listing/Edit/Delete</a>
						<a href="pro-type.php">Property Types</a>
						<a href="pro-features.php">Property Features</a>
						<a href="com-features.php">Community Features</a>
					
						<a href="area.php">Areaes/Locations</a>
						<a href="team.php">Team</a>	

					</div>  

					<!--3nd  drop down menu -->                                                   
					<div id="dropmenu4" class="dropmenudiv" style="width:250px;">
						<a href="config.php">Site Configuration</a>
						<a href="users.php">User List</a>
						<a href="page.php?ID=SED">Site Description for Search Engine</a>
						<a href="page.php?ID=SEKW">Keywords for Search Engine</a>
					</div>  

				

	<script type="text/javascript">
		cssdropdown.startchrome("chromemenu")
	</script>


				 
					
				  </td></tr>
				
			
				  <tr <? echo rowcol(1) ?>><td width=20%  align="center" height=20><B>Hello <?= ucwords($user_name) ?></B></td>
				  <td width=60% align="center"  height=20><FONT SIZE="+1"><?= $DOMAIN ?></FONT></td><td  align="center" height=20 width=20%> <A   HREF="logout.php">Log Out</A></td></tr>
				  </table>


<TABLE border="0" height="480" width="100%">
<TR>
	<TD valign=top>


	
