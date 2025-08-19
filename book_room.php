<?php
include 'db.php';
if (!isset($_POST['hotel_id'])) { die("Invalid request"); }

$hotel_id = intval($_POST['hotel_id']);
$name = $_POST['customer_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$checkin = $_POST['checkin_date'];
$checkout = $_POST['checkout_date'];

$stmt = $conn->prepare("INSERT INTO bookings (hotel_id, customer_name, email, phone, checkin_date, checkout_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $hotel_id, $name, $email, $phone, $checkin, $checkout);
$stmt->execute();

header("Location: confirmation.php?id=" . $stmt->insert_id);
exit;
