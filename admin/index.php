<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
 ob_start();
$log='';
if (!isset($action)) : $action=""; endif; 
include("../common.php") ;



if ($_POST['action']=="GO") :
    
    $userid = $_POST['userid'];
    $pwd    = $_POST['pwd'];

    
	$r = mysql_query("select * from user where userid='$userid' and pwd='$pwd'") or die("Can not get data from user file") ;
	if (mysql_num_rows($r)<=0) :
		$log= "Userid/Password miss match. Please try again." ;
	else:
		global $user_id,$user_name,$u_type;
		$query1="SELECT userid,full_name,utype FROM user WHERE userid='$userid'";
		$result = mysql_query($query1) or die("Query failed"); 
		$num_of_rows = mysql_num_rows ($result) ;  
		while ($row = mysql_fetch_array($result)):
			$user_id   = $row["userid"];
			$user_name = $row["full_name"];
			$u_type = $row["utype"] ;
		endwhile;
		session_start();
		$_SESSION["user_id"] = $user_id;
		$_SESSION["user_name"]= $user_name;
		$_SESSION["u_type"] = $u_type;
		header("location: stats.php") ;
	endif;
endif;



?>
<!-- Start of Header -->
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link rel="stylesheet" type="text/css" href="style.css">




<title>Site Manager <?echo $COMPANY; ?> </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="fValConfig.js"></script>
<script type="text/javascript" src="fValidate.js"></script>


</head>

<body topmargin="2" leftmargin="0" onload="document.myform.userid.focus();">

<div align="center" style="padding:5px;background:#f4f4f4;">
	<FONT SIZE="+2">Site Manager</FONT>
</div>

<div align="center" style="padding:60px;height:200px;font-size:14px;">
	
    
    	<?	

		if (strlen($log)>0){



		 echo error_box($log);

		}



	?>
		<div style='height:253px;width:506px; margin:20px auto 20px auto; background:url(images/lgoin-bg.jpg);border:1px solid #fff;'>

	

		<form name='login' method="post" action="index.php" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);">

			<input type='hidden' name='action' value='GO'/>



		<div style='border:0px solid #ccc;width:210px;height:40px; margin-top:55px; margin-left:-15px;'>

			<input type='text' name='userid' style="height:27px;border:0;background:transparent; width:100%; font-size:18px;" onkeypress="return tabE(this,event)" value='' alt="length|4" emsg="Please enter User ID." />

		</div>

		

		<div style='border:0px solid #ccc;width:210px;height:40px; margin-top:38px; margin-left:-15px;'>

			<input type='password' name='pwd' style="height:27px;border:0;background:transparent; width:100%; font-size:18px;" onkeypress="return tabE(this,event)" value='' alt="length|4" emsg="Please enter Password." />

		</div>

		

		<div style='border:0px solid #ccc;width:210px;height:40px; margin-top:15px; text-align:center;'>

			<input type="image" src="images/login-bt.png" style='border:0;height:40px;width:120px;'/>

		</div>

		

		</form>

	</div>

	

	

	

	
	 Copyright &copy; <? echo date("Y") . " " . $COMPANY; ?></font>
</div>



</body>

</html>
