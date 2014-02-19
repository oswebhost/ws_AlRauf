jQuery(function() {
  jQuery('.error2').hide();
  var messagetext = jQuery("textarea#content");
  messagetext.focusout(function(){
		if (messagetext.val() == ''){messagetext.text('Your Message'); }
  });
  messagetext.focus(function(){
		if (messagetext.val() == 'Your Message') {messagetext.text(''); }					   
  });
  jQuery(".button").click(function() {
		// validate and process form
		// first hide any error messages
    jQuery('.error2').hide();
    
    var iam = jQuery("select#iam").val();
    if(iam=="0"){
        jQuery("span#iam_error").show();
        jQuery("select#iam").focus();
         return false;
    }
    
      
    var pname = jQuery("input#pname").val();
     if (pname=="Your Name" || pname == "") {
          jQuery("span#pname_error").show();
          jQuery("input#pname").focus();
          return false;
    }
    
	  var pemail = jQuery("input#pemail").val();
	  if (pemail == "Your Email" || pemail == "") {
          jQuery("span#pemail_error").show();
          jQuery("input#pemail").focus();
          return false;
    }
	
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(!emailReg.test(pemail)) {
    	jQuery("span#pemail_error").show();
        jQuery("input#pemail").focus();
          return false;
	}
	
    var pphone = jQuery("input#pphone").val();
    if (pphone=="Your Phone No" || pphone == "") {
      jQuery("span#pphone_error").show();
      jQuery("input#pphone").focus();
      return false;
    }
    
    var paddress = jQuery("input#paddress").val();
    var pcity    = jQuery("input#pcity").val();
    
    

  
    var offer_type = jQuery("select#offer_type").val();
    if(offer_type=="0"){
        jQuery("span#offer_error").show();
        jQuery("select#offer_type").focus();
         return false;
    }

    var property_title = jQuery("input#property_title").val();
    if(property_title==""){
        jQuery("span#property_title_error").show();
        jQuery("input#property_title").focus();
         return false;
    }

    var property_type = jQuery("select#property_type").val();
    if(property_type=="0"){
        jQuery("span#property_type_error").show();
        jQuery("select#property_type").focus();
         return false;
    }

    var price = jQuery("input#price").val();
    if(price=="" || price == "0"){
        jQuery("span#price_error").show();
        jQuery("input#price").focus();
         return false;
    }

    var price_in = jQuery("select#price_in").val();
    if(price_in=="" || price_in == "0"){
        jQuery("span#price_error").show();
        jQuery("select#price_in").focus();
         return false;
    }
    
    var price_unit = jQuery("select#price_unit").val();
    
    

    var address = jQuery("input#address").val();
    if(address=="" ){
        jQuery("span#address_error").show();
        jQuery("input#address").focus();
         return false;
    }

    var stories = jQuery("input#stories").val();
    if(stories=="" ){
        jQuery("span#stories_error").show();
        jQuery("input#stories").focus();
         return false;
    }

    var bedrooms = jQuery("input#bedrooms").val();
    if(bedrooms=="" ){
        jQuery("span#bedrooms_error").show();
        jQuery("input#bedrooms").focus();
         return false;
    }

    var bathrooms = jQuery("input#bathrooms").val();
    if(bathrooms=="" ){
        jQuery("span#bathrooms_error").show();
        jQuery("input#bathrooms").focus();
         return false;
    }

    var garage = jQuery("input#garage").val();
    if(garage=="" ){
        jQuery("span#garage_error").show();
        jQuery("input#garage").focus();
         return false;
    }
    
    var age = jQuery("input#age").val();
    if(age=="" ){
        jQuery("span#age_error").show();
        jQuery("input#age").focus();
         return false;
    }

    var floor_area = jQuery("input#floor_area").val();
    if(floor_area=="" || floor_area=="0"){
        jQuery("span#floor_area_error").show();
        jQuery("input#floor_area").focus();
         return false;
    }

    var area = jQuery("input#area").val();
    if(area=="" || area=="0"){
        jQuery("span#area_error").show();
        jQuery("input#area").focus();
         return false;
    }
  
    var content = jQuery("textarea#content").val();
    if(content==""){
        jQuery("span#content_error").show();
        jQuery("textarea#content").focus();
         return false;
    }

    var floor_sqft = jQuery("select#floor_sqft").val();
    var sq_ft      = jQuery("select#sq_ft").val();


    
     var dataString =  'iam=' + iam + '&pname='+pname + '&pemail='+ pemail + '&pphone=' + pphone + '&paddress=' + paddress + 
     '&pcity=' + pcity + '&offer_type=' + offer_type + '&property_title=' + property_title + '&property_type='+ property_type + 
     '&price=' + price + '&price_in=' + price_in + '&price_unit=' + price_unit + '&address=' + address + '&stories=' + stories + 
     '&bedrooms=' + bedrooms + '&bathrooms=' + bathrooms + '&garage=' + garage + '&age=' + age  + '&floor_area=' + floor_area +
     '&floor_sqft=' + floor_sqft +'&area='+area +'&sq_ft='+sq_ft+'&content='+content  ;	
     
    	
	  jQuery.ajax({
      type: "POST",
      url: "js/submit-property.php",
      data: dataString,
      success: function(result) {
        jQuery('#contactform').html("<div id='message'></div>");
        jQuery('#message').html(result)
        .hide()
        .fadeIn(1500, function() {
          jQuery('#message');
        });
      }
     });
    return false;
	});
});

