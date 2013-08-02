<?php  



include '../db/db-connect.php';


$cid        = $_GET['pid'];
$type		= 1; // 2 for video

$querymedia = "SELECT
  mj_fund_media.mfm_path As FundingPicture
From
  mj_fund_media
Where
  mj_fund_media.mfm_id_fk = '$cid' AND mj_fund_media.mfm_type = 1";
$result     = mysql_query($querymedia);
$totalRow   = mysql_num_rows($result);


echo "<h4>Pictures</h4>";

if ($totalRow ==0) {
	echo "No picture yet. Upload pne or more.";
}
else {

	echo "<ul>";

	while ($row = mysql_fetch_object($result)) { ?>
		

		<li>
			<div style="width:100px; height:100px; border:1px solid #f1f1f1; padding:5px !important; margin:5px;">
				<img src="<?php echo $row->FundingPicture; ?>" width="100px" style="background-color:#fff;">
				<a href="#" id="" class="setDefaultImage" data-img="<?php echo $row->FundingPicture; ?>" data-ads="<?php echo $cid; ?>" style="font-size:10px">Set Default Image</a>
			</div>
		</li>
		

<?php

	}

}


?>
<div class="clear"></div>
</ul>


<script type="text/javascript">
	$(document).ready(function(){

		$('.setDefaultImage').live('click', function(){
			var imgID = $(this).attr('id');
			var imgPath = $(this).attr('data-img');
			var adsID = $(this).attr('data-ads');
			var type = 'projectfunding';

			$.ajax({
				url: "ajax/ajax-set-market-image-default.php",
				type: "POST",
				data: "img_path="+imgPath+"&ads_id="+adsID+'&type='+type,

				success:function(html){
					if (html == 1) {
						//alert('New ads cover has been set it!');
						alert('New ads cover has been set it!');
						window.location = "edit-project.php?pid="+adsID
					};
				}
			});

			//alert('click imgID '+imgID+' path=> '+imgPath);
			return false;
		});
	});
</script>