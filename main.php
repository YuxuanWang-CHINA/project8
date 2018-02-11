<?php
/*
	YuxuanWang-CHINA 
	project8
	在线多人实时对话系统
	
	
	MIT License
	Copyright (c) 2018 Yuxuan_Wang
*/
?>
<?php
session_start();
if(!isset($_SESSION['project8_username']))
{
	header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Main Page</title>
<script src="http://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
</head>

<script>
var $times=0;

function showText($xml)
{
	$(".mainPassage").remove();
	$length=$xml.getElementsByTagName("passage").length;
	for (var $i=$length-1;$i>=0;$i--)
	{
		var $txt=$xml.getElementsByTagName("main")[$i].childNodes[0].nodeValue;
		var $writer=$xml.getElementsByTagName("writer")[$i].childNodes[0].nodeValue;
		var $date=$xml.getElementsByTagName("date")[$i].childNodes[0].nodeValue;
		var $time=$xml.getElementsByTagName("time")[$i].childNodes[0].nodeValue;
		//console.log($writer+" : "+$txt);
		//console.log("<br/>");
		var para=document.createElement("li");
		var node=document.createTextNode($date+"_"+$time+" ---- "+$writer+" : "+$txt);
		para.appendChild(node);
		para.setAttribute("class","mainPassage");
		var element=document.getElementById("passage");
		element.appendChild(para);
	}
	$times++;
}

window.setInterval(function()
	{
		if (window.XMLHttpRequest) 
		{// code for IE7+, Firefox, Chrome, Opera, Safari 
			xhttp=new XMLHttpRequest(); 
		} 
		else 
		{// code for IE6, IE5 
			xhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		}
		xhttp.open("GET","text.xml",true);
		xhttp.setRequestHeader('If-Modified-Since', '0');
		xhttp.send();
		xhttp.onreadystatechange=function() 
		{
			if (xhttp.readyState==4 && xhttp.status==200) 
			{
				showText(xhttp.responseXML);
			} 
		}
	},
3000);

function add()
{
	var $input=document.getElementById("input").value;
	document.getElementById("input").value="";
	if (window.XMLHttpRequest) 
	{// code for IE7+, Firefox, Chrome, Opera, Safari 
		xhttp=new XMLHttpRequest(); 
	} 
	else 
	{// code for IE6, IE5 
		xhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
	}
	xhttp.open("GET","add.php?input="+$input,true);
	xhttp.send();
	/*xhttp.onreadystatechange=function() 
	{
		if (xhttp.readyState==4 && xhttp.status==200) 
		{
			$re=xhttp.responseText
		} 
	}*/
}

function exit()
{
	if (window.XMLHttpRequest) 
	{// code for IE7+, Firefox, Chrome, Opera, Safari 
		xhttp=new XMLHttpRequest(); 
	} 
	else 
	{// code for IE6, IE5 
		xhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
	}
	xhttp.open("GET","exit.php",true);
	xhttp.send();
	xhttp.onreadystatechange=function() 
	{
		if (xhttp.readyState==4 && xhttp.status==200) 
		{
		window.location.assign("main.php");
		} 
	}

}

</script>

<body onbeforeunload="exit()">
<h1>Your name:<?php echo $_SESSION['project8_username'] ?></h1>
<form>
	<button type="button" onClick="exit()">exit</button>
</form>

<form>
	<label for="input">Input</label>
	<input type="text" id="input" name="input"></input>
	<button type="button" onClick="add()">Submit</button>
</form>
<ul>
<li id="passage">Passage:</li>
</ul>

</body>
</html>