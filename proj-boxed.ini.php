<table width='100%' cellpadding='3' cellspacing='0' border='0'>
	<tr>

	<?

		$q = mysql_query("select * from ads where  ad_status='1' order by rand() limit 1") or die ("2" . mysql_error());	


		
		$d2 = mysql_fetch_array($q) ;

		$url = "<a href='ad-details.php?ID=$d2[rid]&C=&P=HOME'> ";

		$showid= $d2[rid];

		$logo = project_by($d2[projectid],"LOGO");

		$project = project_by($d2[projectid],"NAME") ;

		$offer = strtolower($d2["offer_type"])  . ".gif" ;



		$ch = "<div style='padding:2px;'></div>\n\n";

		echo "<td  valign='top' colspan='2' >";

		echo "<div style='padding-top:2px;padding-bottom:0px;'><font color='#000000' size='3'><strong>$url". stripslashes($d2[property_title])."</a></strong></font></div>";
		
		echo "</td></tr>";

		echo "<tr><td valign='top'>";

		echo $d2[property_type] ." <b>". $d2[offer_type] ."</b>$ch<BR>";
			
		echo "<table width='100%' border='0' cellpadding='5' cellspacing='0'>";

		if ($d2[offer_type]=='RENT'):

			 if (strlen($d2[location])>0):
				echo "<tr><td id='detail-td'>Area</td><td id='detail-td2'>$d2[location]</td></tr>";
			endif;

			if (strlen($d2[floor_area])>0):
				echo "<tr><td id='detail-td'>Floor</td><td id='detail-td2'>". $d2['floor_area'] ." <font size='1'>$d2[floor_sqft]</font></td></tr>";
			endif;

			if (strlen($d2[area])>0):
				echo "<tr><td id='detail-td'>Covered Area</td><td id='detail-td2'>". $d2['area'] ." <font size='1'>$d2[sq_ft]</font></td></tr>";
			endif;


		  echo "<tr><td id='detail-td'>Demand</td><td id='detail-td2'>". num2($d2['price']) ." <font color='blue'>$d2[price_in]</font> $d2[price_unit]</td></tr>";

		else:

		 if (strlen($d2[address])>0):
		  echo "<tr><td id='detail-td'>Address</td><td id='detail-td2'>$d2[address]</td></tr>";
		endif;

			if (strlen($d2[location])>0):
				echo "<tr><td id='detail-td'>Area</td><td id='detail-td2'>$d2[location]</td></tr>";
			endif;


			if (strlen($d2[floor_area])>0):
				echo "<tr><td id='detail-td'>Floor Area</td><td id='detail-td2'>". $d2['floor_area'] ." <font size='1'>$d2[floor_sqft]</font></td></tr>";
			endif;

			if (strlen($d2[area])>0):
				echo "<tr><td id='detail-td'>Lot/Land Area</td><td id='detail-td2'>". $d2['area'] ." <font size='1'>$d2[sq_ft]</font></td></tr>";
			endif;
			
			echo "<tr><td id='detail-td'>Demand</td><td id='detail-td2'>". num2($d2['price']) . " <font color='blue'>$d2[price_in]</font> $d2[price_unit]</td></tr>";

		endif;

	
	

		echo "</table>";






		 



		
		 

		

		

		echo "<div id='link' style='float:right;text-align:right;'>$url view details</a></div>";



	?>

	</td>

	<td width='30%' align='center' valign="top">

	<? echo "<img src='pro_images/main_" . getimage($d2["rid"]) . "' height='160' width='140' style='border:1px solid #000000 padding:4px;'>"; ?>

	</td>



	</tr>

</table>