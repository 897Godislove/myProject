<?php
    date_default_timezone_set("africa/lagos");
    $currenttime=time();
    $datetime =strftime("%b-%m-%Y %H:%M:%S",$currenttime);
    echo $datetime;
    echo "<br>";
    echo "<br>";
    echo "<br>";
    $create_datetime = date("Y-m-d H:i:s");
    echo $create_datetime;



?>