<html>
<head>
	<title>Video</title>
	<link href="/css/video-js.css" rel="stylesheet">
	<script src="/js/video.js"></script>
</head>
<body>
<?php  



include '../db/db-connect.php';


$cid        = $_GET['cid'];
$type		= 2; // 2 for video

$querymedia = "SELECT * FROM mj_idea_media WHERE mi_id_fk = '$cid' AND mim_type = '$type'";
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
		  <source src="<?php echo $row->mim_path; ?>" type='video/mp4'>
		</video>


<?php
	}

}


?>

</body>
</html>