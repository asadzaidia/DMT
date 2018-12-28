
// $(document).ready(function(){
//     $(document).ajaxStart(function(){
//         $("#wait").css("display", "block");
//     });
//     $(document).ajaxComplete(function(){
//         $("#wait").css("display", "none");
//     });
   
// });

//checking segmentName using ajax
$(document).ready(function(){
    $('#sn').blur(function(){
        var segmentname=$(this).val();
        $.ajax({
            url:"check_segment.php",
            method:"POST",
            data:{
                segmentname:segmentname
            },
            dataType:"text",
            success:function(html){
    
                $('#snavailable').html(html);
            }
        });
    });
    });

