<?php
session_start();
if(!isset($_SESSION['project8_username']))
{
	header("location:index.php");
}
$input=$_GET["input"];
$writer=$_SESSION['project8_username'];
$date=date("Y")."-".date("m")."-".date("d");
$time=date("H").date("i").date("s");
$xml=simplexml_load_file("text.xml");
$xml->addChild("passage","");
//"<date>".$date."</date>"."<time>".$time."</time>"."<writer>".$writer."</writer>"."<main>".$input."</main>");
$length=count($xml->passage);
$xml->passage[$length-1]->addChild("date",$date);
$xml->passage[$length-1]->addChild("time",$time);
$xml->passage[$length-1]->addChild("writer",$writer);
$xml->passage[$length-1]->addChild("main",$input);

//echo "<date>".$date."</date>"."<time>".$time."</time>"."<writer>".$writer."</writer>"."<main>".$input."</main>"
$modi=$xml->asXML();
file_put_contents("text.xml",$modi);

?>