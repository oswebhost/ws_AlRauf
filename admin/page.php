<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");
$msg='';
if ($_REQUEST['ID'] == "TOC") :
	$heading = "Terms of Use" ;
elseif ($_REQUEST['ID'] == "ABOUT") :
	$heading = "About" ;
elseif ($_REQUEST['ID']== "PRIVACY") :
	$heading = "Privacy Policy" ;
elseif ($_REQUEST['ID'] == "CONTACT") :
	$heading = "Contact information" ;
elseif ($_REQUEST['ID'] == "SED") :
	$heading = "Site Decription for Search Engine" ;
elseif ($_REQUEST['ID'] == "RECOMMEND") :
	$heading = "Tell a Friend" ;
elseif ($_REQUEST['ID'] == "THANKYOU") :
	$heading = "Thank you message" ;
elseif ($_REQUEST['ID'] == "SEKW") :
	$heading = "Keywords for Search Engine" ;
elseif ($_REQUEST['ID'] == "ACCT") :
	$heading = "Accounts & Passwords" ;
elseif ($_REQUEST['ID'] == "GIFT") :
	$heading = "Gift Services" ;
elseif ($_REQUEST['ID'] == "DISCLAIMER") :
	$heading = "Disclaimer" ;
elseif ($_REQUEST['ID'] == "DELIVERY") :
	$heading = "Delivery Time and Cost" ;
elseif ($_REQUEST['ID'] == "IP") :
	$heading = "Intellectual Property" ;
elseif ($_REQUEST['ID'] == "FEE") :
	$heading = "Advertising Fee/Cost" ;
endif;

$category=""; 
$_content ="" ;
if ($_POST['ACTION']=='SAVE'):
	$_content = addslashes($_POST["content"] );
    $page_heading = addslashes($_POST['page_heading']);
	$q = mysql_query("update pages set page_content='$_content', page_heading='$page_heading' where page_key='$_REQUEST[ID]'") or die( mysql_error() );
endif;

$result= mysql_query("SELECT * from pages WHERE page_key='$_REQUEST[ID]' ") or die( mysql_error() );
$num_row = mysql_num_rows($result) ;
if ($num_row<1):
	$q = mysql_query("INSERT INTO pages (page_key,page_content, page_heading, page_title) VALUES ('$_REQUEST[ID]','<p>Please login into Site Manager and update page content.','$page_heading','')") or die ( mysql_error() );
endif;
$result= mysql_query("SELECT * from pages WHERE page_key='$_REQUEST[ID]' ") or die( mysql_error() );
$row = mysql_fetch_array($result);
$_content = $row["page_content"];
$_heading = $row["page_heading"] ;

mysql_free_result($result); 
	

?>
<div align="center">
<span class=question>NOTE: for New Paragraph = press ENTER KEY only :: for New Line = press SHIFT+ENTER keys</span>
<table border="0" cellspacing="3" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="3" id="AutoNumber2" bgcolor="#FFFFFF">
 <tr>
   <td width="100%" valign="top"><p class="pagehd"><?= $heading ?></p>
  <!---BODY_HERE- -->
<? echo $msg ?>

<form method="POST" action="<?echo $url?>" onsubmit="return checkform(this);">
<INPUT TYPE="hidden" NAME="ACTION" value="SAVE">
   <table width="90%" align="center"  >    
   <tr>
	  <td width="100%">
      Page Heading<br />
      
      <input type="text" name="page_heading" class="head" size="80" maxlength="70" value="<? echo stripslashes(trim($_heading)) ?>"> Max. 70 characters&nbsp;&nbsp;&nbsp;<input type="submit" value="Save" name="B1" class="bt">
	  
	  </td>
	<tr>
	 
      <td width="90%"><?= $heading ?> Content <br />
     
        <?  $CONTENT="content"; $_content= stripslashes(trim($_content));
           $Height="400px";$toolbar=1;
           include("spaw.ini.php"); 
        ?>	 
     
     
	  </td>

   <!--  <tr>
      <td width="100%" height="25" colspan="2"  valign="Middle">
	  	<div align="center">
      <input type="submit" value="Save" name="B1" class="find"></div>
	  </td>
    </tr> -->
  </table>
</form>
</td>
</tr>
</table>
</div>
<? include("footer.ini.php") ?>