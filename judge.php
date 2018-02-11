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
$inputName=@$_GET["username"];

$xml=simplexml_load_file("online.xml");
$length=count($xml->name);
//echo $length;
$change=0;
for($i=0;$i<$length;$i++)
{
	$onlineName=$xml->name[$i];
	if ($inputName==$onlineName)
	{
		$change=1;
		echo "0";
	}
}
if($change==0)
{
	$xml->addChild("name", $inputName);
	$modi=$xml->asXML();
	file_put_contents("online.xml",$modi);
	$_SESSION['project8_username']=$inputName;
	echo "1";
}
?>