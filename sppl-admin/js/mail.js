// JavaScript Document
function check()
{

var d= document.form1;
if(d.mailid.value=="")
{
alert("Please enter the email-id");
 d.mailid.focus();
return false;
}
else if((d.mailid.value.indexOf('@') == -1) || (d.mailid.value.indexOf('.') == -1))
	 {
	 alert("please enter valid email address");
	 d.mailid.value='';
	 d.mailid.focus();
	 return false();
	 }
else 
{
d.action="scripts/suscribe.php";
d.submit();
return true;
}
}


//function to check validation of the donation form 
function check_donate()
{

var d= document.form2;
if(d.amount.value=='')
{
alert("Please enter the Amount Donating");
 d.amount.focus();
return false;
}
else
if(d.name.value=='')
{
alert("Please enter Your Name");
 d.name.focus();
return false;
}
else if(d.email.value=='')
{
alert("Please enter the email-id");
 d.email.focus();
return false;
}
else if((d.email.value.indexOf('@') == -1) || (d.email.value.indexOf('.') == -1))
	 {
	 alert("please enter valid email address");
	 d.email.value='';
	 d.email.focus();
	 return false();
	 }
else 
{d.action="index.php?file=donate&msg=1";
d.submit();
return true;}
}


//function to check the contact us form 

function check_contact()
{
if(document.frmcontact.fname.value=="")
   { 
   alert("Please Enter your First Name");
     document.frmcontact.fname.focus();
	  return false;
    }
	
	else if ((document.frmcontact.email.value=='') || (document.frmcontact.email.value.indexOf('@') == -1) ||(document.frmcontact.email.value.indexOf('.') == -1)) 
 {
alert("Enter valid email address ");
document.frmcontact.email.value="";
 document.frmcontact.email.focus();
return false;
}

else if(document.frmcontact.comment.value=="")
   { 
   alert("Please Enter comment");
     document.frmcontact.comment.focus();
	  return false;
    }
	else
return true;

}