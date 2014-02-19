<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
include("config.ini.php");
include("common.php");
include("class.pagination.php");

$current = 3;


$PAGE_TITILE = 'Property List ' .  $PAGE_TITILE ;

require_once("header.ini.php") ;






$sql = "select a.* from ads a where rid>0  ";

if (strlen($_GET['CAT'])>0){
    $sql .= "and a.property_type='$_GET[CAT]' ";
}


if (strlen($_GET['property_type'])>0){
    $sql .= "and a.property_type='$_GET[property_type]' ";
}

if (strlen($_GET['location'])>0){
    $sql .= "and a.location='$_GET[location]' ";
}

if (strlen($_GET['offer'])>2){
    $sql .= "and a.offer_type='$_GET[offer]' ";
}

if (($_GET['beds'])>0){
    $sql .= "and a.bedrooms like '%$_GET[beds]%' ";
}

if (($_GET['baths'])>0){
    $sql .= "and a.bathrooms like '%$_GET[baths]%' ";
}


$data = $db->prepare($sql) ;

$data->execute();
$total_row = $data->rowCount();

if (isset($_GET['page'])){
	$page = (int) $_GET['page'];
}
$pagination = new Pagination();
if (isset($_GET[cat])){
	$pagination->setLink($PHP_SELF."?CAT=$_GET[CAT]&page=%s");
}else{
	$pagination->setLink($PHP_SELF."?page=%s");
}
$pagination->setPage($page);
$pagination->setSize(6);
$pagination->setTotalRecords($total_row);


$sql .= "order by a.posted_date desc, a.property_title " . $pagination->getLimitSql();



?>


   
    
			
<div id="maincontent">
	<div id="content">
		<h2 class="underline">Properties</h2>
				
        <?
            $temp = $db->prepare($sql);
            $temp->execute();
            
            if($temp->rowCount()==0){
                
                echo "<font size='+1'>No property is listed under $_GET[CAT]</font>";
            }
         
         
           
            while ($data = $temp->fetch()){
                $url = "property-details.php?ID=" .$data['rid'];
        
        ?>               
                
				<div class="list_properties">
					<div class="title_property2">
					   <h2><?php echo $data['property_title'];?></h2> <span class="star"><?php echo $data['offer_type'];?></span>
                    </div><!-- end .title_property2 -->
                    
					<div class="clear"></div>
					<div class="list_img"><img src="<?php echo ifimage($data['rid']);?>" alt="" style=" margin-bottom:15px;width:184px;height:119px;" /></div>
					<div class="list_text">
					   <!-- <img src="images/content/pp-nologo.gif" alt="" class="alignright"/> -->
					<strong>Demand:</strong>	<?php echo num2($data['price']);?> <?php echo punit($data['price_in']);?> <?php echo $data['price_unit'];?> <br />
					<br />
                        <strong><?php echo $data['property_type'];?></strong> <br />
                    	<?php echo $data['bedrooms'];?> beds | <?php echo $data['bathrooms'];?> baths <br />
                         Covered Area: <?php echo num0($data['floor_area']);?> <?php echo sm_size($data['floor_sqft']);?><br /> 
                         Plot Area: <?php echo num0($data['area']);?>&nbsp;<?php echo sm_size($data['sq_ft']);?><br /><br />
					
                    <span class="blue"><?php echo $data['location'];?></span><br />
                    
                             <a href="<?php echo $url;?>" class="featured">View full details</a>
                             
					</div><!-- end .list_text -->
					<div class="clear"></div>
                    
		 	    </div><!-- end .list_properties -->
          
          
          <?php } ?>
        
     
        <div id="pages" style="width:110px;margin:-25px 0 20px 0;float:right;">
    		 <?
              echo $pagination->create_links();
            ?>
            <div class="clear"></div>					
	   </div>
      <div class="clear"></div>          

        
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