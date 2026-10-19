<HTML>
<HEAD>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=iso-8859-2">
<META HTTP-EQUIV="Creation-date" CONTENT="2009-03-10T19:57:57Z">
<TITLE>Statystyka strony.</TITLE>
<BASE HREF="http://dhost.info/">
</HEAD>
<BODY>
<p>
<?php 
require("config.php");
$sql = mysql_connect($host,$user,$password) or die(mysql_error());
mysql_select_db($database);
$question = "SELECT * FROM licznik";
$result = mysql_query($question) or die(mysql_error());
while($line = mysql_fetch_array($result))
{
  echo $line['id']."<b>. nazwa:</b> ".$line['name']." <b>ilość wejść:</b> ".$line['count'];
}
$start = $_GET['start'];
if (!isset($start)) 
{ 
$start = 1;
} 
$limit = (($start - 1) * 20); 
$sql_num = mysql_query("SELECT * FROM wyslane"); 
$num = mysql_num_rows($sql_num); 
$ile_stron = ceil($num/20);
?>
<br/>
</p>
<div align="left">
<?php
if ($ile_stron > 1)
{
  $nr_linia = 1;  
  for($nr = 1;$nr <= $ile_stron;$nr++)
  {
  	echo "<a href=\"".$_SERVER['PHP_SELF']."?start=$nr\">[$nr]</a>&nbsp;&nbsp;";       
    if($nr_linia < 20) 
	{
	  $nr_linia++;
	}
	else
	{
	  $nr_linia = 0;
	  echo "<br/>";
	}
  }
}
?>
</div>
<div align="center">
<?php
if ($start > 1) 
{ 
  echo "<a href=\"".$_SERVER['PHP_SELF']."?start=".($start-1)."\"><< poprzednia</a>&nbsp;&nbsp;";
} 
if (($num > 20) && (($limit + 20) < $num)) 
{
  echo "<a href=\"".$_SERVER['PHP_SELF']."?start=".($start+1)."\">następna >></a>";
} 
?>
</div>
<?php
$sql_results = mysql_query("SELECT * FROM wyslane LIMIT $limit,10");
while($results = mysql_fetch_array($sql_results))
{
  echo "<br/>\n<div><p>Nr. <B>".$results['id']."</B> Data wysłania: <b>".$results['data']."</b> ";
  echo "IP nadawcy: <b><a href=\"pizdonurek/msender/sprawdz.php?ip=".$results['ip']."\" target=\"_blank\">".$results['ip']."</a></b></p>\n";
  echo "<p>Do: <b><a href=\"mailto:".$results['odbiorca']."\">".$results['odbiorca']."</a></b></p>";
  echo "<p>Od: <b><a href=\"mailto:".$results['nadawca']."\">".$results['nadawca']."</a></b></p>";
  echo "<p>Temat: <b>".$results['temat']."</b></p>\n";
  echo "<p>Treść: <br/>".nl2br($results['tresc'])."</p></div><hr>\n";
}
mysql_close($sql); 
?>
<div align="center">
<?php
if ($start > 1) 
{
  echo "<a href=\"".$_SERVER['PHP_SELF']."?start=".($start-1)."\"><< poprzednia</a>&nbsp;&nbsp;";
} 
if (($num > 20) && (($limit + 20) < $num)) 
{
  echo "<a href=\"".$_SERVER['PHP_SELF']."?start=".($start+1)."\">następna >></a>";
} 
?>
</div>
</BODY>
</HTML>
<?php 
exit; 
?>
