

<?php
/*
* Reference for tables: https://getbootstrap.com/docs/4.5/content/tables/
*/

session_start();
require_once('../config.php');
require_once('../validate_session.php');
require_once("constants.php");
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
$sql = "select account_name from account;";
if ($result = $conn->query($sql)) {
    ?>
    <table class="table" width=50%>
        <thead>
        <td> Messages</td>
        </thead>
        <tbody>
        <?php
        function getAccountNames($result) {
            $receipt_account_names = array();
            while ($row = $result->fetch_row()) {
                $receipt_account_names[$row[0]] = 1;
            }
            return $receipt_account_names;
        }
        $receipt_account_names = array_keys(getAccountNames($result));
        foreach ($receipt_account_names as $receipt_account_name) {
            if ($receipt_account_name == $account_name) continue;
            $url_params = RECEIPT_ACCOUNT_NAME . "=" . $receipt_account_name;
            ?>
            <tr>
                <td><?php printf("%s", $receipt_account_name); ?></td>
                <td><a href="message_content.php?<?php echo $url_params?>">View</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>
<!-- Link to return to student_menu-->
<a href="menu.php?">Back to Student Menu</a><br>
<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>