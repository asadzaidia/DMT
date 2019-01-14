function getAPI(a){

	var s_id=a;
	//call to get api of clicked segment
	$.ajax({
            url:"usercodes/get_api.php",
            method:"POST",
            data:{
                segment_id:s_id
            },
            dataType:"text",
            success:function(html){
				// console.log(html);
				document.getElementById('apidata').innerHTML=html;
      			  $('#APIMODEL').modal({show:true});
            }
        });
   
    

	}