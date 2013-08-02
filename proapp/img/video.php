<?php  


include 'header.php';
include 'db/db-connect.php';

$qRandIdea		=	"SELECT
					  mj_idea_post.id_pictures As Picture,
					  mj_idea_post.id_post_id As picId,
					  mj_idea_post.id_title As ideaTitle,
					  mj_idea_post.id_desc,
					  mj_idea_post.id_usr_id_fk As usrIdFK,
					  mj_users.usr_name As usrName,
					  mj_users.user_pic As usrPic,
					  mj_idea_post.id_rat_up As ideaLove
					From
					  mj_idea_post Inner Join
					  mj_users On mj_idea_post.id_usr_id_fk = mj_users.usr_id
					Where
					  mj_idea_post.id_post_published = 1
					Order By
					  RAND()
					Limit 15";

$rqRandIdea	=	mysql_query($qRandIdea);

//$rowqRandIdea = mysql_fetch_object($rqRandIdea);



$query_rsCategoryArticle = "SELECT * FROM mj_learn_article_category";
$rsCategoryArticle = mysql_query($query_rsCategoryArticle) or die(mysql_error());
$row_rsCategoryArticle = mysql_fetch_assoc($rsCategoryArticle);
$totalRows_rsCategoryArticle = mysql_num_rows($rsCategoryArticle);



// query video
$query_user       = "SELECT * FROM video";
$result_user      = mysql_query($query_user);
$total_rows_user  = mysql_num_rows($result_user);


?>

<head>
	<title>How-To Be..</title>

	<style>

	body {
		font-family:"Arial";
		background-color: #eaeaea;
	}

	a {
		color: #333;
		text-decoration: none;
	}

	a:hover {
		text-decoration: underline;
	}

	ul#vid_ui {
		border:0px solid red;
		margin:0;padding:0;

		width: 800px;
	}

	ul#vid_ui li {
		width: 220px;
		min-height: 100px;
		display: inline-block;
		list-style: none;
		border:1px solid #eaeaea;
		border-bottom: 2px solid #bababa;
		padding: 2px;
		padding-top: 8px;
		margin: 10px;
		text-align: center;
		background-color: white;
	}

	#container2{
		background-color: #fafafa;
	}

	ul#vid_ui li:hover {
		background-color: #fafafa;
	}

	.cat_name {
		text-align:center;
		font-size: 11px;
		margin-bottom: 5px;
	}

	h5 {
		margin:10px 0px 5px 0px;
	}

	</style>

</head>
<body>


<div id="content" class="">

	<?php include 'quickpost.php'; ?>
	
  <div id="contentContainer" width="1000">







<br>
<br>



<h1>Karier Bantuan</h1>
<div id="container2">


<!-- 

	Landmark 
	
	/**

	// embed URL utube
	http://www.youtube.com/embed/<youtube-id-from-database>

	// get current image utube
	http://img.youtube.com/vi/<youtube-id-from-database>/hqdefault.jpg



-->







		<?php if ($total_rows_user == 0): ?>
			
			<p>
				No data
			</p>

		<?php endif // end if row user 0 ?>

		<?php if ($total_rows_user != 0): ?>
			
			<ul  id="vid_ui">
			
				<?php while($object_user = mysql_fetch_object($result_user)) { ?>
		
						<li >
							<a href=<?php echo $object_user->video_url; ?></>
							<img src=<?php echo $object_user->video_image; ?> width="160" height="108">
							<h5><?php echo $object_user->video_title; ?></h5>
							</a>
							<div class="cat_name" align="center">Category: <i><?php echo $object_user->video_category; ?></i></div>
	</li>

				<?php } // end while ?>
			
			</ul>

		<?php endif ?>



		</div>
</div>
<?php  





/**
 * Include Footer
 */



include 'footer.php';


?>
</body>
</html>

<!-- Type
MIME Type	text/html
Resource Type	Document
Location
Full URL	file:///Users/HaryanaHakim/Library/Containers/com.apple.mail/Data/Library/Mail%20Downloads/vid_ui.html
Scheme	file
Path	/Users/HaryanaHakim/Library/Containers/com.apple.mail/Data/Library/Mail%20Downloads/vid_ui.html
Filename	vid_ui.html
 -->
