<!--
/**
 * CS 4342 Database Management
 * @author Instruction team Spring 2021 with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 * Resources: https://www.utep.edu/cs/support/FAQs%20Knowledge%20Base.html -- CS Department FAQ's for accessing servers
 *
 * MAKE SURE YOU HAVE CREATED THE TABLES provided in the CreateTablesFirst.txt file before running this files.
 */
-->

<?php
# localhost:8080
$host = "dbserver.cs.utep.edu"; #enter the DB server location
$db = "edgarcia5_s21makdb";   # 1. Enter your team database here for your group project.
                            # OR 2. Enter your individual database here to complete this exercise.

$username = "edgarcia5";  # If 1 above (for your group project), enter the username of the interface or reports lead.
                 # If 2 above (for this individual exercise), enter your username.

$password = "*MAK2021!!";  # If 1 above (for your group project), enter the password of the interface or reports lead. Make sure it is not used anywhere else as it will be shared among team members.
                 # If 2 above (for this individual exercise), enter your individual password.    
                   
                 

/**
 * Making the connection to the database.
 * Parameters - host, username, password, team database.
 */
$conn = new mysqli($host, $username, $password, $db);

/**
 * Validating the connection to server.
 */
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
