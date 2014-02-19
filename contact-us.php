<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/


include("config.ini.php");
include("common.php");

$current = 6;

$ID="CONTACT";

$pagecontent =  page_content($ID);

$PAGE_TITILE = " Contact $COMPANY "  ;

require("header.ini.php") ;


?>
<script type="text/javascript" src="js/contact.js"></script>

<div id="maincontent">
	<div id="content" class="full">

<div class="one_third">
	<div class="sidebar">
	<ul>
		<li class="widget-container">
			<h2 class="widget-title">Postal <span class="blue">Address</span></h2>
			<div class="bg_gray" style="height: 350px;">
			<img src="images/content/img3.jpg" alt=""  /><br /><br />
            <p><span class="blue"><strong><?php echo $pagecontent->heading;?></strong></span><br/>
            <?php echo $pagecontent->content; ?>
			</p>
			</div><!-- end .bg_gray -->
		</li>
	</ul>
	</div>
</div>
<div class="one_third">
	<div class="sidebar">
	<ul>
		<li class="widget-container">
			<h2 class="widget-title">Let's <span class="blue">Talk</span></h2>
			<div class="bg_gray" style="height: 350px;">
				<div id="contactform" style="padding:0;">
				  <form id="contact" action="">
                      
					<fieldset>
					  <input type="text" name="name" id="name" size="20" value="Your Name" onblur="if (this.value == ''){this.value = 'Your Name'; }" onfocus="if (this.value == 'Your Name') {this.value = ''; }" class="text-input" />
					  <input type="text" name="email" id="email" size="30" value="Your Email" onblur="if (this.value == ''){this.value = 'Your Email'; }" onfocus="if (this.value == 'Your Email') {this.value = ''; }" class="text-input" />	
                      <input type="text" name="phone" id="phone" size="30" value="Your Phone No" onblur="if (this.value == ''){this.value = 'Your Phone No'; }" onfocus="if (this.value == 'Your Phone No') {this.value = ''; }" class="text-input" />

					 <textarea cols="" style='height:180px;' name="msg" id="msg">Your Message</textarea>
                     
					  <span class="error" id="name_error">Please enter name !</span>
                      <span class="error" id="phone_error">Please enter phone number !</span>
					  <span class="error" id="email_error">Please enter email address !</span>
					  <span class="error" id="email_error2">Please enter valid email address !</span>
					  <span class="error" id="msg_error">Please enter comment !</span>
                      
					 <input type="submit" name="submit" class="button" id="submit_btn" value="submit"/>
					</fieldset>
				  </form>
				</div><!-- end #contactform -->
			</div><!-- end .bg_gray -->
		</li>
	</ul>
	</div>
 </div>


<div class="one_third last">
	<div class="sidebar">
	<ul>
		<li class="widget-container">
			<h2 class="widget-title">Find Us <span class="blue">Online</span></h2>
			<div class="bg_gray" style="height: 350px;">
                <p><?php //echo ym();?></p>
                <p><?php //echo skype();?></p>
                <p><?php //echo msn();?></p>
			</div><!-- end .bg_gray -->
		</li>
	</ul>
	</div>
</div><!-- end .one_third last -->

    
	</div><!-- end #sidebar_right -->
	
	<div class="clear"></div>
</div><!-- end #maincontent -->

<? require_once("footer.ini.php") ; ?>