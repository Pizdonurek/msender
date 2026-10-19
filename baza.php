<HTML>
<HEAD>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=iso-8859-2">
<META NAME="Description" CONTENT="Opis dokumentu">
<META NAME="Author" CONTENT="Autor dokumentu">
<TITLE>Lista adresów zastrzeżonych i dodawanie nowych.</TITLE>
</HEAD>
<BODY>
<form ACTION="baza.php" METHOD="post">
<P>Dodaj <input TYPE="text" name="adres"></P>
<input TYPE="button" value="dodaj" onclick="document.forms[0].submit()">
</FORM>
<P>
<?php 
require("config.php");
$sql = mysql_connect($host,$user,$password) or die(mysql_error());
mysql_select_db($database);
if(isset($_POST['adres']))
{
  $question = "INSERT INTO adresy VALUES('".$_POST['adres']."')";
  $result = mysql_query($question) or die(mysql_error());
}
$question = "SELECT * FROM adresy";
$result = mysql_query($question) or die(mysql_error());
while($line = mysql_fetch_array($result))
{
  echo $line['email']."<br/>";
}
mysql_close($sql);
?>
</P>
</BODY>
</HTML>
