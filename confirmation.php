<?php
include 'db.php';
if (!isset($_GET['id'])) { die("Invalid request"); }
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT b.*, h.name AS hotel_name FROM bookings b JOIN hotels h ON b.hotel_id=h.id WHERE b.id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();
if (!$booking) { die("Booking not found"); }
?>
<!DOCTYPE html>
<html>
<head>
<title>Booking Confirmation</title>
<style>
    body { font-family: Arial; background: #f4f4f4; text-align: center; }
    .box { background: white; display: inline-block; padding: 20px; margin-top: 50px; border-radius: 8px; }
</style>
</head>
<body>
<div class="box">
    <h2>Booking Confirmed!</h2>
    <p>Hotel: <?php echo $booking['hotel_name']; ?></p>
    <p>Name: <?php echo $booking['customer_name']; ?></p>
    <p>Check-in: <?php echo $booking['checkin_date']; ?></p>
    <p>Check-out: <?php echo $booking['checkout_date']; ?></p>
    <p>We have sent confirmation to <?php echo $booking['email']; ?></p>
</div>
</body>
</html>
