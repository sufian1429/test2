<!DOCTYPE html>
<html>
<head>
    <title>API Test Cases</title>
</head>
<body>
    <h1>API Test Cases</h1>
    
    <?php
// ตั้งค่าส่วนหัวให้สามารถเรียกใช้งานได้จากที่ไหนก็ได้
header('Access-Control-Allow-Origin: *');

// เชื่อมต่อฐานข้อมูล (ตั้งค่าตามที่คุณใช้)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "assign";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "User added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
// Test Case 1: ดึงข้อมูลทั้งหมด
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '\assign_job\api') {
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    
    $users = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    
    echo json_encode($users);
    exit;
}

// Test Case 2: ดึงข้อมูลตามรหัสผู้ใช้
if ($_SERVER['REQUEST_METHOD'] === 'GET' && preg_match('/\/assign_job\/api\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $userId = $matches[1];
    
    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo json_encode($user);
    } else {
        echo json_encode(array('message' => 'User not found.'));
    }
    
    exit;
}

// Test Case 3: เพิ่มข้อมูลใหม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/assign_job/api') {
    // รับข้อมูลที่ส่งมาจาก Postman
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $email = $data['email'];
    
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'User added successfully.'));
    } else {
        echo json_encode(array('message' => 'Error: ' . $conn->error));
    }
    
    exit;
}

// Test Case 4: อัปเดตข้อมูล
if ($_SERVER['REQUEST_METHOD'] === 'PUT' && preg_match('/\/assign_job\/api\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $userId = $matches[1];
    
    // รับข้อมูลที่ส่งมาจาก Postman
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data['name'];
    $email = $data['email'];
    
    $sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = $userId";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'User updated successfully.'));
    } else {
        echo json_encode(array('message' => 'Error: ' . $conn->error));
    }
    
    exit;
}

// Test Case 5: ลบข้อมูล
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && preg_match('/\/assign_job\/api\/(\d+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $userId = $matches[1];
    
    $sql = "DELETE FROM users WHERE id = $userId";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('message' => 'User deleted successfully.'));
    } else {
        echo json_encode(array('message' => 'Error: ' . $conn->error));
    }
    
    exit;
}

// ถ้าไม่พบเส้นทาง URL ที่ถูกกำหนด
http_response_code(404);
echo json_encode(array('message' => 'Invalid endpoint.'));

$conn->close();
?>




    
</body>
</html>
