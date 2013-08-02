<html>
<head>
	<title>Video</title>
	
</head>
<body>
<?php  



include '../db/db-connect.php';


$cid        = $_GET['pid'];
$type		= 2; // 2 for video

$querymedia = "SELECT * FROM mj_fund_media WHERE mfm_id_fk = '$cid' AND mfm_type = '$type'";
$result     = mysql_query($querymedia);
$totalRow   = mysql_num_rows($result);


echo "<h4>Video</h4>";

if ($totalRow ==0) {
	echo "No video yet. Upload one or more.";
}
else {


	while ($row = mysql_fetch_object($result)) { ?>
		

		
		<video id="my_video_<?php echo $row->mim_id; ?>" class="video-js vjs-default-skin" controls
		  preload="auto" width="320" height="240" data-setup="{}">
		  <source src="<?php echo $row->mfm_path; ?>" type='video/mp4'>
		</video>


<?php
	}

}


?>

</body>
</html>