
<?php
// Accessing the information for the DB connection from the configuration file and validating that a user is logged in.
session_start();
require('../config.php');
require_once('../validate_session.php');
require_once("constants.php");

define('ACCOUNT_INFO', "account_info");

$note = array_key_exists('note', $_GET) ? $_GET['note'] : null;

function getMessages($receipt_account_name, $account_name, $connection): array {
    $query = "select Date, Content from messages where receipt_account_name = '$receipt_account_name' AND account_name = '$account_name';";
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
if (array_key_exists(ACCOUNT_INFO, $_GET)) {
    $values = explode("-", $_GET[ACCOUNT_INFO]);
    $receipt_account_name = $values[0];
    $account_name = $values[1];
} else {
    $receipt_account_name = $_GET[RECEIPT_ACCOUNT_NAME];
    $account_name = $_SESSION[ACCOUNT_NAME];
}

# $conn = (new Connection())->getConnection();

queryMessage($note, $conn, $receipt_account_name, $account_name);
$messages = getMessages($receipt_account_name, $account_name, $conn);
$account_messages = getMessages($account_name, $receipt_account_name, $conn);
$messages = array_merge($messages, $account_messages);
usort($messages, 'comparator');

function queryMessage($note, $connection, $receipt_account_name, $account_name) {
    if (!empty($note)) {
        $date = (new DateTime())->getTimestamp();
        $queryMessage = "INSERT INTO messages(receipt_account_name, account_name, Date, content) VALUES " .
            "('$receipt_account_name', '$account_name', $date, '$note')";
        if ($connection->query($queryMessage) === FALSE) {
            print("Failed at :" . $queryMessage);
        }
    }
}

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
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
    <table class="table" width="50%">
      <thread>
          <td> Messages </td>
          <tbody>
          <?php
          $note = array_key_exists('note', $_POST) ? $_POST['note'] : null;
          foreach ($messages as $message) {
              $name = ($message->account_name == $account_name) ? $account_name : $receipt_account_name;
          ?>
              <tr>
                  <td><?php printf("%s", $name . ": " . $message->content); ?></td>
              </tr>
          <?php
          }
          ?>
          </tbody>
      </thread>
    </table>
    <table class="table" width="50%">
        <?php
        $url_param = $receipt_account_name . "-" . $account_name;
        ?>
        <form action="<?=$_SERVER['PHP_SELF'] ?>" method="GET">
            <textarea cols=40 rows=5 name="note" wrap=virtual></textarea>
            <p/>
            <input type=submit value="<?=$receipt_account_name?>" name="<?=RECEIPT_ACCOUNT_NAME?>">
        </form>
    </table>
<!-- Link to return to student_menu-->
<!-- TODO Change this! -->
<a href="menu.php?">Back to Menu</a><br>
<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

