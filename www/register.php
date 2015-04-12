<?php require_once('Connections/db_conn.php');
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
 mysql_select_db($database_db_conn, $db_conn);
  $query_user = sprintf("SELECT email FROM account WHERE email ='".$_POST['email']."'");
  $user = mysql_query($query_user, $db_conn) or die(mysql_error());
  $row_user = mysql_fetch_assoc($user);
  $totalRows_user = mysql_num_rows($user);
  
  if($totalRows_user > 0){
  echo "<div class='error'>Este email ya está registrado. Por favor Ingrese otro email.</div>";
  }else{
if ((isset($_POST["MM_Insert"])) && ($_POST["MM_Insert"] == "register-form")) {

  $insertSQL = sprintf("INSERT INTO account (name, last, email, password, bibleversion) VALUES (%s,%s,%s,%s,%s)",
                       GetSQLValueString($_POST['fname'], "text"),
					   GetSQLValueString($_POST['lname'], "text"),
					   GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString(sha1($_POST['pass']), "text"),
					   GetSQLValueString($_POST['bible-version-select'],"text"));

  mysql_select_db($database_db_conn, $db_conn);
  $Result1 = mysql_query($insertSQL, $db_conn) or die(mysql_error());

$insertGoTo = "<div class='success'>Bienvenido(a)</div><script type='text/javascript'>window.location.href = 'index.html#page';localStorage.setItem('username','".$loginUsername."');initData('".$loginUsername."');</script>";
echo $insertGoTo;
  }
  }
?>