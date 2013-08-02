<?php  


// ==================================================================
//
// DB
//
// ------------------------------------------------------------------

include '../db/db-connect.php';






// ==================================================================
//
// Get market id
//
// ------------------------------------------------------------------

$market_id		  = mysql_real_escape_string(stripslashes(htmlspecialchars($_GET['mid'])));




// ==================================================================
//
// SELECT review by id
//
// ------------------------------------------------------------------

$queryRiview 	  = "SELECT
					  mj_users.usr_name As Reviewer,
					  mj_market_review.mr_reviewbody As reviewtext,
					  mj_market_review.mr_date_submited As reviewDate
					From
					  mj_market_review Inner Join
					  mj_users On mj_market_review.mr_usr_id_fk = mj_users.usr_id
					Where
					  mj_market_review.mr_mpost_id_fk = '$market_id'
					Order By
					  mj_market_review.mr_date_submited ASC";
$resultRiview	  = mysql_query($queryRiview);





// ==================================================================
//
// Output
//
// ------------------------------------------------------------------

$numrowResult	  = mysql_num_rows($resultRiview);



/* if available */
if ($numrowResult != 0) {


	/* total responses */
	echo '<strong>'.$numrowResult.' response(s) for this advertisement.</strong>';

	/* UL */
	echo "<ul class=\"reviewUI\">";

	while ($rowReview = mysql_fetch_object($resultRiview)) {
		

		/* li */
		echo "<li>";
		echo "<p>".$rowReview->Reviewer." - ".$rowReview->reviewDate."</p>";
		echo "<p>".$rowReview->reviewtext."</p>";
		echo "</li>";


	}


	/* /UL */
	echo "</ul>";

	echo '<div class="clear"></div>';


} else {


	echo "No review yet.";


}


?>