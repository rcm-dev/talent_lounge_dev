<?php if (isset($_SESSION['MM_Username'])): ?>
<nav id="menu">
<?php endif; ?>

<?php if (!isset($_SESSION['MM_Username'])): ?>
<nav id="menu">
<?php endif; ?>
    <div class="center">
    	<div>
        <?php if (!isset($_SESSION['MM_Username'])): ?>
       
       <nav>
                    <ul id="navmenu" class="">
                        <li><a href="../creative-idea.php" title="Showcase">Showcase</a></li>
                        <li><a href="../allUser.php" title="Talent">Talent</a></li>
                        <li><a href="company_directory2.php" title="Companies">Companies</a></li>
                        <li><a href="jobsOpeningAll.php" title="Jobs">Jobs</a></li>
                        <li><a href="#" title="Chalk Talk">Chalk Talk</a></li>
                        <li><a href="#" title="Training">Training</a></li>
                        <li style="display:none">
                            <a href="../takethetour.php">Take a Tour</a>
                        </li>
                        <li>
                            <a href="../login.php" id="iloginEmp" style="color: orange !important; display:none;">Employer Login</a>
                        </li>
                        <li style="display:none">
                            <a href="../pricing.php">Pricing</a>
                        </li>
                        <li style="display:none"><a href="" title="Talent Launchpad">Talent Launchpad</a>
                            <ul>
								<li><a href="../news_Highlights.php" title="News &amp; Highlight">News &amp; Highlights</a></li>
								<li><a href="../exhibition_entertainment.php" title="Exibitions &amp; Displays">Exhibitions &amp; Displays </a></li>
								<li><a href="../slide.php" title="Performance &amp; Live Shows">Performances &amp; Live Shows</a></li>
								<li><a href="../entrepreneur-library.php" title="Education &amp; Learning">Education &amp; Learning</a></li>


						</ul></li>
                        <li style="display:none">
                            <div style="border:0px solid red;"><span style="color: white; margin-top:5px;">Hiring Talent? &nbsp;</span>  <span><a href="../login.php" class="tl-btn-red public" style="color: white !important; display: inline-block; padding:0px 4px !important; line-height: 24px;">Post a Job!</a></span> &nbsp; <span style="color: white">Employer Login: Call +603 7665 0607 Now!</span></div>
                        </li>
                        
                    </ul><!-- /navmenu -->
                    </nav>
        <?php endif ?>

        <?php if (isset($_SESSION['MM_Username'])): ?>
            
       <nav>
                    <ul id="navmenu" class="">
                        <li><a href="../index.php" title="Back to Home">Home</a></li>
                        <li><a href="index.php" title="Recruitment">Recruitment</a>
                            <ul>
                                <li>
                                    <a href="../company_directory.php">Company Directory</a>
                                </li>
                                <li><a href="../funding.php" title="Talent Showcase">Talent Showcase</a></li>
                                <li><a href="../creative-idea.php" title="Freelancer">Freelancer</a></li>
                                <li><a href="jobsByDisabled.php?ads_type=2" title="Disabled Careers">Disabled Careers</a></li>
                                <li><a href="jobsByProfessional.php?ads_type=1" title="Retiress Careers">Retiress Careers</a></li>
                            </ul>
                        </li>
                        <li><a href="" title="Social Network">Social Network</a>
                            <ul>
                                <li><a href="../connect.php" title="Connect &amp; Share">Connect &amp; Share</a></li>
                                <li><a href="../search-market.php?sp=DESC" title="Buy &amp; Sell">Buy &amp; Sell</a></li>

                        </ul></li>
                        <li style="display:none">
                            <a href="../takethetour.php">Take a Tour</a>
                        </li>
                        <li style="display:none"><a href="" title="Talent Launchpad">Talent Launchpad</a>
                            <ul>
								<li><a href="../news_Highlights.php" title="News &amp; Highlight">News &amp; Highlights</a></li>
								<li><a href="../exhibition_entertainment.php" title="Exibitions &amp; Displays">Exhibitions &amp; Displays </a></li>
								<li><a href="../slide.php" title="Performance &amp; Live Shows">Performances &amp; Live Shows</a></li>
								<li><a href="../entrepreneur-library.php" title="Education &amp; Learning">Education &amp; Learning</a></li>


						</ul></li>
                        
                        <li>
                            <a href="#" title="Dashboard">My Application</a>
                            <ul>
                                <li>
                                    <a href="sessionGateway.php" title="Dashboard">Recruitment</a>    
                                </li>
                                <li>
                                    <a href="../contribute.php" title="Dashboard">Contribution</a>    
                                </li>
                            </ul>
                        </li>
                         
                    </ul><!-- /navmenu -->
                </nav>
        <?php endif ?>


        </div>
        <div class="right" style="margin-top:10px !important; display:none;">
            <?php if (isset($_SESSION['MM_Username'])): ?>
                <div class="topleftmarkerting" style="margin-top:0px; color:#fff;">
            <?php endif; ?>

            <?php if (!isset($_SESSION['MM_Username'])): ?>
                <div class="topleftmarkerting" style="margin-top:5px; color:#fff;">
            <?php endif; ?>
                
                <?php //if(!isset($usr_email)) { ?>
                    <!-- <a href="../takethetour.php" title="Learn More" class="topLeft" style="color:#A0A0A0; margin-right:20px;">Learn More</a> -->
                <?php //} ?>
                
                <img src="../images/Apps-help-browser-icon.png" style="position:absolute; margin-left:-10px" />
                <a href="../1-Help+and+Support.html" title="Service &amp; Support" class="topLeft" style="color:#A0A0A0;">Service &amp; Support</a>

                &middot;

                <a href="../pricing.php" class="topLeft" style="color:#A0A0A0;">Pricing &amp; Package</a>

<!-- <a href="../contactus.php" title="Contact Us" class="topLeft" style="color:#A0A0A0;">Contact Us</a> -->
            </div>
        </div>
       	<div class="clear"></div>
    </div><!-- .center -->
</nav>