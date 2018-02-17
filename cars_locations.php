<?php
 ob_start();
 session_start();

 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }

 // select logged-in users detail
 $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<?php
$servername = "localhost";
$username   = "root";
$password   = ""; 
$dbname     = "cr11_sabine_hartmann_php_car_rental";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "\n");
}
?>


<!-- HTML================================= -->

<!-- html/head/<body> navbar-->
<?php include('navbar.php'); ?>


<!-- further page content-->

<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-2" role="group" aria-label="First group">
    <button type="button" class="btn btn-secondary bg-success"><a href="home.php">List of our offices</a></button>
    <button type="button" class="btn btn-secondary bg-success"><a href="cars_list.php">List of our cars</a></button>
    <button type="button" class="btn btn-secondary bg-success"><a href="cars_locations.php">Locations of cars</a></button>
  </div>
</div>

<?php 
    $sql = "
    SELECT `car`.`car_id`,`car`.`car_model`, `car`.`car_color`, `car`.`car_year`, `office`.`office_name`,`office`.`office_street`, `office`.`office_city`, `car`.`car_image`
    FROM `car` 
    LEFT JOIN `cars_at_offices` ON `cars_at_offices`.`fk_car_id` = `car`.`car_id` 
    LEFT JOIN `office` ON `cars_at_offices`.`fk_office_id` = `office`.`office_id`
    WHERE `office`.`office_name` IS NOT NULL";

      $result1 = mysqli_query($conn, $sql);
      ?>
  <div class="container-fluid row mx-auto">
    
    <div class="px-5 p-3 m-auto" style="overflow-x:auto;">
      <h3 class="leuke-titel">These cars are available at our offices</h3>
      <table class="table table-sm table-hover table-striped">
        <tr>
            <th>No</th>
            <th>Model</th>
            <th>Colour</th>
            <th>Year</th>
            <th>Office</th>
            <th>Street</th>
            <th>City</th>
            <th>Photo</th>
          </tr>

      <?php 
        while($row = mysqli_fetch_assoc($result1)) {
      ?>
        <tr>
          <td><?php echo $row['car_id']; ?></td>
          <td class="vet"><?php echo $row['car_model']; ?></td>
          <td><?php echo $row['car_color']; ?></td>
          <td><?php echo $row['car_year']; ?></td>
          <td class="vet"><?php echo $row['office_name']; ?></td>
          <td><?php echo $row['office_street']; ?></td>
          <td><?php echo $row['office_city']; ?></td>
          <td><img class='car-image float-right' src='img/<?php echo $row['car_image']; ?>'></td>
        </tr>
      <?php
        }
      ?>
      </table>

    </div>

<?php 
// Free result set

mysqli_free_result($result1);
 ?>

 
    <?php 
    $sql = "
    SELECT `car`.`car_id`,`car`.`car_model`, `car`.`car_color`, `car`.`car_year`, `location`.`location_point_in_time`, `location`.`location_street`, `location`.`location_city`, `car`.`car_image`
    FROM `car`
    LEFT JOIN `location` ON `location`.`fk_car_id` = `car`.`car_id`
    WHERE `location`.`location_point_in_time` IS NOT NULL";

      $result = mysqli_query($conn, $sql);
      ?>
  <div class="container-fluid row mx-auto">
    
    <div class="px-5 p-3 m-auto" style="overflow-x:auto;">
      <h3 class="leuke-titel">Tracked location of rented cars</h3>
      <table class="table table-sm table-hover table-striped">
        <tr>
            <th>No</th>
            <th class="vet">Model</th>
            <th>Colour</th>
            <th>Year</th>
            <th>Last tracked</th>
            <th>Street</th>            
            <th>City</th>
            <th>Photo</th>
          </tr>

      <?php 
        while($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr>
          <td><?php echo $row['car_id']; ?></td>
          <td class="vet"><?php echo $row['car_model']; ?></td>
          <td><?php echo $row['car_color']; ?></td>
          <td><?php echo $row['car_year']; ?></td>
          <td><?php echo $row['location_point_in_time']; ?></td>
          <td><?php echo $row['location_street']; ?></td>
          <td><?php echo $row['location_city']; ?></td>
          <td><img class='car-image float-right' src='img/<?php echo $row['car_image']; ?>'></td>
        </tr>
      <?php
        }
      ?>
      </table>

    </div>

<?php 
// Free result set

mysqli_free_result($result);
?>


<?php 
// Close connection

mysqli_close($conn);
 ?>

           

<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>
 
