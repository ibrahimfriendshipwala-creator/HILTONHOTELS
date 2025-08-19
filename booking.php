<?php
include 'db.php';
if (!isset($_GET['id'])) { die("Invalid request"); }
$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM hotels WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$hotel = $stmt->get_result()->fetch_assoc();
if (!$hotel) { die("Hotel not found"); }
?>
<!DOCTYPE html>
<html>
<head>
<title>Book <?php echo $hotel['name']; ?></title>
<style>
    body { font-family: Arial; background: #f4f4f4; }
    .form-box { max-width: 500px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
    input, button { width: 100%; padding: 10px; margin-top: 10px; }
    button { background: #002b5c; color: white; border: none; cursor: pointer; }
</style>
</head>
<body>
<div class="form-box">
    <h2>Book <?php echo $hotel['name']; ?></h2>
    <form action="book_room.php" method="POST">
        <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
        <input type="text" name="customer_name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="date" name="checkin_date" required>
        <input type="date" name="checkout_date" required>
        <button type="submit">Confirm Booking</button>
    </form>
</div>
</body>
</html>
