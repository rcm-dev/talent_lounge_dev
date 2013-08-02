<?php  



include '../db/db-connect.php';


// ==================================================================
//
// Get string
//
// ------------------------------------------------------------------


$ideaprice	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['ideaprice'])));
$ideaIdFK 	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['ideaIdFK'])));
$usrIdFK  	= mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['usrIdFK'])));



// ==================================================================
//
// Run query
//
// ------------------------------------------------------------------

$insertQuery = "INSERT INTO mj_idea_price (ip_id, usr_id_fk, mrket_post_id_fk, ip_price)
				VALUES ('', '$usrIdFK', '$ideaIdFK', '$ideaprice')";

$result		 = mysql_query($insertQuery);


$queryPrice = "SELECT
			  mj_users.usr_name As suggestName,
			  mj_idea_price.ip_price As suggestPrice
			From
			  mj_idea_price Inner Join
			  mj_users On mj_idea_price.usr_id_fk = mj_users.usr_id
			Where
			  mj_idea_price.mrket_post_id_fk = '$ideaIdFK'
			ORDER BY mj_idea_price.ip_price ASC";

$resultPrice= mysql_query($queryPrice);
?>


<div id="tblePrice">
<table border="1">
	<thead>
		<tr>
			<th>Suggestion by</th>
			<th>Price</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($rowPrice = mysql_fetch_object($resultPrice)) { ?>
			
		<tr>
			<td><?php echo $rowPrice->suggestName; ?></td>
			<td><?php echo $rowPrice->suggestPrice; ?></td>
		</tr>

		<?php } ?>
	</tbody>
</table>
</div>