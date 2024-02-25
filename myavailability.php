<?php 

    include $_SERVER['DOCUMENT_ROOT'] . "/header.php"; 
    if(isset($_SESSION['user']) && isset($_SESSION['user']['id']))
    {
        $sql = "SELECT `availability` FROM `users` WHERE `id`='" . $_SESSION['user']['id'] . "'";
        $res = mysqli_query($db, $sql);
        $result = mysqli_fetch_assoc($res);
    	$schedule = json_decode($result['availability'], true);
        ?>
        <script type="text/javascript">
            var schedule_array = <?php echo $result['availability']; ?>;
        </script>
         <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 1400px;
            overflow-x: auto;
        }
        th, td {
            padding: 10px;
            text-align: center;
            cursor: pointer;
        }
        td:not(:first-child):hover {
            filter: brightness(0.85);
        }
        .free {
            background-color: #34a854 !important;
        }
        .busy {
            background-color: #ea4236 !important;
        }
        th{
            user-select: none; /* Standard syntax */
        }
    </style>
    <script type="text/javascript">
        var schedule_array = <?php echo $result['availability']; ?>;

        var isUpdating = false;

        document.addEventListener('DOMContentLoaded', function() {
            var cells = document.querySelectorAll('td');
            cells.forEach(function(cell) {
                cell.addEventListener('mousedown', function(event) {
                    isUpdating = true;
                    updateCell(event.target);
                });
                cell.addEventListener('mouseover', function(event) {
                    if (isUpdating) {
                        updateCell(event.target);
                    }
                });
            });
            document.addEventListener('mouseup', function() {
                isUpdating = false;

            });
        });

        function updateCell(cell) {
            var rowCol = cell.id.split("-");
            var row = rowCol[1];
            var col = rowCol[2];
            var isFree = document.getElementById('free').checked;
            schedule_array[row][col] = isFree ? 0 : 1;
            $("#schedule_input").attr("value", JSON.stringify(schedule_array));
            if (isFree) {
                cell.classList.remove('busy');
                cell.classList.add('free');
            } else {
                cell.classList.remove('free');
                cell.classList.add('busy');
            }
        }
    </script>
     <h3 style="text-align:center;">My Availability</h3>
    <div class="col justify-content-center mb-3 table-responsive-md" style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Day/Time</th>
                    <th>00:00-00:30</th>
                    <th>00:30-01:00</th>
                    <th>01:00-01:30</th>
                    <th>01:30-02:00</th>
                    <th>02:00-02:30</th>
                    <th>02:30-03:00</th>
                    <th>03:00-03:30</th>
                    <th>03:30-04:00</th>
                    <th>04:00-04:30</th>
                    <th>04:30-05:00</th>
                    <th>05:00-05:30</th>
                    <th>05:30-06:00</th>
                    <th>06:00-06:30</th>
                    <th>06:30-07:00</th>
                    <th>07:00-07:30</th>
                    <th>07:30-08:00</th>
                    <th>08:00-08:30</th>
                    <th>08:30-09:00</th>
                    <th>09:00-09:30</th>
                    <th>09:30-10:00</th>
                    <th>10:00-10:30</th>
                    <th>10:30-11:00</th>
                    <th>11:00-11:30</th>
                    <th>11:30-12:00</th>
                    <th>12:00-12:30</th>
                    <th>12:30-13:00</th>
                    <th>13:00-13:30</th>
                    <th>13:30-14:00</th>
                    <th>14:00-14:30</th>
                    <th>14:30-15:00</th>
                    <th>15:00-15:30</th>
                    <th>15:30-16:00</th>
                    <th>16:00-16:30</th>
                    <th>16:30-17:00</th>
                    <th>17:00-17:30</th>
                    <th>17:30-18:00</th>
                    <th>18:00-18:30</th>
                    <th>18:30-19:00</th>
                    <th>19:00-19:30</th>
                    <th>19:30-20:00</th>
                    <th>20:00-20:30</th>
                    <th>20:30-21:00</th>
                    <th>21:00-21:30</th>
                    <th>21:30-22:00</th>
                    <th>22:00-22:30</th>
                    <th>22:30-23:00</th>
                    <th>23:00-23:30</th>
                    <th>23:30-00:00</th>
                </tr>
            </thead>
             <?php 
                for($i = 0; $i < 7; $i++)
                {
                    echo "<tr><th>{$weekdays[$i]}</th>";
                    for($k = 0; $k < 48; $k++) {
                        $cell_id = "cell-{$i}-{$k}";
                        $class = $schedule[$i][$k] == 0 ? "free" : "busy";
                        echo "<td id='{$cell_id}' class='{$class}' ></td>";
                    }
                    echo "</tr>";
                }
            ?>
        </table>
        
       </div>
       <div class="form-check">
          <input class="form-check-input" type="radio" name="mark" id="free" checked>
          <label class="form-check-label" for="flexRadioDefault1">
            Free
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="mark" id="busy">
          <label class="form-check-label" for="flexRadioDefault2">
            Busy
          </label>
        </div>
        <div style="width: 50%;">
            <form action="action.php" method="POST">
                <input type="hidden" name="schedule_array" id="schedule_input" value="<?php echo $result['availability']; ?>">
                <button type="submit" class="original-button" name='save_schedule'>Save</button>
            </form>
            <?php 
                if(isset($_GET['success']))
                {
                    ?>
                    <br>
                    <br>
                    <div class="alert alert-success alertingmessage" role="alert">
                      Your schedule has been updated successfully!
                    </div>
                    <?php
                }
            ?>
        </div>
    	<?php
    }
    else{
        echo "<script>window.location.href='/login.php';</script>";
        exit;
    }
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>