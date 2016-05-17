<?php require_once('../Connections/proyecto.php'); ?>
<?php 
//Reanudamos la sesión 
@session_start(); 
//Validamos si existe realmente una sesión activa o no 
if(!$_SESSION["MM_Username"])
{ 
  //Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
  header("Location: accesousuario.php"); 
  exit(); 
} 
?>
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
  $insertSQL = sprintf("INSERT INTO usuarios (Codigo, Tipo_Documento, Nombres, Apellidos, Direccion, Telefono, Celular, Sexo, Dia, Mes, Ano, Edad, Contrasena) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, PASSWORD(%s))",
                       GetSQLValueString($_POST['Codigo'], "int"),
                       GetSQLValueString($_POST['Tipo_Documento'], "text"),
                       GetSQLValueString($_POST['Nombres'], "text"),
                       GetSQLValueString($_POST['Apellidos'], "text"),
                       GetSQLValueString($_POST['Direccion'], "text"),
                       GetSQLValueString($_POST['Telefono'], "text"),
                       GetSQLValueString($_POST['Celular'], "text"),
                       GetSQLValueString($_POST['Sexo'], "text"),
                       GetSQLValueString($_POST['Dia'], "int"),
                       GetSQLValueString($_POST['Mes'], "text"),
                       GetSQLValueString($_POST['Ano'], "int"),
                       GetSQLValueString($_POST['Edad'], "int"),
                       GetSQLValueString($_POST['Contrasena'], "text"));

  mysql_select_db($database_proyecto, $proyecto);
  $Result1 = mysql_query($insertSQL, $proyecto) or die(mysql_error());

  $insertGoTo = "acsesousuario.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>REGISTRO</title>
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
  <tr style="background-image:url(../imagenes/fondo_8.gif)">
    <td width="698"><p>&nbsp;</p>
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Documento:</td>
          <td><input type="text" name="Codigo" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Tipo Documento:</td>
          <td><select name="Tipo_Documento">
            <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Seleccionar...</option>
            <option value="Tarjeta de Identidad" <?php if (!(strcmp("Tarjeta de Identidad", ""))) {echo "SELECTED";} ?>>Tarjeta de Identidad</option>
            <option value="Cedula de Ciudadania" <?php if (!(strcmp("Cedula de Ciudadania", ""))) {echo "SELECTED";} ?>>Cedula de Ciudadania</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Nombres:</td>
          <td><input type="text" name="Nombres" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Apellidos:</td>
          <td><input type="text" name="Apellidos" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Direccion:</td>
          <td><input type="text" name="Direccion" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Telefono:</td>
          <td><input type="text" name="Telefono" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Celular:</td>
          <td><input type="text" name="Celular" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Sexo:</td>
          <td><select name="Sexo">
            <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Seleccionar...</option>
            <option value="F" <?php if (!(strcmp("F", ""))) {echo "SELECTED";} ?>>Femenino</option>
            <option value="M" <?php if (!(strcmp("M", ""))) {echo "SELECTED";} ?>>Masculino</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Dia:</td>
          <td><select name="Dia">
            <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Seleccionar...</option>
            <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>1</option>
            <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>2</option>
          <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>3</option>
            <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>4</option>
            <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>>5</option>
            <option value="6" <?php if (!(strcmp(6, ""))) {echo "SELECTED";} ?>>6</option>
            <option value="7" <?php if (!(strcmp(7, ""))) {echo "SELECTED";} ?>>7</option>
            <option value="8" <?php if (!(strcmp(8, ""))) {echo "SELECTED";} ?>>8</option>
            <option value="9" <?php if (!(strcmp(9, ""))) {echo "SELECTED";} ?>>9</option>
            <option value="10" <?php if (!(strcmp(10, ""))) {echo "SELECTED";} ?>>10</option>
          <option value="11" <?php if (!(strcmp(11, ""))) {echo "SELECTED";} ?>>11</option>
          <option value="12" <?php if (!(strcmp(12, ""))) {echo "SELECTED";} ?>>12</option>
          <option value="13" <?php if (!(strcmp(13, ""))) {echo "SELECTED";} ?>>13</option>
          <option value="14" <?php if (!(strcmp(14, ""))) {echo "SELECTED";} ?>>14</option>
          <option value="15" <?php if (!(strcmp(15, ""))) {echo "SELECTED";} ?>>15</option>
          <option value="16" <?php if (!(strcmp(16, ""))) {echo "SELECTED";} ?>>16</option>
          <option value="17" <?php if (!(strcmp(17, ""))) {echo "SELECTED";} ?>>17</option>
          <option value="18" <?php if (!(strcmp(18, ""))) {echo "SELECTED";} ?>>18</option>
          <option value="19" <?php if (!(strcmp(19, ""))) {echo "SELECTED";} ?>>19</option>
          <option value="20" <?php if (!(strcmp(20, ""))) {echo "SELECTED";} ?>>20</option>
          <option value="21" <?php if (!(strcmp(21, ""))) {echo "SELECTED";} ?>>21</option>
          <option value="22" <?php if (!(strcmp(22, ""))) {echo "SELECTED";} ?>>22</option>
          <option value="23" <?php if (!(strcmp(23, ""))) {echo "SELECTED";} ?>>23</option>
          <option value="24" <?php if (!(strcmp(24, ""))) {echo "SELECTED";} ?>>24</option>
          <option value="25" <?php if (!(strcmp(25, ""))) {echo "SELECTED";} ?>>25</option>
          <option value="26" <?php if (!(strcmp(26, ""))) {echo "SELECTED";} ?>>26</option>
          <option value="27" <?php if (!(strcmp(27, ""))) {echo "SELECTED";} ?>>27</option>
          <option value="28" <?php if (!(strcmp(28, ""))) {echo "SELECTED";} ?>>28</option>
          <option value="29" <?php if (!(strcmp(29, ""))) {echo "SELECTED";} ?>>29</option>
          <option value="30" <?php if (!(strcmp(30, ""))) {echo "SELECTED";} ?>>30</option>
          <option value="31" <?php if (!(strcmp(31, ""))) {echo "SELECTED";} ?>>31</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Mes:</td>
          <td><select name="Mes">
            <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Seleccionar...</option>
            <option value="Enero" <?php if (!(strcmp("Enero", ""))) {echo "SELECTED";} ?>>Enero</option>
            <option value="Febrero " <?php if (!(strcmp("Febrero ", ""))) {echo "SELECTED";} ?>>Febrero </option>
          <option value="Marzo" <?php if (!(strcmp("Marzo", ""))) {echo "SELECTED";} ?>>Marzo</option>
          <option value="Abril" <?php if (!(strcmp("Abril", ""))) {echo "SELECTED";} ?>>Abril</option>
          <option value="Mayo" <?php if (!(strcmp("Mayo", ""))) {echo "SELECTED";} ?>>Mayo</option>
          <option value="Junio" <?php if (!(strcmp("Junio", ""))) {echo "SELECTED";} ?>>Junio</option>
          <option value="Julio" <?php if (!(strcmp("Julio", ""))) {echo "SELECTED";} ?>>Julio</option>
          <option value="Agosto" <?php if (!(strcmp("Agosto", ""))) {echo "SELECTED";} ?>>Agosto</option>
          <option value="Septiembre" <?php if (!(strcmp("Septiembre", ""))) {echo "SELECTED";} ?>>Septiembre</option>
          <option value="Octubre" <?php if (!(strcmp("Octubre", ""))) {echo "SELECTED";} ?>>Octubre</option>
          <option value="Noviembre" <?php if (!(strcmp("Noviembre", ""))) {echo "SELECTED";} ?>>Noviembre</option>
          <option value="Diciembre" <?php if (!(strcmp("Diciembre", ""))) {echo "SELECTED";} ?>>Diciembre</option>
          </select></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Ano:</td>
          <td><input type="text" name="Ano" value="" size="10" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Edad:</td>
          <td><input type="text" name="Edad" value="" size="10" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Contrasena:</td>
          <td><input type="password" name="Contrasena" value="" size="32" /></td>
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
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>