<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
 ob_start();
session_start() ;
$userid = $_SESSION['userid'];

$curpage="property";

require_once("common.php") ;
require_once("header.ini.php") ;


$cap = getprocat($CAT);
$category = getprocat_menu($CAT) ;



$Today=time();
$offer='SALE';
$ch="\n";
$sp = "\n\n<div style='padding:3px;'></div>\n\n";
$ch_combo ="<option value=''></opion>";


//if ($_POST[C]==''): unset($C); else: $C=$_POST[C]; endif;
//$PAGE = $_POST[N];


if (strlen($cap)>0):
	$query="select * from ads where property_type='$cap' order by posted_date desc";
else:	
	$query="select * from ads order by posted_date desc";
endif;

$pageNav  ="<form style='padding:0;margin:0px;' method='post' action='$PHP_SELF'>\n";
$pageNav .="<input type='hidden' name='CAT' value='$CAT'>\n\n";
$pageNav .= "<select class='bt' name='PAGE' onChange='this.form.submit();' style=\"width:50px;height:20px;font-size:11px;\" >\n" ;

$result= mysql_query($query) or die( mysql_error() );
$number_rows = mysql_num_rows($result);

if((!$PAGE) || (is_numeric($PAGE) == false) || ($PAGE < 0) || ($PAGE > $number_rows)) {
      $PAGE = 1; //default
 } 
$total_pages = ceil($number_rows/$NO_ROWS) ;
$set_limit 	= $PAGE * $NO_ROWS - ($NO_ROWS);



if ($total_pages>1): 
   for ($i=1; $i<=$total_pages; $i++):
	 $X++;
	 $pp = ($i<10? "0$i" : $i) ;
		$pageNav .= "<option value='$i' ";
		if ($i==$PAGE) : $pageNav .= " selected " ; endif;
		$pageNav .= ">$pp </option>\n";
	endfor;	

	$pageNav .= "</select>\n\n</form>\n\n";
endif;



$qry = mysql_query("$query LIMIT  $set_limit,$NO_ROWS") or die (mysql_error());


?>
<center>
<table width='980' cellpadding='0' cellspacing='0' border='0'>
	<tr>
		<td valign='top' width='730' style='padding-right:12px;'>
		<? box_top_square("100%"); ?>

			

		<table border="0" width="100%">
		<tr align="left">
		  <td width="100%"  colspan='2' valign="top"><h3 style='margin-bottom:0px;'>Properties <FONT SIZE="2" COLOR="red"><?echo  (strlen($category)>0? "[$category]": "") ;?></FONT></h3> </td>
		</tr>
		<? if($total_pages>1): ?>
		 <tr>
		  <td width="45%" align="right" ><FONT style='font-size:10px;'>Page No:</FONT></td>
		  <td width="65%" align="left"  ><? echo $pageNav; ?> </td>
		 </tr>
		<? endif;?>

		</table> 

<center>
<?

while ($data = mysql_fetch_array($qry) ):
  
  $logo = project_by($data[projectid],"LOGO");
  $project = project_by($data[projectid],"NAME") ;
  $offer = strtolower($data["offer_type"])  . ".gif" ;

  if ($data["ad_status"]=='1'):
	echo "<table width='100%' cellpadding='2' border='0' style='border:5px solid #FFCC66;background:url(images/box-bg.jpg) repeat-x;'>$ch";
    echo "<tr>$ch";
	echo "<td width='60%' height='35' colspan='2' height='25' style='background:url($logo) no-repeat top right;'>"   ;
  else:
	echo "<table width='100%' cellpadding='2' border='0' style='border:2px solid #3366CC;background:#FBFDFB'>$ch";
	echo "<tr>$ch";
	echo "<td width='60%' height='35'  colspan='2' height='25'>"   ;
  endif;

	
  
   if ($data["ad_status"]=='1'):
	  echo "<span id='ad-head'>" . stripslashes($data["property_title"]) . "</span>";
   else:
	  echo "<span id='ad-head'>" . stripslashes($data["property_title"]) . "</span> ";
   endif;

  echo "</td>$ch";

  echo "<td width='20%' valign='top' rowspan='2'>";
  
  echo "<table width='100%' border='0'>";
  echo "<tr>";

 echo "<td width='100%' style='padding-left:5px;padding-right:5px;'>";
 echo "<div style='height:35px;padding-left:10px;padding-top:1px;font-size:18px;margin-bottom:5px;'>";
 echo "<img src='images/$offer' border='0'>";
 echo "</div>";

 echo "<img src='images/spacer.gif' width='65' height='1' border='0'><br>";
 if ($data["stories"]>0):
	  echo "<div style='background:url(images/stories.gif) no-repeat;height:35px;padding-left:40px;padding-top:1px;font-size:18px;margin-bottom:5px;'>";
	  echo "<b>" . $data["stories"] . "</b>" ;
	  echo "</div>";
  endif;

  if ($data["bedrooms"]>0):
	  echo "<div style='background:url(images/bedrooms.gif) no-repeat;height:35px;padding-left:40px;padding-top:1px;font-size:18px;margin-bottom:5px;'>";
	  echo "<b>" . $data["bedrooms"] . "</b>" ;
	  echo "</div>";
  endif;
if ($data["bathrooms"]>0):
	  echo "<div style='background:url(images/bathroom.gif) no-repeat;height:35px;padding-left:40px;padding-top:1px;font-size:18px;margin-bottom:5px;'>";
	  echo "<b>" . $data["bathrooms"] . "</b>" ;
	  echo "</div>";
  endif;

if ($data["garage"]>0):
	  echo "<div style='background:url(images/carpark.gif) no-repeat;height:35px;padding-left:40px;padding-top:1px;font-size:18px;margin-bottom:5px;'>";
	  echo "<b>" . $data["garage"] . "</b>" ;
	  echo "</div>";
  endif;


  echo "</td></tr></table>";
  



  echo "</td></tr>$ch";

  echo "<tr>$ch";
  if (ifimage($data['rid'])>0):	
	  echo "<td width='120' valign='top' rowspan='2' ><img src='pro_images/th_". getimage($data['rid']) ."' border='0'></td>";
  else:
	  echo "<td rowspan='2' ><img src='images/spacer.gif' width='115' height='1' border='0'></td>";
  endif;

  echo "<td  width='100%' valign='top' height='100' >";
  echo "<table width='100%' cellpadding='5' cellspacing='1' border='0'>";
  echo "<tr><td id='detail-td'>Property Type</td><td id='detail-td2'>$data[property_type]</td></tr>";
  if (strlen($data[address])>0):
	  echo "<tr><td id='detail-td'>Address</td><td id='detail-td2'>$data[address]</td></tr>";
  endif;
  if (strlen($data[location])>0):
	echo "<tr><td id='detail-td'>Area</td><td id='detail-td2'>$data[location]</td></tr>";
  endif;
 if (strlen($data[floor_area])>0):
	echo "<tr><td id='detail-td'>Floor Area</td><td id='detail-td2'>". num0($data[floor_area]) ." <font size='1'>$data[floor_sqft]</font></td></tr>";
 endif;
  if (strlen($data[area])>0):
		echo "<tr><td id='detail-td'>Lot/Land Area</td><td id='detail-td2'>". num0($data[area]) ." <font size='1'>$data[sq_ft]</font></td></tr>";
  endif;
  if (strlen($project)>0):	
	echo "<tr><td id='detail-td'>Project/Developed by</td><td id='detail-td2'>$project</td></tr>";
  endif;
  if ($data[offer_type]=='RENT'):
  	  echo "<tr><td id='detail-td'>Rent</td><td id='detail-td2'>". num2($data[price]) ." <font color='blue'>$data[price_in]</font> $data[price_unit]</td></tr>";
  else:
	  echo "<tr><td id='detail-td'>Price</td><td id='detail-td2'>". num2($data[price]) ." <font color='blue'>$data[price_in]</font></td></tr>";
  endif;
  echo "</table>";

  echo "</td>";
  echo "</tr>";
  echo "<tr><td align='center'>";
 echo "<div id='link'><a href='ad-details.php?CAT=$CAT&N=$npage&ID=". $data['rid'] ."'> view details...</a></div>" ;
  echo "</td></tr></table>$sp";
endwhile;
echo "</center>$ch";

?>
<BR><BR>
<? if($total_pages>1): ?>
<table border="0" width="100%">
 <tr>
	  <td width="45%" align="right" ><FONT style='font-size:10px;'>Page No:</FONT></td>
	  <td width="65%" align="left"  ><? echo $pageNav?> </td>
  </tr>
</table> 
<? endif; ?>

<? box_bottom();?>

		
		</td>
		


		<td valign='top' width='230' style='padding-top:0px;'>
			
				<? include("pro-category-menu.ini.php"); ?>
			
		</td>	
	</tr>
</table>
</center>

<? require_once("footer.ini.php") ; ?>