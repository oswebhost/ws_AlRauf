<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
include("config.ini.php");
include("common.php");


$current = 4;
require_once("header.ini.php") ;



?>

<script type="text/javascript" src="js/submit_property.js"></script>
 
<div id="maincontent">
	<div id="content">
		<h2 class="underline">Submit <span class="blue">Property</span></h2>



<form id="contactform"  action="" >


            <h4 class='blue'>Personal Information</h4>
            	   
            <div class="left">I am *</div>
                <div class="right" style="padding-top: 10px; padding-bottom:9px;">
                    <select name='iam' id="iam" style="">
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
                    <input type='text' name='pname' id="pname" value="<? echo $_POST["pname"];?>" /><span class="error2" id="pname_error">missing ! </span> 
                 </div>
                <div class="clear"></div>
                    
                    
            	<div class="left">Email Address *</div>
            	<div class="right"><input type='text' name='pemail' id="pemail" value="<? echo $_POST["pemail"];?>" /><span class="error2" id="pemail_error">missing ! </span> </div>
            	<div class="clear"></div>
            
            	<div class="left">Phone *</div>
            	<div class="right"><input type='text' name='pphone' id="pphone"  value="<? echo $_POST["pphone"];?>" /><span class="error2" id="pphone_error">missing ! </span> </div>
            	<div class="clear"></div>
            	
                <div class="left">Address</div>
            	<div class="right"><input  type='text' name='paddress' id="paddress" value="<? echo $_POST["paddress"];?>" /></div>
            	<div class="clear"></div>
            	
                <div class="left">City</div>
            	<div class="right"><input type='text' name='pcity' id="pcity" value="<? echo $_POST["pcity"];?>" /></div>
                <div class="clear"></div>
            	
            	
            <br /><br />
            
            <h4 class='blue'>Property Details</h4>
            
            		<div class="left">Property for *</div>
                    
            		<div class="right" style="padding-top: 10px; padding-bottom:9px;">
                		<select style="" name='offer_type'  id="offer_type" >
                				<option value='0'>Select One</option>
                				<option value='SALE' <? echo selected("SALE",$_POST["offer_type"]);?>>SALE</option>
                				<option value='TOLET' <? echo selected("TOLET",$_POST["offer_type"]);?>>TOLET/RENT</option>
                        </select><span class="error2" id="offer_error">Please select one! </span> 
                    </div>
            	    <div class="clear"></div>
                
            		<div class="left">Title *</div>
            		<div class="right"><input type='text' name='property_title' id="property_title" value="<? echo $_POST["property_title"];?>" /><span class="error2" id="property_title_error">missing ! </span> </div>
            	    <div class="clear"></div>
                
                
            		<div class="left">Property Type *</div>
            		<div class="right" style="padding-top: 10px; padding-bottom:9px;"><? echo property_type_box($_POST["property_type"]); ?></select><span class="error2" id="property_type_error">Please select one! </span></div>
                    <div class="clear"></div>
            
            
            		<div class="left">Demand Rs *</div>
            		<div class="right"><input style="width:100px;" type='text' name='price' id='price' value="<? echo $_POST["price"];?>" />
            		&nbsp;
            		<select name='price_in' id="price_in" style="width: 80px;">
            			<option  value='0'>- -select one- -</option>
                        <option value='Lahk'  <? echo selected("Lahk",$_POST["price_in"]);?>>Lakh</option>
            			<option value='Crore' <? echo selected("Crore",$_POST["price_in"]);?>>Crore</option>
                        <option value='Hazar' <? echo selected("Hazar",$_POST["price_in"]);?>>Hazar</option>
            		</select>
            		&nbsp;
            		<select name='price_unit' style="width: 120px;">
            				<option value=''></option>
            				<option value='Daily'     <? echo selected("Daily",$_POST["price_unit"]);?>>Daily</option>
            				<option value='Weekly'    <? echo selected("Weekly",$_POST["price_unit"]);?>>Weekly</option>
            				<option value='Monthly'   <? echo selected("Monthly",$_POST["price_unit"]);?>>Monthly</option>
            				<option value='Quarterly' <? echo selected("Quarterly",$_POST["price_unit"]);?>>Quarterly</option>
            				<option value='Semi-Annually' <? echo selected("Semi-Annaully",$_POST["price_unit"]);?>>Semi-Annually</option>
            		</select><span class="error2" id="price_error">missing ! </span> 
                    </div>
                    <div class="clear"></div>
            
            
                    <div class="left">Property Location *</div>
                   	<div class="right"><input type='text' id="address" name='address' value="<? echo $_POST["address"];?>"/><span class="error2" id="address_error">missing ! </span></div>
            	    <div class="clear"></div>
            
            
                    <div class="left">Stories *</div>
                   	<div class="right"><input style="width:100px;" type='text' name='stories' id="stories" value="<? echo $_POST["stories"];?>" /><span class="error2" id="stories_error">missing ! </span></div>
                    <div class="clear"></div>
                    
                    <div class="left">Bedrooms *</div>
                   	<div class="right"><input style="width:100px;" type='text' name='bedrooms' id="bedrooms" value="<? echo $_POST["bedrooms"];?>" /><span class="error2" id="bedrooms_error">missing ! </span></div>
                    <div class="clear"></div>
                    
                    <div class="left">Bathrooms *</div>
                   	<div class="right"><input style="width:100px;" type='text' name='bathrooms' id="bathrooms" value="<? echo $_POST["bathrooms"];?>" /><span class="error2" id="bathrooms_error">missing ! </span></div>
                    <div class="clear"></div>
                    
                    <div class="left">Garage *</div>
                   	<div class="right"><input style="width:100px;" type='text' name='garage' id="garage" value="<? echo $_POST["garage"];?>" /> No of cars can be park <span class="error2" id="garage_error">missing ! </span></div>
                    <div class="clear"></div>
                    
                    <div class="left">Age *</div>
                   	<div class="right"><input style="width:100px;" type='text' name='age' id="age" value="<? echo $_POST["age"];?>" /> No of years <span class="error2" id="age_error">missing ! </span></div>
                    <div class="clear"></div>
                    
                    <div class="left">Covered Area *</div>
                   	<div class="right"><input style="width:100px;" type='text' name='floor_area' id="floor_area" value="<? echo $_POST["floor_area"];?>" />
                    <select name='floor_sqft' style="width:125px;" id="floor_sqft">
                        <option value='Square Yards' <? echo selected("Square Meters",$_POST["floor_sqft"]);?>>Square Yards</option>
                        <option value='Square Feets' <? echo selected("Square Feets",$_POST["floor_sqft"]);?>>Square Feets</option>
                        <option value='Acres' <? echo selected("Acres",$_POST["floor_sqft"]);?>>Acres</option>
                    </select><span class="error2" id="floor_area_error">missing ! </span>
                    </div>
                    <div class="clear"></div>
                    
                    <div class="left">Plot/Land Area *</div>
                   	<div class="right"><input style="width:100px;" type='text' name='area' id="area" value="<? echo $_POST["area"];?>" />
                    <select name='sq_ft' style="width:125px;" id="sq_ft">
                        <option value='Square Yards' <? echo selected("Square Meters",$_POST["sq_ft"]);?>>Square Yards</option>
                        <option value='Square Feets' <? echo selected("Square Feets",$_POST["sq_ft"]);?>>Square Feets</option>
                        <option value='Acres' <? echo selected("Acres",$_POST["sq_ft"]);?>>Acres</option>
                    </select><span class="error2" id="area_error">missing ! </span>
            	   </div>
                
                
            
     
            <div class="clear"></div>
            
            <label>Description</label> <span class="error2" id="content_error">missing ! </span><br />
            <textarea rows="8" name="content" id="content" style='width:100%'><? echo stripslashes(trim($_POST[description])) ?></textarea>
            
            <div class="clear"></div>
            
            
            
            <input type="submit" name="submit" class="button" value="Submit Details"/><br />
            	
             
</form>
  <div class="clear"></div>


		
			<br /><br />
			
			


	</div><!-- end #content -->
	
	<div class="sidebar_right">
		<div class="sidebar">
		   
            	<h2 class="underline">Search <span class="blue">Property</span></h2>
                        <?php include("search-list.ini.php");?>
	       </div><!-- end #sidebar -->
	</div><!-- end #sidebar_right -->
	
	<div class="clear"></div>
    
    
    
                    
</div><!-- end #maincontent -->


<? require_once("footer.ini.php") ; ?>