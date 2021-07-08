<?php
  include("includes/session.php");
  include("includes/conn.php");
  include("includes/header.php");

  $flightId=$_GET['id'];

  $stmt=$conn->prepare("SELECT origin_id, destination_id, departure_date, departure_time, arrival_date, arrival_time, airports.name, airports.location, destination.name AS dname, destination.location AS dloc
  FROM flights
  INNER JOIN airports ON flights.origin_id=airports.id
  INNER JOIN airports AS destination ON flights.destination_id=destination.id
  WHERE flights.id = :id");
  $stmt->bindValue(':id', $flightId);
  $stmt->execute();
  $flight=$stmt->fetch();


  $crew_stmt=$conn->prepare("SELECT * FROM crew_flight
  INNER JOIN crew ON crew_flight.crew_id=crew.id
  INNER JOIN flights on crew_flight.flight_id=flights.id
  INNER JOIN roles on crew.role_id=roles.id
  WHERE crew_flight.flight_id = :id");
  $crew_stmt->bindValue(':id', $flightId);
  $crew_stmt->execute();
  $crew=$crew_stmt->fetchAll();

  $conn=NULL;
?>
  <body>
    <header>
      <div class="header-container">
        <h1>Queensgate Airlines</h1>
        <div class="user">Logged in as, <i><?php echo $_SESSION["email"]; ?></i></div>
        <ul class="logout">
          <li>
            <a href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </header>
    <main>
      <div class="container">
        <nav>
          <ul>
            <li class="nav-link active details">
              <a href="index.php">Back to Flight List</a>
            </li>
          </ul>
        </nav>
        <div class="flight-details">
          <?php if ($flight) {
            echo "<div class='flight-header'>";
            echo "<h1>{$flight['name']}</h1>";
            echo "<i class='fas fa-chevron-right fa-lg'></i>";
            echo "<h1>{$flight['dname']}</h1>";
            echo "</div>";
            echo "<div class='flight-info'>";
            echo "<div class='flight-departure'>";
            echo "<h3>Departing from {$flight['name']}</h3>";
            echo "<p><i class='far fa-calendar-alt'></i> {$flight['departure_date']}</p>";
            echo "<p><i class='far fa-clock'></i> {$flight['departure_time']}</p>";
            echo "</div>";
            echo "<div class='travel'></div>";
            echo "<div class='flight-arrival'>";
            echo "<h3>Arriving at {$flight['dname']} </h3>";
            echo "<p><i class='far fa-calendar-alt'></i> {$flight['arrival_date']}</p>";
            echo "<p><i class='far fa-clock'></i> {$flight['arrival_time']}</p>";
            echo "</div>";
            echo "</div>";
          } ?>

          <div class="flight-crew">
            <h2>Crew Members</h2>
            <?php
              foreach ($crew as $crews) {
                echo "<div class='crew'>";
                echo "<h3>{$crews['first_name']} {$crews['last_name']}</h3>";
                echo "<p>{$crews['name']}</p>";
                echo "</div>";
              }
            ?>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>
