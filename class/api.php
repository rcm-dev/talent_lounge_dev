<?php  


/**
 * Any function or php variable should be here
 */
require 'db/db-connect.php';


// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('Asia/Kuala_Lumpur');


// OUTPUT January-26-2012-11-17-44-am
$getTimeStamp		=	date("F-j-Y-g-i-s-a");
$lastLogin			=	date("Y-m-j g:i:s:a");


// 2 week Date + Time
$dateEnd = date("Y-m-d G:i:s", 
				mktime(
					date("G"), 
					date("i"), 
					date("s"), 
					date("m"), 
					date("d")+14, 
					date("Y"))
				);

/*echo $dateEnd;

if ("2012-01-24 11:52:40" != $dateEnd) {
	# code...
	echo "xsama";
} else {
	echo "sama";
}*/



function convertPrice($price)
{
	if ($price < 1000) {
									 	
	 	return "RM".$price;
	 } 

	if ($price >= 1000 && $price <= 999999) {
		
		$kprice = $price / 1000;
		return "RM".$kprice."K";

	}

	if ($price >= 1000000 && $price <= 9999999) {
		
		$kprice = $price / 1000000;
		return "RM".$kprice."M";

	}
}

?>