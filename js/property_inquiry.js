jQuery(function() {
  jQuery('.error2').hide();
  var messagetext = jQuery("textarea#msg");
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
	  var name = jQuery("input#name").val();
     if (name=="Your Name" || name == "") {
          jQuery("span#name_error").show();
          jQuery("input#name").focus();
          return false;
    }
    
 
	  var email = jQuery("input#email").val();
	  if (email == "Your Email" || email == "") {
          jQuery("span#email_error").show();
          jQuery("input#email").focus();
          return false;
    }
	
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if(!emailReg.test(email)) {
    	jQuery("span#email_error2").show();
        jQuery("input#email").focus();
          return false;
	}
	
    var phone = jQuery("input#phone").val();
     if (phone=="Your Phone No" || phone == "") {
          jQuery("span#phone_error").show();
          jQuery("input#phone").focus();
          return false;
    }
    
	  var msg = jQuery("textarea#msg").val();
	  if (msg == "Your Message" || msg == "") {
    	  jQuery("span#msg_error").show();
    	  jQuery("textarea#msg").focus();
    	  return false;
    }

   var time = jQuery("input#time").val();
     if (time=="Your Time" || time == "") {
          jQuery("span#time_error").show();
          jQuery("input#time").focus();
          return false;
    }
   
   var url   = jQuery("input#url").val();
   var about = jQuery("input#about").val();
        
	var dataString =  'url='+url +'&about='+about+'&time='+time+'&name='+ name + '&email=' + email + '&phone=' + phone + '&msg=' + msg;
       
	//alert (dataString);return false;
		
	  jQuery.ajax({
      type: "POST",
      url: "js/property_inquiry.php",
      data: dataString,
      success: function(result) {
        jQuery('#contact-information').html("<div id='message'></div>");
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

