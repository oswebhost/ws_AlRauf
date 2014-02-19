<? 
/*
	Written by: MIK (MI Khan)  info@1os.us 
	Company   : 1 OS Web Hosting & Services
	URL		  : http://www.1os.us 
*/
include("config.ini.php");
include("common.php");



$PAGE_TITILE =  ' Real Estate News'  ;

require_once("header.ini.php") ;


?>


<div class="centercolumn">
		
	<div id="maincontent">
		<div id="content" class="full">
		<h2 class="underline">Real Estate <span class="blue">News</span></h2>
        
        
            <?php
              if ($_GET['ID']>0){
                
                    
                    $temp = $db->prepare("select * from news where news='1' and rid='$_GET[ID]'");
                    $temp->execute();
                    $data = $temp->fetch();
                
                    echo "<h2>" . stripslashes($data['title'])  ."</h2>\n";
                    echo "<blockquote><p>" .  stripslashes($data['content']) ."</p></blockquote>";
             ?>
                    <div class="slider-button" style="margin-top:20px;"><a href="realestate-news.php">Back</a></div>
              
             <?
              }else{
                
                $x = 0 ;
                $temp = $db->prepare("select * from news where news='1' order by rank, title");
                $temp->execute();
                while ($data = $temp->fetch()){
                    $last = '';
                    $url = $PHP_SELF . "?ID=". $data['rid'];    
                $x++;
                if ($x==3) $last = 'last';
            ?>
            
                <div class="one_third <?php echo $last;?>">
    				<h5><?php echo stripslashes($data['title']);?></h5>
                    <div style="height: 150px;overflow: hidden;margin-bottom:30px;">
    				    <blockquote><p><?php echo substr(strip_tags($data['content']),0,250);?>...</p></blockquote>
                    </div>
                    <div class="slider-button" style="margin-top:10px;"><a href="<?php echo $url;?>">more</a></div>
				</div><!-- end .one_third -->
                
			<?
                if ($x>2) {
                  $x=0; 
                  echo 	'<br class="clear" /><hr />' ;  
                } 
             }
            }
            ?>
            

    
			<div class="clear"></div>
		</div><!-- end #maincontent -->
	</div><!-- end #centercolumn -->


<br /><br />





<? require_once("footer.ini.php") ; ?>