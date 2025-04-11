window.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const movieId = urlParams.get("movie_id");
  if (movieId) {
    const input = document.getElementById("movie_id");
    if (input) input.value = movieId;
  }
});

document.getElementById("bookingForm").addEventListener("submit", function (e) {
  let errors = [];

  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const movieId = document.getElementById("movie_id").value.trim();
  const seats = document.getElementById("seats").value.trim();

  if (name === "") errors.push("Name is required.");
  if (email === "" || !email.includes("@")) errors.push("A valid email is required.");
  if (movieId === "" || isNaN(movieId) || movieId <= 0) errors.push("Movie ID must be a valid number.");
  if (seats === "" || isNaN(seats) || seats <= 0) errors.push("Please enter a valid number of seats.");

  if (errors.length > 0) {
    e.preventDefault();
    alert("Please fix the following errors:\n\n" + errors.join("\n"));
  }
});