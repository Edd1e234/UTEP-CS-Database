<!--
/**
 * CS 4342 Database Management
 * @author Instruction team Spring and Fall 2020 with contribution from L. Garnica
 * @version 2.0
 * Description: The purpose of these file is to provide PhP basic elements for an interface to access a DB. 
 * Resources: https://getbootstrap.com/docs/4.5/components/alerts/  -- bootstrap examples
 *
 */
-->
<?php
if (!isset($_SESSION['logged_in']) || empty($_SESSION['logged_in'])) { 
     //header('Location: ../index.php'); 
	 die("::Access restricted to users logged in::");
}
?>