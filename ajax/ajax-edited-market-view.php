<?php  



include '../db/db-connect.php';


$mid        = $_GET['mid'];

$querymedia = "SELECT * FROM mj_market_media WHERE mmm_mp_id_fk = '$mid'";
$result     = mysql_query($querymedia);
$totalRow   = mysql_num_rows($result);


echo "<h4>Pictures</h4>";

if ($totalRow ==0) {
	echo "No picture yet. Upload pne or more.";
}
else {


	echo '<ul id="marketMediaListUI">';
	while ($row = mysql_fetch_object($result)) {
		

		echo '<li><img src="'.$row->mmm_path.'" width="100" height="100" style="background-color: #fff; padding:5px; border:1px solid #f1f1f1; margin:5px;" />';
		echo '<a href="#" id="'.$row->mmm_id.'" class="setDefaultImage" data-img="'.$row->mmm_path.'" data-ads="'.$mid.'">Set Default Image</a>';
		echo '</li>';

	}
	echo '<div class="clear"></div>';
	echo '</ul>';

}


?>

<script type="text/javascript">
	$(document).ready(function(){

		$('.setDefaultImage').live('click', function(){
			var imgID = $(this).attr('id');
			var imgPath = $(this).attr('data-img');
			var adsID = $(this).attr('data-ads');
			var type = 'adsmarket';

			$.ajax({
				url: "ajax/ajax-set-market-image-default.php",
				type: "POST",
				data: "img_path="+imgPath+"&ads_id="+adsID+'&type='+type,

				success:function(html){
					if (html == 1) {
						//alert('New ads cover has been set it!');
						alert('New ads cover has been set it!');
						window.location = "edit-market.php?mid="+adsID
					};
				}
			});

			//alert('click imgID '+imgID+' path=> '+imgPath);
			return false;
		});
	});
</script>