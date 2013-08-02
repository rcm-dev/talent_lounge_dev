<?php  



/**
 * PROJECT SUBMITED
 */



// INCLUDE EVERYTHING NEEDED
include '../db/db-connect.php';
//include '../class/api.php';


// function
// OUTPUT January-26-2012-11-17-44-am
$getTimeStamp		=	date("F-j-Y-g-i-s-a");
$lastLogin			=	date("Y-m-j g:i:s:a");


// 2 week Date + Time
$dateEnd = date("Y-m-d g:i:s", 
				mktime(
					date("G"), 
					date("i"), 
					date("s"), 
					date("m"), 
					date("d")+14, 
					date("Y"))
				);


// GET POST
$projectIdea	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['projectIdea'])));
$shortBrief	        =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['shortBrief'])));
$pro_cat	        =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['pro_cat'])));
$businessModel	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['businessModel'])));
$customerMarket	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['customerMarket'])));
$accessTiming	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['accessTiming'])));
$economicTrends	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['economicTrends'])));
$techDevinnovation	=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['techDevinnovation'])));
$ipRegulation	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['ipRegulation'])));
$industryFuture	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['industryFuture'])));
$ideaDevelopment	=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['ideaDevelopment'])));
$project_budget	    =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['project_budget'])));
$FundingMilestones	=	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['FundingMilestones'])));
$user_id	        =	mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['user_id'])));

//$pro_cover_img			=	$_FILES['pro_cover_img']['name'];
//$pro_cover_vid			=	$_FILES['pro_cover_vid']['name'];

$pro_cover_img			=	'images/projectCover.jpg';
$pro_cover_vid			=	'NULL';




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
		fund_post_ended,
		fund_post_video,
		fund_post_ratup,
		fund_post_ratdown,
		fund_view,
		fund_post_published,
		fund_post_success,
		fund_post_failed) 
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
		'$dateEnd',
		'$pro_cover_vid',
		'0',
		'0',
		'0',
		'0',
		'0',
		'0'
		)";


$pro_result			=	mysql_query($sql);
$pro_new_id			=	mysql_insert_id();

echo $pro_new_id;



?>