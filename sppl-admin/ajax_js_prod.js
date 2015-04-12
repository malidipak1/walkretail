// JavaScript Documentvar xmlHttp
var j
var txtHint
//var pre_id
/*function view_sub_category()
{
document.form1.action="sub_category.php?action=view_sub_category";
document.form1.submit();
}*/

function chk_str(str,i,start)
{
        if(str!="")     
        {       
                //alert("OK")
                //pre_id=i
                // alert("str="+str+"i="+i)
                //alert(str)
                
                document.getElementById('catidval').value=str
                show_sub_cat(str,i,start)
        }
        if (str.length==0)
  {     
        txtHint='txtHint'+(i)
        
        //alert(i)
        if(i==1)
        {       
                document.getElementById(txtHint).innerHTML="Select categories to get its sub categories"
                cats_id="cat1"
        }
        else
        {       
                alert(txtHint)
                document.getElementById(txtHint).innerHTML=""
                cats_id="cat"+(i-1)
        }
        //alert(cats_id="cat"+(i-1))
        cat_id=document.getElementById(cats_id).value
        document.getElementById("catidval").value=cat_id
        return
  }
                
//}


 

}

function show_sub_cat(str,i,start){
        cats_id="cat"+(i)
        cat_id=document.getElementById(cats_id).value
        document.getElementById("catidval").value=cat_id
        
//alert(i)
//var start  = start;
//
//if(start){  // this is for applying paging with ajax
//}else
//{
//start=0;
//}
j=i

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Browser does not support HTTP Request")
  return
  }
  var i=i+1;
var url="sub_cat.php"
url=url+"?catid="+str+"&i="+i+"&start="+start

//alert(url)
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChanged
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}
function stateChanged()
{
//alert (xmlHttp.readyState)
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {      
        txtHint='txtHint'+j
        //alert(txtHint)
        //win.document.forms[0].elements[field_name].value
        //alert(xmlHttp.responseText)
//document.form1.elements['txtHint'].innerHTML=xmlHttp.responseText
if(xmlHttp.responseText.length!="")
{
document.getElementById(txtHint).innerHTML=xmlHttp.responseText
}

 }
}
function GetXmlHttpObject()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 // Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}
