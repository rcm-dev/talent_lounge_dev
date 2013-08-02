<?php  


include 'header.php';
include 'db/db-connect.php';
//include 'class/short.php';



// shows query

$query_user       = "SELECT * FROM performance_schedules";
$result_user      = mysql_query($query_user);
$total_rows_user  = mysql_num_rows($result_user);
?>
<!--  <link href="css/bootstrap.css" rel="stylesheet"> -->
<style>
/*#contentContainer {
    background-image:"img/279142_5919.jpg" width="1600" height="1200";}*/
    
    
    .left{
        float: left;
        margin-left: 10px;
    }

    .rigth{
        float:right;
    }

    .clear{
        float:both;
    }

</style>

<link rel="stylesheet" href="css/slidorion.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="js/jquery.easing.js"></script>
<script src="js/jquery.slidorion.min.js"></script>


<div id="content" class="">



<?php include 'quickpost.php'; ?>
    
   <div id="contentContainer">
    <img src="images/bg_lifeshows.jpg" class="bg">
    <div class="left" style="border-top:0px solid #cccccc; padding:10px">
        <!-- CHange Action -->
        <div id="connect-container">
            <!-- <div id="loadstream">
 -->
            <div id="slidorion">
                <div id="slider">
                    
                        
                            <div class="slide" >
                                
                               <div class="slide"><img src=<?php echo $object_user->perform_image; ?> width="400" height="400"></div>
                                  
                            </div>

                        
                        <div id="accordion">
                                <div class="link-header">KL Acapella Group Performance</div>
                                <div class="link-content">
                                    <p>
                                        <strong>Performance by :</strong> KL Acapella Band
                                    </p>
                                    <p>
                                        <strong>Date:</strong> 23 May 2013
                                    </p>
                                    <p>
                                        <strong>Time:</strong>9pm
                                    </p><!-- content -->
                                </div>
                                <div class="link-header">Estralla Indie Band Show</div><!-- content -->
                                <div class="link-content">
                                    <p>
                                        <strong>Performance by :</strong> Estralla Indie Band
                                    </p>
                                    <p>
                                        <strong>Date:</strong> 23 June 2013
                                    </p>
                                    <p>
                                        <strong>Time:</strong>10pm
                                    </p><!-- content -->
                                </div>
                                <div class="link-header">Poem Recital for Ghaza</div><!-- content -->
                                <div class="link-content">
                                    <p>
                                        <strong>Performance by :</strong> Poem Recital
                                    </p>
                                    <p>
                                        <strong>Date:</strong> 23 August 2013
                                    </p>
                                    <p>
                                        <strong>Time:</strong>8pm
                                    </p><!-- content -->
                                </div>
                            </div>
                        
                
                </div>
            </div>
        </div><!-- /CHange Action -->
    </div>
</div><!-- /orange left -->

<?php if ($total_rows_user == 0): ?>
            
            <p>
                No data
            </p>

        <?php endif // end if row user 0 ?>

        <?php if ($total_rows_user != 0): ?>
            
            <ul id="reportcard">
            
                <?php while($object_user = mysql_fetch_object($result_user)) { ?>
        
                        <li>
                            <?php echo $object_user->perform_title; ?>
                        </li>
                        
                <?php } // end while ?>
            
            </ul>

        <?php endif ?>

        <div class="rigth" style="border-top:0px solid #cccccc; padding:10px">
           <div id="connect-container">
            <form class="-form _horizontal_">
    <div class="-form-row">
        <label>Login</label>
        <span class="-form-field -col2">
            <input type="text">
        </span>
        <span class="-form-field-help">Help me</span>
    </div>
    <div class="-form-row">
        <label>Password</label>
        <span class="-form-field -col2">
            <input type="password">
        </span>
    </div>
    <div class="-form-row">
        <div class="-form-group">
            <label>
                <input type="checkbox">
            </label>
        </div>
    </div>
    <div class="-form-row">
        <div class="-form-group">
            <a class="-btn">Save</a>
            <a class="-btn -error- -unstyled-">Cancel</a>
        </div>
    </div>
</form>
 </div>
        </div>
<div class="clear"></div>
</div>
</div>









<script type="text/javascript">
$(document).ready(function(){
    $('#slidorion').slidorion({
        speed: 1000,
        interval: 4000,
        effect: 'slideLeft'
    });
});
</script>

<?php
include 'footer.php';


?>