<?php
if (!isset($_SESSION)) {
  session_start();
}


$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "false";

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
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../Dashboard.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
$conn = mysqli_connect("localhost", "root", "", "assign");

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}

// เรียกข้อมูลผู้ใช้
$user_id = $_SESSION['MM_Username'];
$query_Name = "SELECT * FROM member WHERE mem_ID = '$user_id'";
$result_Name = mysqli_query($conn, $query_Name);

// ตรวจสอบผลลัพธ์
if (mysqli_num_rows($result_Name) > 0) {
    $row_Name = mysqli_fetch_assoc($result_Name);
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin</title>
</head>

<body>
<table width="1657" height="602" border="0" align="center">
   <tr>
    <td width="182" height="60"><img src="../img_web/Logo.jpg" width="216" height="219" alt="logo" longdesc="img_web/Logo.jpg" /></td>
    <td width="1465"><?php echo isset($row_Name['mem_name']) ? $row_Name['mem_name'] : 'No name available'; ?></td>
</tr>

    <tr>
      <td><table width="200" border="0" align="center">
        <tr>
          <td><a href="../Dashboard.php"><input type="submit" name="to_dashboard" id="to_dashboard" value="Dashboard" align="middle"/></a></td>
        </tr>
        <tr>
          <td><a href="../Task.php"><input type="submit" name="to_task" id="to_task" value="Task" /></a></td>
        </tr>
        <tr>
          <td><a href="../Report.php"><input type="submit" name="to_report" id="to_report" value="Report" /></a></td>
        </tr>
        <tr>
          <td><a href="../Document.php"><input type="submit" name="to_document" id="to_document" value="Document" /></a></td>
        </tr>
        <tr>
          <td><a href="../Customer.php"><input type="submit" name="to_customer" id="to_customer" value="Customer" /></a></td>
        </tr>
        <tr>
          <td><a href="../Project.php"><input type="submit" name="to_project" id="to_project" value="Project" /></a></td>
        </tr>
        <tr>
          <td height="305">&nbsp;</td>
        </tr>
        <tr>
          <td><a href="../Edit_Profile.php"><input type="submit" name="to_edit" id="to_edit" value="Edit Profile" /></a></td>
        </tr>
        <tr>
          <td><a href="../admin/dashboard_admin.php"><input type="submit" name="to_edit" id="to_edit" value="Admin" /></a></td>
        </tr>
        <tr>
          <td><a href="<?php echo $logoutAction ?>" class="logout">
            <i class='bx bxs-log-out-circle' ></i>
            <span class="text">Logout</span>
          </a></td>
        </tr>
        <tr>
          <td height="34">&nbsp;</td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</body>
</html>