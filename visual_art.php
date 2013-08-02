<?php  


/**
 * 
 * 
 * Get row idea details
 * by id from url
 * 
 * 
 */
include 'header.php';

# sqlinjection

?>
<?php include 'quickpost.php'; ?>

<div id="content" class="<?php if(!isset($_SESSION['usr_id'])) { echo "topfix"; } ?>">

	
	
	<div id="contentContainer" >


		<div class="heading">
			<h1 class="heading_title">Visual Art</h1>
		</div>

			<div class="left cnscontainerPlain" style="margin-top:20px; width:700px !important;">

			<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="3D Thumbnail Hover Effects" />
        <meta name="keywords" content="3d, 3dtransform, hover, effect, thumbnail, overlay, curved, folded" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css1/demo.css" />
        <link rel="stylesheet" type="text/css" href="css1/style_common.css" />
        <link rel="stylesheet" type="text/css" href="css1/style4.css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css' />
		<script type="text/javascript" src="js/modernizr.custom.69142.js"></script> 
    </head>
    <body>
        <div class="container">
			<!-- Codrops top bar -->
           

            <div id="grid" class="main">
				<div class="view">
					<div class="view-back">
						
						<span data-icon="A">566</span>
						<span data-icon="B">124</span>
						<a href="http://www.flickr.com/photos/ag2r/6271521984/in/photostream">&rarr;</a>
					</div>
					<img src="images2/11.jpg" width="300" height="200"/>
				</div>
				<div class="view">
					<div class="view-back">
						<span data-icon="A">210</span>
						<span data-icon="B">102</span>
						<a href="http://www.flickr.com/photos/ag2r/6131126901/in/photostream">&rarr;</a>
					</div>
					<img src="images2/20.jpg" width="300" height="200" />
				</div>
				<div class="view">
					<div class="view-back">
						<span data-icon="A">690</span>
						<span data-icon="B">361</span>
						<a href="http://www.flickr.com/photos/ag2r/5033654303/in/photostream">&rarr;</a>
					</div>
					<img src="images2/3.jpg" width="300" height="200" />
				</div>
				<div class="view">
					<div class="view-back">
						<span data-icon="A">987</span>
						<span data-icon="B">130</span>
						<a href="http://www.flickr.com/photos/ag2r/4846704157/in/photostream">&rarr;</a>
					</div>
					<img src="images2/14.jpg" width="300" height="200"/>
				</div>
			</div>
        </div>
		<script type="text/javascript">	
			
			Modernizr.load({
				test: Modernizr.csstransforms3d && Modernizr.csstransitions,
				yep : ['http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js','js/jquery.hoverfold.js'],
				nope: 'css/fallback.css',
				callback : function( url, result, key ) {
						
					if( url === 'js/jquery.hoverfold.js' ) {
						$( '#grid' ).hoverfold();
					}

				}
			});
				
		</script>
    </body>
</html>
</div>



			<?php include 'sidebar_exhibition.php'; ?>
			


			<div class="clear"></div>
		


	

</div><!-- /content -->
<input type="hidden" name="page_title" value="<?php echo ucwords($rowIdeaDetails->id_title); ?>" id="page_title" />


<?php  

/**
 * Include Footer
 */

include 'footer.php';


?>