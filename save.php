<?php
include("includes/conn.php");

// Basic Form Processing
$originId = $_POST['origin_id'];
$destId = $_POST['destination_id'];
$depDate = $_POST['departure_date'];
$depTime = $_POST['departure_time'];
$arrDate = $_POST['arrival_date'];
$arrTime = $_POST['arrival_time'];
$pilots = [];
if (isset($_POST['pilots'])) {
  $pilots = $_POST['pilots'];
}
$attendants = [];
if (isset($_POST['attendants'])) {
  $attendants = $_POST['attendants'];
}
// SQL INSERT for adding a new row
// Use prepared statement to bind the values from the form
$query = "INSERT INTO flights (id, origin_id, destination_id, departure_date, departure_time, arrival_date, arrival_time) VALUES (NULL, :originId, :destId, :depDate, :depTime, :arrDate, :arrTime)";
$stmt = $conn->prepare($query);
$stmt->bindValue(':originId', $originId);
$stmt->bindValue(':destId', $destId);
$stmt->bindValue(':depDate', $depDate);
$stmt->bindValue(':depTime', $depTime);
$stmt->bindValue(':arrDate', $arrDate);
$stmt->bindValue(':arrTime', $arrTime);

if ($stmt->execute()) {
  $msg = "<p>Successfully added the new flight.</p>";
} else {
  $msg = "<p>There was a problem inserting the data.</p>";
}

$newFlightId = $conn->lastInsertId();

foreach ($pilots as $pilotId) {
  $query = "INSERT INTO crew_flight (crew_id, flight_id) VALUES (:crewId, :flightId)";
  $stmt = $conn->prepare($query);
  $stmt->bindValue(':crewId', $pilotId);
  $stmt->bindValue(':flightId', $newFlightId);
  $stmt->execute();
}

foreach ($attendants as $attendantId) {
  $query = "INSERT INTO crew_flight (crew_id, flight_id) VALUES (:crewId, :flightId)";
  $stmt = $conn->prepare($query);
  $stmt->bindValue(':crewId', $attendantId);
  $stmt->bindValue(':flightId', $newFlightId);
  $stmt->execute();
}

$conn = NULL;
?>

<body>
  <?php echo $msg; ?>
</body>

</html>