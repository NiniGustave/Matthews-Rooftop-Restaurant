<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO announcements (message) VALUES (?)");
    if ($stmt) {
        $stmt->bind_param("s", $message);
        if ($stmt->execute()) {
            echo "Announcement posted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Prepare failed: " . $conn->error;
    }
}
?>

<!-- Form -->
<form method="POST">
    <textarea name="message" placeholder="Write your announcement..." required></textarea>
    <button type="submit">Post Announcement</button>
</form>