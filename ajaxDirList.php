<?php 
include 'db/db-connect.php';
 ?>
<?php  


// get id via parameter



$catIndustryID     = $_GET['catID'];
$stateIndustryID  = $_GET['stateID'];


// display id and query list directoty
   


if($catIndustryID != 0 && $stateIndustryID  != 0){
$query_list = "SELECT
  mj_users.*,
  jp_employer.*,
  jp_industry.*,
  mj_state.*
From
  mj_users Inner Join
  jp_employer On jp_employer.users_id_fk = mj_users.users_id Inner Join
  jp_industry On jp_employer.emp_industry_id_fk = jp_industry.indus_id
  Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
  mj_state.state_id = '$stateIndustryID' And
  jp_industry.indus_id = '$catIndustryID'";
}

if($catIndustryID == 0 && $stateIndustryID  != 0){
  $query_list = "SELECT
  mj_users.*,
  jp_employer.*,
  jp_industry.*,
  mj_state.*
From
  mj_users Inner Join
  jp_employer On jp_employer.users_id_fk = mj_users.users_id Inner Join
  jp_industry On jp_employer.emp_industry_id_fk = jp_industry.indus_id
  Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
  mj_state.state_id = '$stateIndustryID' ";


}

if($catIndustryID != 0 && $stateIndustryID  == 0){
$query_list = "SELECT
  mj_users.*,
  jp_employer.*,
  jp_industry.*,
  mj_state.*
From
  mj_users Inner Join
  jp_employer On jp_employer.users_id_fk = mj_users.users_id Inner Join
  jp_industry On jp_employer.emp_industry_id_fk = jp_industry.indus_id
  Inner Join
  mj_state On mj_users.mj_state_fk = mj_state.state_id
Where
  jp_industry.indus_id = '$catIndustryID'";

}

$result_list             = mysql_query($query_list) or die(mysql_error());

$total_row_list   = mysql_num_rows($result_list);



if ($total_row_list == 0)
  { 
   echo 'no company';


 }


 else{
  ?>
 <div id="projectListed" class="pro-containerEx1">
            
          <ul class="comp_advert">
                        

            <?php while ($rowrandProject = mysql_fetch_object($result_list)) { ?>
              
              <li class="ui-window">
                <div class="project-item1">
                  <div class="project-visual1">

                    <div class="project-visual-container1">
                    <div class="project-visual-top1">
                    <!-- <a href="<?php //echo urlencode($rowrandProject->proTitle); ?>-project-<?php //echo $rowrandProject->proId; ?>.html"> -->
                    <div align ="center">
                   <strong style="color:#800000; font-size:17px; font-family:Arial"><a href="employer.php?emp_id=<?php echo $rowrandProject->emp_id_fk ?>&employer=<?php echo $rowrandProject->emp_name ?>"><?php echo $rowrandProject->emp_name ?></a></strong><br/>

                                          <br/>
                      <div class="imgFunding" style="overflow:hidden; width:190px; height:130px; border:0px solid red; background-image: url('<?php echo $rowrandProject->emp_pic; ?>'); background-position:center center; background-size: auto 100%; background-repeat: no-repeat;">
                        <!-- <img src="<?php echo $rowrandProject->proImg; ?>" width="190"> -->
                      </div><!-- /imgFunding -->
                                    <br/>
                    <strong style="color:#1F4864"><?php echo $rowrandProject->emp_web; ?></strong>
                   <strong style="color:#1F4864"><?php echo $rowrandProject->emp_tel; ?></strong> <br><br>
                    <strong style="color:#1F4864"><?php echo $rowrandProject->emp_address; ?></strong>
                                       <br/>
                    
                    
                  
                  
                      


                   
                    </div>

                  </div>
                  
                  <div class="clear"></div>
                </div>
              </div>
              </li>

            <?php } ?>
            
          <div class="clear"></div>
          </ul> 
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




