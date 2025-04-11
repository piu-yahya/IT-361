<?php
session_start();
$booking = $_SESSION['last_booking'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Thank You</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css" />
  <style>
    .thank-you-container {
      max-width: 700px;
      margin: 50px auto;
      text-align: center;
      background: #f9f9f9;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .thank-you-container img {
      max-width: 200px;
      margin: 10px auto;
    }
    .thank-you-container h2 {
      color: green;
    }
    .thank-you-container p {
      font-size: 1.1rem;
    }
    .thank-you-container a {
      color: #007BFF;
      text-decoration: none;
      margin: 0 10px;
    }
    .thank-you-container a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    <h1>🎉 Thank You</h1>
  </header>

  <main>
    <div class="thank-you-container">
      <h2>Payment Successful 💳</h2>
      <p>Thank you! Your booking and payment have been confirmed.</p>

      <?php if ($booking): ?>
        <?php if (!empty($booking['movie_image'])): ?>
          <img src="images/<?= htmlspecialchars($booking['movie_image']) ?>" alt="Movie Poster">
		          <p><strong>Name of Movie:</strong> <?= htmlspecialchars($booking['movie_title']) ?></p>

        <?php endif; ?>
      <?php else: ?>
        <p>No booking summary found.</p>
      <?php endif; ?>

      <br>
      <a href="index.html">Back to Home</a> | 
      <a href="view_bookings.php">View My Bookings</a>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Movie Ticket Booking System. IT-361 Web Technologies</p>
  </footer>
</body>
</html>
