<?php
session_start();
if(!isset($_SESSION['project8_username']))
{
	header("location:index.php");
}

$username=$_SESSION['project8_username'];

$xml=simplexml_load_file("online.xml");
$length=count($xml->name);
for($i=0;$i<$length;$i++)
{
	$onlineName=$xml->name[$i];
	if ($username==$onlineName)
	{
		unset($xml->name[$i]);
	}
}
$modi=$xml->asXML();
file_put_contents("online.xml",$modi);
unset($_SESSION['project8_username']);
?>