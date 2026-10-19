<?php 
if(!isset($_GET['ip']) && !isset($_GET['host']))
{
  header("Location: http://dhost.info/pizdonurek/msender/");
  exit;
}
if(isset($_GET['ip']))
{
  $tytul = "Sprawdzanie adresu domenowego dla numeru IP: ".$_GET['ip'];
  $wynik = "IP: <b>".$_GET['ip']."</b><br/> Host: <b>".gethostbyaddr($_GET['ip'])."</b>";
}
if(isset($_GET['host']))
{
  $tytul = "Sprawdzanie IP dla adresu domenowego: ".$_GET['host'];
  $wynik = "Host: <b>".$_GET['host']."</b><br/> IP: <b>".gethostbyname($_GET['host'])."</b>";
}
?>
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=iso-8859-2">
<META HTTP-EQUIV="Creation-date" CONTENT="2005-08-12T14:29:35Z">
<TITLE>
<?php 
echo $tytul;
?>
</TITLE>
<style TYPE="text/css">
<!--
body {
        background-color: #FFFFFF;
        scrollbar-base-color: #FFFFFF;
        scrollbar-arrow-color: #000000;
}

div {
        padding: 50px;
        text-align: center;
        color: #8D8D8D;
        font-family: Courier New, default;
        font-weight: normal;
        font-size: 14px;
}

a {
        text-decoration: none;
        color: #0000CC;
}

a:hover {
        text-decoration: underline;
        color: #CC0000;
}
-->
</STYLE>
</HEAD>
<BODY>
<DIV>
<?php 
echo $wynik;
?>
<br/>
<A HREF="javascript:window.close();">zamknij okno</A>
</DIV>
</BODY>
</HTML>
<?php 
exit;
?>