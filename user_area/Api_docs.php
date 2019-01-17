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

  	<?php  include('UserAreaIncludes/inside_navbar.php'); ?>

  		<!-- Body-->
		  <p style="margin-top: 120px;"></p>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
					<h1 class='page-header'>HTTP API</h1>
					<div class="well">
						<p style="font-size:13px;">http://campaignbird.tk/apis/add_subs.php?content=XXX&&Apikey=XXXXXX</p>
						</div>
						<p><strong>Apikey:</strong> is the apikey of your Segment</p>
						<p><strong>content:</strong> is weather email or mobile number according to your Type of Segment.
 						
						 <br/><br/><br/>

						 &nbsp;&nbsp;&nbsp;<ul>
 													<li><a href="#"  data-toggle="modal" data-target="#node">NodeJs Example</a><br/></li>
													 <li><a href="#" data-toggle="modal" data-target="#php">PHP Example</a></li>
						 							</ul>




<!-- Modal Node -->
<div class="modal fade" id="node" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-header">Node.js Example</h4>
      </div>
      <div class="modal-body" id="html">
      <div style="overflow-x: scroll;"> 
      <xmp>
       
const apikey='XXXX';	

// POST method route
app.post('/', function (req, res) {
  
const api="http://localhost/dmt/apis/add_subs.php?content
	="+req.body.content+"&&Apikey="+apikey;

const CallAPI=(callback)=>{
	
	request(api,{json:true},(err,res,body)=>{
if(err)
	{
    	 return callback(err);
  }
        return callback(body);
	});
		
  }

    CallAPI(function(response){
        res.write(JSON.stringify(response));
        res.end();

    });
  });

      </xmp>
      </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="php" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modal-header">PHP Example</h4>
      </div>
      <div class="modal-body" id="html">
      <div style="overflow-x: scroll;"> 
      <xmp>
if(isset($_POST['submit']))
	{
		$content=$_POST['content'];
	}
$Apikey="XXXXXX";
					
$url="http://localhost/dmt/apis/add_subs.php?
content=$content&&Apikey=$Apikey";
		
$ch=curl_init();
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_URL,$url);
curl_exec($ch);
curl_close($ch);
					


</xmp>
</div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
						 
						 



					
					</div>
				</div>
			</div>

		 <!-- Body-->


	<?php include('UserAreaIncludes/inside_footer.php');?> 


  </body>

  </html>