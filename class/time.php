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


function ago($when) {
        $diff = date("U") - $when;

        // Days
        $day = floor($diff / 86400);
        $diff = $diff - ($day * 86400);

        // Hours
        $hrs = floor($diff / 3600);
        $diff = $diff - ($hrs * 3600);

        // Mins
        $min = floor($diff / 60);
        $diff = $diff - ($min * 60);

        // Secs
        $sec = $diff;

        // Return how long ago this was. eg: 3d 17h 4m 18s ago
        // Skips left fields if they aren't necessary, eg. 16h 0m 27s ago / 10m 7s ago
        $str = sprintf("%s%s%s%s",
                $day != 0 ? $day."d " : "",
                ($day != 0 || $hrs != 0) ? $hrs."h " : "",
                ($day != 0 || $hrs != 0 || $min != 0) ? $min."m " : "",
                $sec."s ago"
        );

        return $str;
}
?>