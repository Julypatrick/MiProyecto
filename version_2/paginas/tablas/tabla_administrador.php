<?php require_once('../../Connections/proyecto.php'); ?>
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

$maxRows_administrador = 10;
$pageNum_administrador = 0;
if (isset($_GET['pageNum_administrador'])) {
  $pageNum_administrador = $_GET['pageNum_administrador'];
}
$startRow_administrador = $pageNum_administrador * $maxRows_administrador;

mysql_select_db($database_proyecto, $proyecto);
$query_administrador = "SELECT * FROM administradores";
$query_limit_administrador = sprintf("%s LIMIT %d, %d", $query_administrador, $startRow_administrador, $maxRows_administrador);
$administrador = mysql_query($query_limit_administrador, $proyecto) or die(mysql_error());
$row_administrador = mysql_fetch_assoc($administrador);

if (isset($_GET['totalRows_administrador'])) {
  $totalRows_administrador = $_GET['totalRows_administrador'];
} else {
  $all_administrador = mysql_query($query_administrador);
  $totalRows_administrador = mysql_num_rows($all_administrador);
}
$totalPages_administrador = ceil($totalRows_administrador/$maxRows_administrador)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
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
</style>
</head>

<body background="../../imagenes/paper.gif">
<p>&nbsp;</p>
<table align="center">
  <tr>
    <td width="160"><img src="../../imagenes/44.png"/></td>
    <td width="494" ><p align="center"><img src="../../imagenes/nombre.png" width="448" height="78" /></td> 
  </tr>
</table>
<hr width="900" color="#000000"/>
<hr width="1000" color="#000000"/>
<br />
<table width="708" border="1" bordercolor="#000000" align="center">
  <tr style="background-image:url(../../imagenes/girl.gif)">
    <td width="698">
    <p>&nbsp;</p>
    <?php do { ?>
      <table width="468" border="1">
        <tr>
          <td width="129">Documento</td>
          <td width="323"><?php echo $row_administrador['Codigo']; ?></td>
          </tr>
        <tr>
          <td>Tipo Documento</td>
          <td><?php echo $row_administrador['Tipo_Documento']; ?></td>
          </tr>
        <tr>
          <td>nombres</td>
          <td><?php echo $row_administrador['Nombres']; ?></td>
          </tr>
        <tr>
          <td>apellidos</td>
          <td><?php echo $row_administrador['Apellidos']; ?></td>
          </tr>
        <tr>
          <td>direccion</td>
          <td><?php echo $row_administrador['Direccion']; ?></td>
          </tr>
        <tr>
          <td>telefono</td>
          <td><?php echo $row_administrador['Telefono']; ?></td>
          </tr>
        <tr>
          <td>celular</td>
          <td><?php echo $row_administrador['Celular']; ?></td>
          </tr>
        <tr>
          <td>sexo</td>
          <td><?php echo $row_administrador['Sexo']; ?></td>
          </tr>
        <tr>
          <td>fecha nacimiento</td>
          <td><?php echo $row_administrador['Fecha_Nacimiento']; ?></td>
          </tr>
        <tr>
          <td>edad</td>
          <td><?php echo $row_administrador['Edad']; ?></td>
          </tr>
        <tr>
          <td>cantraseña</td>
          <td><?php echo $row_administrador['Contraseña']; ?></td>
          </tr>
      </table>
      <?php } while ($row_administrador = mysql_fetch_assoc($administrador)); ?>
<p>&nbsp;</p>
    <p>&nbsp;</p>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($administrador);
?>




