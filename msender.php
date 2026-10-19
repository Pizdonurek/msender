<?php 
require("config.php");
if(!strcmp($_SERVER['HTTP_REFERER'],"http://dhost.info/pizdonurek/msender/index.html"))
{
  header("Location: http://dhost.info/pizdonurek/msender/");
  exit;
}

$ip = getenv('REMOTE_ADDR');
$test = true;
$sql = mysql_connect($host,$user,$password) or die(mysql_error());
mysql_select_db($database);
$zapytanie = "SELECT email FROM adresy WHERE (email='".strtolower($_POST['nadawca'])."')";
$wykonaj = mysql_query($zapytanie) or die(mysql_error());
$wynik = mysql_fetch_array($wykonaj);
if($wynik['email'] != "")
{
  $test = false;
}
$zapytanie = "SELECT email FROM adresy WHERE (email='".strtolower($_POST['odbiorca'])."')";
$wykonaj = mysql_query($zapytanie) or die(mysql_error());
$wynik = mysql_fetch_array($wykonaj);
if($wynik['email'] != "")
{
  $host = gethostbyaddr($ip);
  $_POST['tresc'] .= "\n[ Ten e-mail pochodzi z Mail Sendera v1.07 !]\n";
  $_POST['tresc'] .= "Dane wysy³aj±cego:\nIP: ".$ip."\nHost: ".$host."\n";
}
if($test)
{
  $_POST['tresc'] = htmlspecialchars($_POST['tresc']);
  switch($_POST['typ'])
  {
    case "0":
    $contents = $_POST['tresc'];
    $header = "From: ".$_POST['nadawca']."\r\n";
    $header .= "Reply-To: ".$_POST['nadawca']."\r\n"; 
    break;
    case "1":
    $format = "style=\"color: ".$_POST['kolor']."; text-align: ".$_POST['align'].";";
	if(isset($_POST['dec1']))
    {
      $format .= " font-weight: bold;";
    }
    if(isset($_POST['dec2']))
    {
      $format .= " text-decoration: underline;";
    }
    if(isset($_POST['dec3']))
    {
      $format .= " font-style: italic;";
    }
	$format .= " font-family: ".$_POST['font']."; font-size: ".$_POST['size']."pt;\"";
    $contents = "<html><head><title>".strip_tags($_POST['temat'])."</title></head>";
    $contents .= "<body><p ".$format.">".nl2br($_POST['tresc'])."</p></body></html>";
    $header  = "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=".$_POST['kod']."\r\n";
    $header .= "From: ".$_POST['nadawca']."\r\n";
    $header .= "Reply-To: ".$_POST['nadawca']."\r\n";
    break;    
  }
  if(mail($_POST['odbiorca'],strip_tags($_POST['temat']),$contents,$header))
  {
	$zapytanie = "INSERT INTO wyslane VALUES ('','".date("Y-m-d")."','".$ip."','".$_POST['odbiorca']."','".$_POST['nadawca']."','".$_POST['temat']."','".$_POST['tresc']."')";
	mysql_query($zapytanie) or die(mysql_error());
	$licznik_id = getenv('SCRIPT_NAME'); 
	$zapytanie ="SELECT * FROM licznik WHERE (name='".$licznik_id."')";
    $wynik = mysql_query($zapytanie) or die(mysql_error()); 
    $linia = mysql_fetch_array($wynik); 
    if(isset($linia))
    { 
      $zapytanie = "UPDATE licznik SET count=count+1 WHERE (name='".$licznik_id."')";
      mysql_query($zapytanie) or die(mysql_error()); 
      $count = $linia['count']+1; 
    }
    else
    { 
      $zapytanie = "INSERT INTO licznik VALUES ('','".$licznik_id."','2')";
      mysql_query($zapytanie) or die(mysql_error()); 
      $count = '1'; 
    } 
	$outtext = "<p style=\"color: #00CC00; font-weight: bold;\">Wiadomo¶æ zosta³a wys³ana.</p>\nTo jest ".$count." e-mail wys³any za pomoc± Msendera :D"; 
  }
  else
  {
    $outtext = "<p style=\"color: #CC0000; font-weight: bold;\">Wiadomo¶æ nie zosta³a wys³ana.</p>";
  }
}
else
{ 
  $outtext = "<p style=\"color: #CC0000; font-weight: bold;\">Próbowa³e¶ wys³aæ wiadomo¶æ u¿ywaj±c zastrze¿onego adresu !</p>";
}
mysql_close($sql);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=iso-8859-2">
<META HTTP-EQUIV="Creation-date" CONTENT="2009-03-10T19:52:49Z">
<BASE HREF="http://dhost.info/pizdonurek/msender/">
<TITLE>Mail Sender v1.07</TITLE>
<STYLE TYPE="text/css">
<!-- body { background-color: #FFFFFF; scrollbar-base-color: #FFFFFF; scrollbar-arrow-color: #000000; } a { text-decoration: none; color: #0000CC; } a:hover { text-decoration: underline; color: #CC0000; } #pole_1 { position: relative; top: 200px; text-align: center; color: #8D8D8D; font-family: Courier New, default; font-weight: normal; font-size: 12px; } -->
</STYLE>
</HEAD>
<BODY>
<DIV id="pole_1">
<?php 
echo $outtext."<br/>\n";
?>
<A HREF="index.html">powrót</A>
</DIV>
</BODY>
</HTML>
<?php 
exit; 
?>

