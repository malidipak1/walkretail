<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
</head>

<body>
<!--FB Page-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!--FB Page-->
<div id="tgray-bg">
  <div class="middle">
     <div class="middle-inner">
        <?php include("menu.php");?>
     </div>
  </div>
</div>
<?php include("header.php");?>


<!-- end green bg -->

<div class="middle">
  <div class="middle-inner">
  	<div align="center" style="color: red"></div>
  <div class="buy-get-heading">Please give Your Suggetion</div>
    <div class="form-con1">
       <form action="contact_submit.php" method="post" name="qoute" onsubmit="MM_validateForm('name','','R','emailid','','RisEmail','suggestions','','R');return document.MM_returnValue">
       
      <div class="form-pad1">
           
           
      <div class="property-panel-bg" align="center"> 
      
           </div>   
 
<div class="property-panel-bg"> <span class="property-panel-left">Name</span> <span class="poperty-panel-right">
                  <input name="name" type="text" class="sell2" id="name" />
</span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">Email-Id</span> <span class="poperty-panel-right">
                  <input name="emailid" type="text" class="sell2" id="emailid" />
        </span> </div>
                
                <div class="property-panel-bg"> 
                  <span class="property-panel-left">Your Suggetion</span> 
                     <span class="poperty-panel-right">
                     <textarea name="suggestions" rows="4" class="sell3" id="suggestions"></textarea>
                     </span> 
          </div>
                
               
        
          
                
                
                      <div class="property-panel-bg"> 
                  <!-- <span class="property-panel-left">Comment</span> 
                     <span class="poperty-panel-right">
                     <textarea name=description rows="4" class="sell3"></textarea>
                     </span>  -->
          </div>         
                <br /><br /><br />
        <div class="property-panel-bg"> 
                  <span class="property-panel-left">&nbsp;</span> 
                    <div class="poperty-panel-right">
    <table width="50%" border="0" cellspacing="10" cellpadding="0">
      <tr>
        <td align="center" valign="middle"><input type="submit" name="submit" id="submit" value="Submit" /></td>
      </tr>
    </table>
</div> 
          </div>
                
                
</div>
</form>
            </div>
  </div>
</div>
 <!-- middle panel end -->
 
 
 
 <!-- light gray bg end -->
 
 <div id="footer-bg">
   <div class="middle">
     <div class="middle-inner">
        <?php include("footer.php");?>
     </div>
   </div>
 </div>
 
 <!-- end footer green-->
 
 <div id="footer-gray">
   <div class="middle">
     <div class="middle-inner">
        <?php include("copy.php");?>
     </div>
   </div>
 </div>
 

 

</body>
</html>
