<?php  



include 'dbconnect.php';

$querymedia = "SELECT * FROM media";
$result = mysql_query($querymedia);


echo "<h4>Media</h4>";

while ($row = mysql_fetch_object($result)) {
	

	echo '<img src="'.$row->m_path.'" />';

}


?>