jQuery(function() {
  jQuery('.error').hide();
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
    jQuery('.error').hide();
	  var name = jQuery("input#name").val();
     if (name=="Your Name" || name == "") {
          jQuery("span#name_error").show();
          jQuery("input#name").focus();
          return false;
    }
    
    var phone = jQuery("input#phone").val();
     if (phone=="Your Phone No" || phone == "") {
          jQuery("span#phone_error").show();
          jQuery("input#phone").focus();
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
	
	  var url = jQuery("input#url").val();
	  if (url == "") {
          jQuery("input#url").focus();
          return false;
    }
	  var msg = jQuery("textarea#msg").val();
	  if (msg == "Your Message" || msg == "") {
    	  jQuery("span#msg_error").show();
    	  jQuery("textarea#msg").focus();
    	  return false;
    }
		
	var dataString = 'name='+ name + '&email=' + email + '&phone=' + phone + '&msg=' + msg;
	//alert (dataString);return false;
		
	  jQuery.ajax({
      type: "POST",
      url: "js/contact.php",
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

