<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
?>
<script language="Javascript1.2"><!-- // load htmlarea
_editor_url = "./htmlarea/";                // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
 document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
 document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
// --></script> 
<SCRIPT LANGUAGE="JavaScript">

function checkform ( form )
 {
	
     if (form.question.value=="" || form.question.value.lenght=<10) {
         alert( "Question length must be at least 15 characters." );
         form.question.focus();
         return false ;
     }
	 if (form.category.value=="") {
         alert( "Enter a Category" );
         form.category.focus();
         return false ;
	 }
	 if (form.rank.value=="") {
         alert( "Enter a sort order for question" );
         form.rank.focus();
         return false ;
	 }
	 if (form.ansby.value=="") {
         alert( "Enter your name." );
         form.ansby.focus();
         return false ;
	 }
	 
	  if (form.answer.value=="" || form.answer.value.lenght < 20 ) {
         alert( "Answer is Too short! Please type aleast 20 characts." );
         form.answer.focus();
         return false ;
     }
}
</script>