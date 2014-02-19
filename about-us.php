<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
include("config.ini.php");
include("common.php");

$current = 2;

$pagecontent =  page_content("ABOUT");
 

$PAGE_TITILE = $pagecontent->heading . ' ' .  $PAGE_TITILE ;

require_once("header.ini.php") ;


?>


<div id="about_container">
    <div class="txtcontent">
        <h2 class="underline"><span class="blue"><?php echo $pagecontent->heading;?></span></h2>
        <p><?php echo $pagecontent->content;?></p>
    </div>
</div>	
        
        

    
    
			
<div id="maincontent">
	<div id="content">
		<h2 class="underline">Our <span class="blue">Team</span></h2>
		  <?php
            
            $temp = $db->prepare("select * from agents order by rank, agent_name");
            $temp->execute();
            
          
          ?>
          
          <table border='0' cellpadding='0'>
            <?php 
                while ($data = $temp->fetch()){ 
            ?>
            <tr>
                <td style='width:10%;vertical-align: top;'>
                        <?php echo show_agent_pic("agents/".$data['pic']); ?>
                </td>
                <td style='width:90%;vertical-align: top;text-align:left;'>
                <?php 
                    echo "<span class='team'>" . $data["agent_name"] . "</span> <br />" . $data["position"] . "<br />" ;
            		echo  "Mobile No: <b>" . $data["cell_no"] . "</b><br />" ;
                    echo  "Phone No: <b>" . $data["contact_no"] . "</b><br />" ;
            		echo  "Email: <b>" . $data["email"]  . "</b><br />" ;
                ?>
                </td>
                <tr>
                    <td colspan="2" style="border-top:1px dotted #ccc;"></td>
                </tr>
            </tr>
            <?php } ?>
          </table>
          
          
          
        
	</div><!-- end #content -->
	
    
    
	<div class="sidebar_right">
		<div class="sidebar">
		    <h2>Featured <span class="blue">Preperty</span></h2>
			 
                <div style='text-align:center;margin-bottom:20px; background:#f6f6f6; border:1px solid #ededed; padding:15px;'>
				 <?
                    $sql="select a.*,i.image_name,i.main from ads a, ads_images i where
                            a.rid=i.propertyid and a.offer_type='SALE' and i.main='1' order by a.posted_date desc, 
                                a.property_title,rand() limit 1";
                                
                    $temp = $db->prepare($sql);
                    $temp->execute();
                   
                    while ($data = $temp->fetch()){
                        $url = "property-details.php?ID=" .$data['rid'];
                        
                ?>
            		  <img src="pro_images/<?php echo $data['image_name'];?>" alt="" style=" margin-bottom:15px;width:184px;height:119px;" />
					  <h6><a href="<?php echo $url;?>"><?php echo trim($data['property_title']) ."<br />" . $data['location'];?></a></h6>
					  <ul class="box_text">
					  	<li><span class="left">Beds:</span> <?php echo $data['bedrooms'];?> bed</li>
						<li><span class="left">Baths:</span> <?php echo $data['bathrooms'];?> bath</li>
						<li><span class="left">Covered Area:</span> <?php echo num0($data['floor_area']);?>&nbsp;<?php echo sm_size($data['floor_sqft']);?></li>
						<li><span class="left">Plot Area:</span> <?php echo num0($data['area']);?>&nbsp;<?php echo sm_size($data['sq_ft']);?></li>
                        <li><span class="left">Demand:</span>	<?php echo $data['price'];?> <?php echo punit($data['price_in']);?> <?php echo $data['price_unit'];?></li>
					  </ul>	<br /> 			
				
                
                 <?php } ?>
			 </div>

			
        </div><!-- end #sidebar -->
	</div><!-- end #sidebar_right -->
	
	<div class="clear"></div>
</div><!-- end #maincontent -->








<? require_once("footer.ini.php") ; ?>