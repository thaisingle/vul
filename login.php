<?php
// กำหนด token ที่ถูกต้อง
$valid_token = '86f995837101e3ec21afe6deb12362d2f3d29760ad638e3cb36509fea4c70d73';

// กำหนด username และ password ที่ถูกต้องสำหรับตัวอย่าง (ควรใช้ฐานข้อมูลในการใช้งานจริง)
$valid_username = 'admin';
$valid_password = 'p@ssw0rd';

// ตรวจสอบว่ามี token ถูกส่งมาใน header ภายใต้ชื่อ 'Authorization' หรือไม่
if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
    // รับค่า token จาก header
    $token = $_SERVER['HTTP_AUTHORIZATION'];

    // ตรวจสอบความถูกต้องของ token
    if ($token === $valid_token) {
        // ตรวจสอบว่ามีการส่งค่า username และ password มาผ่าน URL หรือไม่
        if (isset($_GET['username']) && isset($_GET['password'])) {
            $username = $_GET['username'];
            $password = $_GET['password'];

            // ตรวจสอบความถูกต้องของ username และ password
            if ($username === $valid_username && $password === $valid_password) {
                // ส่งค่ากลับไปเป็น JSON
                echo json_encode(array('status' => 'success'));
            } else {
                // ถ้า username หรือ password ไม่ถูกต้อง
                if ($username !== $valid_username) {
                    echo json_encode(array('status' => 'error', 'message' => 'Invalid username'));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Invalid password'));
                }
            }
        } else {
            // ถ้าไม่มี username หรือ password ส่งค่า error กลับไป
            echo json_encode(array('status' => 'error', 'message' => 'Missing username or password'));
        }
    } else {
        // ถ้า token ไม่ถูกต้อง
        echo json_encode(array('status' => 'error', 'message' => 'Invalid token'));
    }
} else {
    // ถ้าไม่มี token ส่งค่า error กลับไป
    echo json_encode(array('status' => 'error', 'message' => 'No permission'));
}
?>