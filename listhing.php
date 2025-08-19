<?php
include 'db.php';
$location = isset($_GET['location']) ? $_GET['location'] : '';
$sql = "SELECT * FROM hotels WHERE location LIKE ?";
$stmt = $conn->prepare($sql);
$searchLocation = "%".$location."%";
$stmt->bind_param("s", $searchLocation);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
<title>Available Hotels</title>
<style>
    body { font-family: Arial; background: #f4f4f4; }
    .hotel { background: white; padding: 15px; margin: 15px auto; width: 80%; border-radius: 8px; }
    img { width: 100%; border-radius: 8px; }
    a { text-decoration: none; color: white; padding: 8px 15px; background: #002b5c; border-radius: 5px; }
</style>
</head>
<body>
<h2 style="text-align:center;">Hotels in "<?php echo htmlspecialchars($location); ?>"</h2>
<?php while($hotel = $result->fetch_assoc()): ?>
<div class="hotel">
    <img src="<?php echo $hotel['image_url']; ?>" alt="Hotel Image">
    <h3><?php echo $hotel['name']; ?></h3>
    <p><?php echo $hotel['description']; ?></p>
    <p>Price: $<?php echo $hotel['price']; ?> / night</p>
    <a href="hotel.php?id=<?php echo $hotel['id']; ?>">View Details</a>
</div>
<?php endwhile; ?>
</body>
</html>
