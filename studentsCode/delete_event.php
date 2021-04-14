

<?php

session_start();
require_once('../config.php');
require_once('../validate_session.php');
require_once('constants.php');

function queryFunction($connection, $query, $location="events.php?dfafkaldfalkjf") {

    if ($connection->query($query) === TRUE) {
        echo "Student deleted successfuly";
        header("Location: " . $location);
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }
}

if (isset($_GET['event_id'])){

    $event_id = $_GET['event_id'];
    $delete = "DELETE from event_guess_list where Event_id = '$event_id'";
    queryFunction($conn, $delete);

    $delete = "delete from event where Event_id = '$event_id'";
    queryFunction($conn, $delete);


} else{
    echo "No Event_id received";
    header("Location: events.php");
}

?>