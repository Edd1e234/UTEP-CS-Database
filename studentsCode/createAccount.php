<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CS4342 Create User Account</title>

    <!-- Importing Bootstrap CSS library https://getbootstrap.com/ -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>

<body>
<div style="margin-top: 20px" class="container">
    <h1>Create Account</h1>
    <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
    <form action="createAccount.php" method="post">
        <div class="form-group">
            <label for="id">ID</label>
            <input class="form-control" type="text" id="id" name="id">
        </div>
        <div class="form-group">
            <label for="account_name">Account Name</label>
            <input class="form-control" type="text" id="account_name" name="account_name">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" name='Submit' type="submit" value="Create Account">
        </div>
    </form>
    <div>
        <br>
        <a href="createUser.php">Click to create User</a>-->
    </div>

    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- PhP code starts here -->
<?php
require_once('config.php');

if (isset($_POST['Submit']))
{
    /**
     * Grab information from the Account and store values into variables.
     */
    $id = isset($_POST['id']) ? $_POST['id'] : " ";
    $account_name = isset($_POST['account_name']) ? $_POST['account_name'] : " ";

    //Insert into ACCOUNT table;
    $queryAccount  = "INSERT INTO Account (id, account_name)
                   VALUES ('".$id."', '".$account_name."');";
    if ($conn->query($queryAccount) === TRUE)
    {
        echo "New account created successfully with the username: ".$account_name."</p>";
    }
    else
    {
        echo "Error: " . $queryAccount . "<br>" . $conn->error;
    }
    // If you want to redirect without seeing messages printed, uncomment the following line:
    //header("Location: index.php");
}
?>
</body>
</html>