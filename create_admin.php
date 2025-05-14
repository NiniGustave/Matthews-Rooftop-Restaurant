<?php
require 'db.php';

$username = 'admin'; // change as needed
$password = 'admin123'; // change as needed
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admin (username, password_hash) VALUES (?, ?)");
if ($stmt) {
    $stmt->bind_param("ss", $username, $password_hash);
    if ($stmt->execute()) {
        echo "Admin created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Prepare failed: " . $conn->error;
}
?>