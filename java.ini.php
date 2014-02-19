<SCRIPT language="JavaScript" type="text/javascript">

	var newwindow = ''
	function view(url) {
	if (newwindow.location && !newwindow.closed) {
		newwindow.location.href = url; 
		newwindow.focus(); } 
	else { 
		newwindow=window.open(url,'htmlname','width=404,height=316,resizable=1');} 
	}

	function tidy() {
	if (newwindow.location && !newwindow.closed) { 
	   newwindow.close(); } 
	}



function view(url) {

if (newwindow.location && !newwindow.closed) {

    newwindow.location.href = url; 

    newwindow.focus(); } 

else { 

    newwindow=window.open(url,'htmlname',' left=0,top=0,width=518,height=670,resizable=0,scrollbars=yes');} 

}

function regpass(url) {

if (newwindow.location && !newwindow.closed) {

    newwindow.location.href = url; 

    newwindow.focus(); } 

else { 

    newwindow=window.open(url,'htmlname',' left=200,top=100,width=450,height=250,resizable=0,scrollbars=yes');} 

}

</script> 

<SCRIPT language="JavaScript" type="text/javascript">

_editor_url = "admin/htmlarea/";                

var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);

if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }

if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }

if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }

if (win_ie_ver >= 5.5) {

 document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');

 document.write(' language="Javascript1.2"></scr' + 'ipt>');  

} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }



</script> 



<script src="fValConfig.js"></script>

<script src="fValidate.js"></script>



<SCRIPT language="JavaScript" type="text/javascript">

//document.write('<STYLE TYPE="text/css">.imgTrans{ filter:revealTrans(duration=0.2,transition=9) }</STYLE>');

//Uncomment the next line for fading rollovers instead of dissolving:
document.write('<STYLE TYPE="text/css">.imgTrans{ filter:blendTrans(duration=0.4) }</STYLE>');

var onImages=new Array();
function Rollover(imgName, imgSrc)
{
	onImages[imgName] = new Image();
	onImages[imgName].src = imgSrc;
}

function turnOn(imgName){ 
	if(document.images[imgName].filters != null)
		document.images[imgName].filters[0].apply();
	document.images[imgName].offSrc = document.images[imgName].src;
	document.images[imgName].src    = onImages[imgName].src;
	if(document.images[imgName].filters != null)
		document.images[imgName].filters[0].play();
}

function turnOff(imgName){ 
	if(document.images[imgName].filters != null)
		document.images[imgName].filters[0].stop();
	document.images[imgName].src = document.images[imgName].offSrc;
}

//Specify name of participating images, plus paths to their onMouseover replacements:
Rollover("home",  "images/home_on.jpg");
Rollover("about", "images/about_on.jpg");
Rollover("contact", "images/contact_on.jpg");
Rollover("search", "images/search_on.jpg");
Rollover("adv", "images/adv_on.jpg");
Rollover("news", "images/news_on.jpg");
Rollover("property", "images/property_on.jpg");

</script>


<script>

var dayarray=new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat")
var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")

function getthedate(){
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var hours=mydate.getHours()+12
var minutes=mydate.getMinutes()
var seconds=mydate.getSeconds()
var dn="AM"
if (hours>=12)
dn="PM"
if (hours>12){
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
//change font size here
var cdate="<small><font color='ffffff' face='tahoma'><b>"+dayarray[day]+" "+" "+daym+"-"+montharray[month] +"-"+year+" "+hours+":"+minutes+":"+seconds+" "+dn
+"</b></font></small>"
if (document.all)
document.all.clock.innerHTML=cdate
else if (document.getElementById)
document.getElementById("clock").innerHTML=cdate
else
document.write(cdate)
}
if (!document.all&&!document.getElementById)
getthedate()
function goforit(){
if (document.all||document.getElementById)
setInterval("getthedate()",1000)
}

</script>
