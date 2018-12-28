


@import url('https://fonts.googleapis.com/css?family=Roboto');
body
{
	margin:0;
	padding:0;
	font-family: 'Roboto', sans-serif;


}

.overlay
{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: #c2c2d6;
	transition: .5s;

}

.newsletter
{
	position: absolute;
	top: 50%;
	left: 50%;
	transform:translate(-50%,-50%);
	width: 35%;
	height: 55%;
	min-height: 200px;
	background: #6600cc;
	box-shadow: 0 10px 15px rgba(0,0,0,.5);
	padding: 40px 60px 60px;
	box-sizing:border-box;

}

.newsletter .close
{
	position: absolute;
	top: -20px;
	right: -20px;
	color: #fff;
	cursor: pointer;
	background: #e91e63;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	line-height: 40px;
	text-align: center;
	font-size: 20px;
	border: 4px solid white;

}

.icon
{
	text-align: center;
	color: white;
	font-size: 80px;
}

.newsletter h1
{
	margin: 0;
	padding: 0;
	text-align: center;
	color: white;
	font-family: 'Roboto', sans-serif;
	font-weight: 300;
	font-size: 35px;
}
.newsletter p
{
	margin: 0;
	padding: 0;
	text-align: center;
	color: white;
	font-size: 18px;
	font-weight: 300;
}

.sform
{
	position: relative;
	margin-top: 35px;
}

.sform input[type="email"]
{
	width: 100%;
	height: 50px;
	border-radius: 60px;
	border: none;
	outline: none;
	padding: 20px;
	padding-right: 200px;
	box-sizing:border-box;
	font-size: 15px;
	background:#a64dff;
	color: white;
	font-family: 'Roboto', sans-serif;
	font-weight: 300;
}

.sform input[type="email"]::placeholder
{
	color: white;
}

.sform input[type="submit"]
{
	width: 100px;
	height: 50px;
	border-radius: 60px;
	border: none;
	outline: none;
	position: absolute;
	top: 0;
	right: 0;
	font-size: 15px;
	background: #00bcd4;
	color: white;
	font-family: 'Roboto', sans-serif;
	font-weight: 300;
	cursor: pointer;
	transition:.5s;

}

.sform input[type="submit"]:hover
{
	background: #e91e63
}









