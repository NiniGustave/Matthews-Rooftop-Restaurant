<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $reviewer_name = $_POST['reviewer_name'];
    $dish_name = $_POST['dish_name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare("INSERT INTO reviews (reviewer_name, dish_name, rating, comment)
                            VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssis", $reviewer_name, $dish_name, $rating, $comment);
        if ($stmt->execute()) {
            echo "Review submitted!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Prepare failed: " . $conn->error;
    }
}
?>

<!-- Review Form -->
<form method="POST">
    <input type="text" name="reviewer_name" placeholder="Your Name" required>
    <input type="text" name="dish_name" placeholder="Dish Name" required>
    <input type="number" name="rating" min="1" max="5" required>
    <textarea name="comment" placeholder="Your review..."></textarea>
    <button type="submit">Submit Review</button>
</form>