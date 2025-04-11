<?php
include 'db.php';
$query = "SELECT b.*, m.title FROM bookings b JOIN movies m ON b.movie_id = m.id ORDER BY b.booking_time DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>My Bookings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
    }

    main {
      padding: 40px;
      max-width: 1000px;
      margin: auto;
    }

    h2 {
      text-align: center;
      font-size: 2rem;
      color: #2c3e50;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      border-radius: 10px;
      overflow: hidden;
    }

    th, td {
      padding: 14px;
      border-bottom: 1px solid #eee;
      text-align: center;
      vertical-align: middle;
    }

    th {
      background-color: #2c3e50;
      color: white;
    }

    tr:hover {
      background-color: #f9f9f9;
    }

    .actions a, .actions button {
      display: inline-block;
      padding: 6px 10px;
      margin: 2px;
      color: white;
      background-color: #2980b9;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-size: 0.9em;
      cursor: pointer;
    }

    .delete {
      background-color: #c0392b;
    }

    .qr-img {
      width: 70px;
      height: 70px;
    }
  </style>
</head>
<body>
  <header>
    <h1 style="text-align:center; padding:20px;">📋 My Bookings</h1>
    <nav style="text-align:center;">
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="movies.php">Movies</a></li>
        <li><a href="book.php">Book Ticket</a></li>
        
      </ul>
    </nav>
  </header>

  <main>
    <h2>📄 Booking Summary</h2>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Movie</th>
          <th>Seats</th>
          <th>Type</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['title']) ?></td>
          <td><?= $row['seats'] ?></td>
          <td>
            <?php
              $type = $row['seat_type'];
              $icon = $type === 'VIP' ? '👑💺' : ($type === 'Premium' ? '✨💺' : '💺');
              echo $icon . ' ' . htmlspecialchars($type);
            ?>
          </td>
          <td class="actions">
            <a href="edit_booking.php?id=<?= $row['id'] ?>">Edit</a>
            <a class="delete" href="delete_booking.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>

  <footer style="text-align:center; padding:20px;">
    <p>&copy; 2025 Movie Ticket Booking System. IT-361 Web Technologies</p>
  </footer>
</body>
</html>
