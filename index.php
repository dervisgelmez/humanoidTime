<?php 
    // Add the humanoidTime class to the project
    require 'src/class.humanoidTime.php';
    // Set your own time zone 
    date_default_timezone_set('Europe/Istanbul');
    // Create a class
    $hTime = new humanoidTime(); 
    // Send data in the appropriate format to getHumanoid method
    // 23022019233000 or 23/02/2019/23/30/00/00
    // Sorted this way, day month year hour minute second

    // To save the database
    $hTime->getHumanoid(date("dmYHis"));
    // or $hTime->getHumanoid(date("d/m/Y/H/i/s"));
    echo '<br>';
    // Examples
    $hTime->getHumanoid("24022019202455");
    // or $hTime->getHumanoid("24/02/2019/20/24/55");
?>