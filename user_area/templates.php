<?php
session_start();
if(isset($_SESSION['username'])){
  //inactivity constraint
   $aa=$_SESSION['username'];
        
         
  }
 else{

  echo "<script>window.open('../index.php','_self')</script>";
 }

 ?>
<!DOCTYPE html>
<html>
  <head>
    <?php  include('../includes/header_includes.php'); ?>
    <link rel="stylesheet" href="userAreaStyles/userareastyle.css">
     <link rel="stylesheet" href="userAreaStyles/template.css">
    <title>Campaign Bird</title>

  </head>
  <body>
  <!--header-->
  <?php  include('UserAreaIncludes/inside_navbar.php'); ?>
  <!--body-->
  <div class="temp">   
          <!--header-->
          <div id="temp_h">
           <h1 class="main" style="margin-top:100px;">Email Subscription Templates</h1>
           <hr class="line1" >
          </div><!--temp_h-->
          <!--subscription tempalte-->
          <div class="component">
            <div class="row" id="r1">
              <!--template 1-->
              <div class="col-md-4" id="comp1">

                <img src="../images/s1.jpg" class="img-responsive img-thumbnail" id="img1" alt="newsletter" data-toggle="modal" data-target="#modal1">
                 <!--modal-->
                 <!-- Modal -->
                <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                 <div class="modal-header">
                  <h3 class="modal-title" id="modal-header">Subscription Template</h3>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent">
                  <li class="active"><a href="#html" data-toggle="tab">HTML</a></li>
                  <li><a href="#css" data-toggle="tab">CSS</a></li>
                  <li><a href="#js" data-toggle="tab">JS</a></li>
                </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="html">
             <pre>
              <?php  include('templatecode/s1.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="css">
              <pre>
              <?php  include('templatecode/s1c.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="js">
            <pre></pre>
            </div> 
           </div>
          </div>
             <div class="modal-footer">
            </div>
            </div>
            </div>
           </div>
                
            </div> <!--col-->

            <!--template 2-->
            <div class="col-md-4">
               <img src="../images/s2.jpg" class="img-responsive img-thumbnail" id="img2" alt="newsletter" data-toggle="modal" data-target="#modal2">

              <!-- Modal -->
                <div class="modal fade" id="modal2" tabindex="-1" role="dialog"  aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                 <div class="modal-header">
                  <h3 class="modal-title" id="modal-header">Subscription Template</h3>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent">
                  <li class="active"><a href="#html2" data-toggle="tab">HTML</a></li>
                  <li><a href="#css2" data-toggle="tab">CSS</a></li>
                  <li><a href="#js2" data-toggle="tab">JS</a></li>
                </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="html2">
             <pre>
              <?php  include('templatecode/s2.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="css2">
              <pre>
              <?php  include('templatecode/s2c.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="js2">
            <pre></pre>
            </div> 
           </div>
          </div>
             <div class="modal-footer">
            </div>
            </div>
            </div>
           </div>

            </div><!--col-->

            <!--template 3-->
           <div class="col-md-4">
            
             <img src="../images/s3.jpg" class="img-responsive img-thumbnail" id="img3" alt="newsletter" data-toggle="modal" data-target="#modal3">

              <!-- Modal -->
                <div class="modal fade" id="modal3" tabindex="-1" role="dialog"  aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                 <div class="modal-header">
                  <h3 class="modal-title" id="modal-header">Subscription Template</h3>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent">
                  <li class="active"><a href="#html3" data-toggle="tab">HTML</a></li>
                  <li><a href="#css3" data-toggle="tab">CSS</a></li>
                  <li><a href="#js3" data-toggle="tab">JS</a></li>
                </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="html3">
             <pre>
              <?php  include('templatecode/s3.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="css3">
              <pre>
              <?php  include('templatecode/s3c.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="js3">
            <pre></pre>
            </div> 
           </div>
          </div>
             <div class="modal-footer">
            </div>
            </div>
            </div>
           </div>


           </div><!--col-->
         </div><!--row1-->

          <div class="row">

            <!--template 4-->

           <div class="col-md-4">
             <img src="../images/s4.jpg" class="img-responsive img-thumbnail" id="img4" alt="newsletter" data-toggle="modal" data-target="#modal4">

              <!-- Modal -->
                <div class="modal fade" id="modal4" tabindex="-1" role="dialog"  aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                 <div class="modal-header">
                  <h3 class="modal-title" id="modal-header">Subscription Template</h3>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent">
                  <li class="active"><a href="#html4" data-toggle="tab">HTML</a></li>
                  <li><a href="#css4" data-toggle="tab">CSS</a></li>
                  <li><a href="#js4" data-toggle="tab">JS</a></li>
                </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="html4">
             <pre>
              <?php  include('templatecode/s4.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="css4">
              <pre>
              <?php  include('templatecode/s4c.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="js4">
            <pre></pre>
            </div> 
           </div>
          </div>
             <div class="modal-footer">
            </div>
            </div>
            </div>
           </div>
           </div><!--col-->

           <!--template 5-->
           <div class="col-md-4">
            <img src="../images/s5.jpg" class="img-responsive img-thumbnail" id="img5" alt="newsletter" data-toggle="modal" data-target="#modal5">

              <!-- Modal -->
                <div class="modal fade" id="modal5" tabindex="-1" role="dialog"  aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                 <div class="modal-header">
                  <h3 class="modal-title" id="modal-header">Subscription Template</h3>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent">
                  <li class="active"><a href="#html5" data-toggle="tab">HTML</a></li>
                  <li><a href="#css5" data-toggle="tab">CSS</a></li>
                  <li><a href="#js5" data-toggle="tab">JS</a></li>
                </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="html5">
             <pre>
              <?php  include('templatecode/s5.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="css5">
              <pre>
              <?php  include('templatecode/s5c.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="js5">
            <pre></pre>
            </div> 
           </div>
          </div>
             <div class="modal-footer">
            </div>
            </div>
            </div>
           </div>

           </div><!--col-->

           <!--template 6-->
          <div class="col-md-4">

            <img src="../images/s6.jpg" class="img-responsive img-thumbnail" id="img6" alt="newsletter" data-toggle="modal" data-target="#modal6">

              <!-- Modal -->
                <div class="modal fade" id="modal6" tabindex="-1" role="dialog"  aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                 <div class="modal-header">
                  <h3 class="modal-title" id="modal-header">Subscription Template</h3>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent">
                  <li class="active"><a href="#html6" data-toggle="tab">HTML</a></li>
                  <li><a href="#css6" data-toggle="tab">CSS</a></li>
                  <li><a href="#js6" data-toggle="tab">JS</a></li>
                </ul>

          <div class="tab-content">
            <div class="tab-pane active" id="html6">
             <pre>
              <?php  include('templatecode/s6.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="css6">
              <pre>
              <?php  include('templatecode/s6c.php'); ?>
            </pre>
            </div> 
            <div class="tab-pane" id="js6">
            <pre></pre>
            </div> 
           </div>
          </div>
             <div class="modal-footer">
            </div>
            </div>
            </div>
           </div>


           </div><!--co--->


          </div><!--row2-->


          </div><!--component-->

  </div><!--temp-->



  <div class="container">
    <div class="row">
        <center><h1>OR</h1></center>
        <br>
        <center><a href="drag_drop/index.php" class="btn btn-success btn-lg style">Create Your Own Template!</a></center>
    </div>
  </div>



  <!--footer-->
    <?php include('UserAreaIncludes/inside_footer.php');?> 
  </body>
  </html>

  <!--mtk engineering-->