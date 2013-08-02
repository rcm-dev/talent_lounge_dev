<?php  



include '../db/db-connect.php';


$cid        = $_GET['cid'];
$type		= 1; // 2 for video

$querymedia = "SELECT * FROM mj_idea_media WHERE mi_id_fk = '$cid' AND mim_type = '$type'";
$result     = mysql_query($querymedia);
$totalRow   = mysql_num_rows($result);


echo "<h4>Pictures</h4>";

if ($totalRow ==0) {
	echo "No picture yet. Upload pne or more.";
}
else {


	echo '<ul>';
	while ($row = mysql_fetch_object($result)) {
		
		echo '<li>';
		echo '<img src="'.$row->mim_path.'" width="100" height="100" style="background-color: #fff; padding:5px; border:1px solid #f1f1f1; margin:5px;" />';
		echo '<a href="#" id="'.$row->mim_id.'" class="setDefaultImage" data-img="'.$row->mim_path.'" data-ads="'.$cid.'">Set Default Image</a>';
		echo '</li>';
	}
	echo '</ul>';

}


?>

<script type="text/javascript">
	$(document).ready(function(){

		$('.setDefaultImage').live('click', function(){
			var imgID = $(this).attr('id');
			var imgPath = $(this).attr('data-img');
			var adsID = $(this).attr('data-ads');
			var type = 'creativeidea';

			$.ajax({
				url: "ajax/ajax-set-market-image-default.php",
				type: "POST",
				data: "img_path="+imgPath+"&ads_id="+adsID+'&type='+type,

				success:function(html){
					if (html == 1) {
						//alert('New ads cover has been set it!');
						alert('New ads cover has been set it!');
						window.location = "edit-idea.php?cid="+adsID
					};
				}
			});

			//alert('click imgID '+imgID+' path=> '+imgPath);
			return false;
		});
	});
</script>