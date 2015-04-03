<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Walk Retail</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
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
    <div class="form-con1">
      <div class="form-bg">
        <div class="property-panel-bg"> <span class="property-panel-left">From</span> <span class="poperty-panel-right">
                  <input name="Selling_Price" type="text" class="sell2" id="Selling Price:"/>
                </span> </div>
                <div class="property-panel-bg"> <span class="property-panel-left">To</span>Clients Information</div>
      </div>
      <div class="form-pad1">
           
           
              
<div class="property-panel-bg"> <span class="property-panel-left">Subject</span> <span class="poperty-panel-right">
                  <input name="subject" type="text" class="sell2" />
                </span> </div>
                <div class="property-panel-bg"> 
                  <span class="property-panel-left">Message</span> 
                     <span class="poperty-panel-right">
                     <textarea name="message" rows="4" class="sell3"></textarea>
                     </span> 
          </div>
                 <div class="property-panel-bg"> 
                     <span class="property-panel-left">Quantity</span> 
                     <span class="poperty-panel-right">
                         <span><input name="quality" type="text" class="sell4"/></span>
                         <span>
                         <select name="Property_Category" class="sell4">                   
                         <option class="boldclass" >All Residential</option>
						 <option class="" value="Residential_Apartment">Residential Apartment</option>
						 <option class="" value="Independent_House_Villa">Independent House/Villa</option>
						 <option class="" value="Residential_Land">Residential Land</option>
						 <option class="" value="Independent_Builder_Floor">Independent/Builder Floor</option>
						 <option class="" value="Farm_House">Farm House</option>
						 <option class="" value="Studio_Apartment">Studio Apartment</option>
						 <option class="" value="Serviced_Apartments">Serviced Apartments</option>
						 <option class="" value="RNew_Projects">New Projects</option>
						 <option class="" value="ROther">Other</option>
						 <option class="boldclass">All Commercial</option>
						 <option class="" value="Commercial_Shops">Commercial Shops</option>
						 <option class="" value="Commercial_Showrooms">Commercial Showrooms</option>
						 <option class="" value="Commercial_Office_Space">Commercial Office/Space</option>
						 <option class="" value="Commercial_Land_Inst_Land">Commercial Land/Inst. Land</option>
						 <option class="" value="Hotel_Resorts">Hotel/Resorts</option>
						 <option class="" value="Guest-House_Banquet-Halls">Guest-House/Banquet-Halls</option>
						 <option class="" value="Time_Share">Time Share</option>
						 <option class="" value="Space_in_Retail_Mall">Space in Retail Mall</option>
						 <option class="" value="Office_in_Business_Park">Office in Business Park</option>
						 <option class="" value="Office_in_IT_Park">Office in IT Park</option>
						 <option class="" value="Ware_House">Ware House</option>
						 <option class="" value="Cold_Storage">Cold Storage</option>
						 <option class="" value="Factory">Factory</option>
						 <option class="" value="Manufacturing">Manufacturing</option>
						 <option class="" value="Business_center">Business center</option>
						 <option class="" value="CNew_Projects">New Projects</option>
						 <option class="" value="COther">Other</option>
						 <optgroup label='Land'  class='boldclass' ></optgroup>
						 <option class="" value="Residential_Land">Residential Land</option>
						 <option class="" value="Agricultural_Farm_Land">Agricultural/Farm Land</option>
						 <option class="" value="Commercial_Land_Inst_Land">Commercial Land/Inst. Land</option>
						 <option class="" value="Industrial Lands_Plots">Industrial Lands/Plots</option>
					</select>
                         </span>
                     </span> 
                </div>
                <div class="property-panel-bg"> 
                <span class="property-panel-left">Attach File :</span><input name="Attachment[]" type="file"  id="Attachment[]" />
                <br /><br/>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;File Format: Jpeg, Jpg, Gif, Png, PDF, PPT, Word, Excel, mp3. Maximum File Size: 2MB</span>
                </div>
                <div class="property-panel-bg"> 
                  <span class="property-panel-left">&nbsp;</span> 
                     <span class="poperty-panel-right">
                     <br />
                        <input name="SEND" type="submit" value="send"  class="send"/>
                    </span> 
          </div>
                
                
</div>
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
