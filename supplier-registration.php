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
    <div class="left-2-panel">
     
      <div class="supp-con1">
        <div class="supp-left">
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Name</div>
             <div class="supplier-panel-right"><input name="Name" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company Name</div>
             <div class="supplier-panel-right"><input name="company-name" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Email Id</div>
             <div class="supplier-panel-right"><input name="email-id" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Website (If any)</div>
             <div class="supplier-panel-right"><input name="website" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Phone No.</div>
            <div class="supplier-panel-right"><input name="phone-no" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company Address</div>
             <div class="supplier-panel-right"><input name="company-address" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Category</div>
             <div class="supplier-panel-right"><input name="category" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">User Name</div>
             <div class="supplier-panel-right"><input name="user-name" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Password</div>
             <div class="supplier-panel-right"><input name="passward" type="text" class="field" /></div>
          </div>
         
        </div>
        <div class="supp-right">
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">City</div>
             <div class="supplier-panel-right"><input name="city" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Zip Code</div>
             <div class="supplier-panel-right"><input name="zip-code" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">State</div>
             <div class="supplier-panel-right"><input name="state" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company PanCard</div>
             <div class="supplier-panel-right"><input name="company-pancard" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Gumasta Licence</div>
            <div class="supplier-panel-right"><input name="Attachment[]" type="file"  id="Attachment[]" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company if Registered</div>
             <div class="supplier-panel-right"><input name="Attachment[]" type="file"  id="Attachment[]" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Company is in Partnership<br />
             or Propertier</div>
             <div class="supplier-panel-right"><input name="Attachment[]" type="file"  id="Attachment[]" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Make Payment Online</div>
             <div class="supplier-panel-right"><input name="make-payment-online" type="text" class="field" /></div>
          </div>
          <div class="supplier-panel-bg">
             <div class="supplier-panel-left">Choose Currency</div>
             <div class="supplier-panel-right">
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
             </div>
          </div>
          
        </div>
      </div>
      
    </div>
    
    <!-- left panel end -->
    
    
    

    
     <!-- right panel end -->
     
     
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
