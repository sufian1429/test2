<?php
require_once('Connections/assign.php');
session_start();


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

// Validate request to login to this site.
if (!isset($_SESSION)) {
    session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
    $loginUsername = $_POST['Username'];
    $password = $_POST['Password'];
    $MM_fldUserAuthorization = "mem_level";
    $MM_redirectLoginSuccess = "admin/dashboard_admin.php";
    $MM_redirectLoginFailed = "Index.php";
    $MM_redirecttoReferrer = true;

    $assign = mysqli_connect("localhost", "root", "", "assign");
    $query = "SELECT * FROM assign";
    $result = mysqli_query($assign, $query);

    $LoginRS__query = sprintf("SELECT mem_ID, mem_password, mem_level FROM member WHERE mem_ID=%s AND mem_password=%s",
        GetSQLValueString($assign, $loginUsername, "int"), GetSQLValueString($assign, $password, "text"));

    $LoginRS = mysqli_query($assign, $LoginRS__query);
    $loginFoundUser = mysqli_num_rows($LoginRS);

    if ($loginFoundUser) {
        $loginStrGroup = mysqli_fetch_assoc($LoginRS)['mem_level'];

        if (PHP_VERSION >= 5.1) {
            session_regenerate_id(true);
        } else {
            session_regenerate_id();
        }
        // Declare two session variables and assign them
        $_SESSION['MM_Username'] = $loginUsername;
        $_SESSION['MM_UserGroup'] = $loginStrGroup;

        if (isset($_SESSION['PrevUrl']) && $MM_redirecttoReferrer) {
            $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];
        }
        
        header("Location: " . $MM_redirectLoginSuccess);
        exit;
    } else {
        header("Location: " . $MM_redirectLoginFailed);
        exit;
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	
<!--===============================================================================================-->	
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

    <title>Login</title>
    <!-- Add your CSS styles and other meta tags here -->
    <link rel="stylesheet" type="text/css" href="./CSS/index.css">
    <script src="./JS/button.js"></script>

</head>

<body>
    <header class="header">
        <nav class="nav">
            <div>
                <img src="./img_web/logo.png" alt="" width="50px" height="50px" />
                <router-link to="/" class="nav_logo">SIT</router-link>
            </div>

            <button class="button" id="form-open" onclick="openForm()">Login</button>
        </nav>
    </header>

    <section class="home">
        <div class="form_container">
            <i class="uil uil-times form_close" onclick="closeForm()"></i>

            <div class="form">
                <!-- <form method="post" action="<?php echo $loginFormAction; ?>">
                    <h2>Login</h2>


                    <div class="input_box">
                        <input name="Username" type="text" placeholder="Enter your ID" required />
                        <i class="uil uil-envelope-alt email"></i>
                    </div>

                    <div class="input_box">
                        <input name="Password" type="password" placeholder="Enter your password" required />
                        <i class="uil uil-lock password"></i>
                       
                    </div>

                    

                    <button class="button" type="submit">Login Now</button>

                </form> -->
                

				<form  method="post" action="<?php echo $loginFormAction; ?>">
					<span class="login100-form-title">
						Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" name="Username" type="text" placeholder="Enter your ID" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" name="Password" type="password" placeholder="Enter your password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button  class="login100-form-btn" class="button" type="submit">
							Login
						</button>
					</div>

					

					
				</form>
		
            </div>
            
        </div>
        
        
    </section>
    

    
</body>

</html>