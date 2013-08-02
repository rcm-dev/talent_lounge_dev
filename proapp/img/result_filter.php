<?php  

/* Include header */
include 'header.php';
include 'db/db-connect.php';


// Query User
$usrSQL = "SELECT
  mj_users.user_pic As usrPicture,
  mj_users.usr_id,
  mj_users.usr_name As currName,
  mj_users.usr_workat,
  mj_users.usr_tel As currPhoneNo,
  mj_users.usr_general_info As CurGenInfo
From
  mj_users
Where
  mj_users.usr_id = '$usr_id'";

$rusrSQL = mysql_query($usrSQL);
$rowusrSQL = mysql_fetch_object($rusrSQL);

// Set page title
$page_name = "Filter Result";

// assign object
$curr_page_title = $page_name;




// get parameter from url form result filter
$a = mysql_real_escape_string(@$_GET['a']);
$p = mysql_real_escape_string(@$_GET['p']);
$s = mysql_real_escape_string(@$_GET['s']);
$c = mysql_real_escape_string(@$_GET['c']);

$f = mysql_real_escape_string(@$_GET['f']);
$i = mysql_real_escape_string(@$_GET['i']);
$c = mysql_real_escape_string(@$_GET['c']);
$e = mysql_real_escape_string(@$_GET['e']);

$h = mysql_real_escape_string(@$_GET['h']);
$s = mysql_real_escape_string(@$_GET['s']);
$d = mysql_real_escape_string(@$_GET['d']);

$f = mysql_real_escape_string(@$_GET['f']);
$s = mysql_real_escape_string(@$_GET['s']);
$i = mysql_real_escape_string(@$_GET['i']);
$r = mysql_real_escape_string(@$_GET['r']);




/**
 * DISC or APSC SINGLE
 * /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 */



// on only for DISC / APSC
if ($a == true) {
	
	if (@$_GET['sort'] == 'desc') {
		
		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE profile_filter.DISC LIKE '%a%'
					ORDER BY disc_d DESC";

	} else {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE profile_filter.DISC LIKE '%a%'";
	}
}





// on only for DISC
if ($p == true) {
	
	if (@$_GET['sort'] == 'desc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE profile_filter.DISC LIKE '%p%'
					ORDER BY disc_i DESC";

	} else {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE profile_filter.DISC LIKE '%p%'";
	}
}





// on only for DISC
if ($s == true) {

	if (@$_GET['sort'] == 'desc') {
	
		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE profile_filter.DISC LIKE '%s%'
					ORDER BY disc_s DESC";

	} else {
		
		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE profile_filter.DISC LIKE '%s%'";
	}
}





// one only for DISC
if ($c == true) {

	if (@$_GET['sort'] == 'desc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE profile_filter.DISC LIKE '%c%'
					ORDER BY disc_c DESC";

	} else {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE profile_filter.DISC LIKE '%c%'";
	}
}

/**
 * /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 */









/**
 * DISC DOUBLE
 * /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 */



// Two for DISC
if ($a == true && $p == true) {
	
	if (@$_GET['sort'] == 'adesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%a,p%' or profile_filter.DISC LIKE '%p,a%')
					ORDER BY disc_d DESC";

	} elseif (@$_GET['sort'] == 'pdesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%a,p%' or profile_filter.DISC LIKE '%p,a%')
					ORDER BY disc_i DESC";

	} else {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%a,p%' or profile_filter.DISC LIKE '%p,a%')";

	}
}


// Two for DISC
if ($a == true && $s == true) {
	
	if (@$_GET['sort'] == 'adesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%a,s%' or profile_filter.DISC LIKE '%s,a%')
					ORDER BY disc_d DESC";

	} elseif (@$_GET['sort'] == 'sdesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%a,s%' or profile_filter.DISC LIKE '%s,a%')
					ORDER BY disc_s DESC";

	} else {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%a,s%' or profile_filter.DISC LIKE '%s,a%')";

	}
}



// Two for DISC
if ($a == true && $c == true) {
	
	if (@$_GET['sort'] == 'adesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%a,c%' or profile_filter.DISC LIKE '%c,a%')
					ORDER BY disc_d DESC";

	} elseif (@$_GET['sort'] == 'cdesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%a,c%' or profile_filter.DISC LIKE '%c,a%')
					ORDER BY disc_c DESC";

	} else {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%a,c%' or profile_filter.DISC LIKE '%c,a%')";

	}
}



// Two for DISC
if ($p == true && $s == true) {
	
	if (@$_GET['sort'] == 'pdesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%p,s%' or profile_filter.DISC LIKE '%s,p%')
					ORDER BY disc_i DESC";

	} elseif (@$_GET['sort'] == 'sdesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%p,s%' or profile_filter.DISC LIKE '%s,p%')
					ORDER BY disc_s DESC";

	} else {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%p,s%' or profile_filter.DISC LIKE '%s,p%')";

	}
}



// Two for DISC
if ($p == true && $c == true) {
	
	if (@$_GET['sort'] == 'pdesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%p,c%' or profile_filter.DISC LIKE '%c,p%')
					ORDER BY disc_i DESC";

	} elseif (@$_GET['sort'] == 'cdesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%p,c%' or profile_filter.DISC LIKE '%c,p%')
					ORDER BY disc_c DESC";

	} else {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%p,c%' or profile_filter.DISC LIKE '%c,p%')";

	}
}




// Two for DISC
if ($s == true && $c == true) {

	if (@$_GET['sort'] == 'sdesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%s,c%' or profile_filter.DISC LIKE '%c,s%')
					ORDER BY disc_s DESC";

	} elseif (@$_GET['sort'] == 'cdesc') {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%s,c%' or profile_filter.DISC LIKE '%c,s%')
					ORDER BY disc_c DESC";

	} else {

		// query the profile_filter table based on DISC 'A' only
		$query = "SELECT profile_filter.*, 
					mj_users.*
					FROM profile_filter 
					INNER JOIN mj_users ON profile_filter.user_id_fk = mj_users.usr_id
					WHERE (profile_filter.DISC LIKE '%s,c%' or profile_filter.DISC LIKE '%c,s%')";
	}
}




/**
 * /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 */







$result_filter = mysql_query($query);
$num_rows_filter = mysql_num_rows($result_filter);





// get current url function
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}



?>
<?php include 'quickpost.php'; ?>
<div id="contentContainer" style="padding:30px">
	
	<div class="left">
		
	</div>
	<div class="left" style="">
		<h1 class="heading_title" style="margin-top:20px !important;">
		<?php echo $page_name; ?></h1>
	</div>
	<div class="clear"></div>

	<br>

	<div class="ui-window">
		<?php if ($num_rows_filter == 0): ?>
			<p>No Student.</p>
		<?php endif ?>

		<?php if ($num_rows_filter != 0): ?>

			<?php if ($a == true && $p == false && $s == false && $c == false): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=desc">Filter Highest 1st</a>
				</p>
			<?php endif ?>
			<?php if ($a == false && $p == true && $s == false && $c == false): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=desc">Filter Highest 1st</a>
				</p>
			<?php endif ?>
			<?php if ($a == false && $p == false && $s == true && $c == false): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=desc">Filter Highest 1st</a>
				</p>
			<?php endif ?>
			<?php if ($a == false && $p == false && $s == false && $c == true): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=desc">Filter Highest 1st</a>
				</p>
			<?php endif ?>




			<?php if ($a == true && $p == true): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=adesc">Filter [A] Highest 1st</a> | <a href="<?php echo curPageURL(); ?>&amp;sort=pdesc">Filter [P] Highest 1st</a>
				</p>
			<?php endif ?>

			<?php if ($a == true && $s == true): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=adesc">Filter [A] Highest 1st</a> | <a href="<?php echo curPageURL(); ?>&amp;sort=sdesc">Filter [S] Highest 1st</a>
				</p>
			<?php endif ?>

			<?php if ($a == true && $c == true): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=adesc">Filter [A] Highest 1st</a> | <a href="<?php echo curPageURL(); ?>&amp;sort=cdesc">Filter [C] Highest 1st</a>
				</p>
			<?php endif ?>



			<?php if ($p == true && $s == true): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=pdesc">Filter [P] Highest 1st</a> | <a href="<?php echo curPageURL(); ?>&amp;sort=sdesc">Filter [S] Highest 1st</a>
				</p>
			<?php endif ?>

			<?php if ($p == true && $c == true): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=pdesc">Filter [P] Highest 1st</a> | <a href="<?php echo curPageURL(); ?>&amp;sort=cdesc">Filter [C] Highest 1st</a>
				</p>
			<?php endif ?>




			<?php if ($s == true && $c == true): ?>
				<p>
					<strong>Filter Option:</strong> <a href="<?php echo curPageURL(); ?>&amp;sort=sdesc">Filter [S] Highest 1st</a> | <a href="<?php echo curPageURL(); ?>&amp;sort=cdesc">Filter [C] Highest 1st</a>
				</p>
			<?php endif ?>


			
			<br>
			<strong style="color:green"><?php echo $num_rows_filter; ?> student(s) matched</strong>
			<br>
			<br>

			<ul id="studentReportCard">
				<?php while ($rows_filter = mysql_fetch_object($result_filter)) { ?>
					
					<li>
						<div style="float:left">
							<img src="<?php echo $rows_filter->user_pic ?>" alt="" style="max-width:70px;max-height:70px;">
						</div>
						<div style="float:right; height:100%; width:320px;">
							<?php if ($rows_filter->users_fname == NULL && $rows_filter->users_lname == NULL) { ?>
								<strong style="font-size:18px; color:#437ead;"><?php echo $rows_filter->usr_name; ?></strong>
							<?php } else { ?>
								<strong style="font-size:18px; color:#437ead;"><?php echo $rows_filter->users_fname; ?> <?php echo $rows_filter->users_lname; ?></strong>
							<?php } ?>
							<br>
							<?php echo $rows_filter->usr_email; ?><br>
							<br>
							<strong>View:</strong> <span><a href="proapp/report_employer.php?uid=<?php echo $rows_filter->user_id_fk; ?>" title="Employer Report" target="_blank">Employer Report</a></span> &middot; <span><a href="proapp/career-report.php?uid=<?php echo $rows_filter->user_id_fk; ?>" title="Career Report" target="_blank">Career Report</a></span>
							<br>
							<!-- <span><?php echo $rows_filter->disc_d ?></span> -->
						</div>
						<div style="clear"></div>
					</li>

				<?php } ?>
			</ul>

		<?php endif ?>
	</div>
	
</div>


<!-- Page Title -->
<input type="hidden" name="page_title" value="<?php echo $curr_page_title; ?>" id="page_title" />

<!-- get current email -->
<input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>" />



<script>
	/* get current email */
	var current_email = $('input#current_email').val();

	if (current_email == '') {
		$('body').css('display', 'none');
		document.location.href = "index.php";
		console.log('Not Login');
	}
	else {
		console.log("Current Email => "+current_email);
	}
</script>

<?php  

/* Include header */
include 'footer.php';

?>