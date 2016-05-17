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

$maxRows_libros = 10;
$pageNum_libros = 0;
if (isset($_GET['pageNum_libros'])) {
  $pageNum_libros = $_GET['pageNum_libros'];
}
$startRow_libros = $pageNum_libros * $maxRows_libros;

mysql_select_db($database_proyecto, $proyecto);
$query_libros = "SELECT * FROM libros";
$query_limit_libros = sprintf("%s LIMIT %d, %d", $query_libros, $startRow_libros, $maxRows_libros);
$libros = mysql_query($query_limit_libros, $proyecto) or die(mysql_error());
$row_libros = mysql_fetch_assoc($libros);

if (isset($_GET['totalRows_libros'])) {
  $totalRows_libros = $_GET['totalRows_libros'];
} else {
  $all_libros = mysql_query($query_libros);
  $totalRows_libros = mysql_num_rows($all_libros);
}
$totalPages_libros = ceil($totalRows_libros/$maxRows_libros)-1;

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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RESERVA</title>
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

<body background="../img/FONDO_8.gif">
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
    <td width="78"><p align="center"><a href="principal.php"><font face="Lucida Console, Monaco, monospace" size="+2" color="#FF0000">X</font></a><a href="principal.php"><font face="Lucida Console, Monaco, monospace" size="+1" color="#000099"> Cerrar sesion... </font></a></p>
    <td width="70"  bgcolor="#FFFFFF" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="ub.html">Reservas</a></font></font></td>
    <td width="70" ><p align="center"><font face="Comic Sans MS, cursive" color="" ><a href="indezu.php">Inicio</a></font></font></td>
  </tr>
</table>
<table width="708" border="1" bordercolor="#000000" align="center">
  <tr style="background-image:url(../imagenes/fondo_8.gif)">
    <td width="698">
    <p align="center">&nbsp;</p>
    <form id="form1" name="form1" method="post" action="">
      <label for="Busqueda"></label>
       <p align="center">
       <p align="center">       
         
         <?php do { ?>
       <p align="center">
       <div align="center"></div>
        <div align="center">
          <table width="668" border="1">
            <tr>
              <td width="107" align="center" bgcolor="#CCCCCC">Codigo </td>
              <td width="182" align="center" bgcolor="#CCCCCC">Nombre </td>
              <td width="177" align="center" bgcolor="#CCCCCC">Autor </td>
              <td width="137" align="center" bgcolor="#CCCCCC" >Editorial</td><td width="31"></td>
             </tr>
            <tr>
              <td bgcolor="#FFFFFF"><?php echo $row_libros['Codigo']; ?></td>
              <td bgcolor="#FFFFFF"><?php echo $row_libros['Nombre']; ?></td>
              <td bgcolor="#FFFFFF"><?php echo $row_autor['Nombres']; ?></td>
              <td bgcolor="#FFFFFF"><?php echo $row_editorial['Nombre']; ?></td>
              <td><a href="u-r.php">Reseervar Libro</a></td>
             </tr>
          </table>
        </div>
        <?php } while ($row_libros = mysql_fetch_assoc($libros)); ?>
<p align="center">
          
          </div>
<p align="center">       
</form>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($libros);

mysql_free_result($autor);

mysql_free_result($editorial);
?>
