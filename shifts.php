<?php 

    include $_SERVER['DOCUMENT_ROOT'] . "/header.php"; 
    if(isset($_SESSION['user']) && isset($_SESSION['user']['id']))
    {
        ?>
        <div class="row justify-content-center " style="border: 4px solid #e4a01a;border-radius: 20px;padding: 10px; margin-bottom: 50px; width: 50%; text-align: center;">
            <h3 style="text-align:center;">New shift</h3>
            <form method="POST" action="action.php" >
                <div class="mb-3 form-group">
                    <select class="form-select" name="day">
                      <option disabled selected value>Day</option>
                      <option value="0">Monday</option>
                      <option value="1">Tuesday</option>
                      <option value="2">Wednesday</option>
                      <option value="3">Thursday</option>
                      <option value="4">Friday</option>
                      <option value="5">Saturday</option>
                      <option value="6">Sunday</option>
                    </select>
                </div>

                <div class="mb-3 form-group">
                    <select class="form-select" name="starttime">
                      <option disabled selected value>Start</option>
                     <?php
                    for ($hour = 0; $hour < 24; $hour++) {
                        for ($minute = 0; $minute < 60; $minute += 30) {
                            // Calculate the value for each option based on hour and minute
                            $value = ($hour * 60 + $minute) / 30 * 50;
                            // Format hour and minute with leading zeros if needed
                            $formatted_hour = str_pad($hour, 2, '0', STR_PAD_LEFT);
                            $formatted_minute = str_pad($minute, 2, '0', STR_PAD_LEFT);
                            // Print the option tag
                            echo "<option value=\"$value\">$formatted_hour:$formatted_minute</option>";
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="mb-3 form-group">
                    <select class="form-select" name="endtime">
                      <option disabled selected value>End</option>
                     <?php
                    for ($hour = 0; $hour < 24; $hour++) {
                        for ($minute = 0; $minute < 60; $minute += 30) {
                            // Calculate the value for each option based on hour and minute
                            $value = ($hour * 60 + $minute) / 30 * 50;
                            // Format hour and minute with leading zeros if needed
                            $formatted_hour = str_pad($hour, 2, '0', STR_PAD_LEFT);
                            $formatted_minute = str_pad($minute, 2, '0', STR_PAD_LEFT);
                            // Print the option tag
                            echo "<option value=\"$value\">$formatted_hour:$formatted_minute</option>";
                        }
                    }
                    ?>
                    </select>
                </div>
                <button type="submit" class="original-button" name='make_shift'>Create</button>
            </form>
            <?php 
                if(isset($_GET['success']))
                {
                    if($_GET['success'] == 101)
                    {

                    ?>
                    <br>
                    <br>
                    <div class="alert alert-success alertingmessage" role="alert" style="margin-top: 10px;">
                      A new shift has been updated successfully!
                    </div>
                    <?php
                    }
                    else if($_GET['success'] == 102)
                    {
                         ?>
                    <br>
                    <br>
                    <div class="alert alert-success alertingmessage" role="alert" style="margin-top: 10px;">
                      Shift assignmenets have been cleared!
                    </div>
                    <?php
                    }
                    else if($_GET['success'] == 103)
                    {
                         ?>
                    <br>
                    <br>
                    <div class="alert alert-success alertingmessage" role="alert" style="margin-top: 10px;">
                      Auto assignments of shifts has been done!
                    </div>
                    <?php
                    }
                }

            ?>
        </div>
        <br>
        <br>
        <hr>
        <div class="row justify-content-center table-responsive-md" style="margin-top: 50px;">
            <h3 style="text-align:center;">Shifts</h3>

            <table class="table">
                <thead>
                    <tr>
                        <th>Shift ID</th>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Assigned Employee</th>
                    </tr>
                </thead>
                <?php 
                $sql = "SELECT * FROM `shifts` WHERE `empID`='" . $_SESSION['user']['id'] . "' ORDER BY `day` ASC, `start`";
                $res = mysqli_query($db, $sql);
                while($row = mysqli_fetch_assoc($res))
                {
                    $user = "-";
                    if($row['userID'] != 0)
                    {
                        $sql2 = "SELECT `name`, `surname` FROM `users` WHERE `id`='" . $row['userID'] . "'";
                        $res2 = mysqli_query($db, $sql2);
                        $result2 = mysqli_fetch_assoc($res2);
                        $user = $result2['name'] . " " . $result2['surname'];
                    }
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $weekdays[$row['day']]; ?></td>
                        <td><?php echo valueToTime($row['start']); ?></td>
                        <td><?php echo valueToTime($row['end']); ?></td>
                        <td><?php echo $user; ?></td>
                    </tr>
                    <?php
                }
                 ?>
            </table>
            
        </div>
        <div class="row justify-content-center" style="margin-top: 50px; width: 50%;">
            <form action="action.php" method="POST">
                <button type="submit" class="original-button" name='clear_shift'>Clear assignments</button><br>
                <button type="submit" class="original-button" name='auto_assign_shift'>Auto assign</button>
                
            </form>
        </div>
        <?php
    }
    else{
        echo "<script>window.location.href='/login.php';</script>";
        exit;
    }
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>