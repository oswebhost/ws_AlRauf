<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
include("config.ini.php");
include("common.php");

$current = 3;

$sql= $db->exec("update ads set viewed = viewed+1 where rid='$_GET[ID]'");

$sql="select image_name,i.main from ads_images i where propertyid ='$_GET[ID]' order by i.main desc";

$temp = $db->prepare($sql);
$temp->execute();
while ($data = $temp->fetch()){
    $imgfile[] = 'pro_images/'. trim($data['image_name']);
}


$sql="select * from ads where rid ='$_GET[ID]'";
$temp = $db->prepare($sql);
$temp->execute();
$data = $temp->fetch();

$pfeat = explode("|",$data['property_features']);
$cfeat = explode("|",$data['community_features']);

$PAGE_TITILE = trim($data['property_title']). " " . $data['location'] ;

require_once("header.ini.php") ;

?>
<script type="text/javascript" src="js/property_inquiry.js"></script>



	<div class="centercolumn">
			
		<div id="maincontent">
			<div id="content">
				<h2 class="underline"><?php echo trim($data['property_title']); ?></h2>
				<div id="container-slider">
				<ul id="slideshow_detail">
                <?php for($i=0; $i<count($imgfile); $i++){ ?>
					<li>
						<h3><?php echo $PAGE_TITILE; ?></h3>
						<span><?php echo $imgfile[$i];?></span>
						<p></p>
						<img src="<?php echo $imgfile[$i];?>" alt="thumb" />
					</li>
                 <? } ?>
				</ul>
                

				<div id="wrapper">
					<div id="fullsize">
						<div id="imgprev" class="imgnav" title="Previous Image"></div>
						<div id="imglink"></div>
						<div id="imgnext" class="imgnav" title="Next Image"></div>
						<div id="image"></div>
						<div id="information">
							<h3></h3>
							<p></p>
						</div>
					</div>
					<div id="thumbnails">
						<div id="slideleft" title="Slide Left"></div>
						<div id="slidearea">
							<div id="slider"></div>
						</div>
						<div id="slideright" title="Slide Right"></div>
					</div>
				</div>
			<script type="text/javascript" src="js/compressed.js"></script>
			<script type="text/javascript" src="js/script.js"></script>
			<script type="text/javascript">
			<!-- 
			
				$('slideshow_detail').style.display='none';
				$('wrapper').style.display='block';
				var slideshow_detail=new TINY.slideshow_detail("slideshow_detail");
				window.onload=function(){
					slideshow_detail.auto=true;
					slideshow_detail.speed=5;
					slideshow_detail.link="linkhover";
					slideshow_detail.info="information";
					slideshow_detail.thumbs="slider";
					slideshow_detail.left="slideleft";
					slideshow_detail.right="slideright";
					slideshow_detail.scrollSpeed=4;
					slideshow_detail.spacing=25;
					slideshow_detail.active="#fff";
					slideshow_detail.init("slideshow_detail","image","imgprev","imgnext","imglink");
				}
			//-->  
			</script>
			</div><!-- end content-slider -->
			
			<div class="clear"><br /></div>
			
			<h2 class="underline">Property <span class="blue">Details</span> </h2>
			<div id="property-detail">
			<div class="one_half">
				<ul class="box_text">
    		      	<li><span class="left">For</span>		    <?php echo $data['offer_type'];?></li>
					<li><span class="left">Stories</span>		<?php echo $data['stories'];?></li>
                    <li><span class="left">Bedrooms	</span>		<?php echo $data['bedrooms'];?> </li>
					<li><span class="left">Bathrooms</span>		<?php echo $data['bathrooms'];?></li>
					<li><span class="left">Garage</span>		<?php echo $data['garage'];?> </li></li>
				</ul>	
			</div>
			<div class="one_half last" style="width: 355px;">
				<ul class="box_text">
                    <li><span class="left">Demand</span>		<?php echo $data['price'] .' ' . punit($data['price_in']) . ' ' . $data['price_unit'] ;?> </li>
					<li><span class="left">Location</span>		<?php echo $data['location'];?> </li>
					<li><span class="left">Property Type</span>	<?php echo $data['property_type'];?></li>
					<li><span class="left">Covered Area</span>	<?php echo $data['floor_area'] .' ' . sm_size($data['floor_sqft']) ;?> </li>
					<li><span class="left">Plot Area	</span>	<?php echo $data['area'] .' ' . sm_size($data['sq_ft']) ;?> </li>
                    
				</ul>	
			</div>
				<ul class="box_text">
					<li><span class="left">Property Features	</span>	
                        <span class="right">
                            <?php 
                                for ($i=0; $i<count($pfeat); $i++){ 
                                echo pro_feature_name($pfeat[$i]);
                            }?>
                         </span>
                    </li>
					<li><span class="left">Communit Features</span>
                        <span class="right">
                            <?php 
                                for ($i=0; $i<count($cfeat); $i++){ 
                                echo com_feature_name($cfeat[$i]);
                            }?>
                         </span>
                    </li>
                    <li><?php echo stripcslashes($data['description']);?></li>
				</ul>	
				</div>
				
			<div class="clear"><br /><br /></div>
			
			
            
			<h2 class="underline">Contact <span class="blue"><?php echo $COMPANY;?></span></h2>
            
             <div id="contact-information" >
				<form id="contact" action="">
			         
			         <fieldset>
					<label>My Name</label><br />
					<input type="text" name="name" id="name" size="40"/>
                        <span class="error2" id="name_error">Please enter name !</span> <br />
			
                    
					<label>My Email</label><br />
					<input type="text" name="email" id="email" size="40"/>
                        <span class="error2" id="email_error">Please enter email address !</span>
                        <span class="error2" id="email_error2">Please enter valid email address !</span>
                    <br />

					<label>Phone Number </label><br />
					<input type="text" name="phone" id="phone" size="40"/>
                        <span class="error2" id="phone_error">Please enter phone number !</span>
                    <br />

					<label>Inquiry About</label><br />
					<input type="text" size="65" name="about" id="about" value="<?php echo $PAGE_TITILE ;?>"  readonly />
                    
                    <input type="hidden" size="65"  name="url" id="url" value="<?echo $URL_PATH.$_SERVER['REQUEST_URI'];?>" readonly />
                    <br />
					<label>Questions &amp; Comments</label> 
                        <span class="error2" id="msg_error">Please enter question/comments !</span>
                    <br />
					<textarea  name="msg" id="msg" cols="78" rows="10"></textarea><br />
				
					
					<label>Preferred Contact Time</label><br />
					<input type="text" name="time" id="time" size="40" />
                        <span class="error2" id="time_error">Please enter preferred contact time !</span><br />
					
                    <br />
					   <input type="submit" name="submit" class="button" id="submit_btn" value="Request more details" /><br />
			        </fieldset>
				</form>
			 </div>			

             	<div class="clear"><br /></div>
			</div><!-- end #content -->
			
			<div class="sidebar_right">
			<div class="sidebar">
				<ul>
					<li class="widget-container widget_text">
						<h2 class="widget-title">Our <span class="blue">Team</span></h2>
						<div class="agent">
					
                        
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
                                        <?php echo show_agent_pic("agents/".$data['pic'],90); ?>
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
						
					
					  </div>
                	</li>
				
				    <li>
                           <h2 class="underline">Search <span class="blue">Property</span></h2>
                        <?php include("search-list.ini.php");?>
                    </li>	
					
				
			
				</ul>
            </div><!-- end #sidebar -->
			</div><!-- end #sidebar_right -->
			
			<div class="clear"></div>
		</div><!-- end #maincontent -->
	</div><!-- end #centercolumn -->







<? require_once("footer.ini.php") ; ?>