<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Book a Ticket</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css" />
  <script defer src="script.js"></script>
  <style>
    .movie-info {
      text-align: center;
      margin: 20px auto;
    }
    .movie-info img {
      max-width: 300px;
      border-radius: 10px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <header>
    <h1>🎟️ Book Your Ticket</h1>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="movies.php">Movies</a></li>
        <li><a href="view_bookings.php">My Bookings</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h2>Reservation Form</h2>
    <?php
    include 'db.php';
    $movie_id = $_GET['movie_id'] ?? 0;
    $movie_title = '';
    $movie_image = '';
    if ($movie_id) {
      $result = mysqli_query($conn, "SELECT title, image FROM movies WHERE id = $movie_id");
      if ($row = mysqli_fetch_assoc($result)) {
        $movie_title = $row['title'];
        $movie_image = $row['image'];
      }
    }
    ?>
    <div class="movie-info">
      <p><strong>Selected Movie:</strong> <?= htmlspecialchars($movie_title) ?></p>
      <?php if ($movie_image): ?>
        <img src="images/<?= htmlspecialchars($movie_image) ?>" alt="<?= htmlspecialchars($movie_title) ?>">
      <?php endif; ?>
    </div>

    <form id="bookingForm" action="add_booking.php" method="POST">
      <input type="hidden" name="movie_id" id="movie_id" value="<?= $movie_id ?>" />

      <label for="name">Full Name:</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" required />

      <label for="seat_type">Seat Type:</label>
      
      <select id="seat_type" name="seat_type" required>
        <option value="Standard">💺 Standard - $50</option>
        <option value="Premium">✨💺 Premium - $75</option>
        <option value="VIP">👑💺 VIP - $100</option>
      </select>
    

      <label for="seats">Number of Seats:</label>
      <input type="number" id="seats" name="seats" min="1" required />

      <button type="submit">Submit</button>
    
      <p id="priceDisplay"><strong>Total Price:</strong> $0</p>
    </form>
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
        
  </main>

  <footer>
    <p>&copy; 2025 Movie Ticket Booking System. IT-361 Web Technologies</p>
  </footer>
</body>
</html>
