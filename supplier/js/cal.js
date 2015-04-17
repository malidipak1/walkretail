function fform3_submit()
{
   msg = "";
   pr = new Array();
   var pr_len =1;

   
    pr[0] = new Array();
    pr[0]['from'] = new Date("09 October 2004");
    pr[0]['till'] = new Date("12 October 2004");
   if ( document.fform3.elements['d_from'].value == "")
   {
     msg += "'Check In' field is required\n";
   }
   
   d1 = new Date(document.fform3.elements['d_from'].value);
   d2 = new Date(d1.getTime()+24*60*60*1000*(document.fform3.elements['stay'].value));
   d3 = new Date();
   d3.setMinutes(0);
   d3.setHours(0);
   d3.setSeconds(0);
   d3.setMilliseconds(0);
   if (d1.getTime()<d3.getTime()) {
     msg += "'Check In' is less than today\n";
   }
   /*
   if (d1>d2) {
     alert("'Till Date' is earlier than 'From Date'");
     return false;
   } */
   if ( msg != "" )
   {
     alert(msg);
     return false;
   }
   
   msg = "";
   for( var i=0 ; i < pr_len ; i++) {
       if ( ((d1<=pr[i]['from']) && (d2>=pr[i]['from'])) || ((d1<=pr[i]['till']) && (d2>=pr[i]['till'])) || ((pr[i]['from']<=d1) && (pr[i]['till']>=d1)) || ((pr[i]['from']<=d2) && (pr[i]['till']>=d2))) {
         msg = "Specified period is unavailable.";
       }
   }
   
   if ( msg != "" )
   {
     alert(msg);
     return false;
   } 
//   document.fform3.submit();
}
