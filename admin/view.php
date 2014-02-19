<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");
$category="";
$msg='';
	
	$query="SELECT * from orders WHERE order_no ='$ID'";
	$result= mysql_query($query) or die( mysql_error() );
    $d = mysql_fetch_array($result) ;
	$shipping_cost  = $d["shipping_cost"] ;
	$shipping_days  = $d["shipping_days"] ;
	$ship_type		= $d["ship_type"] ;

$del_url ="view.php?ACTION=DELETE&ID=$ID&PAGE=$PAGE&per_page=$per_page" ;



?>
<div align="center">
<BR>
<div align="center">
	<? 
		if ($ACTION=='DELETE' ):	
			echo "<span class='question'>Are you sure you wanted to Delete this order?</span><br /><br />" ;
			echo "<a href='delete.php?ACTION=DELETE&GO=YES&ID=". $ID ."'>* * *  Y E S * * *</a>" ;
		else:
			echo "<a href='" . $del_url ."'>[  DELETE this ORDER  ]</a>" ;
		endif;
	?>
	
	
</div>

<table border="0" cellspacing="3" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="3" id="AutoNumber2" bgcolor="#FFFFFF">
 <tr>
   <td width="100%" valign="top"><span class="pagehd">Order details</span> 	<a href='print.php?ID=<?=$ID?>' target='_blank'>[  PRINT this ORDER  ]</a>
  <!---BODY_HERE- -->
<? echo $msg ?>
<!-- startprint -->
<table border='0' width="80%" id="table1" cellpadding='5' align='center'>
	<tr>
		<td valign='top'>
			<? 
				$info = pay_details(); 
				$info= ereg_replace("%pay_last_name%",  $d["pay_last_name"], $info) ;
				$info= ereg_replace("%pay_first_name%", $d["pay_first_name"], $info) ;
				$info= ereg_replace("%pay_email%",		$d["pay_email"], $info) ;
				$info= ereg_replace("%pay_address1%",	$d["pay_address1"], $info) ;
				$info= ereg_replace("%pay_address2%",	$d["pay_address2"], $info) ;
				$info= ereg_replace("%pay_city%",		$d["pay_city"], $info) ;
				$info= ereg_replace("%pay_zipcode%",	$d["pay_zipcode"], $info) ;
				$info= ereg_replace("%pay_phone%",		$d["pay_phone"], $info) ;
				$info= ereg_replace("%pay_country%",	$d["pay_country"], $info) ;
				echo $info; 
			?>
		</td>
		
		<td valign='top'>
			<? 
				$info = shipping_details(); 
				$info= ereg_replace("%ship_last_name%", $d["ship_last_name"], $info) ;
				$info= ereg_replace("%ship_first_name%",$d["ship_first_name"], $info) ;
				$info= ereg_replace("%ship_address1%",  $d["ship_address1"], $info) ;
				$info= ereg_replace("%ship_address2%",  $d["ship_address2"], $info) ;
				$info= ereg_replace("%ship_city%",	    $d["ship_city"], $info) ;
				$info= ereg_replace("%ship_zipcode%",   $d["ship_zipcode"], $info) ;
				$info= ereg_replace("%ship_phone%",     $d["ship_phone"], $info) ;
				$info= ereg_replace("%ship_country%",   $d["ship_country"], $info) ;
				echo $info; 
			?>
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			<?   
				echo "<B>Remarks:</B> " . $d["remarks"] ;
			?>
		</td>
	</tr>
	<tr>
		<td colspan='2'>
			<?  $currency = $d["currency"] ;
				$cart_info = order_items($d["order_no"], $d["order_date"]) ."<br />" ;
				echo $cart_info;
				

   
			?>
		</td>
	</tr>
</table>
<!-- stopprint -->
</td>
</tr>
</table>
</div>
<? include("footer.ini.php") ;


function order_items($ORDERNO,$ORDER_DATE)
{ $content='';

global $shipping_cost, $shipping_days,$ship_type,$currency ;

$content= '<table border="1" width="100%" id="table1" cellspacing="0" cellpadding="2" style="border-collapse: collapse" bordercolor="#000000" align="center">
				<tr class="tbhead">
					<td width="50%" align="center" colspan="2"><B>Item</B></td>
					<td width="150" align="center"><B>Unit Price</B></td>
					<td width="100" align="center"><B>Qty.</B></td>
					<td width="140" align="center"><B>Postage</B></td>
					<td width="180" align="right"><B>Total</B></td>
				</tr> ' ;

$subTotal=0 ; $totalAmt =0 ; $shipping=0 ; $num=0;
		
	$sql= mysql_query("select * from order_items where order_no='$ORDERNO'") or die( mysql_error() ) ;
	while ($dd = mysql_fetch_array($sql) ):
			$content .= "<tr height='35'>\n"; 
			$content .= "<td colspan='2' align='left'>" ;
			$pid= $dd["order_product_id"];
			$content .=  prodname($pid) . "<br />" ;
			$content .="Postage $currency " . num2($dd["order_postage"]) . "/per item" ;
			
			$content .= "</td>\n";
			$content .= "<td  align='center'>" . $currency . "&nbsp;" . $dd["order_unitprice"] . "</td>\n";
			$content .= "<td  align='center'>" . $dd["order_qty"] . "</td>\n";
			$content .= "<td  align='center'>$currency " . num2($dd["order_postage"] * $dd["order_qty"]) . "</td>\n";
			$content .= "<td  align='right'>" . $currency . "&nbsp;" . "<b> " . num2($dd["order_amt"]) . "</b></td>\n";
			$content .= "</tr>\n\n";
			$subTotal += $dd["order_amt"] ;
	endwhile;
			// sub-total 
				$content .= "<tr height='20'>";
				$content .= "<td colspan='5' align='right'>sub-total:</td>\n" ;
				$content .= "<td align='right'>" . $currency . "&nbsp;" . " <b>" . num2($subTotal) . "</b></td>\n" ;
				//shipping cost
				//$shipping_cost = num2(shipping_cost($zone,$wgt,$osID)) ;
				$content .= "<tr height='20'>";
				$content .= "<td colspan='5' align='right'>Postage:</td>\n" ;
				$content .= "<td align='right'>" . $currency . "&nbsp;" . " <b>" . $shipping_cost . "</b></td>\n" ;
				//Total cost
				$content .= "<tr height='30'>";
				$content .= "<td colspan='5' align='right'><b>Total:</b></td>\n" ;
				$content .= "<td align='right'>" . $currency . "&nbsp;" ." <font size='+1'>" . num2($subTotal+$shipping_cost) . "</font></td>\n" ;
				//Delivery Message
				//$days = find_days($COUNTRY) +  count_days($osID) ;
				/*
				$content .= "<tr height='30'>";
				$content .= "<td colspan='5' align='center'>\n" ;
				if ($ship_type=='free'):
					$content .="<B>Free Electronic</B>";
				else:
					$content .=  "<B>$ship_type </B>";
					$content .=  "<BR>Delivery of your order will take approx. <b>" . $shipping_days  . "</b> days.</td>\n" ;
				endif;
				$content .= "</tr>\n" ;
				*/
				$content .= "<tr height='35'>";
				$content .= "<td colspan='6' align='center'>\n" ;
				$content .=  "<span class=heading>ORDER NO :  <b>" . $ORDERNO  . "</b></span><br>" . $ORDER_DATE ."</td>\n" ;
				$content .= "</tr>\n" ;
				$content .= "</table>\n" ;
				$content .= "</table>\n" ;
	
	
  return $content ;				
}

function shipping_details()
{
return '<table border="1" width="100%" cellspacing="0" cellpadding="4" style="border-collapse: collapse" bordercolor="#E0E0E0" id="table1" align="center">
	<tr>
		<td colspan="2" class="tbhead"><b>Shipping Information</b></td>
	</tr>
	<tr>
		<td width="114" bgcolor="#F4F4F4">Name</td>
		<td width="300" >%ship_last_name%, %ship_first_name% 
	</td>
	</tr>
	<tr>
		<td width="114" bgcolor="#F4F4F4">Address</td>
		<td>%ship_address1%  %ship_address2%
	</td>
	</tr>
	<tr>
		<td width="114" bgcolor="#F4F4F4">City</td>
		<td>%ship_city%, %ship_zipcode%, Phone: %ship_phone%
	</td>
	</tr>
	<tr>
		<td width="114" bgcolor="#F4F4F4">Country</td>
		<td><B>%ship_country% </B>
	</td>
	</tr>
</table>' ;

}

function pay_details()
{
return '<table border="1" width="100%" cellspacing="0" cellpadding="4" style="border-collapse: collapse" bordercolor="#E0E0E0" id="table1" align="center">
	<tr>
		<td colspan="2" class="tbhead"><b>Payment Information</b></td>
	</tr>
	<tr>
		<td width="114" bgcolor="#F4F4F4">Name</td>
		<td width="300" >%pay_last_name%, %pay_first_name% 
	</tr>
	<tr>
		<td width="114" bgcolor="#F4F4F4">Email</td>
		<td>%pay_email% 
	</td>
	</tr>

	<tr>
		<td width="114" bgcolor="#F4F4F4">Address</td>
		<td>%pay_address1% %pay_address2% 
	</td>
	</tr>
	<tr>
		<td width="114" bgcolor="#F4F4F4">City / Country</td>
		<td>%pay_city%, %pay_zipcode%, , Phone: %pay_phone%  <b>%pay_country% </b>
	</td>
	</tr>

</table>' ;

}

?>