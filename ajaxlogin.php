<?php

// include db
//include 'db/db-connect.php';




// get value






// query checking







// result



?>

<?php

if ($_POST) {
	
	$email = $_POST['email'];
	$password = $_POST['password'];

	if ($email == 'demo' && $password == 'demo') {
		
		echo "success";
	}
}

?>