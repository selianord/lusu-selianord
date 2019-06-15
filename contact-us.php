<?php
// Mail processing script 
$errors = array();
$missing = array();
// check if the form has been submitted
if(isset($_POST['submit'])) {
    $to = 'selemani@selianordgroup.co.za'; 
    $subject = 'Feedback From SELIANORD GROUP'; 
    
    $expected = array('First_Name', 'Last_Name', 'Email_Address', 'Telephone', 'Message_Content');
    $required = array('First_Name', 'Last_Name', 'Email_Address', 'Telephone', 'Message_Content');
    
    //create additional headers
    $headers = "From: SELIANORD GROUP <selemani@selianordgroup.co.za>\r\n";
    $headers .= 'Content-Type: text/plain; charset=utf-8';
    require('./includes/processmail.inc.php');
    if ($mailSent) {
//        header("Location: https://www.selianordgroup.co.za/contact-us.php");
//        exit; 
        $success = "Your message has been successfully sent. We'll get back to you as soon as possible!";
    }   
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="icon"  href="images/favicon.png">
  <link rel="icon" type="image/png" href="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Selianord Group | Contact us
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">-->
  <!-- CSS Files -->
  <link href="css/material-kit.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/prettyPhoto.css">
  <!-- custoome css here -->
  <link rel="stylesheet" href="css/customerStyle.css">
</head>

<body class="landing-page sidebar-collapse">
  <?php require_once('includes/navbar.php');?>
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('images/contact-bg.jpg')">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 class="title animated infinite fadeInDown" data-wow-delay="1s">How can we help you</h1>
          <h4  class="wow animated infinite fadeInDown" data-wow-delay="1.4s">Phone us: <strong>+27796855739 | +27711549447</strong></h4>
        </div>
      </div>
    </div>
  </div>
  <div class="main main-raised">
    <section class="contact">
            <div class="container" id="form">
                <div class="row">
					<div class="col-md-12 section-bg">
						 <h2>Have a question? Contact us via email</h2>
					</div>
     <div class="col-md-12 section-bg">
     <?php if($_POST && $suspect || ($_POST && isset($errors['mailfail']))) {?>
            <div class="alert alert-danger">
               <p>Sorry, your message could not be sent. Please try again later!</p>
            </div>
     <?php } elseif ($missing || $errors) { ?>
            <div class="alert alert-danger">
                <p>Please fix the error(s) indicated below!</p>
            </div>
     <?php } ?>
   <form id="contact-form" class="contact-form" name="contactForm" method="post" role="form">
   <div class="row">
       <div class="col-md-6">
            <div class="form-group">
                 <input type="text" id="firstname" name="First_Name" class="form-control" required placeholder="First Name" minlength="4"
												maxlength="25" />
                <?php if($missing && in_array('firstname', $missing)) {?>
                 <span class="text-danger">Please fill in your first name.</span>
                <?php }?>
            </div>
            <div class="form-group">
             <input type="text" id="lastname" name="Last_Name" class="form-control" required placeholder="Last Name" minlength="4"
												maxlength="25"/>
             <?php if($missing && in_array('lastname', $missing)) {?>
             <span class="text-danger">Please fill in your last name.</span>
             <?php }?>
             </div>
             </div>
      <div class="col-md-6">
             <div class="form-group">
                     <input type="text" id="telephone" name="Telephone" class="form-control" required placeholder="111-111-1111" maxlength="15" pattern="^\d{3}-\d{3}-\d{4}$"/>
                    <?php if($missing && in_array('telephone', $missing)) {?>
                    <span class="text-danger">Please fill in your contact number.</span>
                    <?php } elseif (isset($errors['telephone'])) { ?>
                    <span class="text-danger">Invalid telephone number</span>
                    <?php }?>   
                </div>
                <div class="form-group">
                     <input type="email" id="email" name="Email_Address" class="form-control" required placeholder="Email Address" />
                     <?php if($missing && in_array('email', $missing)) {?>
                     <span class="text-danger">Please enter your email address.</span>
                    <?php } elseif (isset($errors['email'])) { ?>
                        <span class="text-danger">Invalid Email Address.</span>
                    <?php } ?>
                </div>
        </div>
                </div>
              <div class="form-group">
                 <textarea class="form-control" id="message" name="Message_Content" cols="48" rows="8" required placeholder="Type your message here"></textarea>
             <?php if($missing && in_array('message', $missing)) { ?>
                <span class="text-danger">Please enter your message.</span>
            <?php } ?>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit" name="submit">Send Message</button>
            </div>
                        </form>
                    </div>
                </div>
            </div>
</section>
<section id="feedback" style="min-height:300px; display:none;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <h1 class="text-success">
                   <i class="fa fa-check"></i> 
                   Your message has been successfully sent.<br />
                   We'll get back to you as soon as possible!
              </h1>
            </div>
        </div>
    </div>
</section>                                                                        
</div><!--end of main tags-->
  <?php require_once('includes/footer.php');?>
    <?php if(isset($success)){ ?>
      <script>
       $(document).ready(function(){
        $("#form").hide();
        $("#feedback").show();
       });
      </script>
     <?php } ?>
  <!--   Core JS Files   -->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap-material-design.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/owl.carousel.js"></script>
  <script src="js/plugin/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="js/plugin/bootstrap-datetimepicker.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="js/plugin/nouislider.min.js"></script>
  <!--  Google Maps Plugin    -->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>-->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="js/plugin/material-kit.js"></script>
</body>

</html>