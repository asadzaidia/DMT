<?php
 session_start();
if(isset($_SESSION['username'])){
  //inactivity constraint
  echo "<script>window.open('user_area/index.php','_self')</script>";
}


?>

<!DOCTYPE html>
<html>
  <head>
    <?php  include('includes/header_includes.php'); ?>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/foot.css">
    <script src="js/top.js"></script>
    <title>Campaign Bird</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/logo.png" />

  </head>

  <body>
      
      <?php include('includes/navbar.php');  ?>
             <br>
             <br>
            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-double-up"></i></button>

              
          <div class="container">
            <!-- feature1-->
             <div id="feature1" class="row text-left">
              <div class="col-md-12 col-lg-12 col-xl-12">
              <h2 class="f-head">Manage Your Email Campaign</h2>
               <p id="desc1">Manage Email Campaigns directly from your area. Whether you need to sell your products,share some big news, or tell a story, our email campaigns that best suit your message.</p>
                <br>
                <br>
                <center><img src="images/email.jpg" alt="email" class="img-responsive"
                   width="500" height="650"></center>
             </div> 
           </div> 
             <br> 
             
               <!--feature 2-->
              <div class="row"  id="feature2">
                <div class="col-md-6 col-lg-6 col-xl-6 ">
              <h2 class="f-head">Build Your Audience </h2>
               <p id="desc2"> Build your segmented audience by<br>
                using our Smart API’s and audience management tool. <br>
                Let others to subscribe you easily. Import and export your contacts.
                </p>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2">

                </div>
                <div class="col-md-4 col-lg-4 col-xl-4">
                <img src="images/audience.jpg" alt="audince" class="img-responsive" style="margin-top:30px;" width="400" height="500">
                </div> 
            </div> 
            <br>
            
            <!--feature 3-->
             <div id="feature3" class="row text-center">
              <div class="col-md-12 col-lg-12 col-xl-12">
              <h2 class="f-head2">Templates On The Go</h2>
               <p id="desc3">Found responsive finite range of already built-in emails and mobile subscription templates.</p>
                <br>
                <br>
                <img src="images/template.jpg" alt="tempalte" class="img-responsive center" id="temp" width="400" height="400">
             </div> 
           </div>
           <br>
           <br>
            </div>
          </div> 

             <!--feature 4-->
          
            <div class="col-md-12" id="feature4" style="background-color: #b8d3db;">

              <div class="col-md-6">
                  <img src="images/mobile.jpg" alt="mobile" class="img-responsive" height="70" id="feature4-img"> 
              </div>
              <div class="col-md-6">
                  <h2 class="f-head">Send Marketing Campaigns To Mobile Phones Via Web.</h2>
                  <p id="desc4"> Send marketing campaign directly from web to others mobile with our smart mobile marketing tool.
                   </p>
                   <br>
              </div>
            </div>
            <br>
      


            <!--feature5-->

             <div class="container">
            <div id="feature5" class="row text-left">
              <div class="col-md-12">
              <h2 class="f-head">View Live Statistics Of Your Campaigns</h2>
               <p id="desc5">View your campaign statistics and validated email statistics directly </p>
                <br>
                <br>
                <center><img src="images/statistic.png" 
                alt="statistic" class="img-responsive " width="400" height="400"></center>
             </div>
             </div>

           </div>

             <br> 

             <!--Newsletter-->

              
                <div class="col-md-12" style="background-color: #b5c5dd;">
                 
              <center>
               <div class="col-md-6 col-md-offset-3">
              
                
                 <center>
                    <h1 class="page-header">SUBSCRIBE TO OUR NEWSLETTER!</h1>


                </center>                
                <center>
                    <p id="new" style="color:#0e394f; font-family:Impact;">Want to stay updated with the latest email marketing tips 
                    and our latest offers?<br>
                    Then subscribe to our newsletter now!
                    </p>

                    </center>

                 <form method="post" action=" ">
                 <div class="form-group">
                   <input type="email" class="form-control newsletter-style" name="email" required style="padding-left: 10px;">
                 </div>
                 <center><button type="submit" class="btn btn-warning btn-lg newsletter-style" name="subscribe">Subscribe!</button></center>
                 <br><br>
                 </form>
                 

               
              
               </div>
               </center>
             </div>  
 

      <div>
       <?php include('includes/footer.php');  ?>
      </div>

  </body>

</html>
<?php 
    	include('codes/sub_emails.php');
?>
