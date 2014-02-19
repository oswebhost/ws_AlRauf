<?  ob_start();
session_start() ;
$userid = $_SESSION['userid'];

$curpage = "news";
include('common.php'); 

$per_page=10;
$q = mysql_query("select * from project_name order by rid desc ") or die(mysql_error());

$number_rows = mysql_num_rows($q);
mysql_free_result($q); 
if (!isset($PAGE)): $PAGE=0; $npage=1; else:
	$npage=$PAGE;
	$PAGE=($PAGE*$per_page) - ($per_page-1)-1;
endif;
$total_pages = intval($number_rows/$per_page);
if ($number_rows % $per_page): $total_pages++;endif;
$X=	0;
if ($total_pages>1): 
  
$b = $npage -1 ;
$next = $npage + 1;



$pageNav .= "Page No : " ;


  
   for ($i=1; $i<=$total_pages; $i++):
	 $X++;
	 if ($i==$npage):
		 $pageNav .= "&nbsp;<B>[$i]</B>";
	 else:
		$pageNav .= "&nbsp;<a style='width:20px' href=$PHP_SELF?p=news&PAGE=$i>$i</a>";
	 endif;
	
	 if ($X>9): $pageNav .= "<br />"; $X=0;  endif;
	
   endfor; 

 
  
endif;

$q = mysql_query("SELECT * from project_name order by rid desc LIMIT $PAGE,$per_page") or die (mysql_error());

$page_content='';
$cap = '';

if (!isset($_GET[ID])) :
	$ch = "\n\n" ;
	$p= $PAGE+1;
	
		$page_content = "<center><table width='95%' border='0' cellpadding='4'>";
	$n=0;
	while ($d = mysql_fetch_array($q) ):
		$rowcol=rowcol($n++);
		$page_content .= "<tr >\n";
		$page_content .= "<td valign='top'  width='20'>";
		if (is_file("projects/" . $d['logo'])):
			$page_content .= "<img src='projects/$d[logo]' border='0' align='left' style='padding-right:10px;padding-bottom:10px;'>";
		endif;
		$page_content .= "</td>\n";
		$page_content .= "<td valign='top' style='padding-bottom:10px;' $rowcol ><div id='link'><a href='$PHP_SELF?ID=$d[rid]&PAGE=$p'>$d[project_name]</a></div>\n\n";
		$page_content .= "<p style='padding:0;'>" . stripslashes(substr(strip_tags($d["project_desc"]),0,560)) . "</td>";
		$page_content .= "</tr>";

	endwhile;
	$page_content .=  "</table></center>\n\n";
	
	$page_content .= "<div align='center' style='padding:10px;' id='link'>$pageNav </div>"; 					

else:
	$p= $PAGE+1;
	$page_content .=  '<div style="padding-right:10px; padding-bottom:0px;text-align:right" id="link"><a href="'. $PHP_SELF .'?PAGE='. $p .'"> лл go back</a></div>';


	$ch = "\n\n" ;
	$q = mysql_query("select * from project_name where rid='$_GET[ID]'") or die(mysql_error());
	$d = mysql_fetch_array($q) ;
	
	$cap = trim($d["project_name"]) ;
	
	$page_content .= '<P>';
	
	if (is_file("projects/" . $d['logo'])):
		$page_content .= "<img src='projects/$d[logo]' border='0' align='left' style='padding-right:10px;padding-bottom:10px;'>";
	endif;

	$page_content .= '<font size="+1" color="#cc0000">' . trim($d["project_name"])  .'</font><br>' . $ch ;
	$page_content .= "<i>".  $d['post_date'] . "</i>" ;

	$page_content .=  trim(stripslashes($d["project_desc"])) . $ch;

	$page_content .=  '<div style="padding-left:10px; padding-bottom:20px;" id="link"><a href="'. $PHP_SELF .'?PAGE='. $p .'"> лл go back</a></div>';
endif;	


$PAGE_TITILE = "$cap Developer  " . $PAGE_TITILE ;

include('header.ini.php'); 


?>
<center>


<table width='100%' cellpadding='0' cellspacing='0' border='0'>
	<tr>
	<td valign='top' width='200' style='padding-left:0px;padding-right:5px;'>
			
			<? include("pro-category-menu.ini.php"); ?>
			
		</td>	
		<td valign='top' width="800" style='padding-right:12px;' >

	<?

$p = $_GET["PAGE"];
echo  "<h3 style='margin-bottom:10px;'>Developers</h3>";

echo $page_content;

		?>

		
		</td>
		
	
	</tr>
</table>




</center>

<? 

include('footer.ini.php'); ?>
