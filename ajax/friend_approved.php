<?php  


include '../db/db-connect.php';

$approveUsrID 		   = $_POST['approveUsrID'];
$approvedBy            = $_POST['approvedBy'];
$approved	           = 0;


$sqlFriendApproved     = "UPDATE mj_usr_network SET usr_network_approved = '$approved' 
					WHERE usr_network_usr_id_fk = '$approveUsrID' AND usr_network_friend_usr_id_fk = '$approvedBy'";
$resultOne			   = mysql_query($sqlFriendApproved);

$sqlFriendApprovedBack = "UPDATE mj_usr_network SET usr_network_approved = '$approved' 
					WHERE usr_network_usr_id_fk = '$approvedBy' AND usr_network_friend_usr_id_fk = '$approveUsrID'";
$resultTwo			   = mysql_query($sqlFriendApprovedBack);


if ($resultOne && $resultTwo) {
	echo 'Friend Approved';
}
else {
	echo 'SQL Error!';
}


// echo $sqlFriendApproved."<br/>";

// echo $sqlFriendApprovedBack;

?>