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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Codigo'])) {
  $loginUsername=$_POST['Codigo'];
  $password=($_POST['Contrasena']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "indezu.php";
  $MM_redirectLoginFailed = "acsesou2.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_proyecto, $proyecto);
  
  /*password=md5 ($contrasena);*/
  
  
  $LoginRS__query=sprintf("SELECT Codigo, Contrasena FROM usuarios WHERE Codigo=%s AND Contrasena=PASSWORD(%s)",
    GetSQLValueString($loginUsername, "double"), GetSQLValueString($password, "text")); 
  $LoginRS = mysql_query($LoginRS__query, $proyecto) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Acseso de Usuarios</title>

<style type="text/css">
body,td,th {
	font-family: "Comic Sans MS", cursive;
	color: #000;
}
a:link {
	color: #000;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000;
}
a:hover {
	text-decoration: underline;
	color: #000;
}
a:active {
	text-decoration: none;
	color: #000;
}
</style>
</head>

<body background="../img/Fondo_8.gif">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center"><img src="../img/bienvenido.png" width="640" height="112" /></p>
<table width="756" align="center" background="Fondo_8.gif">
  <tr>
	<td width="436" height="413"><p align="center"><img src="../img/biblioteca.jpg" width="378" height="279" /></p></td>
    <td width="308"><p><img src="../img/usuario1.png"/></p>
      <p>&nbsp;</p>
      <p>&nbsp; </p>
      <form ACTION="<?php echo $loginFormAction; ?>" method="POST" name="form1" id="form1">
        <table align="center">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Usuario:</td>
            <td><input type="text" name="Codigo" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Contraseña:</td>
            <td><input type="password" name="Contrasena" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><p>&nbsp;
              </p>
              <p align="center">
                <input type="submit" name="Iniciar" id="Iniciar" value="Enviar" />
            </p></td>
          </tr>
        </table>
      </form>
      <p align="center"><font face="Lucida Sans Unicode, Lucida Grande, sans-serif" size="3" color="#0000FF">Si aun no te has registrado</font>    </p>
      <p align="center"><font face="Lucida Sans Unicode, Lucida Grande, sans-serif" color="#000000"><b><a href="registro.php">REGISTRATE...</a></b></font></p>    </td>
</tr>
<tr>
<td>
<span name = "mensaje">
</span>
</td>
</tr>
</table>
<p align="center">&nbsp;</p>

</body>
</html>