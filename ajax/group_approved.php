<?php  


include '../db/db-connect.php';

$approveUsrID 		   = $_POST['groupidfk'];
$approvedBy            = $_POST['approvedBy'];
$approved	           = 1; // joined


$sqlFriendApproved     = "UPDATE mj_network_relation SET mnr_status = '$approved' 
					WHERE mn_id_fk = '$approveUsrID' AND usr_id_fk = '$approvedBy'";
$resultOne			   = mysql_query($sqlFriendApproved);

// $sqlFriendApprovedBack = "UPDATE mj_usr_network SET usr_network_approved = '$approved' 
// 					WHERE usr_network_usr_id_fk = '$approvedBy' AND usr_network_friend_usr_id_fk = '$approveUsrID'";
// $resultTwo			   = mysql_query($sqlFriendApprovedBack);


if ($resultOne) {
	echo 'You is now joined this group.';
}
else {
	echo 'SQL Error!';
}


// echo $sqlFriendApproved."<br/>";

// echo $sqlFriendApprovedBack;

?>