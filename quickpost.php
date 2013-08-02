<?php if (isset($usr_email)) { ?>

<div id="quickPostStatus" class="centerPost">
		<div class="center" style="padding: 5px 0px;">
			<div class="left" >
				<form action="#" method="post">
					<div class="profile-pic48" style="background-image: url('<?php echo $rowusrSQL->usrPicture; ?>'); float:left; margin-right: 10px;">
	    			</div>
	    			<div class="right">
	    				<div id="qPs" class="left">
	    					<input type="hidden" name="onlineUsrID" id="onlineUsrID" value="<?php echo $usr_id; ?>">
	    					<textarea name="updatestatus" id="updatestatus" class="updatestatus" placeholder="What's going on now..?"></textarea>
	    				</div>
	    				<div class="right btnPost">
	    					<input type="submit" name="submitPost" id="submitPost" class="tl-btn-blue" style="font-weight:bold; padding: 10px 30px;" value="Update Status">
	    				</div>
	    				<div class="clear"></div>
	    			</div><!-- / -->
	    			<div class="clear"></div>
				</form>
			</div><!-- /left -->

			<div class="right">
				<div id="quickPostWorldStream" class="none">
					<ul id="quickPostUI" class="marquee">
					<?php  

					// Get second
					function realtime($timestap) {
					        
					    $realtime = strtotime($timestap);

					    return $realtime;
					}

					// 12 min ago..
					function time_since($time) {


					    $original = realtime($time);

					    // array of time period chunks
					    $chunks = array(
					    array(60 * 60 * 24 * 365 , 'year'),
					    array(60 * 60 * 24 * 30 , 'month'),
					    array(60 * 60 * 24 * 7, 'week'),
					    array(60 * 60 * 24 , 'day'),
					    array(60 * 60 , 'hour'),
					    array(60 , 'min'),
					    array(1 , 'sec'),
					    );
					 
					    $today = time(); /* Current unix time  */
					    $since = $today - $original;
					 
					    // $j saves performing the count function each time around the loop
					    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
					 
					    $seconds = $chunks[$i][0];
					    $name = $chunks[$i][1];
					 
					    // finding the biggest chunk (if the chunk fits, break)
					    if (($count = floor($since / $seconds)) != 0) {
					        break;
					    }
					    }
					 
					    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
					 
					    if ($i + 1 < $j) {
					    // now getting the second item
					    $seconds2 = $chunks[$i + 1][0];
					    $name2 = $chunks[$i + 1][1];
					 
					    // add second item if its greater than 0
					    if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0) {
					        $print .= ($count2 == 1) ? ', 1 '.$name2 : " $count2 {$name2}s ago";
					    }
					    }
					    return $print;
					}
					//include '../db/db-connect.php';

					// shortupdate
					function shortMsg2($text) { 

				        // Change to the number of characters you want to display 
				        $chars = 30; 

				        $text = $text." "; 
				        $text = substr($text,0,$chars); 
				        $text = substr($text,0,strrpos($text,' ')); 
				        $text = $text."..."; 

				        return $text; 

				    }

					$cns = "SELECT mj_users.usr_name As pName,
					status_usr_id_fk,
					status_body AS pStatus,
					status_date AS pStatTime,
					mj_users.usr_id AS uid,
					  mj_users.usr_workat As pwAt,
					  mj_users.user_pic As ppic 
					  FROM 
					  mj_status Inner Join
						  mj_users On mj_status.status_usr_id_fk = mj_users.usr_id
						  where status_usr_id_fk != '$usr_id' AND status_date 
						  in(select max(status_date) from mj_status group by `status_usr_id_fk` ) order by status_date desc limit 5";


					$rcns = mysql_query($cns);

					while ($rowcns = mysql_fetch_object($rcns)) { ?>

					<li style="list-style:none">
					<div id="<?php echo $rowcns->uid; ?>" style="border-top:0px dotted #f1f1f1; width:290px; padding: 0px 0px; margin-bottom:10px;">
						
						<div class="left" style="margin-right: 10px; margin-top:0px;">
							<a href="users.php?uid=<?php echo $rowcns->uid; ?>">
							<div class="profile-pic32" style="background-image:url('<?php echo $rowcns->ppic; ?>');">
								
							</div><!-- /profile-pic48 -->
							</a>

						</div><!-- /profile-pic48 -->

						<div class="personame left" style="width:220px;">
								<strong><a href="users.php?uid=<?php echo $rowcns->uid; ?>" style="color:#78A7ED; font-size:12px;"><?php echo $rowcns->pName; ?></a></strong> &middot; <span style="color:#A8AA9B; font-size:11px;"><?php echo $rowcns->pwAt; ?></span><br>
								<p style="color:#D7D8D1; font-size:11px; display: inline-block"><?php echo shortMsg2($rowcns->pStatus); ?>
								<span style="color:#CC77CE"><?php echo time_since($rowcns->pStatTime); ?></span></p>
						</div><!-- /personame -->

						<div class="clear"></div>
					</div><!-- /uid -->
					</li>


					<?php 

					}

					?>
					<div class="clear"></div>
					</ul>
				</div><!-- /intervalStream -->
			</div><!-- /right -->
			<div class="clear"></div>
		</div><!-- /center -->
	</div><!-- /quickPostStatus -->

<?php } ?>