<?php
$database = new SQLite3('myDatabase.db');

// สร้างตาราง users ถ้ายังไม่มีอยู่
$database->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
)");


// ข้อมูลผู้ใช้
$users = array(
    array('id' => 1, 'username' => 'admin', 'password' => 'p@ssw0rd'),
    array('id' => 2, 'username' => 'somsak', 'password' => 'p@ssw0rd1234')
);

// นำเข้าข้อมูลผู้ใช้เข้าไปในฐานข้อมูล
foreach ($users as $user) {
    $stmt = $database->prepare("INSERT INTO users (id, username, password) VALUES (:id, :username, :password)");
    $stmt->bindValue(':id', $user['id'], SQLITE3_INTEGER);
    $stmt->bindValue(':username', $user['username'], SQLITE3_TEXT);
    $stmt->bindValue(':password', $user['password'], SQLITE3_TEXT);
    $result = $stmt->execute();
}

if ($result) {
    echo "ข้อมูลผู้ใช้ถูกเพิ่มเรียบร้อยแล้ว";
} else {
    echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูลผู้ใช้: " . $database->lastErrorMsg();
}

// ปิดการเชื่อมต่อ
$database->close();
?>