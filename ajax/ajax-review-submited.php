<?php  



// included
include '../db/db-connect.php';





// ==================================================================
//
// Get value
//
// ------------------------------------------------------------------
$usrIdFK    = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['currusrid'])));
$reviewBody = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['reviewBody'])));
$marketIdFK = mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['marketIdFK'])));





// ==================================================================
//
// insert review
//
// ------------------------------------------------------------------
$insertRiview = "INSERT INTO mj_market_review (mr_id, mr_usr_id_fk, mr_reviewbody, mr_mpost_id_fk)
				VALUES ('', '$usrIdFK', '$reviewBody', '$marketIdFK')";

$resultRiview = mysql_query($insertRiview);





?>