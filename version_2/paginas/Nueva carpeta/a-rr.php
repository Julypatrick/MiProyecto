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

$maxRows_li = 10;
$pageNum_li = 0;
if (isset($_GET['pageNum_li'])) {
  $pageNum_li = $_GET['pageNum_li'];
}
$startRow_li = $pageNum_li * $maxRows_li;

mysql_select_db($database_proyecto, $proyecto);
$query_li = "SELECT Codigo, Nombre FROM libros";
$query_limit_li = sprintf("%s LIMIT %d, %d", $query_li, $startRow_li, $maxRows_li);
$li = mysql_query($query_limit_li, $proyecto) or die(mysql_error());
$row_li = mysql_fetch_assoc($li);

if (isset($_GET['totalRows_li'])) {
  $totalRows_li = $_GET['totalRows_li'];
} else {
  $all_li = mysql_query($query_li);
  $totalRows_li = mysql_num_rows($all_li);
}
$totalPages_li = ceil($totalRows_li/$maxRows_li)-1;

mysql_select_db($database_proyecto, $proyecto);
$query_re = "SELECT * FROM reservas";
$re = mysql_query($query_re, $proyecto) or die(mysql_error());
$row_re = mysql_fetch_assoc($re);
$totalRows_re = mysql_num_rows($re);

mysql_select_db($database_proyecto, $proyecto);
$query_u = "SELECT Nombres FROM usuarios";
$u = mysql_query($query_u, $proyecto) or die(mysql_error());
$row_u = mysql_fetch_assoc($u);
$totalRows_u = mysql_num_rows($u);
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
    <td width="103" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rb.php">Registro Bibliotecologo</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-ru.php">Registro Usuario</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rl.php">Registro Libros</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rau.php">Registro Autor</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rm.php">Registro Materia</a></font></td>
    <td width="81"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="prestamos.php">Prestamo  Libros</a></font></td>
    <td width="78"><p align="center"><font face="Comic Sans MS, cursive" ><a href="a-dl.php">Devolucion Libros</a></font></td>
    <td width="70"><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="indeza.php">Inicio</a></font></font></td>
  </tr>
</table>
<table width="707" border="1" bordercolor="#000000" align="center">
  <tr style="background-image:url(fondo_8.gif)">
    <td width="697" height="149" background="../img/fondo_8.gif"><div align="center">
      <table width="547" border="1">
        <tr>
          <td width="112">Usuario</td>
          <td width="193">Libro </td>
          <td width="57">Dia </td>
          <td width="95">Mes </td>
          <td width="56">Año </td>
          </tr>
        <tr>
          <td><?php echo $row_re['Usuario']; ?></td>
          <td><?php do { ?>
              <?php echo $row_li['Nombre']; ?>
              <?php } while ($row_li = mysql_fetch_assoc($li)); ?></td>
          <td><?php echo $row_re['Dia']; ?></td>
          <td><?php echo $row_re['Mes']; ?></td>
          <td><?php echo $row_re['Ano']; ?></td>
          </tr>
      </table>
    </div></td>
  </tr>
</table>
<table align="center" border="1" bordercolor="#000000">
<td width="103" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-re.php">Registro Editorial</a></font></td>
<td width="103" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="a-rb.php">Sanciones</a></font></td>
<td width="103" bgcolor="#FFFFFF" ><p align="center"><font face="Comic Sans MS, cursive" ><a href="a-rr.php">Reservas</a></font></td></tr>
</table>
</body>
</html>
<?php
mysql_free_result($li);

mysql_free_result($re);

mysql_free_result($u);
?>
