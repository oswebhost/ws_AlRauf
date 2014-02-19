


<form id="contactform"  action="" >


<h4 class='blue'>Personal Information</h4>
	   
<div class="left">I am *</div>
    <div class="right" style="padding-top: 10px; padding-bottom:9px;">
        <select name='iam' style="">
    		<option value='0'>Select One</option>
    		<option value='Property Owner' <? echo selected("Property Owner",$_POST["iam"]);?>>Property Owner</option>
    		<option value='Real Estate Agent' <? echo selected("Real Estate Agent" ,$_POST["iam"]);?>>Real Estate Agent</option>
    		<option value='Other' <? echo selected("Other",$_POST["iam"]);?>>Other</option>
        </select>
         <span class="error2" id="iam_error">Please select one ! </span>
    </div>
                    
    <div class="clear"></div>
      
    <div class="left">Name * </div>
    <div class="right">
        <input type='text' name='pname' value="<? echo $_POST["pname"];?>" /><span class="error2" id="pname_error">missing ! </span> 
     </div>
    <div class="clear"></div>
        
        
	<div class="left">Email Address *</div>
	<div class="right"><input type='text' name='pemail' value="<? echo $_POST["pemail"];?>" /><span class="error2" id="email_error">missing ! </span> </div>
	<div class="clear"></div>

	<div class="left">Phone *</div>
	<div class="right"><input type='text' name='pphone'  value="<? echo $_POST["pphone"];?>" /><span class="error2" id="pphone_error">missing ! </span> </div>
	<div class="clear"></div>
	
    <div class="left">Address</div>
	<div class="right"><input  type='text' name='paddress' value="<? echo $_POST["paddress"];?>" /></div>
	<div class="clear"></div>
	
    <div class="left">City</div>
	<div class="right"><input type='text' name='pcity' value="<? echo $_POST["pcity"];?>" /></div>
    <div class="clear"></div>
	
	
<br /><br />

<h4 class='blue'>Property Details</h4>

		<div class="left">Property for *</div>
        
		<div class="right" style="padding-top: 10px; padding-bottom:9px;">
    		<select style="" name='offer_type' >
    				<option value='0'>Select One</option>
    				<option value='SALE' <? echo selected("SALE",$_POST["offer_type"]);?>>SALE</option>
    				<option value='TOLET' <? echo selected("TOLET",$_POST["offer_type"]);?>>TOLET/RENT</option>
            </select><span class="error2" id="offer_error">Please select one! </span> 
        </div>
	    <div class="clear"></div>
    
		<div class="left">Title *</div>
		<div class="right"><input type='text' name='property_title' value="<? echo $_POST["property_title"];?>" /><span class="error2" id="property_title_error">missing ! </span> </div>
	    <div class="clear"></div>
    
    
		<div class="left">Property Type *</div>
		<div class="right" style="padding-top: 10px; padding-bottom:9px;"><? echo property_type_box($_POST["property_type"]); ?></select><span class="error2" id="property_type_error">Please select one! </span></div>
        <div class="clear"></div>


		<div class="left">Demand Rs *</div>
		<div class="right"><input style="width:100px;" type='text' name='price'  value="<? echo $_POST["price"];?>" />
		&nbsp;
		<select name='price_in' style="width: 80px;">
			<option  value='0'>- -select one- -</option>
            <option value='K' <? echo selected("K",$_POST["price_in"]);?>>Lakh</option>
			<option value='M' <? echo selected("M",$_POST["price_in"]);?>>Crore</option>
            <option value='H' <? echo selected("H",$_POST["price_in"]);?>>Hazar</option>
		</select>
		&nbsp;
		<select name='price_unit' style="width: 120px;">
				<option value=''></option>
				<option value='Daily'     <? echo selected("Daily",$_POST["price_unit"]);?>>Daily</option>
				<option value='Weekly'    <? echo selected("Weekly",$_POST["price_unit"]);?>>Weekly</option>
				<option value='Monthly'   <? echo selected("Monthly",$_POST["price_unit"]);?>>Monthly</option>
				<option value='Quarterly' <? echo selected("Quarterly",$_POST["price_unit"]);?>>Quarterly</option>
				<option value='Semi-Annually' <? echo selected("Semi-Annaully",$_POST["price_unit"]);?>>Semi-Annually</option>
		</select><span class="error2" id="offer_error">missing ! </span> 
        </div>
        <div class="clear"></div>


        <div class="left">Property Location *</div>
       	<div class="right"><input type='text' name='address' value="<? echo $_POST["address"];?>"/><span class="error2" id="address_error">missing ! </span></div>
	    <div class="clear"></div>




        <div class="left">Stories *</div>
       	<div class="right"><input style="width:100px;" type='text' name='stories' value="<? echo $_POST["stories"];?>" /><span class="error2" id="stories_error">missing ! </span></div>
        <div class="clear"></div>
        
        <div class="left">Bedrooms *</div>
       	<div class="right"><input style="width:100px;" type='text' name='bedrooms' value="<? echo $_POST["bedrooms"];?>" /><span class="error2" id="bedrooms_error">missing ! </span></div>
        <div class="clear"></div>
        
        <div class="left">Bathrooms *</div>
       	<div class="right"><input style="width:100px;" type='text' name='bathrooms' value="<? echo $_POST["bathrooms"];?>" /><span class="error2" id="bathrooms_error">missing ! </span></div>
        <div class="clear"></div>
        
        <div class="left">Garage *</div>
       	<div class="right"><input style="width:100px;" type='text' name='garage' value="<? echo $_POST["garage"];?>" /> No of cars can be park <span class="error2" id="garage_error">missing ! </span></div>
        <div class="clear"></div>
        
        <div class="left">Age *</div>
       	<div class="right"><input style="width:100px;" type='text' name='age' value="<? echo $_POST["age"];?>" /> No of years <span class="error2" id="age_error">missing ! </span></div>
        <div class="clear"></div>
        
        <div class="left">Covered Area *</div>
       	<div class="right"><input style="width:100px;" type='text' name='floor_area'  value="<? echo $_POST["floor_area"];?>" />
        <select name='floor_sqft' style="width:125px;">
            <option value='Square Meters' <? echo selected("Square Meters",$_POST["floor_sqft"]);?>>Square Yards</option>
            <option value='Square Feets' <? echo selected("Square Feets",$_POST["floor_sqft"]);?>>Square Feets</option>
            <option value='Hectares' <? echo selected("Hectares",$_POST["floor_sqft"]);?>>Acres</option>
        </select><span class="error2" id="floor_area_error">missing ! </span>
        </div>
        <div class="clear"></div>
        
        <div class="left">Plot/Land Area *</div>
       	<div class="right"><input style="width:100px;" type='text' name='area' value="<? echo $_POST["area"];?>" />
        <select name='sq_ft' style="width:125px;">
            <option value='Square Meters' <? echo selected("Square Meters",$_POST["sq_ft"]);?>>Square Yards</option>
            <option value='Square Feets' <? echo selected("Square Feets",$_POST["sq_ft"]);?>>Square Feets</option>
            <option value='Hectares' <? echo selected("Hectares",$_POST["sq_ft"]);?>>Acres</option>
        </select><span class="error2" id="area_error">missing ! </span>
	   </div>
    
    

<div class="left" style="width:250px;"><b>Property Features</b></div>
<div class="right" style="width:250px;padding-top:12px;padding-bottom:12px;"><b>Commnunit Features</b></div>
<div class="clear"></div>


<div class="left" style="width:250px;border:0">
	<?  
		$qry = $db->prepare("select * from property_features order by pro_feature");
		$qry->execute();
        while ($dd = $qry->fetch() ):
			echo "<input type='checkbox' name='pro_feature[]' value='". $dd['rid'] ."'" ;
			echo ">&nbsp;&nbsp;";
			echo $dd["pro_feature"] . "<br/>";
		endwhile;
	?>
 </div>


	<div class="right" style="width:250px;padding-top:10px;border:0">
    
		<? 
			$qry = $db->prepare("select * from community_features order by com_feature");
            $qry->execute();
			while ($dd = $qry->fetch() ):
				echo "<input type='checkbox' name='com_feature[]' value='". $dd['rid'] . "'";
				echo ">&nbsp;&nbsp;";
				echo $dd["com_feature"] . "<br/>";
			endwhile;
		?>
	
	</div>
 
<div class="clear"></div>

<label>Description</label> <span class="error2" id="content_error">missing ! </span><br />
<textarea rows="8" name="content" style='width:100%'><? echo stripslashes(trim($_POST[description])) ?></textarea>

<div class="clear"></div>



<input type="submit" name="submit" class="button" value="Submit Details"/><br />
	
 
</form>



