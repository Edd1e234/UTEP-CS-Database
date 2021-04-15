

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
$event_id = $_GET['event_id'];


$sql = "SELECT account_name from event_guess_list where Event_id = '" . $event_id . "';";
if ($result = $conn->query($sql)) {
    ?>
    <table class="table" width=50%>
        <thead>
        <td>Invited Guests</td>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch_row()) {
            if ($row[0] == $account_name) continue;
            ?>
            <tr>
                <td><?php printf("%s", $row[0]); ?></td>
                <td><a href="modify_event.php?remove_event=<?php echo $row[0] . "-" . $event_id ?>">Remove</a></td>
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

$sql = "select account_name from account where not account_name in (select account_name from event_guess_list "
        . "where Event_id = '" . $event_id . "')";
if ($result = $conn->query($sql)) {
    ?>
    <table class="table" width=50%>
        <thead>
        <td>Guests To Invite </td>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch_row()) {
            if ($row[0] == $account_name) continue;
            ?>
            <tr>
                <td><?php printf("%s", $row[0]); ?></td>
                <td><a href="modify_event.php?add_to_event=<?php echo $row[0] . "-" . $event_id ?>">Add</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
} else {
    print("Query did not go through: " . $sql) ;
}
?>
<!-- Link to return to student_menu-->
<a href="menu.php">Menu</a><br>
<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
