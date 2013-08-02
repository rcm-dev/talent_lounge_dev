<?php  



/**
 * PROJECT SUBMITED
 */



// INCLUDE EVERYTHING NEEDED
include 'db/db-connect.php';
include 'class/api.php';



// GET POST
$user_id				=	$_POST['user_id'];
$pro_cat				=	$_POST['pro_cat'];
$projectIdea			=	$_POST['projectIdea'];
$shortBrief				=	$_POST['shortBrief'];
$businessModel			=	$_POST['businessModel'];
$customerMarket			=	$_POST['customerMarket'];
$accessTiming			=	$_POST['accessTiming'];
$economicTrends			=	$_POST['economicTrends'];
$techDevinnovation		=	$_POST['techDevinnovation'];
$ipRegulation			=	$_POST['ipRegulation'];
$industryFuture			=	$_POST['industryFuture'];
$ideaDevelopment		=	$_POST['ideaDevelopment'];
$FundingMilestones		=	$_POST['FundingMilestones'];
$project_budget			=	$_POST['project_budget'];

$pro_cover_img			=	$_FILES['pro_cover_img']['name'];
$pro_cover_vid			=	$_FILES['pro_cover_vid']['name'];




// INSERT SQL
$sql = "INSERT INTO mj_fund_post
		(fund_post_id,
		fund_usr_id_fk,
		fund_cat_id_fk,
		fund_post_title,
		fund_post_short_brief,
		fund_post_business_model,
		fund_post_customer_market,
		fund_post_accesstiming,
		fund_post_economic_trends,
		fund_post_tech_dev_inno,
		fund_post_ip_regulation,
		fund_post_industry_future,
		fund_post_idea_development,
		fund_post_project_budget,
		fund_post_funding_miles,
		fund_post_image,
		fund_post_date,
		fund_post_ended,
		fund_post_video,
		fund_post_ratup,
		fund_post_ratdown,
		fund_post_published) 
		VALUES 
		('',
		'$user_id',
		'$pro_cat',
		'$projectIdea',
		'$shortBrief',
		'$businessModel',
		'$customerMarket',
		'$accessTiming',
		'$economicTrends',
		'$techDevinnovation',
		'$ipRegulation',
		'$industryFuture',
		'$ideaDevelopment',
		'$project_budget',
		'$FundingMilestones',
		'$pro_cover_img',
		'',
		'$dateEnd',
		'$pro_cover_vid',
		'0',
		'0',
		'1'
		)";


$pro_result			=	mysql_query($sql);
$pro_new_id			=	mysql_insert_id();

echo $pro_new_id;


// REDIRECT
if (!$pro_result) {
	echo "Error";
} else {
	echo "inserted";

	// upload configuration
	$uplaod_dir			=	'uploads/project/';
	chmod($uplaod_dir, 0777);

	// Temp image path
	$pro_pic_temp		=	$_FILES['pro_cover_img']['tmp_name'];


	// move file to upload folder
	move_uploaded_file($pro_pic_temp, "$uplaod_dir$user_id-$getTimeStamp-$pro_cover_img");


	// QUery update path image
	$resultPictureUpdate = 
	mysql_query("UPDATE mj_fund_post SET fund_post_image =  '$uplaod_dir$user_id-$getTimeStamp-$pro_cover_img'
				WHERE fund_post_id = '$pro_new_id' ");


	// Respond	
	if (!$resultPictureUpdate) {
		echo "Cannot UPdate";
	} else {
		echo "Picture Updated";
	}

	/*----------------------------------------------------------------*/

	/**
	 * Upload video configuration
	 */

	/*----------------------------------------------------------------*/

	// Temp video path
	$pro_vid_temp		=	$_FILES['pro_cover_vid']['tmp_name'];


	// move file to upload folder
	move_uploaded_file($pro_vid_temp, "$uplaod_dir$user_id-$getTimeStamp-$pro_cover_vid");


	// QUery update path image
	$resultVideoUpdate = 
	mysql_query("UPDATE mj_fund_post SET fund_post_video =  '$uplaod_dir$user_id-$getTimeStamp-$pro_cover_vid'
				WHERE fund_post_id = '$pro_new_id' ");


	// Respond	
	if (!$resultVideoUpdate) {
		echo "Cannot UPdate";
	} else {
		echo "Video Updated";
	}


}




?>