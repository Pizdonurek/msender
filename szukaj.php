<HTML>
<HEAD>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=iso-8859-2">
<META NAME="Description" CONTENT="Opis dokumentu">
<META NAME="Author" CONTENT="Autor dokumentu">
<TITLE>Tytuł</TITLE>
</HEAD>
<BODY>
<form ACTION="szukaj.php" METHOD="post">
<input TYPE="text" name="adres">
<input TYPE="button" value="szukaj" onclick="document.forms[0].submit()">
</FORM>
<?php 
require("config.php");
$sql = mysql_connect($host,$user,$password) or die(mysql_error());
mysql_select_db($database);
$question = "CREATE TABLE wyslane (id int(11) DEFAULT '0' NOT NULL auto_increment unsigned,data datetime NOT NULL,ip varchar(16) NOT NULL,odbiorca varchar(255) NOT NULL,nadawca varchar(255),temat varchar(255),tresc text,PRIMARY KEY (id))";
$result = mysql_query($question) or die(mysql_error);
mysql_close($sql);
?>
<!-- To jest miejsce na treść dokumentu -->

</BODY>
</HTML>
