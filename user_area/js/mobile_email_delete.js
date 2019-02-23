
                             
        function getEID(x){
                                  
            var id=x;
	        //call to get api of clicked segment
            if(confirm('Are You sure?')){

	            $.ajax({
                url:"usercodes/deleteEmail.php",
                method:"POST",
                data:{
                EID:id
                },
                dataType:"text",
                success:function(html){
				
				// document.getElementById('result').innerHTML=html;
                // console.log(html);
                $('#delete'+id).hide('slow');
      			
            }
        });
            }
        }
  
             function getMID(x){
                                  
                                    var id=x;
	        //call to get api of clicked segment
            if(confirm('Are You sure?')){

	            $.ajax({
                url:"usercodes/deleteMobile.php",
                method:"POST",
                data:{
                MID:id
                },
                dataType:"text",
                success:function(html){
				
				// document.getElementById('result').innerHTML=html;
                // console.log(html);
                $('#delete'+id).hide('slow');
      			
            }
        });
            }
   


                                }

                    