function hoverHeadingin(){
    document.getElementById('action').innerHTML='<q>Put Your Heading inside &lt;h1&gt;&lt;/h1&gt;';
  }
  function hoverHeadingout(){
    document.getElementById('action').innerHTML='';
  }

  function putHeading(){
    
   
    document.getElementById('emailcampaign').value=document.getElementById('emailcampaign').value+'<h1></h1>';
  }

  function hoverParagaphin(){
    document.getElementById('action').innerHTML='<q>Put Your Paragraphs inside &lt;p&gt;&lt;/p&gt;';
  }
  function hoverParagaphout(){
    document.getElementById('action').innerHTML='';
  }

  function putParagraph(){
    document.getElementById('emailcampaign').value=document.getElementById('emailcampaign').value+'<p></p>';
  }

  function hoverboldin(){
    document.getElementById('action').innerHTML='<q>Put Your Text inside &lt;b&gt;&lt;/b&gt;';
  }
  function hoverboldout(){
    document.getElementById('action').innerHTML='';
  }

  function putBold(){
    document.getElementById('emailcampaign').value=document.getElementById('emailcampaign').value+'<b></b>';
  }
  
  function newLine(){
    document.getElementById('emailcampaign').value=document.getElementById('emailcampaign').value+'\n';
  }
  function inputfield(){
   //linkfield
   document.getElementById('linkfield').innerHTML="<input type='text' class=form-control id='linkf' placeholder='Paste Link Here'><br> <button type='submit' class='btn btn-success' onclick='addLink()'>Add Link</button>";
  }

  function addLink(){
    //clicked
    var value=document.getElementById('linkf').value;
    if(value!==""){

      document.getElementById('emailcampaign').value=document.getElementById('emailcampaign').value+'\n'+value;
    }
    document.getElementById('linkfield').innerHTML="";
  }