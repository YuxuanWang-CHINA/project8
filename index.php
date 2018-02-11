<?php
session_start();
if(isset($_SESSION['project8_username']))
{
	header("location:main.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Log in</title>
</head>

<script>
	function check()
	{
		var $inputName=document.getElementById("username").value
		//console.log($inputName);
		if (window.XMLHttpRequest) 
			{// code for IE7+, Firefox, Chrome, Opera, Safari 
				xhttp=new XMLHttpRequest(); 
			} 
			else 
			{// code for IE6, IE5 
				xhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
			}
			xhttp.open("GET","judge.php?username="+$inputName,true);
			xhttp.send();
			xhttp.onreadystatechange=function() 
			{
				if (xhttp.readyState==4 && xhttp.status==200) 
				{
					$re=xhttp.responseText
					//console.log($re);
					if($re=="0")
					{
						window.alert("The name has been used");
					}
					if($re=="1")
					{
						window.location.assign("main.php");
					}
				} 
			}

	}
</script>

<body>
	<form>
		<label for="username">Username</label>
		<input type="text" id="username" name="username"></input>
		<button type="button" onClick="check()">Submit</button>
	</form>
</body>
</html>