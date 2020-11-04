<?php
if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_FILENAME'])) header('Location: '.$urlHost); 
//https://wp-mix.com/php-protect-include-files/
function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    
	return $days;
//https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
}
?>