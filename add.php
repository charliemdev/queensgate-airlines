<?php
  include("includes/conn.php");
  include("includes/session.php");
  if($_SESSION["role"]!=="2"){
    header( "Location: 401.php" );
  }
  include("includes/header.php");

  $q_airports = "SELECT * FROM airports";
  $r_airports = $conn->query($q_airports);
  $airports = $r_airports->fetchAll();

  $q_pilots = "SELECT * FROM crew WHERE role_id = 1";
  $r_pilots = $conn->query($q_pilots);
  $pilots = $r_pilots->fetchAll();

  $q_attendants = "SELECT * FROM crew WHERE role_id = 2";
  $r_attendants = $conn->query($q_attendants);
  $attendants = $r_attendants->fetchAll();

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
            <li class="nav-link">
              <a href="index.php">Flights</a>
            </li>
            <?php
              if($_SESSION["role"]=="2"){
                echo '<li class="nav-link active"><a href="add.php">Add Flight</a></li>';
              }
             ?>
          </ul>
        </nav>
        <div class="add-flight">
          <!-- Form -->
          <form action="save.php" method="POST">
            <div class="input-group">
              <label for="origin_id">Origin ID</label>
              <select id="origin_id" name="origin_id">
                <?php
                foreach($airports as $airport){
                	echo "<option value='{$airport["id"]}'>{$airport["name"]}</option>";
                }
                ?>
              </select>
            </div>
            <div class="input-group">
              <label for="destination_id">Destination ID</label>
              <select id="destination_id" name="destination_id">
                <?php
                foreach($airports as $airport){
                	echo "<option value='{$airport["id"]}'>{$airport["name"]}</option>";
                }
                ?>
              </select>
            </div>
            <div class="input-group">
              <label for="departure_date">Departure Date</label>
              <input type="date" id="departure_date" name="departure_date">
            </div>
            <div class="input-group">
              <label for="departure_time">Departure Time</label>
              <input type="time" id="departure_time" name="departure_time">
            </div>
            <div class="input-group">
              <label for="arrival_date">Arrival Date</label>
              <input type="date" id="arrival_date" name="arrival_date">
            </div>
            <div class="input-group">
              <label for="arrival_time">Arrival Time</label>
              <input type="time" id="arrival_time" name="arrival_time">
            </div>

            <fieldset>
              <legend>Select 1 pilot</legend>
              <?php
              foreach($pilots as $pilot){
              	echo "<label for='{$pilot["first_name"]}'><input type='radio' name='pilots[]' value='{$pilot["id"]}' id='{$pilot["first_name"]}'>{$pilot["first_name"]} {$pilot["last_name"]}</label>";
              }
              ?>
            </fieldset>

            <fieldset>
              <legend>Select 3 attendants</legend>
              <?php
              foreach($attendants as $attendant){
              	echo "<label for='{$attendant["first_name"]}'><input type='checkbox' name='attendants[]' value='{$attendant["id"]}' id='{$attendant["first_name"]}'>{$attendant["first_name"]} {$attendant["last_name"]}</label>";
              }
              ?>
            </fieldset>

            <input type="submit" name="btn-submit" value="Add Flight">
          </form>
        </div>
      </div>
    </main>
  </body>
</html>
