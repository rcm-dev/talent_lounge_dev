<?php require_once('../Connections/conJobsPerak.php'); ?>
<?php  
	
session_start();	
$userID = $_SESSION['MM_UserID'];

?>
<h3>New Test</h3>

<form action="#" id="formNewTest" method="post">
	<label for="Test Name">Test Name</label>
	<input type="text" name="testName" id="testName">

	<label for="Test Description">Description</label>
	<textarea name="testDescription" id="testDescription" cols="30" rows="10"></textarea>

	<label for="Score">Scores</label>
	<input type="text" name="testScore" id="testScore">

	<input type="hidden" name="testUserID" id="testUserID" value="<?php echo $userID; ?>">

	<br>
	<input type="submit" id="submitNewTest" value="Save New Test">
</form>

<div class="newTestDone"></div>