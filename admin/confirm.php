<? include("../common.php");

	$query="SELECT * from order_tb WHERE oid='$OID'";
	$result= mysql_query($query) or die("Can not get test");
	while ($row = mysql_fetch_array($result)):
			$order_no = $row["order_no"] ;
			$order_date = $row["order_date"] ;
			$fullname = $row["fullname"] ;
			$email_address = $row["email_address"] ;
			$phone = $row["phone"] ;
			$paper_type = $row["paper_type"] ;
			$no_of_page = $row["no_of_page"] ;
			$status = $row["status"] ;
			$due_date = $row["due_date"] ;
			$subject = $row["subject"] ;
			$proj_name = $row["proj_name"] ;
			$level = $row["level"] ;
			$citation = $row["citation"] ;
			$instruction = $row["instruction"] ;
			$source = $row["source"] ;
			$pay_status = $row["pay_status"] ;

	endwhile;	
$del_url ="save.php?ACTION=DELETE&OID=$OID&PAGE=$PAGE&per_page=$per_page" ;

?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>WedoyourEssay.com</title>
<script language="Javascript1.2"><!-- // load htmlarea
function checkme()
{
	window.close();
	
}
</script>


<link rel="stylesheet" type="text/css" href="../style.css">


</head>

<body topmargin="0" leftmargin="0">




<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#F1F3F1" width="100%" id="AutoNumber1">
  <tr>
    <td width="100%" height="40">
    <img border="0" src="../images/wedo.gif" width="285" height="30"></td>
  
  </tr>
  <tr>
    <td width="100%" bgcolor="#F1F3F1" height="2"></td>
  
  </tr>
  <tr>
    <td width="100%" align="center"><b><font size="4" color="#90C745">
    Confirmation</font></b></td>
  
  </tr>
  <tr>
    <td width="100%"><BR>
   

<h4>Are you sure you want to delete this order # <?= $OID ?> <BR><BR><BR>


    </td>
  
  </tr>
  <tr>
    <td width="100%" align="center" bgcolor="#F1F3F1" height=2></td>
  
  </tr>
  <tr>
    <td width="100%" align="center" height="25">
	<B>[</B>
    <a  href="<?=$del_url?>">YES</a> <B>]</B>&nbsp;&nbsp;&nbsp;
	<B>[</B>
    <a  href="javascript:history.go(-1)">NO</a> <B>]</B></td>
  
  </tr>
</table>

</body>

</html>