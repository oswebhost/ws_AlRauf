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
$pagination->setSize(12);
$pagination->setTotalRecords($total_row);


$sql .= "order by a.posted_date desc, a.property_title " . $pagination->getLimitSql();


?>


<div id="maincontent">
	<div id="content" class="full">
		<h2 class="underline">All Properties</h2>
				
        <?
            $temp = $db->prepare($sql);
            $temp->execute();
           
            while ($data = $temp->fetch()){
                $url = "property-details.php?ID=" .$data['rid'];
        
        ?>               
                
			<ul class="four_column">
                
                 <?
                   
                                
                    $temp = $db->prepare($sql);
                    $temp->execute();
                   
                    
                    while ($data = $temp->fetch()){
                        $url = "property-details.php?ID=" .$data['rid'];
                        
                ?>
                 	<li>
					  <img src="<?php echo ifimage($data['rid']);?>" alt="" />
					  <h6><a href="<?php echo $url;?>"><?php echo trim($data['property_title']) ."<br />" . $data['location'];?></a></h6>
					  <ul class="box_text">
                        <li><span class="left">For:</span>  <?php echo $data['offer_type'];?></li>
					  	<li><span class="left">Beds:</span> <?php echo $data['bedrooms'];?> bed</li>
						<li><span class="left">Baths:</span> <?php echo $data['bathrooms'];?> bath</li>
						<li><span class="left">Covered Area:</span> <?php echo num0($data['floor_area']);?>&nbsp;<?php echo sm_size($data['floor_sqft']);?></li>
						<li><span class="left">Plot Area:</span> <?php echo num0($data['area']);?>&nbsp;<?php echo sm_size($data['sq_ft']);?></li>
                        <li><span class="left">Demand:</span>	<?php echo $data['price'];?> <?php echo punit($data['price_in']);?> <?php echo $data['price_unit'];?></li>
					  </ul>				
					</li>
        		
                
                 <?php } ?>
					
				</ul>
          
          
          <?php } ?>
        <div class="clear"></div>          

     
        <div id="pages" style="width:110px;margin:-25px 0 20px 0;float:right;">
    		 <?
              echo $pagination->create_links();
            ?>
            <div class="clear"></div>					
	   </div>
      <div class="clear"></div>          

        
	</div><!-- end #content -->
	
    
  
	
	<div class="clear"></div>
    
    
                    
</div><!-- end #maincontent -->








<? require_once("footer.ini.php") ; ?>