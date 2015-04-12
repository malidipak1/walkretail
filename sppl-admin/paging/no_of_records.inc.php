&nbsp;&nbsp;Select records per page&nbsp;&nbsp;
<select name="per_page" onChange="set_page_limit(this.value);" >
<option value=""> Select </option>
<?php for($j=1;$j<=100;$j++){ // ?>
<option value="<?php echo $j;?>" <?php if($j==$_SESSION['per_page']) echo 'selected'; ?> > <?php echo $j;?></option>
<?php }?>
</select>
<script type="text/javascript">
function set_page_limit(records){
window.location		=	"<?php echo $file_name?>?per_page="+records;
}
</script>