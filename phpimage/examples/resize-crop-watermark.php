<?php

	require_once('../php_image_magician.php');

	/*	Purpose: Open image
     *	Usage:	 resize('filename.type')
     * 	Params:	 filename.type - the filename to open
     */
	$magicianObj2 = new imageLib('sample_images/racecar.jpg');
     $magicianObj4 = new imageLib('sample_images/racecar.jpg');
     $magicianObj6 = new imageLib('sample_images/racecar.jpg');


	/*	Purpose: Add a watermark to your image
     *	Usage:	 addWatermark([watermark_image], [position])
     * 	Params:	 watermark_image - the image to use as your watermark
     * 			 position - choose from the below options
     * 
     * 				tl = top left,
     * 				t  = top (middle), 
     * 				tr = top right,
     * 				l  = left,
     * 				m  = middle,
     * 				r  = right,
     * 				bl = bottom left,
     * 				b  = bottom (middle),
     * 				br = bottom right
     * 	
     *	Output:	 Adds a watermark image to the bottom-right corner of your image
     */
     $magicianObj -> resizeImage(24, 24, 'crop');
     //$magicianObj -> resizeImage(40, 40, 'crop');
     //$magicianObj -> resizeImage(60, 60, 'crop');
	$magicianObj -> addWatermark('sample_images/watermark-jp.png', 'm');


	/*	Purpose: Save image
     *	Usage:	 saveImage('[filename.type]', [quality])
     * 	Params:	 filename.type - the filename and file type to save as
 	 * 			 quality - (optional) 0-100 (100 being the highest (default))
     *				Only applies to jpg & png only
     */
	$magicianObj -> saveImage('output/resize-crop-watermark.jpg', 50);

?>
