<?php
$host = "localhost:8889"; // 8888 = frontend, 8889 = DB/MySQL
$db = "book_tracker";
$user = "root";
$password = "root";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8;connect_timeout=3",
        $user,
        $password,
    );
} catch (PDOException $error) {
    die("👎 Connection failed: " . $error->getMessage());
}
