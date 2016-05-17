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
  $insertSQL = sprintf("INSERT INTO devoluciones (Codigo, Prestamo, Usuario, Libro, Bibliotecologo, Sancion) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Codigo'], "int"),
                       GetSQLValueString($_POST['Prestamo'], "int"),
                       GetSQLValueString($_POST['Usuario'], "double"),
                       GetSQLValueString($_POST['Libro'], "int"),
                       GetSQLValueString($_POST['Bibliotecologo'], "double"),
                       GetSQLValueString($_POST['Sancion'], "int"));

  mysql_select_db($database_proyecto, $proyecto);
  $Result1 = mysql_query($insertSQL, $proyecto) or die(mysql_error());

  $insertGoTo = "a-dl.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_proyecto, $proyecto);
$query_prestamo = "SELECT * FROM prestamos";
$prestamo = mysql_query($query_prestamo, $proyecto) or die(mysql_error());
$row_prestamo = mysql_fetch_assoc($prestamo);
$totalRows_prestamo = mysql_num_rows($prestamo);

mysql_select_db($database_proyecto, $proyecto);
$query_usuario = "SELECT * FROM usuarios";
$usuario = mysql_query($query_usuario, $proyecto) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

mysql_select_db($database_proyecto, $proyecto);
$query_libro = "SELECT * FROM libros";
$libro = mysql_query($query_libro, $proyecto) or die(mysql_error());
$row_libro = mysql_fetch_assoc($libro);
$totalRows_libro = mysql_num_rows($libro);

mysql_select_db($database_proyecto, $proyecto);
$query_bibliotecologo = "SELECT * FROM administradores";
$bibliotecologo = mysql_query($query_bibliotecologo, $proyecto) or die(mysql_error());
$row_bibliotecologo = mysql_fetch_assoc($bibliotecologo);
$totalRows_bibliotecologo = mysql_num_rows($bibliotecologo);

mysql_select_db($database_proyecto, $proyecto);
$query_sancion = "SELECT * FROM sanciones";
$sancion = mysql_query($query_sancion, $proyecto) or die(mysql_error());
$row_sancion = mysql_fetch_assoc($sancion);
$totalRows_sancion = mysql_num_rows($sancion);
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
    <td width="103"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rb.php">Registro Bibliotecologo</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-ru.php">Registro Usuario</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rl.php">Registro Libros</a></font></td>
      <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rau.php">Registro Autor</a></font></td>
        <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rm.php">Registro Materia</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="prestamos.php">Prestamo  Libros</a></font></td>
    <td width="78" bgcolor="#FFFFFF"><p align="center"><font face="Comic Sans MS, cursive" ><a href="a-dl.php">Devolucion Libros</a></font></td>
    <td width="70" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="indeza.php">Inicio</a></font></font></td>
  </tr>
</table>
<table width="708" border="1" bordercolor="#000000" align="center">
  <tr style="background-image:url(../img/fondo_8.gif)">
    <td width="698" height="317"><p>&nbsp;</p><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Prestamo:</td>
          <td><select name="Prestamo">
            <?php 
do {  
?>
            <option value="<?php echo $row_prestamo['Codigo']?>" ><?php echo $row_prestamo['Codigo']?></option>
            <?php
} while ($row_prestamo = mysql_fetch_assoc($prestamo));
?>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Usuario:</td>
          <td><select name="Usuario">
            <?php 
do {  
?>
            <option value="<?php echo $row_usuario['Codigo']?>" ><?php echo $row_usuario['Nombres']?></option>
            <?php
} while ($row_usuario = mysql_fetch_assoc($usuario));
?>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Libro:</td>
          <td><select name="Libro">
            <?php 
do {  
?>
            <option value="<?php echo $row_libro['Codigo']?>" ><?php echo $row_libro['Nombre']?></option>
            <?php
} while ($row_libro = mysql_fetch_assoc($libro));
?>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Bibliotecologo:</td>
          <td><select name="Bibliotecologo">
            <?php 
do {  
?>
            <option value="<?php echo $row_bibliotecologo['Codigo']?>" ><?php echo $row_bibliotecologo['Nombres']?></option>
            <?php
} while ($row_bibliotecologo = mysql_fetch_assoc($bibliotecologo));
?>
            </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Sancion:</td>
          <td><select name="Sancion">
            <?php 
do {  
?>
            <option value="<?php echo $row_sancion['Codigo']?>" ><?php echo $row_sancion['Codigo']?></option>
            <?php
} while ($row_sancion = mysql_fetch_assoc($sancion));
?>
            </select></td>
        </tr>
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
    </form>
    <p>&nbsp;</p></td>
  </tr>
</table>
<table align="center" border="1" bordercolor="#000000">
<td width="103" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-re.php">Registro Editorial</a></font></td>
<td width="103" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-s.php">Sanciones</a></font></td><td width="103" ><p align="center"><font face="Comic Sans MS, cursive" ><a href="a-rr.php">Reservas</a></font></td></tr>
</table>
</body>
</html>
<?php
mysql_free_result($prestamo);

mysql_free_result($usuario);

mysql_free_result($libro);

mysql_free_result($bibliotecologo);

mysql_free_result($sancion);
?>
