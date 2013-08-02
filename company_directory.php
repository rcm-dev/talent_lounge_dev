<?php  


include 'header.php';
include 'db/db-connect.php';


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




mysql_select_db($dbname, $db);
$randProject  = "SELECT
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
  mj_users.usr_lvl = 1 AND jp_employer.emp_featured = 1";

$rrandProject = mysql_query($randProject);

mysql_select_db($dbname, $db);
$query_rsIndustry = "SELECT * FROM jp_industry WHERE industry_parent = 0";
$rsIndustry = mysql_query($query_rsIndustry,$db) or die(mysql_error());
$row_rsIndustry = mysql_fetch_assoc($rsIndustry);
$totalRows_rsIndustry = mysql_num_rows($rsIndustry);

mysql_select_db($dbname, $db);
$query_rsstate = "SELECT * FROM mj_state";
$rsstate = mysql_query($query_rsstate,$db) or die(mysql_error());
$row_rsstate = mysql_fetch_assoc($rsstate);
$totalRows_rsstate = mysql_num_rows($rsstate);
?>
        <div id="content_full" class="directorySection">
            <?php include 'quickpost.php'; ?>
            <div id="contentContainer">
                <div class="heading" style="margin-bottom:0px;">
                    <br>
                    <h1 class="bebasTitle" style="color: white;">
                        Company Directory
                    </h1>
                    <br>
                </div>
                <div class="">
                    <table width="900" border="0" cellspacing="0" cellpadding="2">
                        <tr>
                            <td>
                                <div id="searchTradingHub">
                                    <form action="employerBrowseResumeResult.php" method="get" name="groupFiltering">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                            <tr>
                                                <td align="center">
                                                    <strong>Industry :</strong>
                                                </td>
                                                <td width="370px">
                                                    <select name="industry" class="query_company" id="query_company">
                                                        <option value="0">
                                                            Category
                                                        </option><?php
                                                            do {  
                                                              ?>
                                                        <option value="<?php echo $row_rsIndustry['indus_id']?>">
                                                            <?php echo $row_rsIndustry['indus_name']?>
                                                        </option><?php
                                                              } while ($row_rsIndustry = mysql_fetch_assoc($rsIndustry));
                                                              $rows = mysql_num_rows($rsIndustry);
                                                              if($rows > 0) {
                                                              mysql_data_seek($rsIndustry, 0);
                                                              $row_rsIndustry = mysql_fetch_assoc($rsIndustry);
                                                              }
                                                              ?>
                                                    </select>
                                                </td>
                                                <td align="center" width="80px">
                                                    <strong>State :</strong>
                                                </td>
                                                <td width="150px">
                                                    <select name="state" class="query_stat" id="query_stat">
                                                        <option value="0">
                                                            State
                                                        </option><?php
                                                            do {  
                                                             ?>
                                                        <option value="<?php echo $row_rsstate['state_id']?>">
                                                            <?php echo $row_rsstate['state_name']?>
                                                        </option><?php
                                                             } while ($row_rsstate = mysql_fetch_assoc($rsstate));
                                                          $rows = mysql_num_rows($rsstate);
                                                          if($rows > 0) {
                                                              mysql_data_seek($rsstate, 0);
                                                            $row_rsstate = mysql_fetch_assoc($rsstate);
                                                          }
                                                             ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input name="submitGeneral" type="submit" id="Check" value="Search">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                                <div id="searchResult" class=""></div><!-- /searchResult -->
                                <div id="searchResult3" class="">
                                <?php


                                $norandProject = mysql_num_rows($rrandProject);

                                if ($norandProject == 0) {

                                echo "No project.";

                                } else { 

                                ?>
                                    <ul class="comp_advert">
                                        <?php while ($rowrandProject = mysql_fetch_object($rrandProject)) { ?>
                                        <li class="ui-window">
                                                            
                                            <strong style="color:#800000; font-size:17px; font-family:Arial">
                                                <a href="recruitment/employer.php?emp_id=<?php echo $rowrandProject->emp_id ?>&amp;employer=<?php echo $rowrandProject->emp_name ?>"><?php echo $rowrandProject->emp_name ?></a></strong><br>
                                            <br>
                                            <a href="recruitment/employer.php?emp_id=<?php echo $rowrandProject->emp_id ?>&amp;employer=<?php echo $rowrandProject->emp_name ?>">
                                            <div class="imgFunding" style="overflow:hidden; width:190px; height:130px; border:0px solid red; background-image: url('recruitment/media/employer/img/<?php echo $rowrandProject->emp_pic; ?>;'); background-position:center center; background-size: auto 100%; background-repeat: no-repeat;">
                                                <img src="recruitment/media/employer/img/<?php echo $rowrandProject->emp_pic ?>" width="190">
                                            </div>
                                            </a>
                                            <br>
                                            <?php echo $rowrandProject->emp_web; ?><br>
                                            <?php echo $rowrandProject->emp_tel; ?><br>
                                            <br>
                                            <address>
                                                <?php echo $rowrandProject->emp_address; ?>
                                            </address><br>
                                            <p style="color:#999; font-size: 12px; line-height: 15px; margin-top:10px">
                                                <?php //echo $rowrandProject->emp_desc; ?>
                                            </p>
                                        </li><?php } ?>
                                    </ul>
                                            </div><?php } ?><!-- /view -->
                                </div><!-- /orange left -->
                                <!-- sidebar-connect n share -->
                                <!-- /sidebar-connect n share -->
                                <div class="clear"></div>
                            </td><!-- /contentContainer -->
                            <!-- /content -->
                            <!-- get current email -->
                            <!-- /get current email -->
                            <?php 

                            // var tours
                            $section = 2;
                            include 'check_tours.php'; 

                            ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" name="current_email" id="current_email" value="<?php echo $usr_email; ?>">

<script type="text/javascript">
$(document).ready(function(){


    $('#Check').click(function(){
    $('#searchResult3').hide();    

    var catID = $('#query_company').val();
    var stateID = $('#query_stat').val();


    var dataString = 'catID='+catID+'&stateID=' + stateID;

    console.log(dataString);


    $('#searchResult').html('loading....').fadeIn().load('ajaxDirList.php?'+dataString);

    return false;




    });    

/* Edit profile fancy box */
    $('#editProfile').fancybox({
        'titlePosition'   : 'inside',

        'transitionIn'    : 'none',

        'transitionOut'   : 'none',

        'type'              : 'iframe'
      });



    /* Register */
    $("#iregister").fancybox({


        'autoScale'         : false,

        'height'            : '70%',

        'transitionIn'      : 'none',

        'transitionOut'     : 'none',

        'titlePosition'   : 'none',

        'type'              : 'iframe'

    });


    /* login */
    $("#ilogin").fancybox({

        'height'            : '70%',

        'autoScale'         : true,

        'transitionIn'      : 'none',

        'transitionOut'     : 'none',

        'titlePosition'   : 'none',

        'type'              : 'iframe'

    });


    /* public figure */
    $('.public').fancybox({

        'height'            : '70%',

        'autoScale'         : true,

        'transitionIn'      : 'none',

        'transitionOut'     : 'none',

        'titlePosition'   : 'none',

        'type'              : 'iframe'

    });


});
</script>
    <?php include("footer.php"); ?>