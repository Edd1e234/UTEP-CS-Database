

<?php
/*
* Reference for tables: https://getbootstrap.com/docs/4.5/content/tables/
*/

session_start();
require_once('../config.php');
require_once('../validate_session.php');
require_once('constants.php');
?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
<?php
$account_name = $_SESSION[ACCOUNT_NAME];

$sql = "SELECT * from upcomingEvents where account_name = '" . $account_name . "';";
$events = array();
if ($result = $conn->query($sql)) {
    ?>
    <table class="table" width=50%>
        <thead>
        <td>Host</td>
        <td>Content </td>
        <td>Date </td>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch_row()) {
            $dateTime = new DateTime();
            $dateTime->setTimestamp($row[3]);
            $events[$row[0]] = 1;
            ?>
            <tr>
                <td><?php printf("%s", $row[1]); ?></td>
                <td><?php printf("%s", $row[2]); ?></td>
                <td><?php printf("%s", $dateTime->format("Y-m-d")); ?></td>
                <td><a href="update_event.php?event_id=<?php echo $row[0] ?>">Invite Guests</a></td>
                <td><a href="delete_event.php?event_id=<?php echo $row[0] ?>">Delete</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
} else {
    print("Query went wrong");
}

$sql = "select * from event where Event_id in (select Event_id from event_guess_list where account_name = '"
    . $account_name . "');";
if ($result = $conn->query($sql)) {
    ?>
    <table class="table" width=50%>
        <tbody>
        <?php
        while ($row = $result->fetch_row()) {
            if (array_key_exists($row[0], $events)) continue;
            $dateTime = new DateTime();
            $dateTime->setTimestamp($row[3]);
            $events[$row[0]] = 1;
            ?>
            <tr>
                <td><?php printf("%s", $row[1]); ?></td>
                <td><?php printf("%s", $row[2]); ?></td>
                <td><?php printf("%s", $dateTime->format("Y-m-d")); ?></td>
                <td><a href="delete_event.php?event_id=<?php echo $row[0] ?>">Delete</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
} else {
    print("Query did nto go through: " . $sql) ;
}
?>
<!-- Link to return to student_menu-->
<a href="menu.php">Menu</a><br>
<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>