<?php
  include('includes/header.php');
  
  
?>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact us</span></p>
            <h1 class="mb-0 bread">login</h1>
          </div>
        </div>
      </div>
    </div>

        <div class="container">
          <div class="col-lg-8 mx-auto">
              <?php 
             if(isset($_POST['send'])):
                
                
              $email = htmlentities($_POST['email']);
              $password = htmlentities($_POST['password']);
              $sql = "SELECT * FROM client WHERE email='$email'";
              $result = query($sql);
              $sql2 = "SELECT * FROM admin WHERE MATRICULE='$email'";
              $result2 = query($sql2);  

                  // $row = mysqli_fetch_array($result);
                  // die(print_r($row));
                  // die(print_r($password));
                 if (mysqli_num_rows($result)>0) {
                     while($row = mysqli_fetch_array($result)){
                       if(password_verify($password,$row['PASSWORD'])){
                        //  die($password);
                        $_SESSION['log']=true;
                        $_SESSION['nom']=$row['NOM'];
                        $_SESSION['id']=$row['ID'];
                        redirect('index.php');
                        // echo '<div class="alert alert-success">mot de passe ou email est incorect</div>';
                       }else{
                        echo '<div class="alert alert-danger">mot de passe ou email est incorect</div>';
                      }
                    }
                  }elseif(mysqli_num_rows($result2)>0){
                    while($row = mysqli_fetch_array($result2)){
                    if($password==$row['PASSWORD']){
                      //  die($result2);
                      $_SESSION['logadmin']=true;
                      $_SESSION['nom']=$row['MATRICULE'];
                      
                      redirect('admin/php/categorie.php');
                    }
                  
                else{
                  echo '<div class="alert alert-danger">email ou mot de passe incorecr</div>';
              }
            }
          }
            
          
                  else{
                    echo '<div class="alert alert-danger">vous n\'avez pas un compte inscrire ici</div>';

                  }
          
                
                endif;      
          
            ?>
            
              
              <?php  
              if(!empty($alert)){
                echo '<div class="alert alert-danger">'.$alert.'</div>';
              }
              
              
              ?>
         <form action="login.php" method="POST" class="bg-white p-5 contact-form">

              
              <div class="form-group">
                <label for="email">entre votre email :</label>
                <input type="text" class="form-control" placeholder="email" name="email">
              </div>
              <div class="form-group">
                <label for="password">entre votre password :</label>
                <input type="password" class="form-control" placeholder="password" name="password">
              </div>
              <div class="form-group">
                <button type="submit" name="send" class="btn btn-primary py-3 px-5">conexion</button>
              </div>
            </form>
          
          </div>

          <!-- <div class="col-md-6 d-flex">
          	<div id="map" class="bg-white"></div>
          </div>
         </div>  -->
       </div>
    </section>  

    <footer class="ftco-footer ftco-section">
      <div class="container">
      	<div class="row">
      		<div class="mouse">
						<a href="#" class="mouse-icon">
							<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
						</a>
					</div>
      	</div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Vegefoods</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Menu</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Shop</a></li>
                <li><a href="#" class="py-2 d-block">About</a></li>
                <li><a href="#" class="py-2 d-block">Journal</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Help</h2>
              <div class="d-flex">
	              <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
	                <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
	                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
	                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
	                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
	              </ul>
	              <ul class="list-unstyled">
	                <li><a href="#" class="py-2 d-block">FAQs</a></li>
	                <li><a href="#" class="py-2 d-block">Contact</a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>