<?php

$db = mysqli_connect('db5015427713.hosting-data.io', 'dbu5532747', 'Markos0817', 'dbs12624409');
mysqli_set_charset($db, "utf8mb4");
session_start();
date_default_timezone_set("America/Chicago");
$weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
// $checkdaterideSQL = "SELECT `username`, `id` FROM `users` WHERE `password`='inprocess'";
// $checkdaterideres = mysqli_query($db, $checkdaterideSQL);
//  while($checkResult = mysqli_fetch_assoc($checkdaterideres))
// {
//     $startDate = strtotime($checkResult['datetime']);
//     $currentDate = strtotime(date('Y-m-d H:i:s'));
//     if($startDate < $currentDate)
//     {
//         $changeSQL = "UPDATE `rides` SET `status`='complete' WHERE `ID`='" . $checkResult['ID'] . "'";
//         $changeres = mysqli_query($db, $changeSQL);
//         $changeresult = mysqli_fetch_assoc($changeres);
//     }
// }
function valueToTime($value) {
    // Convert the value to hours and minutes
    $hours = floor($value / 50 / 2);
    $minutes = ($value / 50 % 2) * 30;

    // Format hours and minutes with leading zeros if needed
    $formatted_hour = str_pad($hours, 2, '0', STR_PAD_LEFT);
    $formatted_minute = str_pad($minutes, 2, '0', STR_PAD_LEFT);

    // Concatenate hours and minutes with a colon
    return "$formatted_hour:$formatted_minute";
}
?>

