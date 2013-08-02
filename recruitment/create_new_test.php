<?php require_once('Connections/conJobsPerak.php'); ?>
<?php  
	
session_start();	
$userID = $_SESSION['MM_UserID'];

?>
<h3>New Test</h3>

<form action="#" id="formNewTest" method="post">
	<label for="Test Name">Test Name</label><br>
	<input type="text" name="testName" id="testName"><br><br>

	<label for="Test Description">Description</label><br>
	<textarea name="testDescription" id="testDescription" cols="30" rows="10"></textarea><br>

	<label for="Score">Scores</label><br>
	<input type="text" name="testScore" id="testScore"><br>

	<input type="hidden" name="testUserID" id="testUserID" value="<?php echo $userID; ?>">

	<br>
	<input type="submit" id="submitNewTest" value="Save New Test" class="button green">
</form>

<div class="newTestDone"></div>