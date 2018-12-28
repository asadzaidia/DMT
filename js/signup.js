

function OnUserNamefocus(){
		var username_constraint=document.getElementById("un");
		username_constraint.innerHTML="* Username can only contain letters and digits<br>* 8 characters minimum";

			var availablity=document.getElementById("availablity");
		availablity.innerHTML="";
		document.getElementById("register").disabled = true;
	}

	function onUserNameblur(){
	var username_constraint=document.getElementById("un");
		username_constraint.innerHTML="";
	}
	function OnPasswordfocus(){
		var password_constraint=document.getElementById("password-hover");
		password_constraint.innerHTML="* Password Can only contain letter and digits<br>* 8 characters minimum";

	

	
	}
	function onPasswordblur(){
		var password_constraint=document.getElementById("password-hover");
		password_constraint.innerHTML="";
	}

	function resultout(){
	var results=document.getElementById("result");
		results.innerHTML="";	
	}

	
	$(document).ready(function(){
		$(document).ajaxStart(function(){
			$("#wait").css("display", "block");
		});
		$(document).ajaxComplete(function(){
			$("#wait").css("display", "none");
		});
	});
//checking username using ajax
	$(document).ready(function(){
$('#username').blur(function(){
	var un=$(this).val();
	$.ajax({
		url:"username_check.php",
		method:"POST",
		data:{
			user_name:un
		},
		dataType:"text",
		success:function(html){

			$('#availablity').html(html);
		}
	});
});
});