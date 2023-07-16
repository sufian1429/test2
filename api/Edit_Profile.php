<?php
require_once('Connections/assign.php');

session_start();

$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
  $isValid = false;

  if (!empty($UserName)) {
    $arrUsers = explode(",", $strUsers);
    $arrGroups = explode(",", $strGroups);

    if (in_array($UserName, $arrUsers)) {
      $isValid = true;
    }

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

if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("", $MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];

  if (strpos($MM_restrictGoTo, "?")) {
    $MM_qsChar = "&";
  }

  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) {
    $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  }

  $MM_restrictGoTo = $MM_restrictGoTo . $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: " . $MM_restrictGoTo);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["MM_update"]) && $_POST["MM_update"] == "form1") {
  $updateSQL = "UPDATE member SET mem_name = ?, mem_img = ?, mem_password = ? WHERE mem_ID = ?";
  $stmt = $assign->prepare($updateSQL);
  $stmt->bind_param("sssi", $_POST['mem_name'], $_POST['mem_img'], $_POST['mem_pass'], $_POST['ID']);
  $stmt->execute();
  $stmt->close();

  $updateGoTo = "Edit_Profile.php";

  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }

  header("Location: $updateGoTo");
  exit;
}

$colname_profile = "-1";

if (isset($_SESSION['MM_Username'])) {
  $colname_profile = $_SESSION['MM_Username'];
}

$query_profile = "SELECT * FROM member WHERE mem_ID = ?";
$stmt = $assign->prepare($query_profile);
$stmt->bind_param("i", $colname_profile);
$stmt->execute();
$profile = $stmt->get_result();
$row_profile = $profile->fetch_assoc();
$totalRows_profile = $profile->num_rows;

?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Edit Profile</title>
  <link rel="stylesheet" type="text/css" href="./CSS/dashboard.css">
  
  <script src="./JS/index.js"></script>
  
</head>


<body class="dark-mode">
  <div>
    <section id="sidebar">
      <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">SIT</span>
      </a>
      <ul class="side-menu top">
        <li>
          <a href="Dashboard.php">
            <i class='bx bxs-dashboard'></i>
            <span class="text">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="Task.php">
           
            <i class='bx bx-task'></i>
            <span class="text">Task</span>
          </a>
        </li>
        <li>
          <a href="Report.php">
            <i class='bx bxs-report'></i>
            <span class="text">Report</span>
          </a>
        </li>
        <li>
          <a href="Document.php">
            <i class='bx bxs-paper-plane'></i>
            <span class="text">Document</span>
          </a>
        </li>
        <li>
          <a href="Customer.php">
            <i class='bx bxs-user-rectangle'></i>
            <span class="text">Customer</span>
          </a>
        </li>
        <li>
          <a href="Project.php">
            <i class='bx bx-paper-plane'></i>
            <span class="text">Project</span>
          </a>
        </li>

      </ul>
      <ul class="side-menu">
        <li class="active">
          <a href="edit_profile.php">
            <i class='bx bxs-cog'></i>
            <span class="text">Edit Profile</span>
          </a>
        </li>
        <li class="active">
          <a href="api.html">
            <i class='bx bxs-cog'></i>
            <span class="text">Test API</span>
          </a>
        </li>
        <li>
          <a href="index.php" class="logout">
            <i class='bx bxs-log-out-circle'></i>
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
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
          <div class="form-input">
            <input type="search" placeholder="Search...">
            <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
          </div>
        </form>


        <a href="#" class="profile">
          <img src="./img_web/logo.png">
        </a>
      </nav>
      <!-- NAVBAR -->

      <!-- MAIN -->
      <main>
        <div class="head-title">
          <div class="left">
            <h1>Edit Profile</h1>
            <ul class="breadcrumb">
              <li>
                <a href="#">Dashboard</a>
              </li>
              <li><i class='bx bx-chevron-right'></i></li>
              <li>
                <a class="active" href="#">Edit Profile</a>
              </li>
            </ul>
          </div>
          <?php echo $row_profile['mem_name']; ?>

        </div>





        <div class="table-data">
          <div class="order">
            <div class="head">
              <h3>Profile</h3>
              
            </div>
            <table>
            <form id="updateProfileForm" name="updateProfileForm" method="POST"
  action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">



                <table width="411" border="0">

                  <tr>
                    <td width="200">รูปเจ้าหน้าที่</td>
                    <td width="201">
                    <div class="col-md-4 text-center">
  <img class="js-image img-fluid rounded" style="width: 180px;height:180px;object-fit: cover;" src="<?php echo $row_profile['mem_img']; ?>">
  <div>
    <div class="mb-3">
      <label for="formFile" class="form-label">Click below to select an image</label>
      <input onchange="display_image(this.files[0])" class="js-image-input form-control" type="file" id="formFile">
    </div>
    <div><small class="js-error js-error-image text-danger"></small></div>
  </div>
</div>

                    </td>
                  </tr>




                  <td width="200">เลขประจำตัวเจ้าหน้าที่ (Username)</td>
                  <td width="201"><?php echo $row_profile['mem_ID']; ?></td>
                  </tr>
                  <tr>
                    <td>ชื่อเจ้าหน้าที่</td>
                    <td><label for="mem_name"></label>
                      <input name="mem_name" type="text" id="mem_name"
                        value="<?php echo $row_profile['mem_name']; ?>" /></td>
                  </tr>

                  <tr>
                    <td>รหัสผ่าน</td>
                    <td><label for="mem_pass"></label>
                      <input name="mem_pass" type="text" id="mem_pass"
                        value="<?php echo $row_profile['mem_password']; ?>" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="ID" type="hidden" id="mem_ID" value="<?php echo $row_profile['mem_ID']; ?>" /></td>
                  </tr>
                 
                </table>
                
                <div class="button">
                  <input type="hidden" name="MM_update" value="form1" />
                  <input type="submit" name="edit" id="edit" value="Save" />
                </div>
                <div>

                </div>
              </form>

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
<script>
var image_added = false;

function display_image(file) {
  var img = document.querySelector(".js-image");
  img.src = URL.createObjectURL(file);

  image_added = true;
}
</script>

