<?php 

include $_SERVER['DOCUMENT_ROOT'] . "/config.php"; 


if(isset($_POST['signin'])) 
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM `users` where `username` = '$username' AND `password` = '$password'";
    $res = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($res);
    if($result)
    {
        $_SESSION['user']['id'] = $result['id'];
        $_SESSION['user']['role'] = $result['role'];

        echo "<script>window.location.href='/';</script>";
    }
    else
    {
        echo "<script>window.location.href='/signin.php?error=106';</script>";
        exit;
    }
}

if(isset($_GET['logout']))
{

	$_SESSION = array();
	echo "<script>window.location.href='/';</script>";
	exit;
}
if(isset($_POST['save_schedule']))
{
	$new_schedule = $_POST['schedule_array'];
	$sql = "UPDATE `users` SET `availability`='" . $new_schedule . "' WHERE `id`='" . $_SESSION['user']['id'] . "'";
	$res = mysqli_query($db, $sql);
    echo "<script>window.location.href='/myavailability?success=101';</script>";
    exit;
}
if(isset($_POST['make_shift']))
{
	$day = $_POST['day'];
	$starttime = $_POST['starttime'];
	$endtime = $_POST['endtime'];
	$sql = "INSERT INTO `shifts`( `day`, `start`, `end`, `empID`) VALUES ('$day', '$starttime', '$endtime', '" . $_SESSION['user']['id'] . "')";
	$res = mysqli_query($db, $sql);
	echo "<script>window.location.href='/shifts?success=101';</script>";
    exit;
}
if(isset($_POST['clear_shift']))
{
    $sql = "SELECT `userID` FROM `shifts` WHERE `empID` = '" . $_SESSION['user']['id'] . "'";
    $res = mysqli_query($db, $sql);
    while($result = mysqli_fetch_assoc($res))
    {
        $sql2 = "UPDATE `users` SET `curT`='0' WHERE `id`='" . $result['userID'] . "'";
        $res2 = mysqli_query($db, $sql2);
    }

    $sql = "UPDATE `shifts` SET `userID`='0' WHERE `empID`='" . $_SESSION['user']['id'] . "'";
    $res = mysqli_query($db, $sql);
    echo "<script>window.location.href='/shifts?success=102';</script>";
    exit;
}
if(isset($_POST['auto_assign_shift']))
{
    $sql = "SELECT * FROM `shifts` WHERE `empID`='3' AND `userID`='0'";
    $res = mysqli_query($db, $sql);
    while($shift = mysqli_fetch_assoc($res))
    {
        /* 
        $shift['id']
        $shift['day']
        $shift['start']
        $shift['end']
        $shift['userID']
        */
        $startBlock = $shift['start'] / 50;
        $endBlock = $shift['end'] / 50;
        $dayOfWeek = $shift['day'];
        $eligibleUsers = [];

        $sql2 = "SELECT * FROM `users` WHERE `empID`='3'";
        $res2 = mysqli_query($db, $sql2);
        while($user = mysqli_fetch_assoc($res2))
        {
            /*
            $user['availability']
            $user['id']
            $user['maxT']
            $user['curT']
            */

            $availabilityMatrix = json_decode($user['availability'], true); // Assuming availability is stored as JSON string
            $isAvailable = true;

            for ($i = $startBlock; $i < $endBlock; $i++) {
                if ($availabilityMatrix[$dayOfWeek][$i] == 1) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {

                $eligibleUsers[] = [
                    'id' => $user['id'],
                    'maxT' => $user['maxT'],
                    'curT' => $user['curT'],
                    'ratio' => $user['curT'] / $user['maxT']
                ];
            }

        }

        usort($eligibleUsers, function($a, $b) {
            return $a['ratio'] <=> $b['ratio'];
        });

        foreach ($eligibleUsers as $user) {
            if (($user['curT'] + ($endBlock - $startBlock) / 2) <= $user['maxT']) {
                // Assign the shift to this user
                $updateShiftSql = "UPDATE `shifts` SET `userID` = '{$user['id']}' WHERE `id` = '{$shift['id']}'";
                $upd1 = mysqli_query($db, $updateShiftSql);

                // Update user's current hours
                $newCurT = $user['curT'] + ($endBlock - $startBlock) / 2;
                $updateUserSql = "UPDATE `users` SET `curT` = '$newCurT' WHERE `id` = '{$user['id']}'";
                $upd2 = mysqli_query($db, $updateUserSql);

                // Assuming there's only one user assigned per shift
                break;
            }
        }
    }
    echo "<script>window.location.href='/shifts?success=103';</script>";
    exit;
}
?>
