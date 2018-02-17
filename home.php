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
    $sql = "SELECT `office`.`office_name`, `office`.`office_street`, `office`.`office_city`, `office`.`office_image` FROM `office`";

      $result = mysqli_query($conn, $sql);
      ?>
  <div class="container-fluid row mx-auto">
    
    <div class="px-5 p-3 m-auto" style="overflow-x:auto;">
      <h3 class="leuke-titel">These are our offices in Vienna</h3>
      <table class="table table-sm table-hover table-striped">
        <tr>
            <th>Office Name</th>
            <th>Street</th>
            <th>City</th>
            <th>Photo</th>
          </tr>

      <?php 
        while($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr>
          <td class="vet"><?php echo $row['office_name']; ?></td>
          <td><?php echo $row['office_street']; ?></td>
          <td><?php echo $row['office_city']; ?></td>
          <td><img class='car-image float-right' src='img/<?php echo $row['office_image']; ?>'></td>
        </tr>
      <?php
        }
      ?>
      </table>

    </div>

<?php 
// Free result set

mysqli_free_result($result);


// Close connection

mysqli_close($conn);
 ?>

           

<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>
