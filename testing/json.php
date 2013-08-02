<html>
<head>
	<title>jSon</title>
</head>
<body>
<?php  



include 'dbconnect.php';

$sql = "SELECT * FROM comment";
$result = mysql_query($sql);

while ($row = mysql_fetch_object($result)) {
	echo $row->com_body.'<br/>';
}



$rows = array();

while ($r = mysql_fetch_assoc($result)) {
	$rows[] = $r;

	echo json_encode($rows);
}
?>


</body>
</html>