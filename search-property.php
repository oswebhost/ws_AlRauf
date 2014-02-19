<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
 ob_start();
session_start() ;
$userid = $_SESSION['userid'];

$curpage = "search";

require_once("common.php") ;

$PAGE_TITILE = " Search Real Estate Properties in Karachi Pakistan with " . $PAGE_TITILE ;
require_once("header.ini.php") ;



?>

<center>
<table width='100%' cellpadding='0' cellspacing='0' border='0'>
	<tr>
	<td valign='top' width='200' style='padding-left:0px;padding-right:10px;'>
			
			<? include("pro-category-menu.ini.php"); ?>
			
		</td>	
		<td valign='top' width="800" style='padding-right:12px;' >

		<? 

			echo "<h3>Search Property</h3>" ;

			
		 ?>	
		  <form method="post" action='search-property.php' style='padding:0;margin:0;'>
			<input type='hidden' name='go' value='1'>

			<table width='100%' cellpadding='5' cellspacing='0' border='0' style='background:url(images/search-bsg.gif) no-repeat top center;'>
			  <tr>	
					<td id='tdleft'>Search For </td>
					<td id='tdright'><input type="text" name='searchfor' style='width:90%'></td>
			  </tr>
			  <tr>	
					<td id='tdleft'>Property Category </td>
					<td id='tdright'><? echo property_type_box_search(); ?></td>
			  </tr>
			  <tr>	
					<td id='tdleft'>Offer Type </td>
					<td id='tdright'>
						<select name='offer_type' style="font-size:13px;height:20px;width:52%;">
							<option value='0'>All Sale/Tolet</option></option>
							<option value='SALE' >SALE</option>
							<option value='RENT' >TOLET</option>
						</select>
				  </td>
			  </tr>

			  <tr>	
					<td id='tdleft'>Specification </td>
					<td id='tdright'>
						<select name='bedrooms' style="font-size:13px;height:20px;width:25%;">
							<option value='0'>Any</option></option>
							<option value='Studio'>Studio</option></option>
							<option value='1'>1 bedroom</option></option>
							<option value='2'>2 bedrooms</option></option>
							<option value='3'>3 bedrooms</option></option>
							<option value='4'>4 bedrooms</option></option>
							<option value='5'>5 bedrooms</option></option>
							<option value='6'>6 bedrooms</option></option>
							<option value='7'>7 bedrooms</option></option>
							<option value='8'>8 bedrooms</option></option>
							<option value='9'>9 bedrooms</option></option>
							<option value='10'>10 bedrooms</option></option>
						</select>&nbsp;
						<select name='bathrooms' style="font-size:13px;height:20px;width:25%;">
							<option value='0'>Any</option></option>
							<option value='1'>1 bathroom</option></option>
							<option value='2'>2 bathrooms</option></option>
							<option value='3'>3 bathrooms</option></option>
							<option value='4'>4 bathrooms</option></option>
							<option value='5'>5 bathrooms</option></option>
						</select>

				  </td>
			  </tr>
			  <tr>	
					<td id='tdleft'>Area Location </td>
					<td id='tdright'><? echo location_box_search('52%'); ?></td>
			  </tr>
<!--  
			   <tr>	
					<td id='tdleft'>Price/Rent Range </td>
					<td id='tdright'>
						<select name='price' style="font-size:13px;height:20px;width:16%;">
							<option value='0'>Any</option></option>
							<?
							  for ($i=1; $i<=100; $i++):
								echo "<option value='$i'>$i</option></option>\n";
							  endfor;
							?>
						</select>&nbsp;
						<select name='price_max' style="font-size:13px;height:20px;width:16%;">
							<option value='0'>Any</option></option>
							<?
							  for ($i=1; $i<=100; $i++):
								echo "<option value='$i'>$i</option></option>\n";
							  endfor;
							?>
						</select>&nbsp;

						<select name='price_in' style="font-size:13px;height:20px;width:16%;">
							<option value='0'>Any</option></option>
							<option value='K'>Thousand</option></option>
							<option value='M'>Million</option></option>

						</select>&nbsp;


						</select> <br>
						Min &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Max
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit

				  </td>
			  </tr>
-->
			   <tr>	
					<td colspan='2' style='padding:10px;text-align:center;'>
						<INPUT TYPE="image" SRC="images/search.jpg" style="border:0">
					</td>
			  </tr>


			</table>


	
		<?

		if ($_POST['go']=='1'):
			
			$sql = "select * from ads where ad_status<>'2' " ;

            if ($_POST['searchfor']<>'') :
			    $sql .= "and property_title like '%$_POST[searchfor]%' " ;
			endif;		   

		   if ($_POST['property_type']>'0') :
				$sql .= " and property_type = '$_POST[property_type]' ";
		   endif;
			
		   if ($_POST['offer_type']>'0') :
				$sql .= " and offer_type = '$_POST[offer_type]' ";
		   endif;

		  if ($_POST['bedrooms']>'0') :
				$sql .= " and (bedrooms like '%". $_POST['bedrooms'] . "%') ";
		   endif;

		   if ($_POST['bathrooms']>'0') :
				$sql .= " and (bathrooms like '%" . $_POST['bathrooms']. "%') ";
		   endif;

		   if ($_POST['location']>'0') :
				$sql .= " and location = '$_POST[location]' ";
		   endif;
		
			if ($_POST['price']>'0') :
				$sql .= " and price >= '$_POST[price]' ";
		   endif;

	       if ($_POST['price_max']>'0') :
				$sql .= " and price_max <= '$_POST[price_max]' ";
		   endif;
		   if ($_POST['price_in']>'0') :
				$sql .= " and price_in = '$_POST[price_in]' ";
		   endif;


		  $q = mysql_query($sql) or die (mysql_error());

		  if ( mysql_num_rows($q)=='0'):
				echo "<center><br>
				<div style='margin-left:30px;margin-right:30px;margin-bottom:10px;padding:10;border:1 solid #FFAAAA;background:#FFF4F4;font-size:12px;font-family:tahoma;font-weight:bold;text-align:center;width:300;'>";
				echo "No match found!";
				echo "</div></center>";
		  else:

			$qry = mysql_query("$sql  order by ad_status, property_title") or die (mysql_error());

			while ($data = mysql_fetch_array($qry) ):
  
					  $logo = project_by($data[projectid],"LOGO");
					  $project = project_by($data[projectid],"NAME") ;
					  $offer = strtolower($data["offer_type"])  . ".gif" ;
				
				echo "<div style='padding-bottom:3px;'></div>";
 
 
echo "<center>$ch";

		echo "<table width='90%' cellpadding='2' border='0' style='border:1px solid #c00000;'>$ch";

		echo "<tr>$ch<td colspan='2'>";

	

	
	



	echo "<span id='ad-head'>" . stripslashes($data["property_title"]) . "</span> ";



	echo "</td>$ch";

	echo "</tr>$ch";



	echo "<tr>$ch";

	if (ifimage($data['rid'])>0):	

	  $url = "<a class='img' href='#' onClick=javascript:view('view_pic.php?ID=".getimage_id($data['rid'])."')>";

	  echo "<td width='120' valign='top' rowspan='2' >";

	  echo "$url<img src='pro_images/th_". getimage($data['rid']) ."' border='0'></a></td>";

	else:

	  echo "<td rowspan='2' ><img src='images/spacer.gif' width='115' height='1' border='0'></td>";

	endif;



	echo "<td  width='100%' valign='top' height='100' >";

	echo "<table width='100%' cellpadding='5' cellspacing='1' border='0'>";



	echo "<tr>";



	echo "<td colspan='2'>";





	echo "<div style='float:left;margin-right:40px;height:35px;padding-left:10px;padding-top:1px;font-size:18px;margin-bottom:5px;'>";

	echo "<img src='images/$offer' border='0'>";

	echo "</div>";



	echo "<img src='images/spacer.gif' width='65' height='1' border='0'><br>";

	if ($data["stories"]>0):

		echo "<div style='float:left;margin-right:20px;background:url(images/stories.gif) no-repeat;height:35px;padding-left:40px;padding-top:1px;font-size:14px;margin-bottom:5px;'>";

		echo "<b>" . $data["stories"] . "</b>" ;

		echo "</div>";

	endif;



	if (strlen($data["bedrooms"])>0):

		echo "<div style='float:left;margin-right:20px;background:url(images/bedrooms.gif) no-repeat;height:35px;padding-left:40px;padding-top:1px;font-size:14px;margin-bottom:5px;'>";

		echo "<b>" . $data["bedrooms"] . "</b>" ;

		echo "</div>";

	endif;

	if (strlen($data["bathrooms"])>0):

		echo "<div style='float:left;margin-right:20px;background:url(images/bathroom.gif) no-repeat;height:35px;padding-left:40px;padding-top:1px;font-size:14px;margin-bottom:5px;'>";

		echo "<b>" . $data["bathrooms"] . "</b>" ;

		echo "</div>";

	endif;



	if ($data["garage"]>0):

		echo "<div style='float:left;margin-right:20px;background:url(images/carpark.gif) no-repeat;height:35px;padding-left:40px;padding-top:1px;font-size:14px;margin-bottom:5px;'>";

		echo "<b>" . $data["garage"] . "</b>" ;

		echo "</div>";

	endif;



	

	

	

	echo "<div style='padding:0px;'>&nbsp;</div></td></tr>";











	echo "<tr><td id='detail-td'>Property Type</td><td id='detail-td2'>$data[property_type]</td></tr>";

	if (strlen($data[address])>0):

	  echo "<tr><td id='detail-td'>Address</td><td id='detail-td2'>$data[address]</td></tr>";

	endif;

	if (strlen($data[location])>0):

		echo "<tr><td id='detail-td'>Area</td><td id='detail-td2'>$data[location]</td></tr>";

	endif;

if ($data[offer_type]=='RENT'):

	if (strlen($data[floor_area])>0):
		echo "<tr><td id='detail-td'>Floor </td><td id='detail-td2'>". $data['floor_area'] ." <font size='1'>$data[floor_sqft]</font></td></tr>";
	endif;

	if (strlen($data[area])>0):
		echo "<tr><td id='detail-td'>Covered Area</td><td id='detail-td2'>". $data['area'] ." <font size='1'>$data[sq_ft]</font></td></tr>";
	endif;
	
	echo "<tr><td id='detail-td'>Demand</td><td id='detail-td2'>". num2($data['price']) . " <font color='blue'>$data[price_in]</font> $data[price_unit]</td></tr>";

	else:

	if (strlen($data[floor_area])>0):
		echo "<tr><td id='detail-td'>Floor Area</td><td id='detail-td2'>". $data['floor_area'] ." <font size='1'>$data[floor_sqft]</font></td></tr>";
	endif;

	if (strlen($data[area])>0):
		echo "<tr><td id='detail-td'>Lot/Land Area</td><td id='detail-td2'>". $data['area'] ." <font size='1'>$data[sq_ft]</font></td></tr>";
	endif;
	
	echo "<tr><td id='detail-td'>Demand</td><td id='detail-td2'>". num2($data['price']) . " <font color='blue'>$data[price_in]</font> $data[price_unit]</td></tr>";

	
endif;

	echo "</table>";


	echo "<div id='link' style='text-align:right;padding:5px'><a href='ad-details.php?CAT=$CAT&N=$npage&ID=". $data['rid'] ."'>property details »»</a></div>" ;

	echo "</td>";

	echo "</tr>";

	echo "</table>";

endwhile;

echo "</center>$ch";










		  endif;



		endif;





   ?>

	

		
		</td>
		


	</tr>
</table>
</center>



<? require_once("footer.ini.php") ; ?>