<?  include("../common.php") ;
	$q = mysql_query("select * from news where rid='$ID' ") or die ( mysql_error() ) ;
	$d = mysql_fetch_array($q) ;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="../style.css">
<title>Send Newsletter</title>

</head>

<body topmargin="0" leftmargin="0">

<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber3" height="100%">
  <tr>
	<td width="100%"  height="25" align="center" <? echo rowcol2(1) ?>>
		<b><FONT SIZE="+1" COLOR="#ffffff">Send Newletters</FONT></b>
	</td>
  </tr>
  <tr>
	<td width="100%" valign="top" height="100%"  bgcolor="#ffffff">
	<BR><BR>
	<p><span class="heading"><?= $d["title"] ?></span></p>
	<p>Sending newsletters. This may take few minuts. Please wait...<br /><br />
	<?
		if ($send=="GO") :
			$info = news_template();
			$info = ereg_replace("%URL_PATH%", $URL_PATH, $info) ;
			$info = ereg_replace("%TITLE%" , $d["title"], $info );
			$info = ereg_replace("%CONTENT%" , stripslashes(trim($d["content"])), $info );
			if (file_exists("../images/". trim($d["news_img"]) )):
				 $image = '<img border="0" src="'. $URL_PATH .'images/'. trim($d["news_img"]) . '" align="left" hspace="5" >' ;
			else:	
				$image = "";
			endif;
			$info = ereg_replace("%IMAGE%", $image, $info);
			$q = mysql_query("select * from address_book where active='$dactive' ") or die ( mysql_error() ) ;
			$number=0; 
			while ($row = mysql_fetch_array($q) ):
				$number++;
				$send_to = trim($row["email_address"]) ;
				$subject = "Hi " . trim($row["person_name"]) ;
				$send= send_letter($subject,stripslashes($info),$send_to);
				echo "$number) $send <br>";
			endwhile;
			echo "<br>Process completed....";
		else:
			echo send_op($ID) ;
		endif;
	?>
		
	</td>
   </tr>

  <tr>
	<td width="100%" valign="top" height="2" bgcolor="#F4F4F4">
	</td>
   </tr>
  <tr>
	<td width="100%" valign="top" height="20" bgcolor="#F4F4F4" align="center">
	
	<A HREF="javascript:close()">x Close window x</A>


	</td>
   </tr>
</table>
</BODY>
</HTML>

<?
function send_op($ID)
{
return '<p><span class="sending">Send to:
	<FORM METHOD=POST ACTION="sendnews.php">
			<INPUT TYPE="hidden" name="ID" value="'. $ID .'">
			<INPUT TYPE="hidden" name="send" value="GO" >
			<INPUT TYPE="radio" NAME="dactive" value="1" class="chk">Active members only<BR>
			<INPUT TYPE="radio" NAME="dactive" value="0" class="chk">Not Active members only<BR>
			<div align="center">
				<input type="submit" value=" Send Now! " name="B1" >
			</div></span>
		</tr>
	</FORM>';
}

function news_template()
{

 return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
	<html>
	<head>
	<meta http-equiv="Content-Language" content="en-us">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<link rel="stylesheet" type="text/css" href="%URL_PATH%style.css">
	<title>Newsletter Preview</title>

	</head>

	<body topmargin="0" leftmargin="0">

	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber3" height="40">
	  <tr>
		<td width="100%"  height="30" align="center" bgcolor="#8cabc8">
			<b><FONT SIZE="+1" COLOR="#ffffff">%TITLE%</FONT></b>
		</td>
	  </tr>
	  <tr>
		<td width="100%" valign="top" height="13">
		<p>
			%IMAGE% %CONTENT%
		</td>
	   </tr>

	  <tr>
		<td width="100%" valign="top" height="2" bgcolor="#F4F4F4" align="center">
		%URL_PATH%
		</td>
	   </tr>
	</table>
	</BODY>
	</HTML>' ;

}

function send_letter($subject,$message,$send_to){
	global $DOMAIN_URL , $DOMAIN, $URL_PATH, $SITE_EMAIL ;

	$fromemail = $DOMAIN . " <" . $SITE_EMAIL .">" 	 ;
	$aol = strtolower(substr($send_to,strlen($send_to)-7));
	$headers  = "MIME-Version: 1.0\r\n";
	 if ($aol=='aol.com'):
		$headers .= "Content-type: text/x-aol\r\n";
	 else:
		 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	 endif;
	$headers .= "From: $fromemail\n";
	$headers .= "Reply-To: $fromemail\n";
	$headers .= "Return-path: $SITE_EMAIL\n";
	$send = mail($send_to, $subject, $message, $headers);
	if ($send==1):
		return "$send_to&nbsp;-->successful";
	else:
		return "$send_to&nbsp;----->FAIL";
	endif;
}

?>