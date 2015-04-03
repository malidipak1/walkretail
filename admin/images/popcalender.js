
   		// Description	: Opens the URL in the pop up Window
        // Parameter List
        // sURL			:URL of the opened page
        // width		:width of the window
        // height		:Height of the window
  
        var objWindow;
        function OpenURL(sURL, width, height)
	    {
		    //If URL is not for Add or preference
			if( (ParseTitleString(sURL) != 'P') && (ParseTitleString(sURL) != 'A') )
			{
				SetAnyChangeToTrue();
			} 
			var win = null;
			Settings = 'dialogWidth:' + width + 'px;dialogHeight:' + height + 'px;center:yes;scroll:no;resizable:yes;status:no;help:no';
			win = window.showModalDialog('Frame.php?navigateUrl=' + encodeURIComponent(sURL), self, Settings); 
	    }


   		// Description		: Trims the input string from left and right side
        // Parameter List
        // prmString		: input string
    	function TrimSpaces(prmString)
	    {
	        var intStart,intEnd;
	        var intLength = prmString.length
	        for( intStart=0; intStart<intLength; intStart++)
	        {
	            if(prmString.charAt(intStart)!=" " )
	            break;
	        }
	        intEnd=intLength-1;
	        while(intEnd>0)
	        {
	            if(prmString.charAt(intEnd)!=" ")
	                        break;
	            intEnd--;
	        }

	        if(intStart<intEnd+1)
	            return prmString.substring(intStart,intEnd+1);
	        else
	            return "";

	    }



	    //    Description     	:   This function is used validates input floating values and also considers comma
        //    					    operator as a valid as a valid separator
	    //    Parameter List
	    //    str     			:   value to be checked
        //    totalLength		:	Total length of the number
        //    decimalPartLength	:  Decimal,part length
        function ValidateDecimalValue(str,totalLength,decimalPartLength)
        {
        	var newstr;

        	newstr = ReplaceChar(str,',','.');

            if(isNaN(newstr)||parseFloat(str) < 0)
             	return false;
            else if(!CheckLength(newstr,totalLength,decimalPartLength))
            		return false;
            else
            	return true;
        }



	    //    Description     	:   This function is used to check whether the length of input valid floating number
        //    					     should not be greater than Maximum permissible value
	    //    Parameter List
	    //    str     			:   value to be checked
        //    totalLength		:	Total length of the number
        //    decimalPartLength	:  Decimal,part length
		
		
        function CheckLength(str,totalLength,decimalPartLength)
	    {
	        var pos;

            pos = str.indexof (".");

            if(pos == -1)
	        {
	            if(str.length > (totalLength-decimalPartLength))
	            	return false;
	            else
	            	return true;
            }
	        else
	        {
	            if(pos > (totalLength-decimalPartLength))
	           		return false;
	            else
	                return true;
	        }
	    }



	    //    Description     	:   This function  Replaces the oldchar with newChar in string
	    //    Parameter List
	    //    theString     	:   input string
        //    oldChar			:	value to be replaced
        //    newChar			:   value that is replaced
 	    function ReplaceChar(theString, oldChar, newChar)
         {
	        var i = 0;
	        var j = theString.length;

	        for(i=0; i < theString.length; i++)
            {
	        	if(theString.charAt(i) == oldChar)
                {
	        		theString = theString.substring(0,i) + newChar +
	        		theString.substring(i+1,theString.length);
	        		if(i > j)
            		{
	        			break;
	        		}
	    		}
	    	}
	    	return theString;
	    }
		
		
		
	//Description: Doesn't allow the user to enter after prmLen decimal places
	//paremeter-List
	//prmThis    	: Refers to the form control
	//prmLen		: Maximum decimal length allowed
	//prmTimeFlag	: Flag that shows the give field is time field or not
	//					1 =time field ,0 = not time field , 3== checks if text is selected
	
	var selected = 0; //Flag that shows whether text is selected or not
	var oldPos;  //value of delimiter(dot,comma or ':') before key press
	var change = "false";
	function CheckMaxDecimalLength(prmThis, prmLen, prmTimeFlag)
	{
		var flag = 0;
		var  posDot,pos, posComma, posColon, str;
		
		//alert(event.keyCode);
		if(prmTimeFlag == 3)
		{
			selected = 1;
		}

		
		if(	(event.keyCode == 46 ) || (event.keyCode == 8 )  || //allow delete key and Backspace key 
		 	(event.keyCode == 37 ) || (event.keyCode == 38 ) || // Arrow keys
			(event.keyCode == 39 ) || (event.keyCode == 40 ) ||
			(event.keyCode == 9 )  || (event.keyCode == 16 ) || // tab and shift keys
			(event.keyCode == 17 ) || (event.keyCode == 13 ) || // ctl and enter keys
			(event.keyCode == 27 ) )  // Esc Keys
		{
			return;
		}
		
		
		if(prmTimeFlag != 3)
		{
			// If the current text is selected allow the key press
			// and set selected = 0 to show that now text is unselected .
			if(selected == 1)
			{
				selected = 0;
				return;
			}
		}		
		

	  	if(prmThis.value != "")
	  	{
	  		posDot = prmThis.value.indexof (".");
	  		posComma = prmThis.value.indexof (",");
			posColon = prmThis.value.indexof (":");
	  		
	  		//If not time field
	  		if(prmTimeFlag == 0)
	  		{
	  		
				if(posColon != -1)
				{
					flag = 1;	
					event.returnValue = false;
								
				}
	  			if( (posDot != -1) && (posComma != -1) )
	  			{
	  				flag = 1;
	  			}
	  			else if( (posDot == -1) && (posComma == -1) )
	  			{
	  				return;
	  			}
	  			else
	  			{
	  				if(posDot != -1)
	  				{
	  					pos = posDot;
	  				}
	  				else
	  				{
	  					pos = posComma;
	  				}
	  			}
	  		}
	  		else //time field
	  		{
	  			if( (posDot != -1) || (posComma != -1) )
	  			{
	  				flag = 1;
	  			}
	  			pos = prmThis.value.indexof (":");
	  		}
	  		
			//Store the old postion of &delimiter
			oldPos = pos;
			
			//str contains the string after decimal
	  		str = prmThis.value.substring(pos+1, prmThis.value.length);
			
	  		//Check the Maximum decimal length	
	  		if(pos != -1)
	  		{
	  			if((str.length + 1) > prmLen+1)
	  			{
	  				flag = 1;
	  			}
				if((str.length + 1) > prmLen)
				{
					 change = "true";
				}
				
	  		}
	  			
	  		if(flag == 1)
	  		{
	  			event.returnValue = false;
	  		}

	  	}//end outermost if
		
		
	}//End Function
	
	
	//Description: After the key is pressed checked whther it is in correct length or not
	//				if not it reduces it to correct length
	//paremeter-List
	//prmThis    	: Refers to the form control
	//prmLen		: Maximum decimal length allowed
	//prmTimeFlag	: Flag that shows the give field is time field or not
	//					1 =time field ,0 = not time field , 3== checks if text is selected
		
	function OnKeyUpCheckLength(prmThis, prmLen, prmTimeFlag)
	{
	
		var pos, posDot, posColon, posComma ;
		posDot = prmThis.value.indexof (".");
		posComma = prmThis.value.indexof (",");
		posColon = prmThis.value.indexof (":");
		
		if(change == 'false')
		{
			return;
		}

 		if(prmTimeFlag == 0)
 		{
 			if( (posDot != -1) && (posComma != -1) )
 			{
 				return;
 			}
 			else if( (posDot == -1) && (posComma == -1) )
 			{
 				return;
 			}
 			else
 			{
 				if(posDot != -1)
 				{
 					pos = posDot;
 				}
 				else
 				{
 					pos = posComma;
 				}
 			}
 		}
 		else //time field
 		{
 			if( (posDot != -1) || (posComma != -1) )
 			{
 				return;
 			}
 			pos = prmThis.value.indexof (":");
 		}
	  		
		//if key is pressed after decimal
		if(change == 'true')
		{
			if( (pos !=- 1) && (pos == oldPos))
			{
				//Reduce the string to correxct length
				strLen = prmThis.value.substring(0, pos).length
				prmThis.value = prmThis.value.substring(0, pos+1) + prmThis.value.substring(pos+1, strLen + prmLen + 1);
			}
		   change = 'false';
		}
	}
	
	
			
	//Description: Validates Time
	//paremeter-List
	//prmThis    	: Refers to the form control
	function ValidateTime(prmThis)
	{
		
		var pos;
		pos = prmThis.value.indexof (":");
		if(pos != -1)
		{
			prmMinutes = prmThis.value.substring(pos+1, prmThis.value.length);
			if(prmMinutes >= 60)
			{
				alert('Ung???ltiger Zeit.');
				this.focus();
				return false;
			}
		}		
		return true;
	}
	
	
	//Description	: Converts time into minutes
	//paremeter-List
	//prmTime    	: time in hours and minutes
	function ConvertTimeIntoMinutes(prmTime)
	{	
		var ihrs, iDecimalPart, iTotalMinutes, pos, factor;
		
		
		pos = prmTime.indexof (".");
		
		iTotalMinutes = 0;
		factor = 100; //Multiplying factor
		
		iHrs = parseInt(String(prmTime));
		iDecimalPart = prmTime.substring(pos + 1,prmTime.length);
		
		if(iDecimalPart.length < 2)
		{
			factor = 10;
		}
		
		iTotalMinutes = parseInt(iHrs * 60 + (prmTime - iHrs)* factor);
		
		return(iTotalMinutes); 
		
	}
	
	//Description	: Parses the URL string into name=value pair out of the string
	//paremeter-List
	//prmURL  	: URL string
	function ParseTitleString(prmURL)
	{
	
		var paramArray = new Array();
		
		// split the query string into param=val pieces
		var qs = prmURL.substr(prmURL.indexof ("?")+1);
		
		qsArray = qs.split("&");
		
		// split param and value into individual pieces
		for (var i=0; i < qsArray.length; i++)
		{
			tmp = qsArray[i].split("=");
			paramArray[tmp[0]] = tmp[1]; 
			if(tmp[0] == 'pageTitle')
			{
				break;
			}
			
		}
		return(paramArray['pageTitle']);
	}
	

	//Description	: Sets the variable anyChange=1 
	//				 This shows that change has taken place in any form
	//               that have not been saved so that when leftpanel is clicked 
	//				 alert message is shown
	function SetAnyChangeToTrue()	
	{
		//Change has taken place
		anyChange = 1;
	}
	

	//Description	: Sets the variable anyChange equal to value of session variable 
	function GetAnyChange()
	{
		
			   
	
	}
	
	
	////Description	: Sets the variable nameChanged equal 1 to show that Customer Name has been changed
	function NameChanged()
	{
		nameChanged = 1;
	}
	

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : This is a javascript file to draw dynamic calender at required
	//          position (whever we require date input) and get date from it.
	//
	/////////////////////////////////////////////////////////////////////////////////

	var	fixedX = -1 // x position (-1 if to appear below control)
	var	fixedY = -1 // y position (-1 if to appear below control)
	var startAt = 1 // 0 - sunday ; 1 - monday
	var showWeekNumber = 0	// 0 - don't show; 1 - show
	var showToday = 1		// 0 - don't show; 1 - show
	var imgDir = "images/"	// directory for images ... e.g. var imgDir="/img/"

	var gotoString = "Go To Current Month"
    //if('DE'=='EN')
   // {
		var todayString = "Today is"
    	var scrollLeftMessage = "Click to scroll to previous month. Hold mouse button to scroll automatically."
        var scrollRightMessage = "Click to scroll to next month. Hold mouse button to scroll automatically."
        var selectMonthMessage = "Click to select a month."
        var selectYearMessage = "Click to select a year."
        var selectDateMessage = "Select [date] as date." // do not replace [date], it will be replaced by date.
   // }
   // else
   // {
    //	var todayString = "Heute ates"
	//	var scrollLeftMessage = "Klicken zur Rolle zum vorhergehenden Monat.  Halten Sie Maustaste scroll automatisch."
	 //   var scrollRightMessage = "Klicken zur Rolle zum folgenden Monat.  Halten Sie Maustaste scroll automatisch."
	//    var selectMonthMessage = "Klicken zum Vorw???hlen einen Monat."
	 //   var selectYearMessage = "Klicken zum Vorw???hlen ein Jahr."
	 //  var selectDateMessage = "W???hlen Sie [date] als Datum vor." // do not replace [date], it will be replaced by date.
  //  }
	var weekString = "Wk"

	var	crossobj, crossMonthObj, crossYearObj, monthSelected, yearSelected, dateSelected, omonthSelected, oyearSelected, odateSelected, monthConstructed, yearConstructed, intervalID1, intervalID2, timeoutID1, timeoutID2, ctlToPlaceValue, ctlNow, dateFormat, nStartingYear

	var	bPageLoaded=false
	var	ie=document.all
	var	dom=document.getElementById

	var	ns4=document.layers
	var	today =	new	Date()
	var	dateNow	 = today.getDate()
	var	monthNow = today.getMonth()
	var	yearNow	 = today.getYear()
	var	imgsrc = new Array("drop1.gif","drop2.gif","left1.gif","left2.gif","right1.gif","right2.gif")
	var	img	= new Array()

	var bShow = false;

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : hides <select> and <applet> objects (for IE only)
	//
	/////////////////////////////////////////////////////////////////////////////////
    function hideElement( elmID, overDiv )
    {
      if( ie )
      {
        for( i = 0; i < document.all.tags( elmID ).length; i++ )
        {
          obj = document.all.tags( elmID )[i];
          if( !obj || !obj.offsetParent )
          {
            continue;
          }

          // Find the element's offsetTop and offsetLeft relative to the BODY tag.
          objLeft   = obj.offsetLeft;
          objTop    = obj.offsetTop;
          objParent = obj.offsetParent;

          while( objParent.tagName.toUpperCase() != "BODY" )
          {
            objLeft  += objParent.offsetLeft;
            objTop   += objParent.offsetTop;
            objParent = objParent.offsetParent;
          }

          objHeight = obj.offsetHeight;
          objWidth = obj.offsetWidth;

          if(( overDiv.offsetLeft + overDiv.offsetWidth ) <= objLeft );
          else if(( overDiv.offsetTop + overDiv.offsetHeight ) <= objTop );
          else if( overDiv.offsetTop >= ( objTop + objHeight ));
          else if( overDiv.offsetLeft >= ( objLeft + objWidth ));
          else
          {
            obj.style.visibility = "hidden";
          }
        }
      }
    }

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : unhides <select> and <applet> objects (for IE only)
	//
	/////////////////////////////////////////////////////////////////////////////////
    function showElement( elmID )
    {
      if( ie )
      {
        for( i = 0; i < document.all.tags( elmID ).length; i++ )
        {
          obj = document.all.tags( elmID )[i];

          if( !obj || !obj.offsetParent )
          {
            continue;
          }

          obj.style.visibility = "";
        }
      }
    }

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function HolidayRec (d, m, y, desc)
	{
		this.d = d
		this.m = m
		this.y = y
		this.desc = desc
	}

	var HolidaysCounter = 0
	var Holidays = new Array()

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function addHoliday (d, m, y, desc)
	{
		Holidays[HolidaysCounter++] = new HolidayRec ( d, m, y, desc )
	}


	if (dom)
	{
		for	(i=0;i<imgsrc.length;i++)
		{
			img[i] = new Image
			img[i].src= img + imgsrc[i]
		}
		document.write ("<div onclick='bShow=true' id='calendar'	class='div-style'><table width="+((showWeekNumber==1)?250:220)+" class='table-style'><tr class='title-background-style' ><td><table width='"+((showWeekNumber==1)?248:218)+"'><tr><td class='title-style'><B><span id='caption'></span></B></td><td align=right><a href='javascript:hideCalendar()'><IMG SRC='"+imgDir+"close.gif' WIDTH='15' HEIGHT='13' BORDER='0' ALT='Close the Calendar'></a></td></tr></table></td></tr><tr><td class='body-style'><span id='content'></span></td></tr>")

		if (showToday==1)
		{
			document.write ("<tr class='today-style'><td><span id='lblToday'></span></td></tr>")
		}

		document.write ("</table></div><div id='selectMonth' class='div-style'></div><div id='selectYear' class='div-style'></div>");
	}

 //   if('DE'=='EN')
   // {
    	var monthName = new Array("January","February","March","April","May","June","July","August","September","October","November","December")
	 //   if (startAt==0)
	   // {
	        dayName = new Array ("Sun","Mon","Tue","Wed","Thu","Fri","Sat")
	  //  }
	  //  else
	  //  {
	  //      dayName = new Array ("Mon","Tue","Wed","Thu","Fri","Sat","Sun")
	  //  }
  //  }
  //  else
   // {
   // 	var monthName = new Array("Januar","Februar","M???rz","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember")
	//    if (startAt==0)
	//    {
	//        dayName = new Array ("Son","Mon","Die","Mit","Don","Fre","Sam")
	//    }
	//    else
	//    {
	 //       dayName = new Array ("Mon","Die","Mit","Don","Fre","Sam","Son")
	 //   }
   // }

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function swapImage(srcImg, destImg)
    {
		if (ie)	{ document.getElementById(srcImg).setAttribute("src",imgDir + destImg) }
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function init()
    {
		if (!ns4)
		{
			if (!ie) { yearNow += 1900	}

			crossobj=(dom)?document.getElementById("calendar").style : ie? document.all.calendar : document.calendar
			hideCalendar()

			crossMonthObj=(dom)?document.getElementById("selectMonth").style : ie? document.all.selectMonth	: document.selectMonth

			crossYearObj=(dom)?document.getElementById("selectYear").style : ie? document.all.selectYear : document.selectYear

			monthConstructed=false;
			yearConstructed=false;

			if (showToday==1)
			{
//	Changed - NIT - May 10
//				document.getElementById("lblToday").innerHTML =	todayString + " <a class='today-style' onmousemove='window.status=\""+gotoString+"\"' onmouseout='window.status=\"\"' title='"+gotoString+"' href='javascript:monthSelected=monthNow;yearSelected=yearNow;constructCalendar();'>"+dayName[(today.getDay()-startAt==-1)?6:(today.getDay()-startAt)]+", " + dateNow + " " + monthName[monthNow].substring(0,3)	+ "	" +	yearNow	+ "</a>"
				document.getElementById("lblToday").innerHTML =	todayString + " <a class='today-style' onmousemove='window.status=\""+gotoString+"\"' onmouseout='window.status=\"\"' title='"+gotoString+"' href='javascript:monthSelected=monthNow;yearSelected=yearNow;constructCalendar();'>"+dayName[(today.getDay()-startAt==-1)?6:(today.getDay()-startAt+1)]+", " + dateNow + " " + monthName[monthNow].substring(0,3)	+ "	" +	yearNow	+ "</a>"
			}

			sHTML1= "<span id='spanLeft'  class='title-control-normal-style' onmouseover='swapImage(\"changeLeft\",\"left2.gif\");this.className=\"title-control-select-style\";window.status=\""+scrollLeftMessage+"\"' onclick='javascript:decMonth()' onmouseout='clearInterval(intervalID1);swapImage(\"changeLeft\",\"left1.gif\");this.className=\"title-control-normal-style\";window.status=\"\"' onmousedown='clearTimeout(timeoutID1);timeoutID1=setTimeout(\"StartDecMonth()\",500)'	onmouseup='clearTimeout(timeoutID1);clearInterval(intervalID1)'>&nbsp<IMG id='changeLeft' SRC='"+imgDir+"left1.gif' width=10 height=11 BORDER=0>&nbsp</span>&nbsp;"
			sHTML1+="<span id='spanRight' class='title-control-normal-style' onmouseover='swapImage(\"changeRight\",\"right2.gif\");this.className=\"title-control-select-style\";window.status=\""+scrollRightMessage+"\"' onmouseout='clearInterval(intervalID1);swapImage(\"changeRight\",\"right1.gif\");this.className=\"title-control-normal-style\";window.status=\"\"' onclick='incMonth()' onmousedown='clearTimeout(timeoutID1);timeoutID1=setTimeout(\"StartIncMonth()\",500)'	onmouseup='clearTimeout(timeoutID1);clearInterval(intervalID1)'>&nbsp<IMG id='changeRight' SRC='"+imgDir+"right1.gif'	width=10 height=11 BORDER=0>&nbsp</span>&nbsp"
			sHTML1+="<span id='spanMonth' class='title-control-normal-style' onmouseover='swapImage(\"changeMonth\",\"drop2.gif\");this.className=\"title-control-select-style\";window.status=\""+selectMonthMessage+"\"' onmouseout='swapImage(\"changeMonth\",\"drop1.gif\");this.className=\"title-control-normal-style\";window.status=\"\"' onclick='popUpMonth()'></span>&nbsp;"
			sHTML1+="<span id='spanYear'  class='title-control-normal-style' onmouseover='swapImage(\"changeYear\",\"drop2.gif\");this.className=\"title-control-select-style\";window.status=\""+selectYearMessage+"\"'	onmouseout='swapImage(\"changeYear\",\"drop1.gif\");this.className=\"title-control-normal-style\";window.status=\"\"'	onclick='popUpYear()'></span>&nbsp;"

			document.getElementById("caption").innerHTML  =	sHTML1

			bPageLoaded=true
		}
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function hideCalendar()
    {
		crossobj.visibility="hidden"
		if (crossMonthObj != null){crossMonthObj.visibility="hidden"}
		if (crossYearObj !=	null){crossYearObj.visibility="hidden"}

		showElement( 'SELECT' );
		showElement( 'APPLET' );
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function padZero(num) {
		return (num	< 10)? '0' + num : num ;
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function constructDate(d,m,y)
	{
		sTmp = dateFormat
		sTmp = sTmp.replace	("dd","<e>")
		sTmp = sTmp.replace	("d","<d>")
		sTmp = sTmp.replace	("<e>",padZero(d))
		sTmp = sTmp.replace	("<d>",d)
		sTmp = sTmp.replace	("mmm","<o>")
		sTmp = sTmp.replace	("mm","<n>")
		sTmp = sTmp.replace	("m","<m>")
		sTmp = sTmp.replace	("<m>",m+1)
		sTmp = sTmp.replace	("<n>",padZero(m+1))
		sTmp = sTmp.replace	("<o>",monthName[m])
		return sTmp.replace ("yyyy",y)
	}


    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function closeCalendar() {
		var	sTmp

		hideCalendar();
		ctlToPlaceValue.value =	constructDate(dateSelected,monthSelected,yearSelected)
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Month Pulldown
	//
	/////////////////////////////////////////////////////////////////////////////////
	function StartDecMonth()
	{
		intervalID1=setInterval("decMonth()",80)
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function StartIncMonth()
	{
		intervalID1=setInterval("incMonth()",80)
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function incMonth ()
    {
		monthSelected++
		if (monthSelected>11) {
			monthSelected=0
			yearSelected++
		}
		constructCalendar()
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function decMonth ()
    {
		monthSelected--
		if (monthSelected<0) {
			monthSelected=11
			yearSelected--
		}
		constructCalendar()
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function constructMonth()
    {
		popDownYear()
		if (!monthConstructed) {
			sHTML =	""
			for	(i=0; i<12;	i++) {
				sName =	monthName[i];
				if (i==monthSelected){
					sName =	"<B>" +	sName +	"</B>"
				}
				sHTML += "<tr><td id='m" + i + "' onmouseover='this.className=\"dropdown-select-style\"' onmouseout='this.className=\"dropdown-normal-style\"' onclick='monthConstructed=false;monthSelected=" + i + ";constructCalendar();popDownMonth();event.cancelBubble=true'>&nbsp;" + sName + "&nbsp;</td></tr>"
			}

			document.getElementById("selectMonth").innerHTML = "<table width=70	class='dropdown-style' cellspacing=0 onmouseover='clearTimeout(timeoutID1)'	onmouseout='clearTimeout(timeoutID1);timeoutID1=setTimeout(\"popDownMonth()\",100);event.cancelBubble=true'>" +	sHTML +	"</table>"

			monthConstructed=true
		}
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function popUpMonth()
    {
		constructMonth()
		crossMonthObj.visibility = (dom||ie)? "visible"	: "show"
		crossMonthObj.left = parseInt(crossobj.left) + 50
		crossMonthObj.top =	parseInt(crossobj.top) + 26

		hideElement( 'SELECT', document.getElementById("selectMonth") );
		hideElement( 'APPLET', document.getElementById("selectMonth") );
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function popDownMonth()
    {
		crossMonthObj.visibility= "hidden"
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Year Pulldown
	//
	/////////////////////////////////////////////////////////////////////////////////
	function incYear()
    {
		for	(i=0; i<7; i++){
			newYear	= (i+nStartingYear)+1
			if (newYear==yearSelected)
			{ txtYear =	"&nbsp;<B>"	+ newYear +	"</B>&nbsp;" }
			else
			{ txtYear =	"&nbsp;" + newYear + "&nbsp;" }
			document.getElementById("y"+i).innerHTML = txtYear
		}
		nStartingYear ++;
		bShow=true
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal Function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function decYear()
    {
		for	(i=0; i<7; i++){
			newYear	= (i+nStartingYear)-1
			if (newYear==yearSelected)
			{ txtYear =	"&nbsp;<B>"	+ newYear +	"</B>&nbsp;" }
			else
			{ txtYear =	"&nbsp;" + newYear + "&nbsp;" }
			document.getElementById("y"+i).innerHTML = txtYear
		}
		nStartingYear --;
		bShow=true
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal Function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function selectYear(nYear)
    {
		yearSelected=parseInt(nYear+nStartingYear);
		yearConstructed=false;
		constructCalendar();
		popDownYear();
	}

	/////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal Function
	//
	/////////////////////////////////////////////////////////////////////////////////
    function constructYear()
    {
		popDownMonth()
		sHTML =	""
		if (!yearConstructed) {

			sHTML =	"<tr><td align='center'	onmouseover='this.className=\"dropdown-select-style\"' onmouseout='clearInterval(intervalID1);this.className=\"dropdown-normal-style\"' onmousedown='clearInterval(intervalID1);intervalID1=setInterval(\"decYear()\",30)' onmouseup='clearInterval(intervalID1)'>-</td></tr>"
			j =	0
			nStartingYear =	yearSelected-3
			for	(i=(yearSelected-3); i<=(yearSelected+3); i++) {
				sName =	i;
				if (i==yearSelected){
					sName =	"<B>" +	sName +	"</B>"
				}

				sHTML += "<tr><td id='y" + j + "' onmouseover='this.className=\"dropdown-select-style\"' onmouseout='this.className=\"dropdown-normal-style\"' onclick='selectYear("+j+");event.cancelBubble=true'>&nbsp;" + sName + "&nbsp;</td></tr>"
				j ++;
			}

			sHTML += "<tr><td align='center' onmouseover='this.className=\"dropdown-select-style\"' onmouseout='clearInterval(intervalID2);this.className=\"dropdown-normal-style\"' onmousedown='clearInterval(intervalID2);intervalID2=setInterval(\"incYear()\",30)'	onmouseup='clearInterval(intervalID2)'>+</td></tr>"

			document.getElementById("selectYear").innerHTML	= "<table width=44 class='dropdown-style' onmouseover='clearTimeout(timeoutID2)' onmouseout='clearTimeout(timeoutID2);timeoutID2=setTimeout(\"popDownYear()\",100)' cellspacing=0>"	+ sHTML	+ "</table>"

			yearConstructed	= true
		}
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal Function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function popDownYear()
    {
		clearInterval(intervalID1)
		clearTimeout(timeoutID1)
		clearInterval(intervalID2)
		clearTimeout(timeoutID2)
		crossYearObj.visibility= "hidden"
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal Function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function popUpYear()
    {
		var	leftOffset

		constructYear()
		crossYearObj.visibility	= (dom||ie)? "visible" : "show"
		leftOffset = parseInt(crossobj.left) + document.getElementById("spanYear").offsetLeft
		if (ie)
		{
			leftOffset += 6
		}
		crossYearObj.left =	leftOffset
		crossYearObj.top = parseInt(crossobj.top) +	26
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : calendar
	//
	/////////////////////////////////////////////////////////////////////////////////
	function WeekNbr(today)
    {
		Year = takeYear(today);
		Month = today.getMonth();
		Day = today.getDate();
		now = Date.UTC(Year,Month,Day+1,0,0,0);
		var Firstday = new Date();
		Firstday.setYear(Year);
		Firstday.setMonth(0);
		Firstday.setDate(1);
		then = Date.UTC(Year,0,1,0,0,0);
		var Compensation = Firstday.getDay();
		if (Compensation > 3) Compensation -= 4;
		else Compensation += 3;
		NumberOfWeek =  Math.round((((now-then)/86400000)+Compensation)/7);
		return NumberOfWeek;
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Internal function
	//
	/////////////////////////////////////////////////////////////////////////////////
	function takeYear(theDate)
	{
		x = theDate.getYear();
		var y = x % 100;
		y += (y < 38) ? 2000 : 1900;
		return y;
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : This function constructs calender with the help of other internal functions
	//
	/////////////////////////////////////////////////////////////////////////////////
	function constructCalendar ()
    {
		var dateMessage
		//var	startDate =	new	Date (yearSelected,monthSelected,1) Changed - NIT - May 10
		var	startDate =	new	Date (yearSelected,monthSelected,2)
		var	endDate	= new Date (yearSelected,monthSelected+1,1);
		endDate	= new Date (endDate	- (24*60*60*1000));
		numDaysInMonth = endDate.getDate()

		datePointer	= 0
		dayPointer = startDate.getDay() - startAt

		if (dayPointer<0)
		{
			dayPointer = 6
		}

		sHTML =	"<table	border=0 class='body-style'><tr>"

		if (showWeekNumber==1)
		{
			sHTML += "<td width=27><b>" + weekString + "</b></td><td width=1 rowspan=7 class='weeknumber-div-style'><img src='"+imgDir+"divider.gif' width=1></td>"
		}

		for	(i=0; i<7; i++)	{
			sHTML += "<td width='27' align='right'><B>"+ dayName[i]+"</B></td>"
		}
		sHTML +="</tr><tr>"

		if (showWeekNumber==1)
		{
			sHTML += "<td align=right>" + WeekNbr(startDate) + "&nbsp;</td>"
		}

		for	( var i=1; i<=dayPointer;i++ )
		{
			sHTML += "<td>&nbsp;</td>"
		}

		for	( datePointer=1; datePointer<=numDaysInMonth; datePointer++ )
		{
			dayPointer++;
			sHTML += "<td align=right>"

			var sStyle="normal-day-style"; //regular day

			if ((datePointer==dateNow)&&(monthSelected==monthNow)&&(yearSelected==yearNow)) //today
			{ sStyle = "current-day-style"; }
			else if	(dayPointer % 7 == (startAt * -1) +1) //end-of-the-week day
			{ sStyle = "end-of-weekday-style"; }

			//selected day
			if ((datePointer==odateSelected) &&	(monthSelected==omonthSelected)	&& (yearSelected==oyearSelected))
			{ sStyle += " selected-day-style"; }

			sHint = ""
			for (k=0;k<HolidaysCounter;k++)
			{
				if ((parseInt(Holidays[k].d)==datePointer)&&(parseInt(Holidays[k].m)==(monthSelected+1)))
				{
					if ((parseInt(Holidays[k].y)==0)||((parseInt(Holidays[k].y)==yearSelected)&&(parseInt(Holidays[k].y)!=0)))
					{
						sStyle += " holiday-style";
						sHint+=sHint==""?Holidays[k].desc:"\n"+Holidays[k].desc
					}
				}
			}

			var regexp= /\"/g
			sHint=sHint.replace(regexp,"&quot;")

			dateMessage = "onmousemove='window.status=\""+selectDateMessage.replace("[date]",constructDate(datePointer,monthSelected,yearSelected))+"\"' onmouseout='window.status=\"\"' "

			sHTML += "<a class='"+sStyle+"' "+dateMessage+" title=\"" + sHint + "\" href='javascript:dateSelected="+datePointer+";closeCalendar();'>&nbsp;" + datePointer + "&nbsp;</a>"

			sHTML += ""
			if ((dayPointer+startAt) % 7 == startAt) {
				sHTML += "</tr><tr>"
				if ((showWeekNumber==1)&&(datePointer<numDaysInMonth))
				{
					sHTML += "<td align=right>" + (WeekNbr(new Date(yearSelected,monthSelected,datePointer+1))) + "&nbsp;</td>"
				}
			}
		}

		document.getElementById("content").innerHTML   = sHTML
		document.getElementById("spanMonth").innerHTML = "&nbsp;" +	monthName[monthSelected] + "&nbsp;<IMG id='changeMonth' SRC='"+imgDir+"drop1.gif' WIDTH='12' HEIGHT='10' BORDER=0>"
		document.getElementById("spanYear").innerHTML =	"&nbsp;" + yearSelected	+ "&nbsp;<IMG id='changeYear' SRC='"+imgDir+"drop1.gif' WIDTH='12' HEIGHT='10' BORDER=0>"
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : Public Function to be called
	//Parameter:
    //		(a) ctl : is the name of the form on which date is required.
    //      (b) ctl2 : is the name of the input control in which the selected date is to be shown
    //		(c) format : is the date format required.
	/////////////////////////////////////////////////////////////////////////////////
	function PopUpCalendar(ctl,	ctl2, format)
    {
		var	leftpos=-170
		var	toppos=0

		if (bPageLoaded)
		{
			if ( crossobj.visibility ==	"hidden" ) {
				ctlToPlaceValue	= ctl2
				dateFormat=format;

				formatChar = " "
				aFormat	= dateFormat.split(formatChar)
				if (aFormat.length<3)
				{
					formatChar = "/"
					aFormat	= dateFormat.split(formatChar)
					if (aFormat.length<3)
					{
						formatChar = "."
						aFormat	= dateFormat.split(formatChar)
						if (aFormat.length<3)
						{
							formatChar = "-"
							aFormat	= dateFormat.split(formatChar)
							if (aFormat.length<3)
							{
								// invalid date	format
								formatChar=""
							}
						}
					}
				}

				tokensChanged =	0
				if ( formatChar	!= "" )
				{
					// use user's date
					aData =	ctl2.value.split(formatChar)

					for	(i=0;i<3;i++)
					{
						if ((aFormat[i]=="d") || (aFormat[i]=="dd"))
						{
							dateSelected = parseInt(aData[i], 10)
							tokensChanged ++
						}
						else if	((aFormat[i]=="m") || (aFormat[i]=="mm"))
						{
							monthSelected =	parseInt(aData[i], 10) - 1
							tokensChanged ++
						}
						else if	(aFormat[i]=="yyyy")
						{
							yearSelected = parseInt(aData[i], 10)
							tokensChanged ++
						}
						else if	(aFormat[i]=="mmm")
						{
							for	(j=0; j<12;	j++)
							{
								if (aData[i]==monthName[j])
								{
									monthSelected=j
									tokensChanged ++
								}
							}
						}
					}
				}

				if ((tokensChanged!=3)||isNaN(dateSelected)||isNaN(monthSelected)||isNaN(yearSelected))
				{
					dateSelected = dateNow
					monthSelected =	monthNow
					yearSelected = yearNow
				}

				odateSelected=dateSelected
				omonthSelected=monthSelected
				oyearSelected=yearSelected

				aTag = ctl
				//alert(aTag);
				do {
					aTag = eval(aTag.offsetParent);
					leftpos	+= aTag.offsetLeft;
					toppos += aTag.offsetTop;
				} while(aTag.tagName!="BODY");

				crossobj.left =	fixedX==-1 ? ctl.offsetLeft	+ leftpos :	fixedX
				crossobj.top = fixedY==-1 ?	ctl.offsetTop +	toppos + ctl.offsetHeight +	2 :	fixedY
				constructCalendar (1, monthSelected, yearSelected);
				crossobj.visibility=(dom||ie)? "visible" : "show"

				hideElement( 'SELECT', document.getElementById("calendar") );
				hideElement( 'APPLET', document.getElementById("calendar") );

				bShow = true;
			}
		}
		else
		{
			init()
			popUpCalendar(ctl,	ctl2, format)
		}
	}
	document.onkeypress = function hidecal1 () {
		if (event.keyCode==27)
		{
			hideCalendar()
		}
	}
	document.onclick = function hidecal2 () {
		if (!bShow)
		{
			hideCalendar()
		}
		bShow = false
	}

	if(ie)
	{
		init()
	}
	else
	{
		window.onload=init
	}


    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : This function will return the total differernce between the from date and to date.
	//
	/////////////////////////////////////////////////////////////////////////////////
	function DateDiff(dttFromDate, dttToDate)
	{
		var date1=new Date();
	    var date2=new Date();
	    var diff=new Date();
		
		aFormat=dttFromDate.split(".")
		if(aFormat.length==3)
		{
			dttFromDate = aFormat[1]+"."+aFormat[0]+"."+aFormat[2]
		}
		
		aFormat=dttToDate.split(".")
		if(aFormat.length==3)
		{
			dttToDate = aFormat[1]+"."+aFormat[0]+"."+aFormat[2]	
		}
        dttFromDate=strReplace(dttFromDate , ".", "/");
        dttToDate=strReplace(dttToDate, ".", "/");
	    var date1temp=new Date(dttFromDate);
	    date1.setTime(date1temp.getTime());
	    var date2temp=new Date(dttToDate);
	    date2.setTime(date2temp.getTime());
	    diff.setTime(date2.getTime() - date1.getTime());
	    var timediff=diff.getTime();
	    var days=Math.floor(timediff / (1000 * 60 * 60 * 24));
	    timediff-=days * (1000 * 60 * 60 * 24);
	    return (days);
	}

    /////////////////////////////////////////////////////////////////////////////////
	//
	//Description : This function will replaces occurance of str2 with str3 in str1.
	//
	/////////////////////////////////////////////////////////////////////////////////
    function strReplace(str1, str2, str3)
    {
  		while(str1.indexof (str2) != -1)
        {
   			str1 = str1.replace(str2, str3);
 		}
  		return str1;
	}
