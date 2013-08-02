<html>
<head>
	<title>Landing SME</title>
	<!-- Place somewhere in the <head> of your document -->
	<link rel="stylesheet" href="flexslider.css" type="text/css">
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="jquery.flexslider.js"></script>
	<style>
		.smeWrap {
			width: 1000px;
			height: 380px;
      overflow: hidden;
		}
		body {
			margin:0;
			padding:0;
		}
	</style>
</head>
<body>
<!-- Place somewhere in the <body> of your page -->
<div class="flexslider smeWrap">
  <ul class="slides">
    <li>
      <a href="../recruitment/browseVidResume.php" target="_parent"><img src="slide/slide1.png" /></a>
    </li>
    <li>
      <a href="../login.php" class="public" target="_parent">
        <img src="slide/slide2.png" />
      </a>
    </li>
    <!-- <li>
      <img src="slide/slide3.jpg" />
    </li>
    <li>
      <img src="slide/slide4.jpg" />
    </li> -->
  </ul>
</div>
<!-- Place in the <head>, after the three links -->
<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider({
    	animation: "fade",
        initDelay: 0,
        keyboard: false,
        pauseOnAction: false,            //Boolean: Pause the slideshow when interacting with control elements, highly recommended.
        pauseOnHover: true 
    });
  });
</script>
</body>
</html>