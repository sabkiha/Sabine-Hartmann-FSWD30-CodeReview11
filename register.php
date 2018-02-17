<?php

 ob_start();
 session_start(); // start a new session or continues the previous

 if( isset($_SESSION['user'])!="" ){
  header("Location: home.php"); // redirects to home.php
 }

 include_once 'dbconnect.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {

  // sanitize user input to prevent sql injection
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);

  $surname = trim($_POST['surname']);
  $surname = strip_tags($surname);
  $surname = htmlspecialchars($surname);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  $street = trim($_POST['street']);
  $street = strip_tags($street);
  $street = htmlspecialchars($street);

  $city = trim($_POST['city']);
  $city = strip_tags($city);
  $city = htmlspecialchars($city);

  $dob = trim($_POST['dob']);
  $dob = strip_tags($dob);
  $dob = htmlspecialchars($dob);

  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your name.";
  } else if (strlen($name) < 1) {
   $error = true;
   $nameError = "Name must have at least 1 character.";
  } else if (!preg_match("/[a-zA-Z]/",$name)) {
   $error = true;
   $nameError = "Name must contain only letters.";
  }

   if (empty($surname)) {
   $error = true;
   $surnameError = "Please enter your surname.";
  } else if (strlen($surname) < 1) {
   $error = true;
   $surnameError = "Name must have at least 1 character.";
  } else if (!preg_match("/[a-zA-Z]/",$surname)) {
   $error = true;
   $surnameError = "Surname must contain only letters.";
  }

   //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {

   // check whether the email exist or not
   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }

  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 2) {
   $error = true;
   $passError = "Password must have at least 3 characters.";
  }

  // password encrypt using SHA256();
  $password = hash('sha256', $pass);

  // validation of street, city, dob

   if (empty($street)) {
   $error = true;
   $streetError = "Please enter your street.";
  } else if (strlen($street) < 1) {
   $error = true;
   $streetError = "Street must have at least 2 characters.";
  } 

  if (empty($city)) {
   $error = true;
   $cityError = "Please enter your city.";
  } else if (strlen($city) < 1) {
   $error = true;
   $cityError = "City must have at least 2 characters.";
  } 

   if (empty($dob)) {
   $error = true;
   $dobError = "Please enter your date of birth.";
  } else if (strlen($dob) < 1) {
   $error = true;
   $dobError = "Date of birth must have at least 2 characters.";
  } 

  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO customer(userName,surname,userEmail,userPass, user_straat, user_city, user_dob) VALUES('$name','$surname','$email','$password','$street','$city','$dob' )";
   $res = mysqli_query($conn, $query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Your Customer Account with PHP Car Rental is registered, please login now";
    unset($name);
    unset($surname);
    unset($email);
    unset($pass);
    unset($street);
    unset($city);
    unset($dob);

   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, please try again later...";
    }
  }
 }

?>

<!-- HTML================================= -->

<!-- html/head/<body> navbar-->
<?php include('navbar.php'); ?>


<!-- further page content-->

  <div class="container-fluid bg-1 text-center"> 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

             <h2>New Customer Registration</h2>
             <hr />       

            <?php
              if ( isset($errMSG) ) { 
            ?>
             <div class="alert">

             <?php echo $errMSG; ?>
              </div>
             <?php
           }
              ?>
    
<input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
    <span class="text-danger"><?php echo $nameError; ?></span>

<input type="text" name="surname" class="form-control" placeholder="Enter Surname" maxlength="100" value="<?php echo $surname ?>" />
    <span class="text-danger"><?php echo $surnameError; ?></span>

<input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
        <span class="text-danger"><?php echo $emailError; ?></span>

<input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
        <span class="text-danger"><?php echo $passError; ?></span>

<input type="text" name="street" class="form-control" placeholder="Enter Street and Number" maxlength="100" value="<?php echo $street ?>" />
    <span class="text-danger"><?php echo $streetError; ?></span>

<input type="text" name="city" class="form-control" placeholder="Enter Postcode and City" maxlength="100" value="<?php echo $city ?>" />
    <span class="text-danger"><?php echo $cityError; ?></span>

<input type="text" name="dob" class="form-control" placeholder="Enter Date of Birth" maxlength="100" value="<?php echo $dob ?>" />
    <span class="text-danger"><?php echo $dobError; ?></span>


        <hr />

        <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Register your account</button>
        <hr />

        <a href="index.php">Got to Login...</a>
    </form>
</div>

<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>