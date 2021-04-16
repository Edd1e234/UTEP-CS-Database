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
    <h1>Create User</h1>
    <!-- styling of the form for bootstrap https://getbootstrap.com/docs/4.5/components/forms/ -->
    <form action="createUser.php" method="post">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input class="form-control" type="text" id="firstname" name="firstname">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input class="form-control" type="text" id="lastname" name="lastname">
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input class="form-control" type="text" id="age" name="age">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" id="email" name="email">
        </div>
        <div class="form-group">
            <label for="id">Id</label>
            <input class="form-control" type="text" id="id" name="id">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" name='Submit' type="submit" value="Create User">
        </div>
    </form>
    <div>
        <br>
        <a href="createAccount.php">Click to create Account Name</a>-->
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
         * Grab information from the User and store values into variables.
         */
        $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : " ";
        $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : " ";
        $age = isset($_POST['age']) ? $_POST['age'] : " ";
        $email = isset($_POST['email']) ? $_POST['email'] : " ";
        $id = isset($_POST['id']) ? $_POST['id'] : " ";
        $password = isset($_POST['password']) ? $_POST['password'] : " ";

        //Insert into USER table;
        $queryUser  = "INSERT INTO User (Fname, Lname, age, email, id, password) 
                   VALUES ('".$firstname."', '".$lastname."', '".$age."', '".$email."', '".$id."', '".$password."');";
        if ($conn->query($queryUser) === TRUE)
        {
            echo "New user created successfully with id: ".$id."</p>";
        }
        else
        {
            echo "Error: " . $queryUser . "<br>" . $conn->error;
        }
        // If you want to redirect without seeing messages printed, uncomment the following line:
        // header("Location: index.php");
    }
    ?>
</body>
</html>

