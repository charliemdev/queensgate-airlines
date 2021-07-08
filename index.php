<?php
  include("includes/session.php");
  include("includes/conn.php");
  include("includes/header.php");

  $q_flights = "SELECT flights.id AS id, origin_id, destination_id, departure_date, departure_time, arrival_date, arrival_time, airports.name, airports.location, destination.name AS dname, destination.location AS dloc
  FROM flights
  INNER JOIN airports ON flights.origin_id=airports.id
  INNER JOIN airports AS destination ON flights.destination_id=destination.id";
  $r_flights = $conn->query($q_flights);
  $flights = $r_flights->fetchAll();

  $q_airports = "SELECT * FROM airports";
  $r_airports = $conn->query($q_airports);
  $airports = $r_airports->fetchAll();

  $conn = NULL;
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
            <li class="nav-link active">
              <a href="index.php">Flights</a>
            </li>
            <?php
              if($_SESSION["role"]=="2"){
                echo '<li class="nav-link"><a href="add.php">Add Flight</a></li>';
              }
             ?>
          </ul>
        </nav>
        <div class="flight-list">
          <?php
            if ($flights) {
              foreach ($flights as $flight) {
                echo "<div class='flight'>";
                echo "<a href='details.php?id={$flight["id"]}'>";
                echo "<div class='departure'>";
                echo "<i class='fas fa-plane-departure fa-2x'></i>";
                echo "<h1>{$flight['name']}</h1>";
                echo "<p>{$flight['location']}</p>";
                echo "</div>";
                echo "<div class='travel'>";
                echo "<i class='fas fa-plane fa-2x'></i>";
                echo "</div>";
                echo "<div class='arrival'>";
                echo "<i class='fas fa-plane-arrival fa-2x'></i>";
                echo "<h1>{$flight['dname']}</h1>";
                echo "<p>{$flight['dloc']}</p>";
                echo "</div>";
                echo "</a>";
                echo "</div>";
              }
            } else {
              echo "No results found.";
            }
          ?>
        </div>
      </div>
    </main>
    <script src="js/ajax.js"></script>
  </body>
