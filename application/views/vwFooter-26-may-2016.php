<footer>

<div class="row">
  <div class="col-md-4">
  <h3>Contact Address</h3>
  <h6><p>Debra Becker Sr. Marketing<br />
   Director IDG World Expo/IDG<br />
   Enterprise Events Phone: 508-766-5452<br />
   Email: dbecker@idgenterprise.com</p><br /></h6>
   </div>
  <div class="col-md-4">
  <h3>Quick Links</h3>
  <ul>
  <li><a href="<?php echo BASE_URL ?>">HOME</a></li>
 <?php    if($this->session->userdata('is_client_login')) { ?>
   <li><a href="<?php echo BASE_URL ?>myaccount">My Account</a></li>
   <li><a href="<?php echo BASE_URL ?>mysubscription">My Subscription</a></li>
   <li><a href="<?php echo BASE_URL ?>resetpassword">Reset password</a></li>
   <li><a href="<?php echo BASE_URL ?>editmail">Reset mail id</a></li>
   <li><a href="<?php echo BASE_URL ?>home/logout">Logout</a></li>
 <?php } else { ?>
  <li><a href="<?php echo BASE_URL ?>">Login</a></li>
  <li><a href="<?php echo BASE_URL ?>register">Register</a></li>
  <?php } ?>
  </ul>
  </h6>
  </div>
  
  <div class="col-md-4">
  <h3>Social</h3>
  <h4>
  <a title="Facebook"><i class="fa fa-facebook-square"></i></a>
  <a title="Twitter"><i class="fa fa-twitter-square"></i></a>
  <a title="Instagram"><i class="fa fa-instagram"></i></a>
  <a title="Pinterest"><i class="fa fa-pinterest-square"></i></a>
  <a title="Linkedin"><i class="fa fa-linkedin-square"></i></a>
  <a title="Google-plus"><i class="fa fa-google-plus-square"></i></a>
  </h4>
  
  </div>
</div>
</footer>

  </body>
</html>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  