
body
{
 margin: 0;
 padding: 0;
 font-family: "Times New Roman", Times, serif;
}

#grad1
{
	background: red;
	   background: linear-gradient(to bottom, #9900cc 0%, #33ccff 100%);
	height: 700px;
}

.sbox
{
	width: 300px;
	height: 280px;
	background:#c2c2d6;
	color: #000cc;
	top: 50%;
	left: 50%;
	position: absolute;
	transform:translate(-50%,-50%);
	box-sizing:border-box;
}

.sbox .ltr i
{
	
	color: #660066;
	text-align: center;
	font-size: 50px;
	position: absolute;
	right: 40%;
	margin-top: 5%;

}

.sbox h1
{
	text-align: center;
	font-size: 26px;
	margin: 0;
	padding: 0;
	color:  #660066;
	text-transform: uppercase;
	padding-top: 75px;
    font-weight: bold;
}

.sbox p{
	text-align: center;
	color: #660066;
	font-size: 16px;
	padding-top: -10%;
}

.sbox input[type="email"]
{
	width: 96%;
	margin-bottom: 5%;
	border: none;
	border-bottom: 1px solid  #660066;
	background: transparent;
	outline: none;
	height: 40px;
	color:  #660066;
	font-size: 18px;
	padding-left: 2%;
	padding-right: 2%;
	text-align: center;
	 font-family: "Times New Roman", Times, serif;

}

.sbox input[type="email"]::placeholder
{
	color:  #660066;
	 font-family: "Times New Roman", Times, serif;
}

.sbox input[type="submit"]
{

	
	border: 1px solid #660066;
	color: white;
	background-color:  #660066;
	float: right;
	font-size: 18px;
	margin-right: 8px;
	 font-family: "Times New Roman", Times, serif;

}