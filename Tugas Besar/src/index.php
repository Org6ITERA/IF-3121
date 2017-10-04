
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="images/logo.png">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!--<meta name="viewport" content="width=device-width"> -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="./css/homestyle.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">


		<title>Home</title>
	    <style type="text/css">
<!--
.style2 {
	font-size: 24px;
	color: #FFFFFF;
}
-->
        </style>
        <script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body onLoad="MM_preloadImages('images/4.jpg','images/6.jpg','images/8.jpg','images/9.jpg')">
<header>
			<div class="container">
				<div id="logo">
					<h1>E-VOTE</h1>
				</div>
				<nav>
					<div id="loginSign">
						<ul>
						  <li><a href="login.php" >Log in</a></li>
					  </ul>
						<li></li>
				  </div>
			  </nav>
			</div>
</header>

		  
		<div id="navi">
			<nav>
				<a href="index.php">Home</a>
				<a href="#">Help</a>
				<a href="#contactUs">Contact</a>			</nav> 
		</div>	


		<section id="showcase">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
						<img src="./img/bg11.jpg" alt="Los Angeles">					</div>
					<div class="item">
						<img src="./img/bg1.jpg" alt="Chicago">					</div>
					<div class="item">
						<img src="./img/human2.jpg" alt="New York">					</div>
				</div>

				<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only">Previous</span>				</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only">Next</span>				</a>			</div>	
		</section>
<section id ="contactUs">
			<div class="container">
				<div id="left">
					<p align="center" class="style2">E-VOTE TEAM</p>
			  </div>
		  <div id="mid">
					<p><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image7','','images/9.jpg',1)"><img src="images/1.jpg" name="Image7" width="210" height="310" border="0"></a>&nbsp;&nbsp;<a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','images/4.jpg',1)"><img src="images/3.jpg" name="Image8" width="210" height="310" border="0"></a> &nbsp;<a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','images/6.jpg',1)"><img src="images/5.jpg" name="Image9" width="210" height="310" border="0"></a>&nbsp;&nbsp;<a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image10','','images/8.jpg',1)"><img src="images/7.jpg" name="Image10" width="210" height="310" border="0"></a></p>
	          </div>
<div id="right">
					<p>,					</p>
			  </div>
			</div>
		</section>
		

		<footer>
			<p> EVOTE Inc, &copy; 2017</p>
		</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
