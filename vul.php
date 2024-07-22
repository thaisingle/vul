<?php
// Example of PHP code with multiple security vulnerabilities based on OWASP Top 10 2021 and beyond

// A01:2021-Broken Access Control
if (isset($_GET['admin_action'])) {
    echo "Performing admin actions without proper access control!";
}

// A02:2021-Cryptographic Failures
$userPassword = "password123";
$hashedPassword = md5($userPassword);
echo "MD5 Hashed Password: " . $hashedPassword . "<br>";

// A03:2021-Injection
$userId = $_GET['user_id'] ?? '1'; 
$query = "SELECT * FROM users WHERE id = $userId"; 

// A04:2021-Insecure Design
if (isset($_GET['login'])) {
    echo "Login attempts not rate limited!";
}

// A05:2021-Security Misconfiguration
ini_set('display_errors', 1);
error_reporting(E_ALL);

// A06:2021-Vulnerable and Outdated Components
echo "PHP Version: " . phpversion() . "<br>";

// A07:2021-Identification and Authentication Failures
if ($_POST['username'] === 'admin') {
    echo "Authenticated as admin without checking password!";
}

// A08:2021-Software and Data Integrity Failures
include 'external_script.php';

// A09:2021-Security Logging and Monitoring Failures
if (isset($_POST['login'])) {
    echo "User login processed without logging!";
}

// A10:2021-Server-Side Request Forgery (SSRF)
if (isset($_GET['image_url'])) {
    $imageUrl = $_GET['image_url'];
    echo file_get_contents($imageUrl);
}

// Additional vulnerabilities
// SQL Injection
if (isset($_GET['search'])) {
    $userInput = $_GET['search'];
    $sql = "SELECT * FROM articles WHERE title = '$userInput'";
}

// XXE
libxml_disable_entity_loader(false);
$xmlfile = file_get_contents('php://input');
$dom = new DOMDocument();
$dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
$creds = simplexml_import_dom($dom);

// LDAP Injection
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $ldap_query = "(uid=$username)";
}

// Cross-Site Scripting (XSS)
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<div>$message</div>";
}

// Local File Inclusion
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    include($file);
}

// Remote File Inclusion
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    include($url);
}

// Hard-coded Password
$dbPassword = "secretPassword";
$connection = new PDO("mysql:host=localhost;dbname=test", "admin", $dbPassword);

// HTTP Response Splitting
if (isset($_GET['redirect'])) {
    header("Location: " . $_GET['redirect']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vulnerable PHP App</title>
</head>
<body>
    <h1>Test OWASP Top 10 Vulnerabilities and More</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Enter username">
        <button type="submit" name="login">Login</button>
    </form>
    <form method="get">
        <input type="text" name="user_id" placeholder="Enter user ID for SQL Injection">
        <button type="submit">Submit</button>
    </form>
    <form method="get">
        <input type="text" name="image_url" placeholder="Enter image URL for SSRF">
        <button type="submit">Fetch Image</button>
    </form>
    <form method="get">
        <input type="text" name="search" placeholder="Search for articles (SQLi)">
        <button type="submit">Search</button>
    </form>
    <form method="get">
        <input type="text" name="message" placeholder="Display a message (XSS)">
        <button type="submit">Display</button>
    </form>
    <form method="get">
        <input type="text" name="file" placeholder="Include a file (LFI)">
        <button type="submit">Include</button>
    </form>
    <form method="get">
        <input type="text" name="url" placeholder="Include a remote file (RFI)">
        <button type="submit">Include</button>
    </form>
    <form method="get">
        <input type="text" name="redirect" placeholder="Test HTTP response splitting">
        <button type="submit">Redirect</button>
    </form>
</body>
</html>
