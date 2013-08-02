<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>jQuery Carousel Evolution</title>
    
    <link rel="Stylesheet" type="text/css" href="content.css" />
    <link rel="Stylesheet" type="text/css" href="carousel.css" />
    
    <script type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="scripts/jquery.carousel.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
        
            $('.carousel').carousel({carouselWidth:930, carouselHeight:500, directionNav:true, shadow:true});
        
        });
    </script>
</head>
<body>

<div class="column12container main_container">

<div class="column12">

<!-- carousel -->

<div class="carousel"> <!-- BEGIN CONTAINER -->
    
    <div class="slides"> <!-- BEGIN CAROUSEL -->
    
        
        <div>
            <img src="gallery/p1.jpg" alt="Penang Event 2013" />
        </div>

        <div>
            <img src="gallery/p2.jpg" alt="Penang Event 2013" />
        </div>

        <div>
            <img src="gallery/p3.jpg" alt="Penang Event 2013" />
        </div>

        <div>
            <img src="gallery/p1.jpg" alt="Penang Event 2013" />
        </div>

        <div>
            <img src="gallery/p2.jpg" alt="Penang Event 2013" />
        </div>

        <div>
            <img src="gallery/p3.jpg" alt="Penang Event 2013" />
        </div>

                        
    </div> <!-- END SLIDES -->
       
</div> <!-- END CAROUSEL -->

</div>

</div> <!-- end right content -->

<div class="clear"></div>


</body>
</html>
