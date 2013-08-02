<?php  



/** 
 * Add this to your page: 
 * <?php 
 * include "shorten_a_text_string.php"; 
 * echo ShortenText($text); 
 * ?> 
 * where $text is the text you want to shorten. 
 *  
 * Example 
 * Test it using this in a PHP page: 
 * <?php 
 * include "shortentext.php"; 
 * $text = "The rain in Spain falls mainly on the plain."; 
 * echo ShortenText($text); 
 * ?> 
 */ 

    function short($text) { 

        // Change to the number of characters you want to display 
        $chars = 255; 

        $text = $text." "; 
        $text = substr($text,0,$chars); 
        $text = substr($text,0,strrpos($text,' ')); 
        $text = $text."..."; 

        return $text; 

    }


    function shortMsg($text) { 

        // Change to the number of characters you want to display 
        $chars = 50; 

        $text = $text." "; 
        $text = substr($text,0,$chars); 
        $text = substr($text,0,strrpos($text,' ')); 
        $text = $text."..."; 

        return $text; 

    }

    function shortBrief($text) { 

        // Change to the number of characters you want to display 
        $chars = 110; 

        $text = $text." "; 
        $text = substr($text,0,$chars); 
        $text = substr($text,0,strrpos($text,' ')); 
        $text = $text."..."; 

        return $text; 

    }

    function shortest($text) { 

        // Change to the number of characters you want to display 
        $chars = 80; 

        $text = $text." "; 
        $text = substr($text,0,$chars); 
        $text = substr($text,0,strrpos($text,' ')); 
        $text = $text."..."; 

        return $text; 

    }



?>