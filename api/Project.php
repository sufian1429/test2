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
  <title>Project</title>
  <link rel="stylesheet" type="text/css" href="./CSS/dashboard.css">
  <script src="./JS/index.js"></script>
  <link rel="stylesheet" type="text/css" href="./CSS/button/button.css">
<script src="./JS/button.js"></script>
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
      <li >
        <a href="Customer.php">
          <i class='bx bxs-user-rectangle' ></i>
          <span class="text">Customer</span>
        </a>
      </li>
      <li class="active">
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
            <form method="post" action="Project.php" enctype="multipart/form-data">
    <h2>Add Project</h2>

    <div class="input_box">
        <input name="pro_name" type="text" placeholder="งาน" required />
        <i class="uil uil-work"></i>
    </div>

    <div class="input_box">
        <input name="pro_type" type="text" placeholder="รายละเอียด" required />
        <i class="uil uil-info-circle"></i>
    </div>

    <div class="input_box">
        <select name="pro_customer" required>
            <?php
            
            // แสดงรายการลูกค้าใน list menu
            $sql = "SELECT cus_ID, cus_name FROM customer";
            $result = $assign->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['cus_ID'] . "'>" . $row['cus_name'] . "</option>";
                }
            } else {
                echo "<option value=''>ไม่พบลูกค้า</option>";
            }

           
            ?>
        </select>
        <i class="uil uil-user"></i>
    </div>

    <div class="input_box">
        <input name="pro_path" type="file" required />
        <i class="uil uil-file-upload"></i>
    </div>

    <button class="button" type="submit">Add Project</button>
</form>
            </div>
        </div>
    </section>
    <!-- MAIN -->
    <main>
      <div class="head-title">
        <div class="left">
          <h1>Project</h1>
          <ul class="breadcrumb">
            <li>
              <a href="#">Dashboard</a>
            </li>
            <li><i class='bx bx-chevron-right' ></i></li>
            <li>
              <a class="active" href="#">Project</a>
            </li>
          </ul>
          
        </div>
        <?php echo $row_profile['mem_name']; ?>
        <button class="button" id="form-open" onclick="openForm()">
        <a  class="btn-download">
          <i class='bx bxs-book-add' ></i>
          <span class="text">Add Project</span>
        </a></button>
      </div>
      
      <div class="table-data">
        <div class="order">
          <div class="head">
            
            <i class='bx bx-search' ></i>
            <i class='bx bx-filter' ></i>
          </div>
          <table>
    <thead>
        <tr>
            <th>งาน</th>
            <th>รายละเอียด</th>
            <th>ลูกค้า</th>
            <th>ไฟล์งาน</th>
        </tr>
    </thead>
    <tbody>
        <?php
       
        // เพิ่มเอกสารใหม่เมื่อส่งแบบฟอร์ม
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pro_name = $_POST['pro_name'];
            $pro_type = $_POST['pro_type'];
            $pro_customer = $_POST['pro_customer'];

            // อัปโหลดไฟล์งาน
            $target_dir = "file/";
            $target_file = $target_dir . basename($_FILES["pro_path"]["name"]);
            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // ตรวจสอบว่าไฟล์เป็นรูปภาพหรือไม่
            if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
                echo "อัปโหลดไฟล์เฉพาะ PDF, DOC หรือ DOCX เท่านั้นที่อนุญาตให้อัปโหลด";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "อัปโหลดไฟล์ไม่สำเร็จ";
            } else {
                if (move_uploaded_file($_FILES["pro_path"]["tmp_name"], $target_file)) {
                    // บันทึกข้อมูลลงในฐานข้อมูล
                    $sql = "INSERT INTO project (pro_name, pro_type, pro_path, pro_customer) VALUES ('$pro_name', '$pro_type', '$target_file', '$pro_customer')";
                    if ($assign->query($sql) === TRUE) {
                        echo "เพิ่มเอกสารเรียบร้อยแล้ว";
                    } else {
                        echo "การบันทึกข้อมูลล้มเหลว: " . $assign->error;
                    }
                } else {
                    echo "พบข้อผิดพลาดในการอัปโหลดไฟล์";
                }
            }
        }

        // แสดงรายการเอกสารทั้งหมดจากฐานข้อมูล
        $sql = "SELECT project.pro_name, project.pro_type, customer.cus_name, project.pro_path FROM project JOIN customer ON project.pro_customer = customer.cus_ID";
        $result = $assign->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['pro_name'] . "</td>";
                echo "<td>" . $row['pro_type'] . "</td>";
                echo "<td>" . $row['cus_name'] . "</td>";
                echo "<td><a href='" . $row['pro_path'] . "'>ดาวน์โหลด</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>ไม่พบเอกสาร</td></tr>";
        }

        
        ?>
    </tbody>
</table>




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
