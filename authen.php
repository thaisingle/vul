<?php
// ตรวจสอบว่ามีการส่งข้อมูลด้วย HTTP POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูล JSON ที่ส่งมา
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // ตรวจสอบว่าข้อมูลมีครบถ้วนและถูกต้อง
    if (isset($data['variables']['input']['idCardNumber'], $data['variables']['input']['phoneNumber'])) {
        // ดึงค่า idCardNumber และ phoneNumber
        $idCardNumber = $data['variables']['input']['idCardNumber'];
        $phoneNumber = $data['variables']['input']['phoneNumber'];

        // ตอบกลับข้อความยืนยัน
        echo "Received idCardNumber: " . $idCardNumber . "\n";
        echo "Received phoneNumber: " . $phoneNumber . "\n";
        echo "บันทึกเรียบร้อย";
    } else {
        // ถ้าข้อมูลไม่ครบหรือไม่ถูกต้อง
        http_response_code(400); // Bad request
        echo "ข้อมูลไม่ครบหรือไม่ถูกต้อง";
    }
} else {
    // ถ้าไม่ใช่ HTTP POST method
    http_response_code(405); // Method Not Allowed
    echo "Method Not Allowed";
}
?>