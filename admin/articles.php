<? 
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-win.com/us/co.uk  ##
#############################################################
include("../common.php");
include("header.ini.php");
$new_img='';



if (!isset($per_page)): $per_page=60; endif;
if (!isset($_REQUEST['ACTION'])) : $_REQUEST['ACTION']="LIST"; endif;


$pageNav=""; $heading = "Articles" ; $tbname = "news" ; $ORDER="rank, title" ;

 if ($_REQUEST['GO']=="SAVE"){
      
    $d_answer = addslashes(trim($_POST['answer'])) ;
    $title    = addslashes(trim($_POST['title'])) ;
    $rank     = (int) $_POST['rank'];
    $ID       = $_REQUEST['ID'];



    if ( ($_REQUEST['ACTION']=='ADD')):
        $q = mysql_query("insert into $tbname (title, rank, content,news) VALUES ('$title','$rank', '$d_answer', '0') ") or die ( mysql_error() ) ;
        $ID = mysql_insert_id() ; 
        $_REQUEST['ACTION']='EDIT' ;
        $_REQUEST['GO']="";
    endif;
    
    if ( ($_REQUEST['ACTION']=='EDIT') ):
         $q = mysql_query("UPDATE $tbname set title='$title', rank='$rank', content='$d_answer' where rid='$ID'") or die ( mysql_error() ) ;
    endif;
 } 
 
if ( $_REQUEST['ACTION']=='DEL') :
	$q = mysql_query("select news_img from $tbname where rid='$ID'") or die ( mysql_error() ) ;
	$d = mysql_fetch_array($q) ;
	$q = mysql_query("DELETE from $tbname where rid='$ID'") or die ( mysql_error() ) ;
	$_REQUEST['ACTION']='LIST' ;
endif; 
         
if ( ($_REQUEST['ACTION']=='EDIT') or ($_REQUEST['ACTION']=='DELETE') ):
	$q = mysql_query("select * from $tbname where rid='$ID' ") or die ( mysql_error() ) ;
	$d = mysql_fetch_array($q) ;
endif;


$query="SELECT * from $tbname where news='0' order by $ORDER";

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

$query="SELECT * from $tbname where news='0' order by $ORDER LIMIT $PAGE,$per_page";
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
 $list.= trim($row["title"]) ."</td>\n"  ;


 $list .="<td $rowcol align=\"center\">". $edit_url . "Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
 $list .= $del_url ."DEL</a>";
 $list .="</td></tr>\n";
endwhile;



?>
<div align="center">
      <table border="0" cellspacing="3" style="border-collapse: collapse" bordercolor="#111111" width="100%" cellpadding="0" id="AutoNumber2" bgcolor="#FFFFFF">
        <tr>
          <td width="40%" valign="top"><p class="pagehd"><? echo $heading?></p>
		  	  <? echo $pageNav?>
		
		 <a href="<?= $fileurl ?>"></a>
		 <table border="1" cellspacing="0" cellpadding="4" style="border-collapse: collapse" bordercolor="#cccccc" width="100%" id="AutoNumber1">
		  <tr>
			<td width="5%" class="tbhead" align="center"><b>No</b></td>
		    <td width="60%" class="tbhead" align="center"><b>Title</b></td>
		    <td width="20%" class="tbhead" align="center"><b>Options</b></td>
		  </tr>
		  <? echo $list ?>
		
		</table>
<br />
<br />

<div align="right">

<form method='post' action="<?= $PHP_SELF?>?ACTION=LIST&fileused=<? echo$fileused?>">
	List Per Page:<select class="go" name ="per_page"> 
	<option <? if($per_page==20): echo "selected";endif;?>>20</option>
	<option <? if($per_page==40): echo "selected";endif;?>>40</option>
	<option <? if($per_page==60): echo "selected";endif;?>>60</option>
	<option <? if($per_page==80): echo "selected";endif;?>>80</option>
	</select>
    <input class="go" type="submit" value="Go"/>
</form>

</div>

 <td width="60%" valign="top">
	<P><br />
	<div align="center"><a href="<?= "$PHP_SELF?ACTION=ADD" ?>">+ Click here to ADD NEW <?= $heading ?>   </A>
	<P>
<? 
	if ($_REQUEST['ACTION']=='DELETE') :
		echo "<div class='err'> " ;
		echo "Are you sure? You wanted to DELETE selected $heading ?" ;
		echo "<br /><br />" ;

		echo "<a href='$PHP_SELF?ACTION=DEL&ID=$ID&per_page=$per_page&PAGE=$npage'>[  Y E S  ]</a>" ;
		
		echo "</div> ";
	endif;
?>



<? if ($_REQUEST['ACTION']<>'LIST') : ?>
<form method="POST" action="<?= $PHP_SELF ?>"  enctype="multipart/form-data" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);">
	<input type="hidden" name="ID" value="<?= $_REQUEST['ID'] ?>" />
	<input type="hidden" name="per_page" value="<?= $per_page ?>"/>
	<input type="hidden" name="PAGE" value="<?= $npage ?>"/>
	<input type="hidden" name="ACTION" value="<?= $_REQUEST['ACTION'] ?>"/>
	<input type="hidden" name="GO" value="SAVE"/>
	<input type="hidden" name="new_image1" value="<?= $d["news_img"] ?>"/>
	<input type="hidden" name="submitted" value="true"/>


	<table border="0" width="98%" id="table1" align="center">
		<tr <?= rowcol(1) ?>>
			<td width="20%">Title</td>
			<td valign="top">
				<input type="text" class="head" name="title" size="20" value="<?= $d["title"] ?>" alt=length|4 >
			</td>
		</tr>
		<tr <?= rowcol(2) ?>>
			<td width="20%">Display Order</td>
			<td valign="top">
				<input type="text" class="go" name="rank" size="20" value="<?= $d["rank"] ?>"  >
			</td>
		</tr>
		<!-- <tr <?= rowcol(1) ?>>
			<td width="20%">Picture (JPG only)</td>
			<td valign="top">
				<input type="file" class="head" name="img[]" size="80" value=""  ><br />
				 Any size.  System will automatically resize it.
			</td>
		</tr> -->
		<tr <?= rowcol(2) ?>>
			
			<td valign="top" colspan='2'>
				Content:<br />	
			
                <?  $CONTENT="answer"; $_content= stripslashes(trim($d["content"]));
                    $Height="400px";$toolbar=1;
                    include("spaw.ini.php"); 
                ?>	 
			</td>
		
		</tr>
		<tr <?= rowcol2(1) ?>>
			<td colspan="2" align="center">
			<input type="submit" value=" Save " name="B1" class="bt"></td>
		</tr>
	</table>
</form>

<? 

	
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

