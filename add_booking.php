<?php
include 'db.php';

$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$movie_id = (int) $_POST['movie_id'];
$seats = (int) $_POST['seats'];

if ($name && $email && $movie_id > 0 && $seats > 0) {
  $sql = "INSERT INTO bookings (name, email, movie_id, seats) VALUES ('$name', '$email', $movie_id, $seats)";
  if (mysqli_query($conn, $sql)) {
    
    header("Location: payment.html");
    exit;
  } else {
    echo "Database Error: " . mysqli_error($conn);
  }
} else {
  echo "<script>alert('All fields are required.'); window.history.back();</script>";
}

mysqli_close($conn);
?>