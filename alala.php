<HTML>
<HEAD>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=iso-8859-2">
<META NAME="Description" CONTENT="Opis dokumentu">
<META NAME="Author" CONTENT="Autor dokumentu">
<TITLE>Lista adresów zastrzeżonych i dodawanie nowych.</TITLE>
</HEAD>
<BODY>
<form ACTION="alala.php" METHOD="post">
<P><input TYPE="text" name="adres"></P>
<input TYPE="button" value="dodaj" onclick="document.forms[0].submit()">
</FORM>
<P>
<?php 
echo getenv('SCRIPT_NAME');
exit;
?>
</P>
</BODY>
</HTML>
