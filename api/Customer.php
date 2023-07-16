<?php require_once('Connections/assign.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = explode(",", $strUsers); 
    $arrGroups = explode(",", $strGroups); 
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

$MM_restrictGoTo = "index.php";
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
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($assign, $theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = $assign->real_escape_string($theValue);

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

$colname_profile = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_profile = $_SESSION['MM_Username'];
}

$query_profile = sprintf("SELECT * FROM member WHERE mem_ID = %s", GetSQLValueString($assign, $colname_profile, "int"));
$profile = $assign->query($query_profile) or die($assign->error);
$row_profile = $profile->fetch_assoc();
$totalRows_profile = $profile->num_rows;
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Customer</title>
  <link rel="stylesheet" type="text/css" href="./CSS/dashboard.css">
  <link rel="stylesheet" type="text/css" href="./CSS/button/button.css">
<script src="./JS/button.js"></script>
  <script src="./JS/index.js"></script>
  <!-- <script src="./JS/buttonMode.js"></script> -->

  
</head>

<body class="dark-mode"> 

      <div >
      <section id="sidebar">
    <a href="#" class="brand">
      <i class='bx bxs-smile'></i>
      <span class="text">SIT</span>
    </a>
    <ul class="side-menu top">
      <li >
        <a href="Dashboard.php">
          <i class='bx bxs-dashboard' ></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li >
        <a href="Task.php">
          
          <i class='bx bx-task' ></i>
          <span class="text">Task</span>
        </a>
      </li>
      
      <li >
        <a href="Report.php">
          <i class='bx bxs-report' ></i>
          <span class="text">Report</span>
        </a>
      </li>
      <li >
        <a href="Document.php">
          <i class='bx bxs-paper-plane' ></i>
          <span class="text">Document</span>
        </a>
      </li>
      <li class="active">
        <a href="Customer.php">
          <i class='bx bxs-user-rectangle' ></i>
          <span class="text">Customer</span>
        </a>
      </li>
      <li>
        <a href="Project.php">
          <i class='bx bx-paper-plane' ></i>
          <span class="text">Project</span>
        </a>
      </li>
      
    </ul>
    <ul class="side-menu">
      <li>
        <a href="Edit_Profile.php">
          <i class='bx bxs-cog' ></i>
          <span class="text">Edit Profile</span>
        </a>
      </li>
      <li>
        <a href="index.php" class="logout">
          <i class='bx bxs-log-out-circle' ></i>
          <span class="text">Logout</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- SIDEBAR -->
  
  
  
  <!-- CONTENT -->
  <section id="content">
    <!-- NAVBAR -->
    <nav>
      <i class='bx bx-menu' ></i>
      <a href="#" class="nav-link">Categories</a>
      <form action="#">
        <div class="form-input">
          <input type="search" placeholder="Search...">
          <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
        </div>
      </form>
     
      
      <a href="#" class="profile">
        <img src="./img_web/logo.png">
      </a>
    </nav>
    <!-- NAVBAR -->
    <section class="home">
        <div class="form_container">
        <i class="uil uil-times form_close" onclick="closeForm()"></i>
            <div class="form">
            <form method="post" action="Customer.php">
        <h2>Add Customer</h2>

        <div class="input_box">
            <input name="cus_name" type="text" placeholder="Enter customer name" required />
            <i class="uil uil-user"></i>
        </div>

        <div class="input_box">
            <input name="cus_type" type="text" placeholder="Enter customer details" required />
            <i class="uil uil-info-circle"></i>
        </div>

        <button class="button" type="submit">Add Customer</button>
    </form>
            </div>
        </div>
    </section>
    <!-- MAIN -->
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Customer</h1>
          <ul class="breadcrumb">
            <li>
              <a href="#">Dashboard</a>
            </li>
            <li><i class='bx bx-chevron-right' ></i></li>
            <li>
              <a class="active" href="#">Customer</a>
            </li>
          </ul>
          
        </div>
        <?php echo $row_profile['mem_name']; ?>
        <button class="button" id="form-open" onclick="openForm()">
        <a  class="btn-download">
          <i class='bx bxs-book-add' ></i>
          <span class="text">Add Customer</span>
        </a></button>
      </div>
      
      <div class="table-data">
        <div class="order">
            <div class="head">
                <!-- <h3>Customer</h3> -->
                <i class="bx bx-search"></i>
                <i class="bx bx-filter"></i>
            </div>
            <table>
    <thead>
        <tr>
            <th>ชื่อลูกค้า</th>
            <th>รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
        <?php
       

        // ตรวจสอบการส่งข้อมูลจากฟอร์ม
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // รับค่าจากฟอร์ม
            $cus_name = $_POST['cus_name'];
            $cus_type = $_POST['cus_type'];

            // เพิ่มข้อมูลลูกค้าในฐานข้อมูล
            $sql = "INSERT INTO customer (cus_name, cus_type) VALUES ('$cus_name', '$cus_type')";
            if (mysqli_query($assign, $sql)) {
                echo "<tr>";
                echo "<td><p>" . $cus_name . "</p></td>";
                echo "<td>" . $cus_type . "</td>";
                echo "</tr>";
            } else {
                echo "การเพิ่มข้อมูลลูกค้าล้มเหลว: " . mysqli_error($assign);
            }
        }

        // ดึงข้อมูลลูกค้าทั้งหมดจากฐานข้อมูล
        $query = "SELECT * FROM customer ORDER BY cus_ID DESC";
        $result = mysqli_query($assign, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><p>" . $row['cus_name'] . "</p></td>";
            echo "<td>" . $row['cus_type'] . "</td>";
            echo "</tr>";
        }

        // ปิดการเชื่อมต่อฐานข้อมูล
        mysqli_close($assign);
        ?>
    </tbody>
</table>

        </div>

        
        </div>
    </div>
    </main>
    <!-- MAIN -->
  </section>
    </div>
</body>
</html>
<?php
$profile->free_result();

?>
