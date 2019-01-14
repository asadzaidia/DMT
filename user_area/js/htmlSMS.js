

                  function checklength(){
                    var value=document.getElementById('emailcampaign').value;
                    var length=value.length+1;
                    var remaining=250-length;
                    if(remaining<=0){
                       document.getElementById("sendsms").disabled = true;
                    }else{
                      document.getElementById("sendsms").disabled = false;
                    }
                    document.getElementById('rem').innerHTML=remaining;
                    
                    
                  }
                  function checklength2(){
                    
                    var value=document.getElementById('emailcampaign').value;
                    var length=value.length+1;
                    var remaining=250-length;
                    if(remaining<=0){
                       document.getElementById("sendsms").disabled = true;
                    }else{
                      document.getElementById("sendsms").disabled = false;
                    }
                    document.getElementById('rem').innerHTML=remaining;
                    
                    
                  }
             
