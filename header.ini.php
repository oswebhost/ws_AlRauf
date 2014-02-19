<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>


<title><? echo $PAGE_TITILE . " " . $COMPANY; ?></title>
<meta http-equiv="Content-Script-Type" content="text/javascript" /> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="robots" content="index, follow" />

<meta name="title" content="<? echo $PAGE_TITILE . " " . $COMPANY; ?>" />
<meta name="description" content="<? echo site_decription(); ?>" />
<meta name="keywords" content="<? echo site_keyword(); ?>"/>

<!-- ////////////////////////////////// -->
<!-- //      Start Stylesheets       // -->
<!-- ////////////////////////////////// -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/inner.css" rel="stylesheet" type="text/css" />
<!-- ////////////////////////////////// -->
<!-- //      Javascript Files        // -->
<!-- ////////////////////////////////// -->



<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/PT_Sans_400.font.js"></script>


<script type="text/javascript">
	 Cufon.replace('h1') ('h2') ('h3') ('h4') ('h5') ('h6') ('.slider-button a') ('.slider-price') ('.button') ('#nav li a', {hover: true});
	 
</script>
<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
<script type="text/javascript" src="js/hoverIntent.js"></script> 
<script type="text/javascript" src="js/superfish.js"></script> 
<script type="text/javascript" src="js/supersubs.js"></script> 
<script type="text/javascript"> 
 var $jts = jQuery.noConflict();
    $jts(document).ready(function(){ 
        $jts("ul.sf-menu").supersubs({ 
		minWidth		: 9,		// requires em unit.
		maxWidth		: 25,		// requires em unit.
		extraWidth		: 0			// extra width can ensure lines don't sometimes turn over due to slight browser differences in how they round-off values
                               // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 
    }); 
 
</script>
<script type="text/javascript" src="js/jquery.cycle.all.min.js"></script>
<script type="text/javascript">
 var $jts = jQuery.noConflict();
    $jts(document).ready(function(){ 
		
		//Slider  
         $jts('#slideshow').cycle({
            timeout: 5000,  // milliseconds between slide transitions (0 to disable auto advance)
            fx:      'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...            
            pager:   '#pager',  // selector for element to use as pager container
            pause:   0,	  // true to enable "pause on hover"
            pauseOnPagerHover: 0 // true to pause when hovering over pager link
        });
     });
</script>


<!--[if IE 6]>
<script src="js/DD_belatedPNG.js"></script>
<script>
  DD_belatedPNG.fix('img');
</script>

<![endif]--> 




</head>
<body>



	<div id="top-container">
		<div class="centercolumn">
		<div id="header">
			<div id="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div><!-- end #logo -->
			<div id="navigation">
				<ul id="nav" class="sf-menu">
					<li><a href="index.php" <?php echo cur_menu($current,1);?>>Home</a></li>
					<li><a href="about-us.php" <?php echo cur_menu($current,2);?>>About</a></li>
					
					
					<li><a href="#" <?php echo cur_menu($current,3);?>>Property</a>
						<ul>
							<li><a href="property-list.php">Property List</a></li>
							<li><a href="property-grid.php">Property Grid</a></li>
	       				</ul>
					</li>
					<li><a <?php echo cur_menu($current,4);?> href="submit-property.php">List your Property</a></li>
					<li><a <?php echo cur_menu($current,6);?> href="contact-us.php">Contact</a></li>
				</ul>
			</div><!-- end #navigation-->
			<div class="clr"></div>
		</div><!-- end #header -->
		</div><!-- end #centercolumn -->
	</div><!-- end #top-container -->
	
	
	<div class="centercolumn">
    