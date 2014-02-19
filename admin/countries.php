<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../config.ini.php");
include("../common.php");
include("header.ini.php");


if (!isset($per_page)): $per_page=60; endif;
if (!isset($ACTION)) : $ACTION="LIST"; endif;


$pageNav=""; $heading = "List of Countries" ; $tbname = "countries" ; $ORDER="country_name" ;

if ( ($ACTION=='ADD') and ($GO=="SAVE") ):
	$q = mysql_query("insert into $tbname (country_id,country_name,code_2) VALUES (0,'$country_name', '$code_2') ") or die ( mysql_error() ) ;
endif;

if ( $ACTION=='DEL') :
	$q = mysql_query("DELETE from $tbname where country_id='$ID'") or die ( mysql_error() ) ;
	$ACTION='LIST' ;
endif; 

if ( ($ACTION=='EDIT') and ($GO=="SAVE") ):
	$q = mysql_query("UPDATE $tbname set country_name='$country_name', code_2='$code_2' where country_id='$ID'") or die ( mysql_error() ) ;
endif;

if ( ($ACTION=='EDIT') or ($ACTION=='DELETE') ):
	$q = mysql_query("select * from $tbname where country_id='$ID' ") or die ( mysql_error() ) ;
	$d = mysql_fetch_array($q) ;
endif;



$query="SELECT * from $tbname order by $ORDER";

$result= mysql_query($query) or die( mysql_error() );
$number_rows = mysql_num_rows($result);

mysql_free_result($result); 
if (!isset($PAGE)): $PAGE=0; $npage=1; else:
	$npage=$PAGE;
	$PAGE=($PAGE*$per_page) - ($per_page-1)-1;
endif;
$total_pages = intval($number_rows/$per_page);
if ($number_rows % $per_page): $total_pages++;endif;
if ($total_pages>1): 
   $pageNav="Pages: ";
   for ($i=1; $i<=$total_pages; $i++):
     if ($i!=$npage):
  		$pageNav .= "&nbsp;<a class='page' href=$PHP_SELF?PAGE=$i&per_page=$per_page>".$i."</a>";
	 else:
		$pageNav .="&nbsp;".$i;
	 endif;
   endfor;
endif;

$query="SELECT * from $tbname order by $ORDER LIMIT $PAGE,$per_page";
$result= mysql_query($query) or die( mysql_error() );
$list="";
$number=0;
while ($row = mysql_fetch_array($result) ):
 $number++;

 $del_url="<a href=$PHP_SELF" ;
 $del_url.="?PAGE=$npage&per_page=$per_page&ACTION=DELETE&ID=";

 $edit_url="<a href=" . $PHP_SELF;
 $edit_url.="?PAGE=$npage&per_page=$per_page&ACTION=EDIT&ID=";
 $edit_url.= $row["country_id"]; 

 $del_url.= $row["country_id"];


 $edit_url.= ">";
 $del_url.= ">";

 $rowcol = rowcol($number);
 $list .="<tr>";
 $list .="<td  $rowcol align=\"center\">" . strtoupper($row["code_2"]) ;
 $list .="</td><td  $rowcol align=\"left\">";
 $list.= trim($row["country_name"]) ;
 
 
 $list .= "</td>\n"  ;


 $list .="<td $rowcol align=\"center\">". $edit_url . "Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
 $list .= $del_url ."DEL</a>";
 $list .="</td></tr>\n";
endwhile;



?>
<div align="center">
      <table border="0" cellspacing="3" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="8" id="AutoNumber2" bgcolor="#FFFFFF">
        <tr>
          <td width="40%" valign="top"><p class="pagehd"><? echo $heading?></p>
		  	  <? echo $pageNav?>
		
		 <A  HREF="<?= $fileurl ?>"></a>
		 <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse" bordercolor="#A7B0BA" width="90%" id="AutoNumber1">
		  <tr>
			<td width="10%" bgcolor="#A7B0BA" align="center"><b>A.code</b></td>
		    <td width="40%" bgcolor="#A7B0BA" align="center"><b>Country</b></td>
			
		    <td width="30%" bgcolor="#A7B0BA" align="center"><b>Options</b></td>
		  </tr>
		  <? echo $list ?>
		
		</table>
<BR>
<BR>

<div align="right">

<FORM METHOD=POST ACTION="<?= $PHP_SELF?>?ACTION=LIST&fileused=<? echo$fileused?>">
	List Per Page:<SELECT class="go" NAME="per_page"> 
	<option <? if($per_page==20): echo "selected";endif;?>>20</option>
	<option <? if($per_page==40): echo "selected";endif;?>>40</option>
	<option <? if($per_page==60): echo "selected";endif;?>>60</option>
	<option <? if($per_page==80): echo "selected";endif;?>>80</option>
	</SELECT>
    <INPUT class="go" TYPE="submit" value="Go">
</FORM>

</div>

 <td width="60%" valign="top">
	<P><BR>
	<div align="center"><A HREF="<?= "$PHP_SELF?ACTION=ADD" ?>">+ Click here to ADD NEW <?= $heading ?>   </A>
	<P>



<? if ($ACTION<>'LIST') : ?>
<form method="POST" action="<?= $PHP_SELF ?>" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);">
	<INPUT TYPE="hidden" name="ID" value="<?= $ID ?>">
	<INPUT TYPE="hidden" name="per_page" value="<?= $per_page ?>">
	<INPUT TYPE="hidden" name="PAGE" value="<?= $npage ?>">
	<INPUT TYPE="hidden" name="ACTION" value="<?= $ACTION ?>">
	<INPUT TYPE="hidden" name="GO" value="SAVE">



	<table border="0" width="95%" id="table1" align="center">
		<tr <?= rowcol(1) ?>>
			<td width="20%">Country</td>
			<td valign="top">
				<input type="text" class="find" name="country_name" size="35" value="<?= $d["country_name"] ?>" alt=length|4 >
			</td>
		</tr>
		<tr <?= rowcol(2) ?>>
			<td width="20%">Code</td>
			<td valign="top">
				<input type="text" class="go" name="code_2" size="10" value="<?= $d["code_2"] ?>" >  <A target="_blank"  HREF="http://www.iso.org/iso/en/prods-services/iso3166ma/02iso-3166-code-lists/list-en1.html">Check for Code</A> 
			</td>
		
		</tr>		

	
		
		</tr>
		<tr <?= rowcol(1) ?>>
			<td colspan="2" align="center">
			<input type="submit" value=" Save " name="B1" style='width:150px;'></td>
		</tr>
	</table>
</form>

<? 

	if ($ACTION=='DELETE') :
		echo "<div align='cneter'> " ;
		echo "<span class=err>Are you sure? You wanted to DELETE selected $heading ?</span>" ;
		echo "<br /><br />" ;

		echo "<a href='$PHP_SELF?ACTION=DEL&ID=$ID&per_page=$per_page&PAGE=$npage'>[  Y E S  ]</a>" ;
		
		echo "</div> ";
	endif;

endif; 

?>


 </td>
		 </td>

        </tr>
     </table>
    </center>
</div>
   
<? include("footer.ini.php") ;




?>

