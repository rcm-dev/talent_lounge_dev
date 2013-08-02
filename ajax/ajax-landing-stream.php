<ul>
<?php  


include '../db/db-connect.php';


function shortUpdate($text) { 

    // Change to the number of characters you want to display 
    $chars = 90; 

    $text = $text." "; 
    $text = substr($text,0,$chars); 
    $text = substr($text,0,strrpos($text,' '));

    if ($chars > 90) {
    	$text = $text."...";
    }
    else {
    	$text = $text."";
    }

     

    return $text; 

}

$cns = "SELECT mj_users.usr_name As pName,status_usr_id_fk,status_body AS pStatus,mj_users.usr_id AS uid,
  mj_users.usr_workat As pwAt,
  mj_users.user_pic As ppic 
  FROM 
  mj_status Inner Join
	  mj_users On mj_status.status_usr_id_fk = mj_users.usr_id
	  where status_date 
	  in(select max(status_date) from mj_status group by `status_usr_id_fk` ) order by RAND() desc limit 5";


$rcns = mysql_query($cns);

while ($rowcns = mysql_fetch_object($rcns)) { ?>

<div id="<?php echo $rowcns->uid; ?>" style="border-top:1px dotted #f1f1f1; width:450px; padding: 10px 0px;">
	
	<div class="left" style="margin-right: 20px">
		<a href="users.php?uid=<?php echo $rowcns->uid; ?>">
		<div class="profile-pic" style="background-image:url('<?php echo $rowcns->ppic; ?>');">
			
		</div><!-- /profile-pic48 -->
		</a>

	</div><!-- /profile-pic48 -->

	<div class="personame left" style="width:300px;">
			<strong><a href="users.php?uid=<?php echo $rowcns->uid; ?>" class="pname"><?php echo $rowcns->pName; ?></a></strong> &middot; <?php echo $rowcns->pwAt; ?><br>
			<p class="pstatus"><?php echo shortUpdate($rowcns->pStatus); ?></p>
	</div><!-- /personame -->

	<div class="clear"></div>
</div><!-- /uid -->



<?php 

}

?>
<div class="clear"></div>
</ul>