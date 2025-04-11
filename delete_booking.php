<?php
include 'db.php';

$id = $_GET['id'] ?? 0;

if ($id > 0) {
  $query = "DELETE FROM bookings WHERE id = $id";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Booking deleted successfully.'); window.location.href='view_bookings.php';</script>";
  } else {
    echo "Error deleting booking: " . mysqli_error($conn);
  }
} else {
  echo "<script>alert('Invalid booking ID.'); window.location.href='view_bookings.php';</script>";
}
?>