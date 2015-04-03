<?php
//	include("checklock.php");
	$root				=	"pont_du/commerce/admin";
	$serverpath			=	$_SERVER['HTTP_HOST']."/".$root;
	//$admin_path =	$GLOBALS[PHP_SELF];
	$admin_path			=	$_SERVER['SCRIPT_FILENAME'];
	$admin_path			=	explode("/",$admin_path);
	$len_path			=	count($admin_path);
	
	$changed_laguage_path		=	"../"."admin_french/".$admin_path[$len_path-1];
?>
<script type="text/javascript">
tinyMCE.init({
		document_base_url : "http://<?php echo $_SERVER['HTTP_HOST']?>//",
		mode : "textareas",
		theme : "advanced",
		plugins : "style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
		theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,separator,forecolor,backcolor,advsearchreplace",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,|,visualchars,nonbreaking",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_path_location : "bottom",
		content_css : "example_full.css",
	    plugin_insertdate_dateFormat : "%Y-%m-%d",
	    plugin_insertdate_timeFormat : "%H:%M:%S",
		extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		external_link_list_url : "link_list.js",
		external_image_list_url : "image_list.js",
		flash_external_list_url : "flash_list.js",
		media_external_list_url : "media_list.js",
		file_browser_callback : "fileBrowserCallBack",
		theme_advanced_resize_horizontal : false,
		theme_advanced_resizing : true,
		nonbreaking_force_tab : true,
		apply_source_formatting : true
	});

	function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Example of filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);

		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "insert_image.php";
	}
</script>
<SCRIPT language="JavaScript">
<!--
if (document.images)
{
  pic1= new Image(20,20);
  pic2= new Image(20,20);
  pic3= new Image(20,20);
  pic4= new Image(20,20);   
  pic5= new Image(20,20);
  pic6= new Image(20,20);
  pic7= new Image(20,20);
  pic8= new Image(20,20);   
  pic9= new Image(20,20);
  pic10= new Image(20,20);
  pic11= new Image(20,20);
  pic12= new Image(20,20);
  pic13= new Image(20,20);
  pic14= new Image(20,20);   
  pic15= new Image(20,20);
  pic16= new Image(20,20);
  pic17= new Image(20,20);
  pic18= new Image(20,20);   
  pic19= new Image(20,20);
  pic20= new Image(20,20);
  pic20= new Image(20,20);
  pic21= new Image(20,20);
  pic22= new Image(20,20);
  pic23= new Image(20,20);
  pic24= new Image(20,20);   
  pic25= new Image(20,20);
  pic26= new Image(20,20);
  pic27= new Image(20,20);
  pic28= new Image(20,20);   
  pic29= new Image(20,20);
  pic30= new Image(20,20);
  pic31= new Image(20,20);
  pic32= new Image(20,20);
  pic33= new Image(20,20);
  pic34= new Image(20,20);   
  pic35= new Image(20,20);
  pic36= new Image(20,20);
  pic37= new Image(20,20);
  pic38= new Image(20,20);   
  pic39= new Image(20,20);
  pic40= new Image(20,20);
  pic41= new Image(20,20);
  pic42= new Image(20,20);
  pic43= new Image(20,20);
  pic44= new Image(20,20);   
  pic45= new Image(20,20);
  pic46= new Image(20,20);
  pic47= new Image(20,20);
  pic48= new Image(20,20);   
  pic49= new Image(20,20);
  pic50= new Image(20,20);
  pic51= new Image(20,20);
  pic52= new Image(20,20);
  pic53= new Image(20,20);
  pic54= new Image(20,20);   
  pic55= new Image(20,20);
  pic56= new Image(20,20);
  pic57= new Image(20,20);
  pic58= new Image(20,20);   
  pic59= new Image(20,20);
  pic60= new Image(20,20);
  pic61= new Image(20,20);
  pic62= new Image(20,20);

  pic1.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/save/images/save.gif";
  
  pic2.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/newdocument.gif";
  
  pic3.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/bold.gif";
  
  pic4.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/italic.gif";
  
  pic5.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/underline.gif";
  
  pic6.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/strikethrough.gif";
  
  pic7.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/justifyleft.gif";
  
  pic8.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/justifycenter.gif";
  
  pic9.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/justifyright.gif";
  
  pic10.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/justifyfull.gif";
  
  pic11.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/cut.gif";
  
  pic12.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/copy.gif";
  
  pic13.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/paste.gif";
  
  pic14.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/paste/images/pastetext.gif";
  
  pic15.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/paste/images/pasteword.gif";
  
  pic16.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/searchreplace/images/search.gif";
  
  pic17.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/searchreplace/images/replace.gif";
  
  pic18.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/bullist.gif";
  
  pic19.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/numlist.gif";
  
  pic20.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/outdent.gif";

  pic21.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/indent.gif";
  
  pic22.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/undo.gif";
  
  pic23.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/redo.gif";
  
  pic24.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/link.gif";
  
  pic25.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/unlink.gif";
  
  pic26.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/anchor.gif";
  
  pic27.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/image.gif";
  
  pic28.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/cleanup.gif";
  
  pic29.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/help.gif";
  
  pic30.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/code.gif";

  pic31.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/insertdatetime/images/insertdate.gif";
  
  pic32.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/insertdatetime/images/inserttime.gif";
  
  pic33.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/preview/images/preview.gif";
  
  pic34.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/forecolor.gif";
  
  pic35.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/backcolor.gif";
  
  pic36.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/table/images/table.gif";
  
  pic37.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/table/images/table_row_props.gif";
  
  pic38.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/table/images/table_cell_props.gif";
  
  pic39.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/table/images/table_insert_row_before.gif";
  
  pic40.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/table/images/table_insert_row_after.gif";

  pic41.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/sub.gif";
  
  pic42.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/sup.gif";
  
  pic43.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/themes/advanced/images/charmap.gif";
  
  pic44.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/emotions/images/emotions.gif";
  
  pic45.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/media/images/media.gif";
  
  pic46.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/advhr/images/advhr.gif";
  
  pic47.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/print/images/print.gif";
  
  pic48.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/directionality/images/ltr.gif";
  
  pic49.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/directionality/images/rtl.gif";
  
  pic50.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/fullscreen/images/fullscreen.gif";

  pic51.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/layer/images/insertlayer.gif";
  
  pic52.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/layer/images/moveforward.gif";
  
  pic53.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/layer/images/movebackward.gif";
  
  pic54.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/layer/images/absolute.gif";
  
  pic55.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/style/images/styleprops.gif";
  
  pic56.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/xhtmlxtras/images/cite.gif";
  
  pic57.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/xhtmlxtras/images/abbr.gif";
  
  pic58.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/xhtmlxtras/images/acronym.gif";
  
  pic59.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/xhtmlxtras/images/del.gif";
  
  pic60.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/xhtmlxtras/images/ins.gif";

  pic61.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/visualchars/images/visualchars.gif";
  
  pic62.src="http://<?php echo $serverpath?>/tinymce/jscripts/tiny_mce/plugins/nonbreaking/images/nonbreaking.gif";

}
//-->
</SCRIPT>