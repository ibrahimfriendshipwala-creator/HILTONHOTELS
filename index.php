<?php
// index.php
include 'db.php';

// Fetch 4 featured hotels from DB
$featuredHotels = $conn->query("SELECT id, name, city, price_per_night, image_url FROM hotels LIMIT 4");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Hilton Hotels Clone</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0; padding: 0;
        background-color: #f4f4f4;
    }
    header {
        background: #002b5c;
        color: #fff;
        padding: 20px;
        text-align: center;
    }
    header h1 { margin: 0; font-size: 28px; }
    .search-bar {
        background: #fff;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .search-bar input, .search-bar button {
        padding: 10px;
        margin: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }
    .search-bar button {
        background: #002b5c;
        color: #fff;
        cursor: pointer;
        transition: 0.3s;
    }
    .search-bar button:hover { background: #004b8d; }
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }
    .hotel-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin: 15px;
        display: inline-block;
        width: calc(25% - 30px);
        vertical-align: top;
        transition: transform 0.3s;
    }
    .hotel-card:hover { transform: translateY(-5px); }
    .hotel-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    .hotel-card .details {
        padding: 15px;
    }
    .hotel-card h3 { margin: 0; font-size: 18px; }
    .hotel-card p { margin: 5px 0; color: #555; }
    @media(max-width: 768px) {
        .hotel-card { width: calc(50% - 30px); }
    }
    @media(max-width: 500px) {
        .hotel-card { width: 100%; }
    }
</style>
</head>
<body>

<header>
    <h1>Hilton Hotels</h1>
    <p>Luxury stays around the world</p>
</header>

<div class="search-bar">
    <input type="text" id="destination" placeholder="Enter destination">
    <input type="date" id="checkin">
    <input type="date" id="checkout">
    <button onclick="searchHotels()">Search</button>
</div>

<div class="container">
    <h2>Featured Hotels</h2>
    <?php while($hotel = $featuredHotels->fetch_assoc()): ?>
        <div class="hotel-card">
            <img src="<?php echo htmlspecialchars($hotel['image_url']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>">
            <div class="details">
                <h3><?php echo htmlspecialchars($hotel['name']); ?></h3>
                <p><?php echo htmlspecialchars($hotel['city']); ?></p>
                <p><strong>$<?php echo htmlspecialchars($hotel['price_per_night']); ?></strong> / night</p>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<script>
function searchHotels() {
    let dest = document.getElementById('destination').value;
    let checkin = document.getElementById('checkin').value;
    let checkout = document.getElementById('checkout').value;

    if(dest.trim() === "" || checkin === "" || checkout === "") {
        alert("Please fill in all fields.");
        return;
    }

    // Redirect with JavaScript
    window.location.href = "listhing.php?destination=" + encodeURIComponent(dest) + "&checkin=" + checkin + "&checkout=" + checkout;
}
</script>

</body>
</html>
