<?php 
include 'db/db-connect.php';
 ?>
<?php  

// get id via parameter



$catIndustryID     = $_GET['catID'];
$stateIndustryID  = $_GET['stateID'];

$industryServiceID  = $_GET['serviceID'];


// display id and query list directoty
   

// all filter
if($catIndustryID == 0 && $stateIndustryID == 0 && $industryServiceID == 0){
$query_list = "SELECT
           mj_fund_post.*,
           mj_users.usr_name As userName,
          
           mj_users.mj_sector_fk,
           mj_users.mj_state_fk,
           mj_fund_post.fund_post_image As picturePost,
           mj_users.usr_workat As workat,
           mj_services.services_name As service,
           mj_sector.sec_name As sector,
           mj_state.state_name As state
            
          From
            mj_users Inner Join
            mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
            Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
            Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
            Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id";

  
}

// filter industry only
if($catIndustryID != 0 && $stateIndustryID  == 0 && $industryServiceID == 0){
 $query_list = "SELECT
           mj_fund_post.*,
           mj_users.usr_name As userName,
          
           mj_users.mj_sector_fk,
           mj_users.mj_state_fk,
           mj_fund_post.fund_post_image,
           mj_users.usr_workat As workat,
           mj_services.services_name As service,
           mj_sector.sec_name As sector,
           mj_state.state_name As state
            
          From
            mj_users Inner Join
            mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
            Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
            Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
            Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
  mj_sector.sec_id = '$catIndustryID'";


}

// filter state only
if($catIndustryID == 0 && $stateIndustryID != 0 && $industryServiceID == 0){
$query_list = "SELECT
           mj_fund_post.*,
           mj_users.usr_name As userName,
          
           mj_users.mj_sector_fk,
           mj_users.mj_state_fk,
           mj_fund_post.fund_post_image,
           mj_users.usr_workat As workat,
           mj_services.services_name As service,
           mj_sector.sec_name As sector,
           mj_state.state_name As state
            
          From
            mj_users Inner Join
            mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
            Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
            Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
            Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
  mj_state.state_id = '$stateIndustryID'";

}


// filter service only
if($catIndustryID == 0 && $stateIndustryID == 0 && $industryServiceID != 0){
$query_list = "SELECT
           mj_fund_post.*,
           mj_users.usr_name As userName,
          
           mj_users.mj_sector_fk,
           mj_users.mj_state_fk,
           mj_fund_post.fund_post_image,
           mj_users.usr_workat As workat,
           mj_services.services_name As service,
           mj_sector.sec_name As sector,
           mj_state.state_name As state
            
          From
            mj_users Inner Join
            mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
            Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
            Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
            Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
  mj_services.services_id = '$industryServiceID'";

}

// filter industry and state
if($catIndustryID != 0 && $stateIndustryID != 0 && $industryServiceID == 0){
$query_list = "SELECT
           mj_fund_post.*,
           mj_users.usr_name As userName,
          
           mj_users.mj_sector_fk,
           mj_users.mj_state_fk,
           mj_fund_post.fund_post_image,
           mj_users.usr_workat As workat,
           mj_services.services_name As service,
           mj_sector.sec_name As sector,
           mj_state.state_name As state
            
          From
            mj_users Inner Join
            mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
            Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
            Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
            Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
    mj_sector.sec_id = '$catIndustryID' AND 
    mj_state.state_id = '$stateIndustryID'";

}


// filter industry and service
if($catIndustryID != 0 && $stateIndustryID == 0 && $industryServiceID != 0){
$query_list = "SELECT
           mj_fund_post.*,
           mj_users.usr_name As userName,
          
           mj_users.mj_sector_fk,
           mj_users.mj_state_fk,
           mj_fund_post.fund_post_image,
           mj_users.usr_workat As workat,
           mj_services.services_name As service,
           mj_sector.sec_name As sector,
           mj_state.state_name As state
            
          From
            mj_users Inner Join
            mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
            Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
            Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
            Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
    mj_sector.sec_id = '$catIndustryID' AND 
    mj_services.services_id = '$industryServiceID'";

}


// filter state and service
if($catIndustryID == 0 && $stateIndustryID != 0 && $industryServiceID != 0){
$query_list = "SELECT
           mj_fund_post.*,
           mj_users.usr_name As userName,
          
           mj_users.mj_sector_fk,
           mj_users.mj_state_fk,
           mj_fund_post.fund_post_image,
           mj_users.usr_workat As workat,
           mj_services.services_name As service,
           mj_sector.sec_name As sector,
           mj_state.state_name As state
            
          From
            mj_users Inner Join
            mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
            Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
            Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
            Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
    mj_state.state_id = '$stateIndustryID' AND 
    mj_services.services_id = '$industryServiceID'";

}
// filter all part
if($catIndustryID != 0 && $stateIndustryID != 0 && $industryServiceID != 0){
$query_list = "SELECT
           mj_fund_post.*,
           mj_users.usr_name As userName,
          
           mj_users.mj_sector_fk,
           mj_users.mj_state_fk,
           mj_fund_post.fund_post_image,
           mj_users.usr_workat As workat,
           mj_services.services_name As service,
           mj_sector.sec_name As sector,
           mj_state.state_name As state
            
          From
            mj_users Inner Join
            mj_fund_post On mj_users.users_id = mj_fund_post.fund_usr_id_fk
            Inner Join mj_services On mj_users.mj_services_fk = mj_services.services_id
            Inner Join mj_sector On mj_users.mj_sector_fk = mj_sector.sec_id
            Inner Join mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
    mj_state.state_id = '$stateIndustryID' AND 
    mj_sector.sec_id = '$catIndustryID' AND 
    mj_services.services_id = '$industryServiceID'";

}

$result_list             = mysql_query($query_list) or die(mysql_error());

$total_row_list   = mysql_num_rows($result_list);



if ($total_row_list == 0)
  { ?>
    <div class="cnscontainerPlain left">
   <div id="searchResult3" class="">

      <div id="inventcontent">


        <div style="padding: 10px 0px">
          <h3 id="cs01">Submission(s)</h3>
        </div>

        <div style="padding: 30px 0px;">
           <h3 align ="center"> No showcase </h3>
        </div>
        
        <div>
        </div>


<?php   } 


 else{
  ?>
 <div class="cnscontainerPlain left">
   <div id="searchResult3" class="">

      <div id="inventcontent">


        <div style="padding: 10px 0px">
          <h3 id="cs01">Submission(s)</h3>
        </div>

        <div style="padding: 30px 0px;">
            <ul class="idea-new-ui">
           <?php while ($rowrandProject = mysql_fetch_object($result_list)) { ?>              
              <li>
                <div class="ideaContainer">
                  <div class="ideaFrame">
                    <div class="ideaFrameImage">
                    <!-- <a class="call-inventcat" href="<?php //echo urlencode($rowqRandIdea->ideaTitle); ?>-idea-<?php// echo $rowqRandIdea->picId; ?>.html" rel="<?php //echo $rowqRandIdea->picId; ?>"> -->
                    <a class="call-inventcat" href="idea-details.php?id=<?php echo $rowrandProject->fund_post_id; ?>" rel="<?php echo $rowrandProject->fund_post_image; ?>">

                      <img src="<?php echo $rowrandProject->fund_post_image; ?>" width="100%" original-title="<?php echo $rowrandProject->fund_post_title; ?>">
                    </a>
                    </div>
                    <div id="idMis" class="ideaMisc">
                      <div class="left multimedia">
                        <img src="images/icon_grey/ic_attachment.png" original-title="Multimedia Included" alt="Multimedia"  height="14" width="14">
                      </div><!-- /attach -->
                      <div class="right comment">
                        <span>
                          <img src="images/icon_grey/ic_chats.png" style="margin-top:2px; margin-left:-20px; position:absolute"  original-title="Comments"/>
                          <?php  

                          $qComment = "SELECT
                                  Count(mj_idea_comment.id_usr_id_fk) As totalComment
                                From
                                  mj_idea_comment
                                Where
                                  mj_idea_comment.id_post_id_fk = '$rowrandProject->fund_post_id'";
                          $rqComment=mysql_query($qComment);
                          $rowqComment=mysql_fetch_object($rqComment);

                          echo number_format($rowqComment->totalComment);

                          ?>
                        </span>
                      </div><!-- /comment -->
                      <div class="right like" style="margin-right:20px">
                        <span>
                          <img src="images/icon_grey/ic_favorite.png" style="margin-top:2px; margin-left:-20px; position:absolute"  original-title="Likes"/>
                          <?php echo number_format($rowrandProject->ideaLove); ?></span>
                      </div><!-- /like -->
                      <div class="clear"></div>
                    </div><!-- /ideaMisc -->
                    <div class="clear"></div>
                  </div>
                </div><!-- /ideaContainer -->
                <div class="ideaByUser">
                  <a href="users.php?uid=<?php echo $rowrandProject->usrIdFK; ?>" title="<?php echo $rowrandProject->usrName; ?>">
                    <div class="pradius" style="background-image: url('<?php echo $rowrandProject->usrPic; ?>');">
                    </div>
                    <strong><?php echo $rowrandProject->usrName; ?></strong>
                  </a>
                </div>
              </li>
              
            <?php } ?>
              <div class="clear"></div>
          </ul>
        </div>
        
        <div>
        </div>

<?php } ?>




 <script>
  $(document).ready(function(){
$('#projectListed').jscroll({
    loadingHtml: '<img src="loading.gif" alt="Loading" /> Loading...',
    padding: 20,
    nextSelector: 'a.jscroll-next:last',
    contentSelector: 'li'
});

    });

  });
</script>




