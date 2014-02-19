<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");


if (!isset($per_page)): $per_page=60; endif;
if (!isset($ACTION)) : $ACTION="LIST"; endif;


$pageNav=""; $heading = "FAQ" ; $tbname = "faq" ; $ORDER="rank, question" ;

if ( ($ACTION=='ADD') and ($GO=="SAVE") ):
	$d_answer = addslashes(trim($answer)) ;
	$q = mysql_query("insert into $tbname (question, rank, answer) VALUES ('$question','$rank', '$d_answer') ") or die ( mysql_error() ) ;
endif;

if ( $ACTION=='DEL') :
	$q = mysql_query("DELETE from $tbname where rid='$ID'") or die ( mysql_error() ) ;
	$ACTION='LIST' ;
endif; 

if ( ($ACTION=='EDIT') and ($GO=="SAVE") ):
	$d_answer = addslashes(trim($answer)) ;
	$q = mysql_query("UPDATE $tbname set question='$question', rank='$rank', answer='$d_answer' where rid='$ID'") or die ( mysql_error() ) ;
endif;

if ( ($ACTION=='EDIT') or ($ACTION=='DELETE') ):
	$q = mysql_query("select * from $tbname where rid='$ID' ") or die ( mysql_error() ) ;
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
  		$pageNav .= "&nbsp;<a href=$PHP_SELF?PAGE=$i&per_page=$per_page>".$i."</a>";
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
 $edit_url.= $row["rid"]; 

 $del_url.= $row["rid"];


 $edit_url.= ">";
 $del_url.= ">";

 $rowcol = rowcol($number);
 $list .="<tr>";
 $list .="<td  $rowcol align=\"center\">" . $number ;
 $list .="</td><td  $rowcol align=\"left\">";
 $list.= trim($row["question"]) ."</td>\n"  ;


 $list .="<td $rowcol align=\"center\">". $edit_url . "Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
 $list .= $del_url ."DEL</a>";
 $list .="</td></tr>\n";
endwhile;



?>
<div align="center">
      <table border="0" cellspacing="3" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="0" id="AutoNumber2" bgcolor="#FFFFFF">
        <tr>
          <td width="50%" valign="top"><p class="pagehd"><? echo $heading?></p>
		  	  <? echo $pageNav?>
		
		 <A  HREF="<?= $fileurl ?>"></a>
		 <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse" bordercolor="#0057C1" width="100%" id="AutoNumber1">
		  <tr>
			<td width="5%" class="tbhead" align="center"><b>No</b></td>
		    <td width="80%" class="tbhead" align="center"><b>Question</b></td>
		    <td width="15%" class="tbhead" align="center"><b>Options</b></td>
		  </tr>
		  <? echo $list ?>
		
		</table>
<BR>
<BR>

<? include("navi.ini.php"); ?>

 <td width="50%" valign="top">
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



	<table border="0" width="98%" id="table1" align="center">
		<tr <?= rowcol(1) ?>>
			<td width="20%">Question</td>
			<td valign="top">
				<input type="text" class="find" name="question" size="20" value="<?= $d["question"] ?>" alt=length|4 >
			</td>
		</tr>
		<tr <?= rowcol(2) ?>>
			<td width="20%">Display Order</td>
			<td valign="top">
				<input type="text" class="go" name="rank" size="20" value="<?= $d["rank"] ?>"  >
			</td>
		</tr>

		<tr <?= rowcol(1) ?>>
			<td width="20%" valign="top">Answer</td>
			<td valign="top">
				<textarea rows="8" name="answer" cols="20" class="text"><p><? echo stripslashes(trim($d["answer"])) ?>
				</textarea>
				  <script language="javascript1.2">
					var config = new Object(); // create new config object
				config.toolbar = [ ['bold','italic','underline', 'strikethrough','subscript','superscript'],
								   ['justifyleft','justifycenter','justifyright','OrderedList','UnOrderedList'],
								   ['Outdent', 'Indent','forecolor','htmlmode'] ]; 
						config.width = "98%";
						config.height = "280px";
						config.bodyStyle = 'background-color: white; font-family: "Tahoma"; font-size: x-small;';
						config.debug = 0;
						config.stylesheet = "style.css";
						editor_generate('answer',config);

					</script>
			</td>
		
		</tr>
		<tr <?= rowcol2(1) ?>>
			<td colspan="2" align="center">
			<input type="submit" value=" Save " name="B1" class="sm_combo"></td>
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

