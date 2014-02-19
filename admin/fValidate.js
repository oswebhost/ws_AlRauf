/***************************************************************************************************
*
*-- Form validation script by Peter Bailey, Copyright (c) 2001-2002
*	Version 3.71b
*	Updated on December 10, 2002
*	www.peterbailey.net
*	me@peterbailey.net
*
*	IF YOU USE THIS SCRIPT, GIVE ME CREDIT PLEASE =)
*
*	Visit http://www.peterbailey.net/fValidate/ for more info
*
*	Please contact me with any questions, comments, problems, or suggestions
*	This script has only been tested on various versions of Windows with IE4+, NS6+ and Moz1.0+
*
*	Note: This document most easily read with tab spacing set to 4
*
*******************************************************************************************************/

function validateForm(Frm, bConfirm, bDisable, bDisableR, groupError) {
	var testOk = false;
	if (groupError && fv['groupErrors'] < fv['switchToEbyE']) { 
		fv['groupError'] = 1; 
		errorData = new Array(); 
		}
	else
		fv['groupError'] = 0;
	
	for (var i=0; i<Frm.elements.length; i++) {						// Loops through all the form's elements		
		if (Frm.elements[i].getAttribute(fv['code'])) {				// Gets the validator attribute, if exists thus starting the validation
			var validateType = Frm.elements[i].getAttribute(fv['code']);
			var validateObj = Frm.elements[i];
			testOk = false;			
			var params = validateType.split("|");					// Separates validation string into parameters
			if (params[0] == 'money') {								// Sets flags for money syntax				
				var dollarsign	= (params[1].indexOf('$') != -1);
				var grouping	= (params[1].indexOf(',') != -1);
				var decimal		= (params[1].indexOf('.') != -1);
				}
			
			if (params[params.length-1] == 'bok')					// Sets flag if field is allowed to be blank
				fv['bok'] = true;
	
			switch (params[0]) {									// Calls appropriate validation function based on type				
				case 'blank'	: if (validateBlank(validateObj)) testOk = true; break;
				case 'equalto'	: if (validateEqualTo(validateObj, params[1], Frm)) testOk = true; break;
				case 'length'	: if (validateLength(validateObj, params[1])) testOk = true; break;
				case 'number'	: if (validateNumber(validateObj, params[1], params[2], params[3])) testOk = true; break;
				case 'numeric'	: if (validateNumeric(validateObj, params[1])) testOk = true; break;
				case 'alnum'	: if (validateAlnum(validateObj, params[1], params[2], params[3], params[4], params[5] )) testOk = true; break;				
				case 'decimal'	: if (validateDecimal(validateObj, params[1], params[2] )) testOk = true; break;
				case 'decimalr'	: if (validateDecimalR(validateObj, params[1], params[2], params[3], params[4] )) testOk = true; break;				
				case 'ip'		: if (validateIP(validateObj, params[1], params[2])) testOk = true; break;
				case 'ssn'		: if (validateSSN(validateObj)) testOk = true; break;
				case 'money'	: if (validateMoney(validateObj, dollarsign, grouping, decimal)) testOk = true; break;
				case 'zip'		: if (validateZip(validateObj, params[1])) testOk = true; break;
				case 'cazip'	: if (validateCAzip(validateObj)) testOk = true; break;
				case 'phone'	: if (validatePhone(validateObj)) testOk = true; break;
				case 'email'	: if (validateEmail(validateObj)) testOk = true; break;
				case 'date'		: if (validateDate(validateObj, params[1], params[2], params[3], params[4])) testOk = true; break;
				case 'cc'		: if (validateCC(validateObj)) testOk = true; break;
				case 'select'	: if (validateSelect(validateObj)) testOk = true; break;
				case 'selectm'	: if (validateSelectM(validateObj, params[1], params[2])) testOk = true; break;
				case 'selecti'	: if (validateSelectI(validateObj, params[1])) testOk = true; break;
				case 'checkbox'	: if (validateCheckbox(validateObj, params[1], params[2])) testOk = true; break;
				case 'radio'	: if (validateRadio(validateObj)) testOk = true; break;
				case 'eitheror'	: if (validateEitherOr(validateObj, params[1], params[2])) testOk = true; break;
				case 'atleast'	: if (validateAtLeast(validateObj, params[1], params[2], params[3])) testOk = true; break;
				case 'file'		: if (validateFile(validateObj, params[1])) testOk = true; break;
				case 'custom'	: if (validateCustom(validateObj)) testOk = true; break;
				// Add additional cases here
				default			: alert('Validation Type Not Found:\n'+params[0]);
				}
			if (!testOk && !fv['groupError']) return false;
			}
		}
	// Begin group error routine
	if (fv['groupError']) {
		fv['groupErrors']++;
		var alertStr = "The fields listed below have erroneous data or need to be filled in.\n\n";
		for (var i in errorData) {
//			fv['revertClass'] = errorData[i].className;
			if (typeof errorData[i].type != 'undefined'  && typeof errorData[i].name != 'undefined') { 
				errorData[i].className = fv['errorClass'];
				alertStr += " -" + formatName(errorData[i]) + "\n";
				}
			else {
				var temp = errorData[i];
				temp[0].className = fv['errorClass'];
				alertStr += " -" + formatName(temp[0]) + "\n";
				}
			errorProcess(errorData[0],0,1);
			}
		if (errorData.length > 0) {
			errorData[0].focus();
			alert(alertStr);
			return false;
			}       
		}
/*******************************************************
*	Any special conditions you have can be added here
********************************************************/		
		
	if (typeof bConfirm == 'undefined') bConfirm = 0;				// Checks for submission flags
	if (typeof bDisable == 'undefined') bDisable = 0;	
	if (typeof bDisableR == 'undefined') bDisableR = 0;	
	if (bConfirm) {
		if(!confirm(fv['confirmMsg']))
			{
			if (fv['confirmAbortMsg'] != '') alert(fv['confirmAbortMsg']);		// Displays confim if requested
			return false;
			}
		}
	if (bDisable) Frm.elements[fv['submitButton']].disabled=true;			// Disables submit if requested
	if (bDisableR) Frm.elements[fv['resetButton']].disabled=true;			// Disables reset if requested
	return true;													// Form has been validated
	}

/***************************************************************************/
function validateBlank(formObj) {
	var objName = formatName(formObj);
	if (fv['is'].ie5 || fv['is'].mac) {
		if (formObj.value == "") {
			return errorProcess2(formObj,0,1,'Please enter the '+objName);
			}
		}
	else {
		var regex = new RegExp(/\S/);
		if (!regex.test(formObj.value)) {
			return errorProcess2(formObj,1,1,'Please enter the '+objName);			
			}
		}
	return true;
	}
/***************************************************************************/
// Special function used for bok
function checkBlank(formObj) {
	if (formObj.value == "")
		return true;
	var regex = new RegExp(/^\s+$/);
	if (regex.test(formObj.value))
		return true;			
	return false;
	}
		
/***************************************************************************/
function validateEqualTo(formObj, otherObjName, Frm) {
	var objName = formatName(formObj);
	var equalToValue = Frm.elements[otherObjName].value;

	if (formObj.value != equalToValue) {
		return errorProcess2(formObj,1,1,otherObjName+' must be the same as '+objName+'.\nPlease make sure the data you entered matches.');
		}
	return true;
	}
	
/***************************************************************************/
function validateLength(formObj,len) {
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	
	if (formObj.value.length < parseInt(len)) {
		return errorProcess2(formObj,1,1,'The '+objName+' must be at least '+len+' characters long');
		}		
	return true;
	}

/***************************************************************************/
function validateNumber(formObj, type, lb, ub) {
	var objName = formatName(formObj);
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
		
	var num = formObj.value;
	if (isNaN(num) || checkBlank(formObj)) {
		return errorProcess2(formObj,1,1,'Please enter a valid number');
		}
	num = (parseInt(type) == 1) ? parseFloat(num) : parseInt(num) ;
	if (num < lb || num > ub)	{
		return errorProcess2(formObj,1,1,'Please enter a number between ' + lb + ' and ' + ub);
		}
	return true;
	}

/***************************************************************************/
function validateNumeric(formObj, len) {
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	var objName = formatName(formObj);
	
	if (len == '*') {
		var regex = /^\d+$/;
		if (!regex.test(formObj.value)) {
			return errorProcess2(formObj,1,1,'Only numeric values are valid for the ' + objName);
			}
		}
	else {
		numReg = "^\\d{"+parseInt(len)+",}$"
		var regex = new RegExp(numReg);
		if (!regex.test(formObj.value)) {
			return errorProcess2(formObj,1,1,'A minimum of '+len+' numeric values are required for the ' + objName);
			}
		}
	return true;
	}

/***************************************************************************/
function validateAlnum(formObj, minLen, tCase, numbers, spaces, puncs) {
	var objName = formatName(formObj);
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	var arrE = new Array();
	arrE[0] = (minLen == "*") ? "None" : minLen;
	var okChars = "";
	switch (tCase.toUpperCase()) {
		case 'U'	:	okChars = "A-Z"; arrE[1] = "UPPER"; break
		case 'L'	:	okChars = "a-z"; arrE[1] = "lower"; break;
		case 'C'	:	okChars = "A-Z][a-z"; if (minLen != "*") minLen--; arrE[1]="Initial capital"; break;
		default		:	okChars = "a-zA-Z"; arrE[1]="Any"; break;
		}
	if (parseInt(numbers)) { okChars += "0-9"; arrE[2] = "Yes"; } else arrE[2] = "No";
	if (parseInt(spaces)) { okChars += " "; arrE[3] = "Yes"; } else arrE[3] = "No";
	if (puncs == "all") { okChars += "."; arrE[4] = "All"; }
	if (puncs == "all") { okChars += puncStr("!@#$%^&*()_+-={}|[]:\";'<\\>?,.?~`"); arrE[4] = "All"; }
	else if (puncs == "none") arrE[4] = "None";
	else { okChars += puncStr(puncs); arrE[4] =  puncStr(puncs).replace(/\\/g,""); }
	var length = (minLen == "*") ? "+" : "{"+minLen+",}";
	var alnumReg = "^["+okChars+"]"+length+"$";
	var regex = new RegExp(alnumReg);
	if (!regex.test(formObj.value) ) {
		return errorProcess2(formObj,1,1,"The data you entered ("+formObj.value+") does not match the requested format for the "+objName+"\nMinimum Length: "+arrE[0]+"\nCase: "+arrE[1]+"\nNumbers allowed: "+arrE[2]+"\nSpaces allowed: "+arrE[3]+"\nPunctuation characters allowed: "+arrE[4]);
		}
	return true;
	}	
/***************************************************************************/
function validateDecimal(formObj, lval, rval) {
	var objName = formatName(formObj);
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	
	(lval == '*')? lval = '*': lval = parseInt(lval);
	(rval == '*')? rval = '*': rval = parseInt(rval);
	var decReg = "";
	if (lval == 0)
		decReg = "^\\.[0-9]{"+rval+"}$";	
	else if (lval == '*')
		decReg = "^[0-9]"+lval+"\\.[0-9]{"+rval+"}$";
	else if (rval == '*')
		decReg = "^[0-9]{"+lval+"}\\.[0-9]"+rval+"$";
	else
		decReg = "^[0-9]{"+lval+"}\\.[0-9]{"+rval+"}$";
	var regex = new RegExp(decReg);
	if (!regex.test(formObj.value)) {
		return errorProcess2(formObj,1,1,formObj.value+' is not a valid '+objName+'.  Please re-enter the '+objName);
		}
	return true;
	}
	
/***************************************************************************/
function validateDecimalR(formObj, lmin, lmax, rmin, rmax) {
	var objName = formatName(formObj);
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	
	(lmin == '*')? lmin = 0: lmin = parseInt(lmin);
	(lmax == '*')? lmax = '': lmax = parseInt(lmax);
	(rmin == '*')? rmin = 0: rmin = parseInt(rmin);
	(rmax == '*')? rmax = '': rmax = parseInt(rmax);
	var	decReg = "^[0-9]{"+lmin+","+lmax+"}\\.[0-9]{"+rmin+","+rmax+"}$"
	var regex = new RegExp(decReg);
	if (!regex.test(formObj.value)) {
		return errorProcess2(formObj,1,1,formObj.value+' is not a valid '+objName+'.  Please re-enter the '+objName);
		}
	return true;
	}
/***************************************************************************/
function validateIP(formObj, portMin, portMax) {
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	if (typeof portMin == 'undefined') portMin = 0;
	if (typeof portMax == 'undefined') portMax = 99999;
	var portOk = true;
	var ipReg = "^((?:([2]{1}[0-5]{2})|([2]{1}[0-4]{1}[0-9]{1})|([1]?[0-9]{2})|([0-9]{1}))[\\.]){3}(?:([2]{1}[0-5]{2})|([2]{1}[0-4]{1}[0-9]{1})|([1]?[0-9]{2})|([0-9]{1}))(\\:[0-9]{1,5})?$"
	var portLoc = formObj.value.indexOf(":");
	if (portLoc != -1) {
		 var port = parseInt(formObj.value.substring(portLoc+1));
		 if (port < portMin || port > portMax) portOk = false;		
		 }
	var regex = new RegExp(ipReg);
	if (!regex.test(formObj.value) || !portOk) {
		var errorMessage =  (regex.test(formObj.value) && !portOk) ?
			"The port number you specified, "+port+",  is out of range.\nIt must be between "+portMin+" and "+portMax :
			formObj.value+' is not a valid IP address.  Please re-enter';
		return errorProcess2(formObj,1,1,errorMessage);
		}
	return true;
	}
/***************************************************************************/
function validateSSN(formObj) {
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }

	var regex = new RegExp(/^\d{3}\-\d{2}\-\d{4}$/);
	if (!regex.test(formObj.value)) {
		return errorProcess2(formObj,1,1,formObj.value+' is not a valid Social Security Number.\nYour SSN must be entered in \'XXX-XX-XXXX\' format.');
		}
	return true;
	}
/***************************************************************************/
function validateMoney(formObj, ds, grp, dml) {
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	
	var moneySyntax;
	if (ds && grp && dml)		// Dollar sign, grouping, and decimal
		{ moneyReg = "^\\$(?:(?:[0-9]{1,3},)(?:[0-9]{3},)*[0-9]{3}|[0-9]{1,3})(\\.[0-9]{2})$";	moneySyntax = "$XX,XXX.XX"; }
	if (ds && grp && !dml)		// Dollar sign and grouping
		{ moneyReg="^\\$(?:(?:[0-9]{1,3},)(?:[0-9]{3},)*[0-9]{3}|[0-9]{1,3})$"; moneySyntax="$XX,XXX"; }
	if (ds && !grp && dml)		// Dollar sign and decimal
		{ moneyReg="^\\$[0-9]*(\\.[0-9]{2})$"; moneySyntax="$XXXXX.XX"; }
	if (!ds && grp && dml)		// Grouping and decimal
		{ moneyReg="^(?:(?:[0-9]{1,3},)(?:[0-9]{3},)*[0-9]{3}|[0-9]{1,3})(\\.[0-9]{2})?$"; moneySyntax="XX,XXX.XX"; }
	if (ds && !grp && !dml)		// Dollar sign only
		{ moneyReg="^\\$[0-9]*$"; moneySyntax="$XXXXX"; }
	if (!ds && grp && !dml)		// Grouping only
		{ moneyReg="^(?:(?:[0-9]{1,3},)(?:[0-9]{3},)*[0-9]{3}|[0-9]{1,3})$"; moneySyntax="XX,XXX"; }
	if (!ds && !grp && dml)		// Decimal only
		{ moneyReg="^[0-9]*(\\.[0-9]{2})$"; moneySyntax="XXXXX.XX"; }
	if (!ds && !grp && !dml)	// No params set, all special chars become optional
		{ moneyReg="^\\$?(?:(?:[0-9]{1,3},?)(?:[0-9]{3},?)*[0-9]{3}|[0-9]{1,3})(\\.[0-9]{2})?$"; moneySyntax="[$]XX[,]XXX[.XX]"; }
	var regex = new RegExp(moneyReg);
	if (!regex.test(formObj.value)) {
		return errorProcess2(formObj,1,1,formObj.value+' does not match the required format of '+moneySyntax+' for '+objName+'.');
		}
	return true;
	}

/***************************************************************************/
function validateSelect(formObj) {
	var objName = formatName(formObj);
	if (formObj.selectedIndex == 0) {
		return errorProcess2(formObj,0,1,"Please select the "+objName);
		}
	return true;
	}
	
/***************************************************************************/
function validateSelectM(formObj, minS, maxS) {
	var objName = formatName(formObj);
	var selectCount = 0;
	if (maxS == 999) maxS = formObj.length;
	for (var i=0; i<formObj.length; i++)
		{
		if (formObj.options[i].selected)
			selectCount++; 
		}
	if (selectCount < minS || selectCount > maxS) {
		return errorProcess2(formObj,0,1,'Please select between '+minS+' and '+maxS+' '+objName+'.\nYou currently have '+selectCount+' selected');
		}
	return true;
	}
	
/***************************************************************************/
function validateSelectI(formObj, indexes) {
	var objName = formatName(formObj);
	var arrIndexes =indexes.split(/[,]/);
	var selectOK = true;
	for (var i=0; i<arrIndexes.length; i++)
		if (formObj.selectedIndex == arrIndexes[i])
			selectOK = false;
	if (!selectOK) {
		return errorProcess2(formObj,0,1,"Please select a valid option for "+objName);
		}
	return true;
	}
		
/***************************************************************************/
function validateZip(formObj, sep) {
	if (typeof sep == 'undefined')
		sep = "- ";
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	zipReg = "^[0-9]{5}(|["+puncStr(sep)+"]?[0-9]{4})$"
	var regex = new RegExp(zipReg);
	if (!regex.test(formObj.value)) {
		return errorProcess2(formObj,1,1,"Please enter a valid 5 or 9 digit Zip code.");
		}
	return true;
	}
	
/***************************************************************************/
function validateCAzip(formObj) {
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	
	zipReg = "^[A-Z][0-9][A-Z] [0-9][A-Z][0-9]$"
	var regex = new RegExp(zipReg);
	if (!regex.test(formObj.value)) {
		return errorProcess2(formObj,1,1,"Please enter a valid postal code.");
		}
	return true;
	}
	
/***************************************************************************/
function validateEmail(formObj)	{	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }

	var emailStr = formObj.value;
	var emailReg1 = /(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/; // not valid
	var emailReg2 = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,6}|[0-9]{1,3})(\]?)$/; // valid
	if (!(!emailReg1.test(emailStr) && emailReg2.test(emailStr))) {// if syntax is valid
		return errorProcess2(formObj,1,1,"Please enter a valid Email address.");
		}
	return true;
	}

/***************************************************************************/
function validateDate(formObj, dateStr, delim, code, specDate) {
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	
	var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
	var vDate = formObj.value;
	var mPlace = dateStr.indexOf("m");
	var dPlace = dateStr.indexOf("d");
	var yPlace = dateStr.indexOf("y");
	var yLength = dateStr.lastIndexOf("y") - yPlace + 1;
	var dateReg = dateStr.replace(/\w/g,"\\d");
	delim = puncStr(delim);
	dateReg = dateReg.replace(/-/g,"[" + delim + "]");
	dateReg = "^" + dateReg + "$";
	var day = vDate.substring(dPlace, dPlace+2);
	var month = vDate.substring(mPlace, mPlace+2);
	var year = vDate.substring(yPlace, yPlace + yLength);
	var regex = new RegExp(dateReg);
	var d = new Date(months[month-1] + " " + day + ", " + year);
	var today = (specDate == 'today') ? new Date() : new Date(specDate);
	today.setHours(0);
	today.setMinutes(0);
	today.setSeconds(0);
	today.setMilliseconds(0);
	var timeDiff = today.getTime() - d.getTime();
	var dateOk = false;
	switch (parseInt(code)) {
		case 1 : // Before specDate
			dateOk = (timeDiff > 0);
			break;
		case 2 : // Before or on specDate
			dateOk = ((timeDiff + 86400000) > 0);
			break;
		case 3 : // After specDate
			dateOk = (timeDiff < 0);
			break;
		case 4 : // After or on specDate
			dateOk = ((timeDiff - 86400000) < 0);
			break;
		default : dateOk = true;
		}
	if (!regex.test(vDate) || d == 'NaN' || !dateOk) {
		return errorProcess2(formObj,1,1,"Please enter a valid date");
		}
	return true;
	}
	
/***************************************************************************/
function validatePhone(formObj)	{
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	
	phoneReg = "^(?:[\(][0-9]{3}[\)]|[0-9]{3})[-. ]?[0-9]{3}[-. ]?[0-9]{4}$";
	var regex = new RegExp(phoneReg);
	if (!regex.test(formObj.value)) {
		return errorProcess2(formObj,1,1,"Please enter a valid Phone number plus Area Code.");
		}
	return true;
	}
	
/***************************************************************************/
function validateCheckbox(formObj, minC, maxC) {	
	var objName = formatName(formObj);
	var formObj = formObj.form.elements[formObj.name];
	var checkTotal = formObj.length;
	var checkCount = 0;
	
	if (maxC == 999) maxC = checkTotal;
	for (var i=0; i<checkTotal; i++) {
		if (formObj[i].checked) checkCount++;
		}
	if (checkCount < minC || checkCount > maxC) {
		if (fv['groupError']) { addError(formObj); return true; }
		alert('You must agree with all terms and conditions');
		for (i=formObj.length-1; i>=0; i--)
			errorProcess(formObj[i],0,1);
		return false;
		}
	return true;
	}

/***************************************************************************/	
function validateRadio(formObj) {	
	var objName = formatName(formObj);
	var formObj = formObj.form.elements[formObj.name];
	var selectTotal = 0;
	
	for (i=0; i<formObj.length; i++)
		if (formObj[i].checked)
			selectTotal++;

	if (selectTotal != 1) {
		if (fv['groupError']) { addError(formObj); return true; }
		alert((formObj[0].getAttribute(fv['emsg'])) ? formObj[0].getAttribute(fv['emsg']) : 'Please select an option for '+objName);
		for (i=formObj.length-1; i>=0; i--)
			errorProcess(formObj[i],0,1);
		return false;
		}		
	return true;
	}
/***************************************************************************/		
function validateEitherOr(formObj, del, fields) {
	var f = formObj.form;
	var arrF = fields.split(del);
	var nbCount = 0;
	var list = "";
	for (var i=0; i<arrF.length; i++) {
		list += " -"+formatName(f.elements[arrF[i]])+"\n";
		if (!checkBlank(f.elements[arrF[i]]))
			nbCount++;
		}
	if (nbCount != 1) {
		if (fv['groupError']) { addError(f.elements[arrF[0]]); return true; }
		alert((formObj.getAttribute(fv['emsg'])) ? formObj.getAttribute(fv['emsg']) : "Only one of the following fields may be filled in:\n"+list);
		for (var i=0; i<arrF.length; i++)
			errorProcess(f.elements[arrF[i]],0,0);
		return false;
		}
	return true;
	}
/***************************************************************************/
function validateAtLeast(formObj, qty, del, fields) {
	var f = formObj.form;
	var arrF = fields.split(del);
	var nbCount = 0;
	var list = "";
	for (var i=0; i<arrF.length; i++) {
		list += " -"+formatName(f.elements[arrF[i]])+"\n";
		if (!checkBlank(f.elements[arrF[i]])) {
			nbCount++;
			}
		}
	if (nbCount < parseInt(qty)) {
		if (fv['groupError']) { addError(f.elements[arrF[0]]); return true; }
		alert((formObj.getAttribute(fv['emsg'])) ? formObj.getAttribute(fv['emsg']) : "At least "+qty+" of the following fields must be filled in:\n"+list);
		for (var i=0; i<arrF.length; i++)
			errorProcess(f.elements[arrF[i]],0,0);
		return false;
		}
	return true;
	}	
/***************************************************************************/
function validateFile(formObj, extensions, cSens) {
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	
	cSens = (cSens) ? "" : "i";
	regExten = extensions.replace(/,/g,"|");
	var fileReg = "^.+\\.("+regExten+")$";
	var regex = new RegExp(fileReg,cSens);
	if (!regex.test(formObj.value)) {
		return errorProcess2(formObj,1,1,"The file must be one of the following types:\n"+extensions+"\nNote: File extention may be case-sensitive");
		}		
	return true;
	}		
/***************************************************************************/		
function validateCustom(formObj) {
	var objName = formatName(formObj);	
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	
	var regex = new RegExp(formObj.getAttribute(fv['pattern']));
	if (!regex.test(formObj.value)) {
		return errorProcess2(formObj,1,1,"The "+objName+" is invalid.");
		}		
	return true;
	}
/****************************************************************************
*	Here are all the ancillary functions
****************************************************************************/
function addError(o) {
	errorData[errorData.length] = o;	
	}
/***************************************************************************/
function formatName(o) {
	var wStr = (o.name) ? o.name : o.id;
	wStr = wStr.replace(/_/g," ");
	return wStr;
	}
/***************************************************************************/	
function errorProcess(o, sel, foc) {
	fv['revertClass'] = o.className;
	o.className = fv['errorClass'];
	if (sel) o.select();
	if (foc) o.focus();
	}
		
function errorProcess2(o, sel, foc, error) {
	var ret = false;
	if (fv['groupError']) { addError(o); ret = true; }
	else {
		alert((o.getAttribute(fv['emsg'])) ? o.getAttribute(fv['emsg']) : error);
		if (sel) o.select();
		if (foc) o.focus();
		}
	fv['revertClass'] = o.className;		
	o.className = fv['errorClass'];
	return ret;
	}		
/***************************************************************************/
function clearStyle(o) {
	if (o.className == fv['errorClass']) o.className = fv['revertClass'];

	}
/***************************************************************************/	
function puncStr(str) {
	str = str.replace("pipe", "|");
	return str.replace(/([\\\|\(\)\[\{\^\$\*\+\?\.])/g,"\\$1");
//	return str.replace(/([\!\@\#\$\%\^\&\*\(\)\_\+\-\=\{\}\|\[\]\\\:\"\;\'\<\>\?\,\.\/])/g,"\\$1");
	}

/*****************************************************************************************************	
*	CREDIT CARD FUNCTIONS
*
*********** WARNING: DO NOT EDIT BELOW THIS LINE UNLESS YOU KNOW WHAT YOU ARE DOING! ****************/	

function cleanupCCNum(ccNum) {
	return ccNum.replace(/\D/g,'');
	}	
/***************************************************************************/	
function validateCC(formObj) {
	if (fv['bok'] && checkBlank(formObj))
		{ fv['bok']=false; return true; }
	var objName = formatName(formObj);
	
	switch (formObj.form.elements[fv['ccType']].value.toUpperCase()) {
		case 'VISA'		: var ccReg = /^4\d{12}(\d{3})?$/; break;
		case 'MC'		: var ccReg = /^5[1-5]\d{14}$/; break;
		case 'DISC'		: var ccReg = /^6011\d{12}$/; break;
		case 'AMEX'		: var ccReg = /^3[4|7]\d{13}$/; break;		
		case 'DINERS'	: var ccReg = /^3[0|6|8]\d{12}$/; break;
		case 'ENROUTE'	: var ccReg = /^2[014|149]\d{11}$/; break;
		case 'JCB'		: var ccReg = /^3[088|096|112|158|337|528]\d{12}$/; break;
		case 'SWITCH'	: var ccReg = /^(49030[2-9]|49033[5-9]|49110[1-2]|4911(7[4-9]|8[1-2])|4936[0-9]{2}|564182|6333[0-4][0-9]|6759[0-9]{2})\d{10}(\d{2,3})?$/; break;
		case 'DELTA'	: var ccReg = /^4(1373[3-7]|462[0-9]{2}|5397[8|9]|54313|5443[2-5]|54742|567(2[5-9]|3[0-9]|4[0-5])|658[3-7][0-9]|659(0[1-9]|[1-4][0-9]|50)|844[09|10]|909[6-7][0-9]|9218[1|2]|98824)\d{10}$/; break;
		case 'SOLO'		: var ccReg = /^(6334[5-9][0-9]|6767[0-9]{2})\d{10}(\d{2,3})?$/; break;
		// Add additonal card types here
		default			: if (!fv['groupError']) alert('Error! Card Type not found!'); return false;
		}
	var formatOK = ccReg.test(formObj.value);
	var luhnOK = validateLUHN(formObj.value);	
	if (!formatOK || !luhnOK) {
		return errorProcess2(formObj,1,1,'The '+objName+' you entered is not valid. Please check again and re-enter');
		}		
	return true;
	}
/***************************************************************************/	
function validateLUHN(ccString) {
	var odds = "";
	var evens = "";
	var i=1;
	
	for (i=ccString.length-2; i>=0; i=i-2) {
		var digit = parseInt(ccString.charAt(i)) * 2;
		odds += digit+"";
		}
	for (i=ccString.length-1; i>=0; i=i-2)
		evens += ccString.charAt(i);
	var luhnStr = odds + evens;
	var checkSum = 0;
	for (i=0; i<luhnStr.length; i++)
		checkSum += parseInt(luhnStr.charAt(i));	
	return (checkSum % 10 == 0);
	}
	