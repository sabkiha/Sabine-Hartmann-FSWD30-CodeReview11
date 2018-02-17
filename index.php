<?php 
session_start();


 ?>

<!-- HTML================================= -->

<!-- html/head/<body> navbar-->
<?php include('navbar.php'); ?>


<!-- further page content-->



	<div class="container-fluid bg-1 text-center">
		<span>
			<h3>Welcome to PHP Car Rental - <a href="login.php">Customer Login</a></h3>
			<h3>Rent with Us &nbsp&nbsp<img src="img/index_image.jpg" class="rounded-circle"  alt="nice car">&nbsp&nbspFor your best price</h3> 			
		</span>
  </div>


<!-- footer + </body-html> -->
<?php include('footer.php'); ?>

<?php ob_end_flush(); ?>
 