
<?php
// Accessing the information for the DB connection from the configuration file and validating that a user is logged in.
session_start();
require_once('../config.php');
require_once('../validate_session.php');

function getMessages($receipt_account_name, $account_name, $connection): array {
    $query = "select * from message_content where Date in (select Date from message where Receipt_account_name ='"
        . $receipt_account_name . "' AND Account_name = '" . $account_name . "')";
    $receipt_account_name_messages = array();
    if ($result = $connection->query($query)) {
        while ($row = $result->fetch_row()) {
            array_push($receipt_account_name_messages, new Message($row[0], $row[1], $account_name));
        }
    } else {
        echo "Something has gone wrong \n Query: " . $query;
    }
    return $receipt_account_name_messages;
}

function comparator($message_1, $message_2): int {
    if ($message_1->date > $message_2->date) {
        return 1;
    }
    return 0;
}

# TODO Change this from Sid to account_name
$receipt_account_name = $_GET['Sid'];

# TODO This is considered the logged in account!
$account_name = "NEPatriots12";
$messages = getMessages($receipt_account_name, $account_name, $conn);
$account_messages = getMessages($account_name, $receipt_account_name, $conn);

$messages = array_merge($messages, $account_messages);
usort($messages, 'comparator');
print_r($messages);

/*
    $sid = isset($_POST['Sid']) ? $_POST['Sid'] : " ";
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : " ";
    $middleName = isset($_POST['middle_name']) ? $_POST['middle_name'] : " ";
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : " ";

    $query = "UPDATE Student SET SfirstName='$firstName', SmiddleName='$middleName', SlastName='$lastName' WHERE Sid = $sid";
    echo $query;

    if (mysqli_query($conn, $query)) {
        echo "Record updated successfully";
        header("Location: view_students.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
*/

class Message {
    public int $date = -1;
    public String $content;
    public String $account_name;
    function __construct($date, $content, $account_name) {
        $this->date = $date;
        $this->content = $content;
        $this->account_name = $account_name;
    }
}
?>