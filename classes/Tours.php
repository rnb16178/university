<?php
class Tours extends Db
{

    public function delete($id)
    {
        $this->connect();
        $sql = "DELETE FROM tours WHERE id = $id";
        $this->delete($sql);
        header("Location: edittours.php");
    }
    public function displayTours()
    {
        $this->connect();
        $sql = "SELECT * FROM tours";
        $result = $this->select($sql);
        if ($result->num_rows > 0) {
            echo '<div class="tour"><table><tr>
         <th><h2>Date</h2></th>
         <th>Venue</th>
         <th>City</th>
         </tr>';
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                list($year, $month, $day) = explode('-', $row['date']);
                if ($month == 1) {
                    $month = "Jan";
                } else if ($month == 2) {
                    $month = "Feb";
                } else if ($month == 3) {
                    $month = "Mar";
                } else if ($month == 4) {
                    $month = "Apr";
                } else if ($month == 5) {
                    $month = "May";
                } else if ($month == 6) {
                    $month = "June";
                } else if ($month == 7) {
                    $month = "Jul";
                } else if ($month == 8) {
                    $month = "Aug";
                } else if ($month == 9) {
                    $month = "Sep";
                } else if ($month == 10) {
                    $month = "Oct";
                } else if ($month == 11) {
                    $month = "Nov";
                } else if ($month == 12) {
                    $month = "Dec";
                }
                echo "<td>" . $day . " " . $month . " " . $year . "</td>";
                echo "<td>" . $row["venue"] . "</td>";
                echo "<td>" . $row["country"] . "</td>";
                echo "</tr></div>";
            }
            echo "</table>";
        } else {
            echo "<p>There currently arent any tours planned</p>";
        }
    }
    public function displayEditTours()
    {

        if ($_SESSION['logged-in']) {
            $this->connect();
            $sql = "SELECT * FROM tours";
            $result = $this->select($sql);
            if ($result->num_rows > 0) {
                echo '<div class="tour"><table><tr>
         <th><h2>Date</h2></th>
         <th>Venue</th>
         <th>City</th>
         </tr>';
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><form method='post' action='updateTours.php'>";
                    list($year, $month, $day) = explode('-', $row['date']);
                    if ($month == 1) {
                        $month = "Jan";
                    } else if ($month == 2) {
                        $month = "Feb";
                    } else if ($month == 3) {
                        $month = "Mar";
                    } else if ($month == 4) {
                        $month = "Apr";
                    } else if ($month == 5) {
                        $month = "May";
                    } else if ($month == 6) {
                        $month = "June";
                    } else if ($month == 7) {
                        $month = "Jul";
                    } else if ($month == 8) {
                        $month = "Aug";
                    } else if ($month == 9) {
                        $month = "Sep";
                    } else if ($month == 10) {
                        $month = "Oct";
                    } else if ($month == 11) {
                        $month = "Nov";
                    } else if ($month == 12) {
                        $month = "Dec";
                    }
                    echo '<input type=hidden name="id" value=' . $row["id"] . '>';
                    echo "<td>" . "<input type='date' name='date' value='" . $row["date"] . "'></td>";
                    echo "<td>" . "<input type='text' name='venue' value='" . $row["venue"] . "'></td>";
                    echo "<td>" . "<input type='text' name='country' value='" . $row["country"] . "'></td>";
                    echo "<td><input type='submit' name='action' value='Update' >" .  "</td>";
                    echo "<td><input type='submit' name='action' value='Delete' >" .  "</td>";

                    echo "</form></tr></div>";
                }
                echo "</table>";
?>
                <h2>Add New Tour</h2>
                <form action="updateTours.php" method="post">
                    <input type="hidden" name="add" value="selected">
                    <input type="date" name="date">
                    <input type="text" name="venue" placeholder="Venue">
                    <input type="text" name="city" placeholder="city">
                    <input type='submit' name='action' value='Add'>
                </form>
            <?php
            } else {
                echo "<p>There currently arent any tours planned</p>";
            }
            ?>

            </div>
<?php
        } else {
            header("Location: tours.php");
        }
    }
}
