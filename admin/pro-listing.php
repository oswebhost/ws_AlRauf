<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
$JAVA='100';
include("../common.php");
include("header.ini.php");



if (!isset($per_page)): $per_page=80;endif;
$pageNav="";

$heading="Property Listing Active";
$tbname="ads";
$ORDER = "property_type,property_title";
$number=0;
$query="SELECT * from $tbname order by $ORDER";
$result= mysql_query($query) or die(mysql_error());
$number_rows = mysql_num_rows($result);
mysql_free_result($result); 

if((!$PAGE) || (is_numeric($PAGE) == false) || ($PAGE < 0) || ($PAGE > $number_rows)) {
      $PAGE = 1; //default
 } 
$total_pages = ceil($number_rows/$per_page) ;
$set_limit 	= $PAGE * $per_page - ($per_page);


$X=50;

$pageNav  ="<form style='padding:0;margin:0px;' method='post' action='$PHP_SELF'>\n";
$pageNav .= "Page: <input type='hidden' name='per_page' value='$per_page'>\n" ;
$pageNav .= "<select class='bt' name='PAGE' onChange='this.form.submit();' style=\"width:50px;height:20px;font-size:11px;\" >\n" ;

for ($i=1; $i<=$total_pages; $i++):
 $X++;
 $pp = ($i<10? "0$i" : $i) ;
	$pageNav .= "<option value='$i' ";
	if ($i==$PAGE) : $pageNav .= " selected " ; endif;
	$pageNav .= ">$pp </option>\n";
endfor;	

$pageNav .= "</select>\n\n</form>\n\n";

$Today=time();
$query="SELECT a.* from ads a order by a.posted_date desc LIMIT $set_limit,$per_page";
$result= mysql_query($query) or die(mysql_error());

$list="";


	if ($action=="DELETE"):
		
	
		echo "<br><br><div id='link' align='center'><div id='head'>Delete this Posting? [<a href='post-free.php?action=DEL&ID=$ID'>Y E S</a>]&nbsp;&nbsp;&nbsp;[<a href='member-home.php'>N o</a>]</div></div>";

		echo "<br/>";

	endif;




?>
<div align="center">
      <table border="0" cellspacing="0" style="border-collapse: collapse"  width="100%" >
        <tr>
          <td width="100%" valign="top"><span class="pagehd"><? echo $heading?></span>

			 <div align='center' style="padding-bottom: 10px;;"> <? echo  $pageNav?></div>
			  
		 <table border="1" cellspacing="0" style="border-collapse: collapse" cellpadding="4" bordercolor="#cccccc" width="100%">
		  <tr height="25" class="tbhead">
			<td width="5%"  align="center"><b>Offer</b></td>
			<td width="10%" align="center"><b>Property Type</b></td>
			<td width="20%"  align="center"><b>Title</b></td>
			<td width="10%" align="center"><b>Listing Status </b></td>
			<td width="4%" align="center"><b>Beds</b></td>
			<td width="4%" align="center"><b>Baths</b></td>
			<td width="10%" align="center"><b>Demand</b></td>
			<td width="10%" align="center"><b>Location</b></td>
			<td width="15%" align="center"><b>Options</b></td> 
		  </tr>
		  <? 
		  $fee=0; $fea=0;$number=0;
		  while ($data = mysql_fetch_array($result) ):
		   $rowcol = rowcol($number++);
			echo "<tr $rowcol>\n";

			echo "<td align='center'>$data[offer_type]</td>\n";
			echo "<td  align='center'>$data[property_type]</td>\n";

			echo "<td>$data[property_title]";

			echo "<br>". agent_name($data["agent_id"]) ;
			echo "</td>\n";
			echo "<td align='center'>" . listing_status($data["ad_status"]) . " </td>\n" ;

			echo "<td align='center'>" . $data[bedrooms]  ."</td>\n";
			echo "<td align='center'>" . $data[bathrooms]  ."</td>\n";
			echo "<td align='right'>". num2($data[price]). "<b>" . $data[price_in] ."</b></td>\n";
			echo "<td align='center'>". $data[location]."</td>\n";
			
			echo "<td align='center'>";
			echo "<a href='add-images.php?ID=$data[rid]&PAGE=$PAGE'>Add Photos</a>";
			echo " | ";
			echo "<a href='post-property.php?ID=$data[rid]&action=EDIT&PAGE=$PAGE'>Edit</a>";
			echo " | ";
			echo "<a href='post-property.php?ID=$data[rid]&action=DELETE&PAGE=$PAGE'>Del</a>";
			echo "</td>";
			
			echo "</tr>\n";
		  endwhile;		  
		  ?>
		
		</table>

<? include("navi.ini.php"); ?>


		 </td>
        </tr>
     </table>
    </center>
</div>
   
<? include("footer.ini.php") ?>

