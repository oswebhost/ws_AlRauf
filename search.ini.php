<div id="advance-search-grid-property">					
     <form id="search" name="searchform" method="get" action="property-list.php">
        <input type="hidden" name="searchnow" value="1" />
        <div id="searchMain">
            <label for="advcity">
            	<span class="colortext">Location/Area</span> <span class="tip">ie. Karachi, Sadar, Nazimabad etc</span><br />
            	<input type="text" id="advcity" name="location" size="72" value="<?php echo $_GET['location']?>" />
            </label>
            <label for="advstate">
            	<span class="colortext">Property Type</span> <span class="tip">ie. Office, House, Building etc</span><br />
            	<input type="text" id="advstate" name="property_type" size="72" value="<?php echo $_GET['property_type']?>" />
            </label>
            <label for="advzipcode">
            	<span class="colortext">Offer</span> <br />
                          
                <select name="offer" id="advoffer" style="width: 120px;">
                        <option value="0" <?php echo  selected($_GET['offer'],0);?>>any</option>
            			<option value="SALE" <?php echo  selected($_GET['offer'],'SALE');?>>For Sale</option>
            			<option value="RENT" <?php echo  selected($_GET['offer'],'RENT');?>>For Rent</option>
            		
            		</select>
            </label>
          
            <label for="advbed">
            	<span class="colortext">Beds</span><br />
            	<select name="beds" id="advbed">
                        <option value="0" <?php echo  selected($_GET['beds'],0);?>>any</option>
            			<option value="1" <?php echo  selected($_GET['beds'],1);?>>1</option>
            			<option value="2" <?php echo  selected($_GET['beds'],2);?>>2</option>
            			<option value="3" <?php echo  selected($_GET['beds'],3);?>>3</option>
            			<option value="4" <?php echo  selected($_GET['beds'],4);?>>4</option>
            			<option value="5" <?php echo  selected($_GET['beds'],5);?>>5</option>
                        <option value="6" <?php echo  selected($_GET['beds'],6);?>>6 or more</option>
            		</select>
            </label>
            <label for="advbath">
            	<span class="colortext">Baths</span><br />
            	<select name="baths" id="advbath">
                        <option value="0" <?php echo  selected($_GET['baths'],0);?>>any</option>
            			<option value="1" <?php echo  selected($_GET['baths'],1);?>>1</option>
            			<option value="2" <?php echo  selected($_GET['baths'],2);?>>2</option>
            			<option value="3" <?php echo  selected($_GET['baths'],3);?>>3</option>
            			<option value="4" <?php echo  selected($_GET['baths'],4);?>>4</option>
            			<option value="5" <?php echo  selected($_GET['baths'],5);?>>5</option>
            		</select>
            </label>
        <label class="last"><br />
        <input type="hidden" name="post_type" value="property" />
        <div style="display:none;">
            <input type="search" id="s" name="s" title="Search Property" placeholder="Search Property" value="search" />
        </div>
        <div style='text-align:center;width:350px;'>
            <button type="submit" value="search" id="searchsubmit">Search</button>
        </div>
        </label>
        <div class="clear"></div>
        </div>
    </form>
<div class="clear"></div>
</div> 