

body
{
 margin: 0;
 padding: 0;
 font-family: sans-serif;
}

#grad1
{
	background: red;
	background: linear-gradient(to top, #ff0000 0%, #ccff33 100%);
	height: 700px;
}

.sbox
{
	width: 300px;
	height: 320px;
	background: black;
	color: white;
	top: 50%;
	left: 50%;
	position: absolute;
	transform:translate(-50%,-50%);
	box-sizing:border-box;
}

.sbox .ltr
{
	position: absolute;
	color: #fff;
	cursor: pointer;
	top: -9%;
	right: 40%;
	background: red;
	width: 60px;
	height: 60px;
	    line-height: 1.5;
	border-radius: 50%;
	text-align: center;
	font-size: 40px;
	border: 4px solid red;

}

.sbox h1
{
	text-align: center;
	font-size: 24px;
	margin: 0;
	padding: 0;
	color: white;
	text-transform: uppercase;
	padding-top: 55px;
    font-weight: bold;
}

.sbox p{
	text-align: center;
	color: white;
	font-size: 18px;
}

.sbox input[type="email"]
{
	width: 96%;
	margin-bottom: 5%;
	border: none;
	border-bottom: 1px solid white;
	background: transparent;
	outline: none;
	height: 40px;
	color: white;
	font-size: 18px;
	padding-left: 2%;
	padding-right: 2%;
	text-align: center;

}

.sbox input[type="email"]::placeholder
{
	color: white;
}

.sbox input[type="submit"]
{

	border-radius: 12px;
	border: 1px solid red;
	color: white;
	background-color: red;
	float: right;
	font-size: 18px;
	margin-right: 8px;

}