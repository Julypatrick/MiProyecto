<?php require_once('../Connections/proyecto.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO libros (Nombre, Autor, Editorial, Referencia) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['Nombre'], "text"),
                       GetSQLValueString($_POST['Autor'], "int"),
                       GetSQLValueString($_POST['Editorial'], "int"),
                       GetSQLValueString($_POST['Referencia'], "int"));

  mysql_select_db($database_proyecto, $proyecto);
  $Result1 = mysql_query($insertSQL, $proyecto) or die(mysql_error());

  $insertGoTo = "a-rl.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_proyecto, $proyecto);
$query_autor = "SELECT * FROM autores";
$autor = mysql_query($query_autor, $proyecto) or die(mysql_error());
$row_autor = mysql_fetch_assoc($autor);
$totalRows_autor = mysql_num_rows($autor);

mysql_select_db($database_proyecto, $proyecto);
$query_editorial = "SELECT * FROM editorial";
$editorial = mysql_query($query_editorial, $proyecto) or die(mysql_error());
$row_editorial = mysql_fetch_assoc($editorial);
$totalRows_editorial = mysql_num_rows($editorial);

mysql_select_db($database_proyecto, $proyecto);
$query_referencia = "SELECT * FROM referencias";
$referencia = mysql_query($query_referencia, $proyecto) or die(mysql_error());
$row_referencia = mysql_fetch_assoc($referencia);
$totalRows_referencia = mysql_num_rows($referencia);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
a:link {
	color: #000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000;
}
a:hover {
	text-decoration: none;
	color: #000;
}
a:active {
	text-decoration: none;
	color: #000;
}
body,td,th {
	font-family: "Comic Sans MS", cursive;
	color: #000;
}
</style>
</head>

<body background="../img/fondo_8.gif">
<p>&nbsp;</p>
<p>&nbsp;</p>
<table align="center">
  <tr>
    <td width="160"><img src="../img/url.png"/></td>
    <td width="494" ><p align="center"><img src="../img/bienvenido.png" width="448" height="78" /></td> 
  </tr>
</table>
<hr width="900" color="#000000"/>
<hr width="1000" color="#000000"/>
<br />
<table width="708" border="1" bordercolor="#000000" align="center">
  <tr>
    <td width="103" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rb.php">Registro Bibliotecologo</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-ru.php">Registro Usuario</a></font></td>
    <td width="81" bgcolor="#FFFFFF"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rl.php">Registro Libros</a></font></td>
      <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rau.php">Registro Autor</a></font></td>
        <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rm.php">Registro Materia</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="prestamos.php">Prestamo  Libros</a></font></td>
    <td width="78"><p align="center"><font face="Comic Sans MS, cursive" ><a href="a-dl.php">Devolucion Libros</a></font></td>
    <td width="70" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="indeza.php">Inicio</a></font></font></td>
  </tr>
</table>
<table width="708" border="1" bordercolor="#000000" align="center">
  <tr style="background-image:url(../img/fondo_8.gif)">
    <td width="698" height="252"><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Nombre:</td>
            <td><input type="text" name="Nombre" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Autor:</td>
            <td><select name="Autor">
              <?php 
do {  
?>
              <option value="<?php echo $row_autor['Codigo']?>" ><?php echo $row_autor['Nombres']?></option>
              <?php
} while ($row_autor = mysql_fetch_assoc($autor));
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Editorial:</td>
            <td><select name="Editorial">
              <?php 
do {  
?>
              <option value="<?php echo $row_editorial['Codigo']?>" ><?php echo $row_editorial['Nombre']?></option>
              <?php
} while ($row_editorial = mysql_fetch_assoc($editorial));
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Referencia:</td>
            <td><select name="Referencia">
              <?php 
do {  
?>
              <option value="<?php echo $row_referencia['Codigo']?>" ><?php echo $row_referencia['Nombre']?></option>
              <?php
} while ($row_referencia = mysql_fetch_assoc($referencia));
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><p>&nbsp;
              </p>
              <p>
                <input type="submit" value="Insertar registro" />
            </p></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form></td>
  </tr>
</table>
<table align="center" border="1" bordercolor="#000000">
<td width="103" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-re.php">Registro Editorial</a></font></td>
<td width="103" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-s.php">Sanciones</a></font></td>
<td width="103" ><p align="center"><font face="Comic Sans MS, cursive" ><a href="a-rr.php">Reservas</a></font></td></tr>
</table>
</body>
</html>
<?php
mysql_free_result($autor);

mysql_free_result($editorial);

mysql_free_result($referencia);
?>
