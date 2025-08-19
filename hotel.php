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
<title><?php echo $hotel['name']; ?></title>
<style>
    body { font-family: Arial; background: #f4f4f4; }
    .container { max-width: 800px; margin: auto; background: white; padding: 20px; border-radius: 8px; }
    img { width: 100%; border-radius: 8px; }
    a { background: #002b5c; padding: 10px 20px; color: white; border-radius: 5px; text-decoration: none; }
</style>
</head>
<body>
<div class="container">
    <img src="<?php echo $hotel['image_url']; ?>">
    <h2><?php echo $hotel['name']; ?></h2>
    <p><?php echo $hotel['description']; ?></p>
    <p>Price: $<?php echo $hotel['price']; ?> / night</p>
    <a href="booking.php?id=<?php echo $hotel['id']; ?>">Book Now</a>
</div>
</body>
</html>
