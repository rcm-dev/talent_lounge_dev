<html>
<head>
	<title>Mojo Testing</title>
	<link rel="stylesheet" type="text/css" href="../css/forms.css">
	<style type="text/css">

	body {
		font-family: "Arial";
		font-size:14px;
		background-color: #f5f5f5;
	}

	label {
		display: block;
	}

	.box {
		padding: 20px;
		border:1px solid #bbb;
		width: 395px;
	}

	.box2 {
		padding: 20px;
		border:1px solid #bbb;
		width: 300px;
	}

	.left {
		float: left;
		margin-right: 10px;
	}

	h1, h2, h3, h4, h5 {
		margin: 0px;
		padding: 0px;
	}

	#bar {
		height: 10px;
		background: grey;
		width: 0px;
	}

	#bar-container {
		border: 1px solid #333;
		height: 10px;
		overflow: hidden;
		width: 100px;
	}

	</style>
	<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
</head>
<body>
<h1>Testing Development</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>



<div class="box left">
	<h3>Live form</h3>

	<p>
	<div class="status success" style="display:none">Successful inserted</div>
	<div class="status error" style="display:none">Fill up the form</div>
	<form method="post">

	<label>Input Text</label>
	<input type="text" name="input" id="input" /> Review :<span id="disp"></span>

	<label>Textarea</label>
	<textarea id="txtarea" name="txtarea" cols="40" rows="5"></textarea><br/>
	<span>Character count: </span><span id="count">145</span>
	
	<div id="bar-container"><div id="bar"></div></div><br/>

	<input type="submit" value="Submit Ajax" id="submitAjax"> <span class="postloading" style="display:none"><img src="../images/ajax-loader.gif" /> Loading</span>
	</form>
	</p>
	
</div>


<div class="box left">
	<h3>Live Comment</h3>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua.</p>
	<hr>

	<ol id="update">
		<?php

		include 'dbconnect.php';

		$sql 	= mysql_query("SELECT * FROM comment");
		$numrow	= mysql_num_rows($sql);

		if ($numrow == 0) {
			# code...
			echo "No comment yet. Be the first";
		}

		while ($rowc = mysql_fetch_array($sql)) {
			$comment_body = $rowc['com_body'];
		

		?>
		<li class="comment-box">
			<span><?php echo $comment_body; ?></span>
		</li>

		<?php } ?>
	</ol>

	<div id="loadcom" style="display:none"><img src="../images/ajax-loader.gif" /></div>
	<div class="flash error" style="display:none">Fill up the comment</div>
	<div class="flash success" style="display:none">Thank you!</div>
	<p>
		<form method="post" name="formcomment">
			<h4>Comment on this article</h4>
			<label>Your comment</label>
			<textarea id="comb" name="comb"></textarea><br/>
			<input type="submit" name="subcomment" value="Submit Comment" id="subcomment" />
		</form>
	</p>
</div>

<div class="box2 left">
	<h3>Live check</h3>
	<p>
		<form method="post">
			<label>Enter Company No</label>
			<input type="text" name="conum" id="conum" />

			<br/>

			<label>Enter IC Director</label>
			<input type="text" name="icnum" id="icnum" />

			<br/>
			<input type="submit" name="subok" id="subok" value="submit" />
		</form>
	</p>
</div>

<script type="text/javascript">

$(document).ready(function(){


	
});

</script>


<script type="text/javascript">
$(document).ready(function(){

	var in1 = $('#input');
	
	in1.hover(function(){
		console.log('IN');
	}, function(){
		console.log('OUT');
	});

	in1.live('keypress', function(){
		var in1Value = in1.val();
		console.log(in1Value);
	});

	in1.keyup(function(){
		var value = $(this).val();
		$('span#disp').text(value);
	}).keyup();

	//console.log(in1);


	// Count
	$('#txtarea').keyup(function(){
		
		var box   = $(this).val();
		var main  = box.length*100;
		var value = (main / 145);
		var count = 145 - box.length;

		if(box.length <= 145){

			$('#count').html(count);
			$('#bar').animate({
				"width": value+'%',
			}, 1);
		
		} else {
			alert(' Full ');
		}

			return false;
	});


});
</script>


<script type="text/javascript">
$(function(){

	
	// Submit update ajax
	$('#submitAjax').click(function(){

		// form var
		var inputUser 	= $('#input').val();
		var textUser  	= $('#txtarea').val();
		var dataString	= 'input=' + inputUser + '&txtarea=' + textUser;

		// validate form
		if (inputUser == '' || textUser == '') {

			$('.status.success').fadeOut(200).hide();
			$('.status.error').fadeOut(200).show();

			$('.status.error').delay(3000).fadeOut('slow');


		} else {

			$('.postloading').show();
			$('.postloading').fadeIn(400);
			
		
			$.ajax({
			
				type: 	"POST",
				url: 	"submit.php",
				data: 	dataString,

				success: function(){
					$('.status.success').fadeOut(200).show();
					$('.status.error').fadeOut(200).hide();
					
					$('#input').val("");
					$('#txtarea').val("");
					$('span#disp').text("");

					$('.status.success').delay(3000).fadeOut('slow');
					$('#count').text("145");
					$('.postloading').hide('slow');
				}

			});
		}

		//console.log(dataString);
		return false;


	});

});	
</script>

<script type="text/javascript">

$(function(){
	
	// submit comment
	$('input#subcomment').click(function(){
		

		var comUser = $('#comb').val();
		var dataCom = 'comb=' + comUser;
		
		if (comUser == '') {
			
			$('div.flash.error').fadeOut(200).show();
			$('div.flash.error').delay(3000).fadeOut('slow');
		
		} else {
			
			$('#loadcom').show();
			$('#loadcom').fadeIn(400);


			$.ajax({
				
				type: "POST",
				url: "submitcomment.php",
				data: dataCom,
				cache: false,

				success: function(html){
					$('div.flash.success').fadeOut(200).show();
					$('div.flash.success').delay(3000).fadeOut('slow');
					
					$('#comb').val("");

					$('ol#update').append(html);
					$('ol#update li:last').fadeIn("slow");
					$('#loadcom').hide();
				}

			});
		}

		//console.log(dataStringCom);
		return false;

	});

});
</script>
</body>
</html>