<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $number_of_guests = $_POST['number_of_guests'];
    $special_request = $_POST['special_request'];

    $stmt = $conn->prepare("INSERT INTO reservations (full_name, email, phone, reservation_date, reservation_time, number_of_guests, special_request)
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssssis", $full_name, $email, $phone, $reservation_date, $reservation_time, $number_of_guests, $special_request);
        if ($stmt->execute()) {
            echo "Reservation successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Prepare failed: " . $conn->error;
    }
}
?>

<!-- Reservation Form -->
<form method="POST">
    <input type="text" name="full_name" required placeholder="Full Name">
    <input type="email" name="email" required placeholder="Email">
    <input type="text" name="phone" placeholder="Phone">
    <input type="date" name="reservation_date" required>
    <input type="time" name="reservation_time" required>
    <input type="number" name="number_of_guests" required placeholder="Guests">
    <textarea name="special_request" placeholder="Any special requests?"></textarea>
    <button type="submit">Reserve Table</button>
</form>