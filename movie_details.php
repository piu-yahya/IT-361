<?php
include 'db.php';

$id = $_GET['id'] ?? 0;

$query = "SELECT * FROM movies WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
  die("Movie not found.");
}

$movie = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($movie['title']) ?> - Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css">
  <style>
    .movie-details {
      max-width: 800px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
    }
    .movie-details img {
      width: 100%;
      max-height: 400px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    .movie-details h2 {
      margin-bottom: 10px;
    }
    .movie-details p {
      margin: 5px 0;
    }
    .movie-details a.btn {
      margin-top: 20px;
      display: inline-block;
    }
  </style>
</head>
<body>
  <header>
    <h1>🎬 Movie Details</h1>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="movies.php">Movies</a></li>
        <li><a href="view_bookings.php">My Bookings</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <div class="movie-details">
      <img src="images/<?= htmlspecialchars($movie['image']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
      <h2><?= htmlspecialchars($movie['title']) ?></h2>
      <p><strong>Genre:</strong> <?= htmlspecialchars($movie['genre']) ?></p>
      <p><strong>Show Time:</strong> <?= date("l, F j, Y - h:i A", strtotime($movie['show_time'])) ?></p>
      <a href="book.html?movie_id=<?= $movie['id'] ?>" class="btn">🎟️ Book This Movie</a>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Movie Ticket Booking System. IT-361 Web Technologies</p>
  </footer>
</body>
</html>