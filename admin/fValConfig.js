var fv = new Array()

/****************************************************
*	Globals.  Modify these to suit your setup
****************************************************/

//	Attribute used for fValidate Validator codes
fv['code'] = 'alt';

//	Attribute used for custom error messages (override built-in error messages)
fv['emsg'] = 'emsg';

//	Attribute used for pattern with custom validator type
fv['pattern'] = 'pattern';

//	Change this to the classname you want for the error highlighting
fv['errorClass'] = 'errHilite';

//	If the bConfirm flag is set to true, the users will be prompted with CONFIRM box with this message
fv['confirmMsg'] = 'Your Message is about to be sent.\nPlease click \'Ok\' to proceed or \'Cancel\' to abort.';

//	If user cancels CONFIRM, then this message will be alerted.  If you don't want this alert to show, then
//	empty the variable (  fv['confirmAbortMsg'] = '';  )
fv['confirmAbortMsg'] = 'Submission cancelled.  Data has not been sent.';

//	Enter the name/id of your form's submit button here (works with type=image too)
fv['submitButton'] = 'Submit';

//	Enter the name/id of your form's reset button here (works with type=image too)
fv['resetButton'] = 'Reset';

//	Ender the name or id of the SELECT object here. Make sure you pay attention to the values (CC Types)
//	used in the case statement for the function validateCC()
fv['ccType'] = 'Credit_Card_Type';

//	NOTE: The config value below exists for backwards compatibility with fValidate 3.55b.  If you have a newer 
//	version, use the above fv['ccType'] instead.
//	Enter the DOM name of the SELECT object here. Make sure you pay attention to the values (CC Types)
//	used in the case statement for the function validateCC()
fv['ccTypeObj'] = 'form1.Credit_Card_Type';

//	Number of group error mode alerts before switching to normal error mode
fv['switchToEbyE'] = 3;

/**********************************************************
*	Do not edit This section. Start below
***********************************************************/

function FV_bs() {
	this.ver = navigator.appVersion; //Cheking for browser version
	this.agent = navigator.userAgent; //Checking for browser type
    var minor = parseFloat(this.ver);
    var major = parseInt(minor);	
	this.dom = document.getElementById?1:0;
	this.opera = (this.agent.indexOf("opera") != -1);
	var iePos  = this.ver.indexOf('msie');
	if (iePos !=-1) {
		minor = parseFloat(this.ver.substring(iePos+5,this.ver.indexOf(';',iePos)))
		major = parseInt(minor);
		}	
	this.ie = ((iePos!=-1) && (!this.opera));
	this.gecko = ((navigator.product)&&(navigator.product.toLowerCase()=="gecko"))?true:false;
    this.ie4   = (this.ie && major == 4);
    this.ie4up = (this.ie && minor >= 4);
    this.ie5   = (this.ie && major == 5);
    this.ie5up = (this.ie && minor >= 5);
    this.ie5_5  = (this.ie && (this.agent.indexOf("msie 5.5") !=-1));
    this.ie5_5up = (this.ie && minor >= 5.5);
    this.ie6   = (this.ie && major == 6);
    this.ie6up = (this.ie && minor >= 6);	
	this.mac = this.agent.indexOf("Mac")>-1;
	}

/****************************************************
*	Constants. Do not edit
****************************************************/

//	Global used for flagging the validateBlank() function within most other validation functions
fv['bok'] = false;

//	Global used for class switching.
fv['revertClass'] = '';

//	Placeholder for Group Error boolean
fv['groupError'] = 0;

//	Placeholder for number of group error alerts
fv['groupErrors'] = 0;

//	Browser Sniffer
fv['is'] = new FV_bs();

//	Array for error totalling while in group error mode
var errorData = new Array();

//	EOF