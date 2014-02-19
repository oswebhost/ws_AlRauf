<?php
include("config.ini.php");
include("common.php");

$current = 1;

$PAGE_TITILE = "Welcome";

include("header.ini.php");
?>



			<!-- BEGIN SLIDE -->
			<div id="slider_container">
			<div id="slideshow_navigation">
			<div id="pager"></div>
			</div><!-- end slideshow navigation -->
				<div id="slideshow">  
                <?
                    $sql="select a.*,i.image_name,i.main from ads a, ads_images i where
                            a.rid=i.propertyid and i.main='1' order by a.posted_date desc, 
                                a.property_title,rand() limit 5";
                                
                    $temp = $db->prepare($sql);
                    $temp->execute();
                   
                    while ($data = $temp->fetch()){
                        $url = "property-details.php?ID=" .$data['rid'];
                        
                ?>

					<div class="cycle">
						<img src="pro_images/<?php echo $data['image_name'];?>" alt="" />
						<div class="farme-slide-text">
							<ul class="slide-text">
								<li><span class="left">Property Type:</span> <?php echo $data['property_type'];?></li>
								<li><span class="left">Address:</span>	<?php echo trim($data['city']) ." " . $data['location'];?></li>
								<li><span class="left">Covered Area:</span>	<?php echo num0($data['floor_area']);?>&nbsp;<?php echo sm_size($data['floor_sqft']);?></li>
								<li><span class="left">Plot Area:</span>	<?php echo num0($data['area']);?>&nbsp;<?php echo sm_size($data['sq_ft']);?></li>
								<li><span class="left">Beds:</span>	<?php echo $data['bedrooms'];?> Bed</li>
								<li><span class="left">Baths:</span>	<?php echo $data['bathrooms'];?> Bath</li>
                                <li><span class="left">Demand:</span>	<?php echo $data['price'];?> <?php echo punit($data['price_in']);?> <?php echo $data['price_unit'];?></li>
							</ul>
							<div class="frame-price">
								<div class="slider-price"><?php echo $data['property_title'];?></div>
                                <div class="clear"></div>
                                <div class="slider-button"><a href="<?php echo $url;?>">more info</a></div>
							</div>
						</div>
					</div><!-- end cycle -->
                    
				<?php } // end of cycle loop ?>
                
				
				</div><!-- end #slideshow -->
			</div><!-- end #slide -->
			<!-- END OF SLIDE -->
			
		<div id="maincontent">
			<div id="content" class="full">
			
            
            	<ul class="two_column">
					<li>
						<h2 class="underline">Welcome <span class="blue"><?php echo $COMPANY;?></span></h2>
                         <?php 
                            $pagecontent =  page_content("ABOUT",530);
                            echo $pagecontent->content; 
                         ?>...  
                         <div class="slider-button"><a href="about-us.php">more info</a></div> 						
					</li>
					
                    <li style="padding-left:15px;">
						<h2 class="underline">Search <span class="blue">Property</span></h2>
                        <?php include("search.ini.php");?>
                    </li>    
				</ul>
                
				<div class="clear"></div>
            
			
                
                
				<div class="title_featured">
				<h2>Featured Preperties <span class="blue">For Sale</span></h2>
                        <a href="property-grid.php" class="featured">view all properties</a>
				</div>
				
            	<div class="clear"></div>
                <ul class="four_column">
                
                 <?
                    $sql="select a.*,i.image_name,i.main from ads a, ads_images i where
                            a.rid=i.propertyid and a.offer_type='SALE' and i.main='1' order by a.posted_date desc, 
                                a.property_title,rand() limit 4";
                                
                    $temp = $db->prepare($sql);
                    $temp->execute();
                   
                    
                    while ($data = $temp->fetch()){
                        $url = "property-details.php?ID=" .$data['rid'];
                        
                ?>
                 	<li>
					  <img src="pro_images/<?php echo $data['image_name'];?>" alt="" />
					  <h6><a href="<?php echo $url;?>"><?php echo trim($data['property_title']) ."<br />" . $data['location'];?></a></h6>
					  <ul class="box_text">
					  	<li><span class="left">Beds:</span> <?php echo $data['bedrooms'];?> bed</li>
						<li><span class="left">Baths:</span> <?php echo $data['bathrooms'];?> bath</li>
						<li><span class="left">Covered Area:</span> <?php echo num0($data['floor_area']);?>&nbsp;<?php echo sm_size($data['floor_sqft']);?></li>
						<li><span class="left">Plot Area:</span> <?php echo num0($data['area']);?>&nbsp;<?php echo sm_size($data['sq_ft']);?></li>
                        <li><span class="left">Demand:</span>	<?php echo $data['price'];?> <?php echo punit($data['price_in']);?> <?php echo $data['price_unit'];?></li>
					  </ul>				
					</li>
        		
                
                 <?php } ?>
					
				</ul>
				
			</div><!-- end #content -->
			<div class="clear"></div>
		</div><!-- end #maincontent -->




<?php include("footer.ini.php"); ?>