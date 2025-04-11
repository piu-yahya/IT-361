<?php
include 'db.php';
$id = $_GET['id'] ?? 0;

$query = "SELECT * FROM bookings WHERE id = $id";
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
  die("Booking not found.");
}
$booking = mysqli_fetch_assoc($result);
$movie_query = mysqli_query($conn, "SELECT title, image, genre FROM movies WHERE id = " . $booking['movie_id']);
$movie = mysqli_fetch_assoc($movie_query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $seats = (int)$_POST['seats'];
  $seat_type = mysqli_real_escape_string($conn, $_POST['seat_type']);

  $price_per_seat = $seat_type === 'VIP' ? 100 : ($seat_type === 'Premium' ? 75 : 50);
  $price = $price_per_seat * $seats;

  $sql = "UPDATE bookings SET name='$name', email='$email', seats=$seats, seat_type='$seat_type', price=$price WHERE id=$id";
  if (mysqli_query($conn, $sql)) {
    header("Location: view_bookings.php");
    exit;
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Booking</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right, #2c3e50, #4ca1af);
      color: #fff;
    }
    .container {
      display: flex;
      max-width: 1000px;
      margin: 60px auto;
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .left {
      flex: 1;
      background: #222;
      padding: 30px;
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .left img {
      max-width: 100%;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .left h2 {
      margin: 10px 0 5px;
    }
    .left p {
      color: #aaa;
      margin-bottom: 0;
    }
    .right {
      flex: 1;
      padding: 40px;
      background: #f9f9f9;
      color: #333;
    }
    h1 {
      margin-bottom: 20px;
      text-align: center;
    }
    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    label {
      font-weight: 500;
    }
    input, select {
      padding: 10px;
      font-size: 1rem;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    #priceDisplay {
      font-weight: bold;
      color: #16a085;
      font-size: 1.2rem;
      text-align: center;
    }
    button {
      background: #3498db;
      color: white;
      padding: 12px;
      font-size: 1rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    button:hover {
      background: #2980b9;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left">
      <img src="images/<?= htmlspecialchars($movie['image']) ?>" alt="Movie Poster">
      <h2><?= htmlspecialchars($movie['title']) ?></h2>
      <p><?= htmlspecialchars($movie['genre']) ?></p>
    </div>
    <div class="right">
      <h1>Edit Booking</h1>
      <form method="POST">
        <label>Customer Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($booking['name']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($booking['email']) ?>" required>

        <label>Number of Seats</label>
        <input type="number" name="seats" value="<?= $booking['seats'] ?>" min="1" required>

        <label>Seat Type</label>
        
        <select name="seat_type" required>
          <option value="Standard" <?= $booking['seat_type'] === 'Standard' ? 'selected' : '' ?>>💺 Standard - $50</option>
          <option value="Premium" <?= $booking['seat_type'] === 'Premium' ? 'selected' : '' ?>>✨💺 Premium - $75</option>
          <option value="VIP" <?= $booking['seat_type'] === 'VIP' ? 'selected' : '' ?>>👑💺 VIP - $100</option>
        </select>


        <p id="priceDisplay">Total Price: $0</p>

        <button type="submit">💾 Save Changes</button>
      </form>
    </div>
  </div>

  <script>
    function calculatePrice() {
      const seatType = document.querySelector('[name="seat_type"]').value;
      const seats = parseInt(document.querySelector('[name="seats"]').value) || 0;
      let price = 50;
      if (seatType === 'Premium') price = 75;
      if (seatType === 'VIP') price = 100;
      const total = seats * price;
      document.getElementById('priceDisplay').textContent = "Total Price: $" + total;
    }

    document.querySelector('[name="seat_type"]').addEventListener('change', calculatePrice);
    document.querySelector('[name="seats"]').addEventListener('input', calculatePrice);
    window.onload = calculatePrice;
  </script>
</body>
</html>
