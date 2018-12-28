<!DOCTYPE html>
<html>
  <head>
    <?php  include('includes/header_includes.php'); ?>
    <link rel="stylesheet" href="styles/style.css">
    <title>The Marketer</title>

  </head>

  <body>

  	<div class="container">
  		<center><img class="img-responsive" src="images/logo.png">
  		<div class="col-md-12">
  		<div class="alert alert-danger" role="alert"><strong>We have found your inactivity please login again</strong></div>
  		</div>

  		<a href="login.php" class="btn btn-info btn-lg style" >Login Again</a>
  		</center>
  		</div>


  </body>

  </html>


  <!-- if((time()-$_SESSION['last_login_time']>900)){
    header("location:../logout.php?logout=We have found your inactivity please login again");
  }
  

     else  
           {  
            //checking time again
                $_SESSION['last_login_time'] = time();  
               
                echo "user area <br>";



        $aa=$_SESSION['username'];
        echo $aa;

        echo '<a href="../logout.php">logout</a>'; 
         }
 -->