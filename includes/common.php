<?php
include '../Connections/powermigrate.php';
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6)
  {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType)
  {
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


// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

/**
 * Generate a random password
 *
 * @param string $size Size of geenrated password
 * @param boolean $with_numbers Option to use numbers
 * @param boolean $with_tiny_letters Option to use tiny letters
 * @param boolean $with_capital_letters Option to use capital letters
 * @access public
 */
function password_generator($size = 6, $with_numbers = true, $with_tiny_letters = true, $with_capital_letters = true) {
    global $pass_g;

    $pass_g = '';
    $sizeof_lchar = 0;
    $letter = '';
    $letter_tiny = 'abcdefghijklmnopqrstuvwxyz';
    $letter_capital = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $letter_number = '0123456789';

    if ($with_tiny_letters == true) {
        $sizeof_lchar += 26;

        if (isset($letter)) {
            $letter .= $letter_tiny;
        } else {
            $letter = $letter_tiny;
        }
    }

    if ($with_capital_letters == true) {
        $sizeof_lchar += 26;

        if (isset($letter)) {
            $letter .= $letter_capital;
        } else {
            $letter = $letter_capital;
        }
    }

    if ($with_numbers == true) {
        $sizeof_lchar += 10;

        if (isset($letter)) {
            $letter .= $letter_number;
        } else {
            $letter = $letter_number;
        }
    }

    if ($sizeof_lchar > 0) {
        srand((double)microtime() * date("YmdGis"));

        for ($cnt = 0; $cnt < $size; $cnt++) {
            $char_select = rand(0, $sizeof_lchar - 1);
            $pass_g .= $letter[$char_select];
        }
    }

    return($pass_g);
}



?>