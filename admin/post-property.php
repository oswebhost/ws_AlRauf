<? /*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/

require_once("../config.ini.php") ;
require_once("../common.php") ;

require_once("header.ini.php") ;


if (!isset($_POST['action'])): $_POST['action']='ADD'; endif;
if (!isset($PAGE)): $PAGE='1'; endif;

if ($_POST['go']=='SAVE'):

	$pro_fea =''; $com_fea='';

	$foo = $_POST['pro_feature'];
	for ($i=0; $i<count($foo); $i++):
		$pro_fea .= $foo[$i] . "|";
	endfor;

	$foo = $_POST['com_feature']; 
	for ($i=0; $i<count($foo); $i++):
		$com_fea .= $foo[$i] . "|";
	endfor;

	$pro_fea = substr($pro_fea,0, strlen($pro_fea)-1);
	$com_fea = substr($com_fea,0, strlen($com_fea)-1);

	$title = addslashes($_POST['property_title']);
	$price = addslashes($_POST['price']); 
	$price_max = addslashes($_POST['price_max']);
	$price_unit = addslashes($_POST['price_unit']); 
	$address = addslashes($_POST['address']); 
	$city = addslashes($_POST['city']); 
	$zipcode= addslashes($_POST['zipcode']); 
	$phone = addslashes($_POST['phone']); 
	$stories = addslashes($_POST['stories']); 
	$betroos = addslashes($_POST['bedrooms']); 
	$bathrooms = addslashes($_POST['bathrooms']); 
	$garage = addslashes($_POST['garage']); 
	$remarks = addslashes($_POST['remarks']); 
	$area = addslashes($_POST['area']); 
	$floor_area = addslashes($_POST['floor_area']); 
	$sq_ft = addslashes($_POST['sq_ft']); 
	$desc = addslashes($_POST['content']);
	$property_type = addslashes($_POST['property_type']);

	$agent_id = $_POST['agent_id'];

endif;




if ( $_POST['go']=='SAVE' and $_POST['action']=='ADD'):

	$postedon = time();
	$qry = "insert into ads (ad_status,projectid,property_title,posted_date,offer_type, price, price_in, price_unit, address, city, location, stories, bedrooms, bathrooms, garage, remarks, area, sq_ft, property_features, community_features,description,property_type,floor_area,floor_sqft,putonhome,price_max,agent_id) VALUES ('$ad_status', '$projectid', '$title','$postedon', '$offer_type', '$price', '$price_unit','$price_in', '$address', '$city', '$location','$stories', '$bedrooms', '$bathrooms', '$garage', '$remarks', '$area', '$sq_ft', '$pro_fea', '$com_fea','$desc','$property_type','$floor_area', '$floor_sqft','$putonhome','$price_max', '$agent_id')";
	mysql_query($qry) or die ("$qry--->>" . mysql_error());
	$ID = mysql_insert_id();
	$new_id = "$offer_type-$ID";
	mysql_query("update ads set property_code='$new_id' where rid='$ID'") or die (mysql_error());
	header("Location: add-images.php?ID=$ID");
	exit;
endif;

if ( $_POST['go']=='SAVE' and $_POST['action']=='EDIT'):
	$qry = "update ads set ad_status='$ad_status', projectid='$projectid', property_title='$property_title',offer_type='$offer_type', price='$price', price_unit='$price_unit', price_in='$price_in', address='$address', city='$city', location='$location', stories='$stories', bedrooms='$bedrooms', bathrooms='$bathrooms', garage='$garage', remarks='$remarks', area='$area', sq_ft='$sq_ft', property_features='$pro_fea', community_features='$com_fea', description='$desc', property_type='$property_type',floor_area='$floor_area', floor_sqft='$floor_sqft', putonhome='$putonhome', price_max='$price_max', agent_id='$agent_id' where rid='$_POST[ID]'";
	mysql_query($qry) or die ("$qry--->>" . mysql_error());
	header("location: pro-listing.php?PAGE=$PAGE");
	exit;
endif;


if ( $_REQUEST['action']=='DEL'):
	
	$q = mysql_query("delete from ads where rid='$_REQUEST[ID]' ") or die ( mysql_error() ) ;
	$q = mysql_query("select * from ads_images where propertyid='$_REQUEST[ID]'") or die ( mysql_error() ) ;	

	while ($data = mysql_fetch_array($q)):
		$file = trim( $data[image_name] );
		if (file_exists("$abpath/$file")):  unlink("$abpath/$file"); endif;
		
	endwhile;
	$q = mysql_query("delete from ads_images where propertyid='$_REQUEST[ID]'") or die (mysql_error());
	header("Location: pro-listing.php?PAGE=$PAGE");
	exit;
	
endif; 


if ($_REQUEST['action']=='EDIT' or $_REQUEST['action']=='DELETE'):
	$qry = mysql_query("select * from ads where rid='$_REQUEST[ID]'") or die (mysql_error());
	$data  = mysql_fetch_array($qry) ;
endif;





?>

<table width='100%'>
<tr>
	<td width='50%'><span class='pagehd'>Post Property Details</span></td>
	<td width='50%' style='padding-left:250px;'><A HREF="pro-listing.php?PAGE=<?echo $PAGE?>">Back</A></td>
</tr>
</table>

<div style='padding:5px;'></div>

<center>

<?
	if ($_POST['action']=="DELETE"):
		
		echo "<div id='link'><div id='head' style='border:1px solid;width:460px;padding:10px;'>Delete this Property? [<a href='post-property.php?ACTION=DEL&ID=$_REQUEST[ID]&PAGE=$PAGE'>Y E S</a>]&nbsp;&nbsp;&nbsp;[<a href='pro-listing.php?PAGE=$_REQUEST[PAGE]</a>]</div></div>";
		echo "<br/>";

	endif;


?>


<form name="agreeform" method="POST" action="<? echo $PHP_SELF;?>" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);">
	<input type="hidden" name="go" value="SAVE" />
	<input type="hidden" name="action" value="<? echo $action;?>" />
	<input type="hidden" name="ID" value="<? echo $_REQUEST[ID] ;?>" />
	

 <table border="1" cellspacing="0" style="border-collapse: collapse" cellpadding="4" bordercolor="#cccccc" width="90%">
		  

 <tr class="tbhead"> <td colspan='2' class="tbhead"  ><b>Property Information</b></td></tr>
	<tr>
		<td width='20%' id='post'>Property Listing Status *</td>
		<td width='70%'>
			<select name='ad_status' class='sele' style="width: 250px;">
				<option value='0' <? echo selected("0",$data["ad_status"]);?>>Normal</option>
				<option value='1' <? echo selected("1",$data["ad_status"]);?>>Featured/Main Project</option>
				<option value='4' <? echo selected("4",$data["ad_status"]);?>>Monthly Project</option>
				<option value='5' <? echo selected("5",$data["ad_status"]);?>>Newly/Upcoming</option>
				<option value='2' <? echo selected("2",$data["ad_status"]);?>>Hidden</option>
			</select>

		
		</td>
	</tr>



	<tr>
		<td id='post'>Property for *</td>
		<td >
		<select name='offer_type' alt="selecti|0" emsg='Please select a Offer Type form the list' class='sele' style="width: 250px;">
				<option value='0'>Select One</option>
				<option value='SALE' <? echo selected("SALE",$data["offer_type"]);?>>SALE</option>
				<option value='RENT' <? echo selected("RENT",$data["offer_type"]);?>>TOLET/RENT</option>

		</select>
		
		</td>
	</tr>

	<tr>
		<td id='post'>Title *</td>
		<td ><input id='ftxt' type='text' name='property_title' alt='length|5' emsg='Missing Data' value="<? echo $data["property_title"];?>"></td>
	</tr>

   <tr>
		<td id='post'>Property Type *</td>
		<td >
		<? echo property_type_box($data["property_type"]); ?>
		</select>
		</td>
	</tr>
	
	<tr>
		<td id='post'><label>Demand Rs *</label></td>
		<td >
		
		<input id='stxt' type='text' style='width:180px;' name='price' alt='length|2' emsg='Missing Data' value="<? echo $data["price"];?>"> 

		


		<select name='price_in' class='sele' alt="selecti|0" emsg='Please select form the list'>
			<option  value='0'>- -select one- -</option>
			<option value='K' <? echo selected("K",$data["price_in"]);?>>Lakh</option>
			<option value='M' <? echo selected("M",$data["price_in"]);?>>Crore</option>
            <option value='H' <? echo selected("H",$data["price_in"]);?>>Hazar</option>
			
		</select>

		<select name='price_unit' class='sele'>
				<option value=''></option>
				<option value='Daily'     <? echo selected("Daily",$data["price_unit"]);?>>Daily</option>
				<option value='Weekly'    <? echo selected("Weekly",$data["price_unit"]);?>>Weekly</option>
				<option value='Monthly'   <? echo selected("Monthly",$data["price_unit"]);?>>Monthly</option>
				<option value='Quarterly' <? echo selected("Quarterly",$data["price_unit"]);?>>Quarterly</option>
				<option value='Semi-Annually' <? echo selected("Semi-Annaully",$data["price_unit"]);?>>Semi-Annually</option>
		</select>
		</td>
	</tr>
	<tr>
		<td id='post'>Status / Remarks </td>
		<td ><input id='ftxt' type='text' name='remarks' value="<? echo $data["remarks"];?>"> </td>
	</tr>
 <tr> <td colspan='2' class="tbhead" ><b>Location</b></td></tr>

	<tr>
		<td id='post'>Address</td>
		<td ><input id='ftxt' type='text' name='address' value="<? echo $data["address"];?>"></td>
	</tr>
	<tr>
		<td id='post'>Area/Location *</td>
		<td ><? echo location_box($data["location"]);?></td>
	</tr>


 <tr> <td colspan='2' class="tbhead" ><b>Specification</b></td></tr>

	<tr>
		<td id='post'>Stories </td>
		<td ><input id='ntxt' type='text' name='stories' value="<? echo $data["stories"];?>"></td>
	</tr>
	<tr>
		<td id='post'>Bedrooms </td>
		<td ><input id='ntxt' type='text' name='bedrooms'  value="<? echo $data["bedrooms"];?>"></td>
	</tr>
	<tr>
		<td id='post'>Bathrooms </td>
		<td ><input id='ntxt' type='text' name='bathrooms'  value="<? echo $data["bathrooms"];?>"></td>
	</tr>
	<tr>
		<td id='post'>Garage </td>
		<td ><input id='ntxt' type='text' name='garage'  value="<? echo $data["garage"];?>"> No of cars can be park</td>
	</tr>
	
	
	<tr> 
		<td id='post'>Floor </td>
		<td ><input id='ntxt' type='text' name='floor_area'  value="<? echo $data["floor_area"];?>" />
		<select name='floor_sqft' class='sele'>
		<option value=' '></option>
      	<option value='Square Meters' <? echo selected("Square Meters",$data["floor_sqft"]);?>>Square Meters</option>
		<option value='Square Feets' <? echo selected("Square Feets",$data["floor_sqft"]);?>>Square Feets</option>
		<option value='Hectares' <? echo selected("Hectares",$data["floor_sqft"]);?>>Acres</option>

		</select>
		</td>
	</tr>

	<tr>
		<td id='post'>Covered Area*</td>
		<td ><input id='ntxt' type='text' name='area'  value="<? echo $data["area"];?>">
		<select name='sq_ft' class='sele'>
		<option value=' '></option>
		<option value='Square Meters' <? echo selected("Square Meters",$data["sq_ft"]);?>>Square Meters</option>
		<option value='Square Feets' <? echo selected("Square Feets",$data["sq_ft"]);?>>Square Feets</option>
		<option value='Hectares' <? echo selected("Hectares",$data["sq_ft"]);?>>Acres</option>
		
		</select>
		</td>
	</tr>

	
  <tr> <td colspan='2' class="tbhead" ><b>Other Property Features</b></td></tr>
 <tr> <td colspan='2' align='center'>
 
 <table width='80%' cellpadding='5' border='0'>
	<tr bgcolor='#E2E2E2'>
		<td width='50%' valign='top'><b>Property Features</b></td>
		<td width='50%' valign='top'><b>Communit Features</b></td>
	</tr>
	<tr>
		<td valign='top'>
			<?  $pro_array = explode("|", $data['property_features']);
				$qry = mysql_query("select * from property_features order by pro_feature") or die (mysql_error());
				while ($dd = mysql_fetch_array($qry) ):
					echo "<input type='checkbox' class='chk' name='pro_feature[]' value='". $dd['rid'] ."'" ;
					if (in_array($dd['rid'], $pro_array)):
						echo " checked" ;
					endif;
					echo ">";
					echo $dd["pro_feature"] . "<br/>";
				endwhile;
			?>
		</td>

		<td valign='top'>
			<?  $com_array = explode("|", $data['community_features']);
				$qry = mysql_query("select * from community_features order by com_feature") or die (mysql_error());
				while ($dd = mysql_fetch_array($qry) ):
					echo "<input type='checkbox' class='chk' name='com_feature[]' value='". $dd['rid'] . "'";
					if (in_array($dd["rid"], $com_array)):
						echo " checked" ;
					endif;
					echo ">";
					echo $dd["com_feature"] . "<br/>";
				endwhile;
			?>
		
		</td>
	</tr>
 </table>
 
 </td></tr>

 <tr> <td colspan='2' class="tbhead" ><b>Description</b></td></tr>

<td colspan='2'>


        <?  $CONTENT="content"; $_content= stripslashes(trim($data[description]));
           $Height="300px";$toolbar=1;
           include("spaw.ini.php"); 
        ?>
      
	  
</td>
</tr>
<? if ($action!='DELETE'): ?>

 <tr> <td colspan='2' class="tbhead"  height='25' align='center'>

	<input type="submit" value="««  Submit  »»" style="width:120px;height:25px;" class="bt">
 </td></tr>
<? endif; ?>
</table>

</form>
</center>


<div style='padding:15px;'></div>
<? require_once("footer.ini.php") ; ?>