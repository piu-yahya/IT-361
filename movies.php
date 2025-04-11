<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM movies");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Now Showing</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
    }
    .movie-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      padding: 30px 20px;
    }
    .movie-card {
      width: 280px;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
      padding: 15px;
    }
    .movie-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
    }
    .movie-card h3 {
      margin: 15px 0 5px;
    }
    .movie-card p {
      margin-bottom: 5px;
      color: #666;
    }
    .movie-card a.btn {
      display: inline-block;
      padding: 8px 15px;
      background: #2980b9;
      color: white;
      border-radius: 5px;
      text-decoration: none;
      margin-top: 10px;
    }
    .movie-card a.btn:hover {
      background: #1c5d89;
    }
  </style>
</head>
<body>
  <header>
    <h1>🎞️ Now Showing</h1>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="movies.php">Movies</a></li>
        <li><a href="book.php">Book Ticket</a></li>
        <li><a href="view_bookings.php">My Bookings</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <div class="movie-grid">
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="movie-card">
          <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
          <h3><?= htmlspecialchars($row['title']) ?></h3>
          <p><strong>Genre:</strong> <?= htmlspecialchars($row['genre']) ?></p>
          <p><strong>Show Time:</strong> <?= date("D, M j, Y - h:i A", strtotime($row['show_time'])) ?></p>
          <a class="btn" href="book.php?movie_id=<?= $row['id'] ?>">Book Now</a>
        </div>
      <?php } ?>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Movie Ticket Booking System. IT-361 Web Technologies</p>
  </footer>
</body>
</html>
