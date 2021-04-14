<?php

session_start();
require_once('../config.php');
require_once('../validate_session.php');
require_once('constants.php');
require_once('delete_event.php');

if (isset($_GET["remove_event"])) {
    $values = explode("-", $_GET["remove_event"]);
    $account_to_be_removed = $values[0];
    $event_id = $values[1];

    $delete = "DELETE from event_guess_list where account_name = '"
        . $account_to_be_removed . "' AND event_id = '" . $event_id . "';";
    queryFunction($conn, $delete, "update_event.php?event_id=" . $event_id);
    print("Something has gone wrong");
}

if (isset($_GET["add_to_event"])) {
    $values = explode("-", $_GET["add_to_event"]);
    $account_to_be_added = $values[0];
    $event_id = $values[1];
    $sql = "insert into event_guess_list(Event_id, account_name) values('". $event_id . "','" . $account_to_be_added ."');";
    queryFunction($conn, $sql, "update_event.php?event_id=" . $event_id);
    die();
    print("Something has gone wrong");
} else {
    print("No key specified");
}

?>
