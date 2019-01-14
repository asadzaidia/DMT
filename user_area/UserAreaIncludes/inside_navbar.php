<?php
@session_start();
$un=$_SESSION['username'];
//console_log($aa);

?>
           
           <nav class="navbar navbar-default navbar-fixed-top">
           
                <div class="container-fluid">
                  <div class="container">
                 <!--logo-->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span> 
                  </button> 
                  
                  <a class="navbar-brand" href="index.php">
                    <img src="../images/logo.png" alt="logo" style="margin-top: -25px;" height="80">
                  </a>
                </div> 

               

               <!--links-->
          
                 <div class="collapse navbar-collapse" id="mynav">
                 <ul class="nav navbar-nav">
                   <li><a href="index.php" >Campaigns</a></li>
                   <li><a href="templates.php" >Templates</a></li>
                   <li><a href="segment.php" >Segment</a></li>
                   <li><a href="Api_docs.php" >API Doc's</a></li>
                   
                 </ul>
                
                 <ul class="nav navbar-nav navbar-right">
                  
                   <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out" ></span>SignOut</a></li>
                   <li><p style="color:  #bf4080;font-weight: bold;font-size:20px;margin-top: 25px;"><?php echo $un; ?></p></li>
                   
                 </ul>
                 </div>   
</div>
               </div>
            </nav> 