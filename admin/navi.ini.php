<div align="right" style="font-size:10px;padding-right:6px;" >

<FORM METHOD=POST ACTION="<?= $PHP_SELF?>?ACTION=LIST&fileused=<? echo $tbname?>" style="margin:0;padding:0;" >
	List Per Page:<SELECT class="bt" NAME="per_page" style="width:70px;height:18px;" onChange="this.form.submit();"> 
	<option value="80" <? if($per_page==80): echo "selected";endif;?>>»&nbsp;&nbsp;80«</option>
	<option value="120" <? if($per_page==120): echo "selected";endif;?>>»120«</option>
	<option value="160"<? if($per_page==160): echo "selected";endif;?>>»160«</option>
	<option value="180" <? if($per_page==180): echo "selected";endif;?>>»180«</option>
	</SELECT>
	<input type='hidden' name='bizcategory' value="<? echo $bizcategory; ?>">
</FORM>
</div>