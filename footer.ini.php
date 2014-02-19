	<div id="bottom-container" style="margin-top:-40px" >
		<div class="centercolumn">
		
			<div id="footer">
				<div id="footer-left" style="padding-left:40px;">
					<div class="one_fourth">
						<ul>
							<li class="widget-container">
								<h2 class="widget-title">Company</h2>
								<ul>
									<li><a href="about-us.php">About Us</a></li>
                                    <li><a href="property-list.php">Property List</a></li>
									<li><a href="submit-property.php">List your Property</a></li>
                                    <li><a href="realestate-news.php">Real Estate News</a></li>
									<li><a href="contact-us.php">Contact Us</a></li>
									
								</ul>
							</li>
						</ul>
					</div><!-- end #one_fourth -->
				
					
                    <?php
                    
                        $sql ="select rid,menu_cap, rank from property_type order by rank, menu_cap limit 10";
                        $temp = $db->prepare($sql);
                        $temp->execute();
                        while ($data = $temp->fetch()){
                            $ary_protype['cap'][] = $data['menu_cap'];
                            $ary_protype['rid'][] = $data['rid'];
                        }
                    ?>
                    
					<div class="one_fourth">
						<ul>
							<li class="widget-container">
								<h2 class="widget-title">Properties</h2>
								<ul>
                                    <?php for ($j=0; $j<=4;$j++){ 
                                        $url = 'property-list.php?CAT='.$ary_protype['cap'][$j];    
                                    ?>
									<li><a href="<?php echo $url;?>"><?php echo $ary_protype['cap'][$j];?></a></li>
								    <?php } ?>
                                </ul>
							</li>
						</ul>
					</div><!-- end #one_fourth -->
                    
                    <div class="one_fourth">
						<ul>
							<li class="widget-container">
								<h2 class="widget-title">Properties</h2>
								<ul>
                                    <?php for ($j=5; $j<=9;$j++){ 
                                        $url = 'property-list.php?CAT='.$ary_protype['rid'][$j];    
                                    ?>
									<li><a href="<?php echo $url;?>"><?php echo $ary_protype['cap'][$j];?></a></li>
								    <?php } ?>
                                </ul>
							</li>
						</ul>
					</div><!-- end #one_fourth -->
                    
                  <div class="one_fourth">
						<ul>
							<li class="widget-container">
								<h2 class="widget-titles">Ads</h2>
								asdfasd
							</li>
						</ul>
					</div><!-- end #one_fourth -->
                    
                    
            	</div><!-- end #footer-left -->

			</div><!-- end #footer -->
			<div class="clear"></div>
            
    
            
		</div><!-- end #centercolumn -->
	
        
	</div><!-- end #bottom-container -->
    	<div class="clear"></div>
  </div>      
        
 <div id="copyright" >
    <div class="textmsg">
        Copyright &copy; <?echo date("Y") . " <a href='$URL_PATH'>$COMPANY</a>"; ?>. All Rights Reserved.
    </div>
 </div>            
		
            
            
	<script type="text/javascript"> Cufon.now(); </script> <!-- to fix cufon problems in IE browser -->
</body>
</html>
<?php  include ('whosonline.php'); ?>