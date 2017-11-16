<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>
<?php require_once("functions.php"); ?>

<?php
	if (logged_in()) {
		redirect_to("main_catalogue.php");
	}
	
	include_once("form_functions.php");
	
	//starting form processing 
	
	if (isset($_POST['submit'])) { // Form has been submitted.
		$errors = array();
		
		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		
		
		if ( empty($errors) ) {
			// Check database to see if username and the hashed password exist there.
			$query = "SELECT User_ID, User_Name ";
			$query .= "FROM user ";
			$query .= "WHERE User_Name = '{$username}' ";
			$query .= "AND User_Password = '{$password}' ";
			$query .= "LIMIT 1";
			$result_set = mysql_query($query);
			confirm_query($result_set);
			if (mysql_num_rows($result_set) == 1) {
				// username/password authenticated
				// and only 1 match
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['User_id'] = $found_user['User_ID'];
				$_SESSION['User_Name'] = $found_user['User_Name'];
				
				redirect_to("main_catalogue.php");
			} else {
				// username/password combo was not found in the database
				$message = "Username/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
			}
		} else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
		
	} else { // Form has not been submitted.
		if (isset($_GET['logout']) && $_GET['logout'] == 1) {
			$message = "You are now logged out.";
		} 
		$username = "";
		$password = "";
	}

?>






<html>
    <head>
        <title>login page</title>
    </head>
    <body>
        <table border="0" width="800" height="700" align="center" cellspacing="0" cellpadding="0">
            <tr>
                <td height="150"><img src="image/banner.png" alt="islington banner" width="800" height="150"/></td>
            </tr>
            <tr>
                <td height="10"><img src="image/stripe.png" alt="stripe" width="800" height="10"/></td>
            </tr>
            <tr>
                <td height="50" ></td>
            </tr>
            <tr>
                <td height="300"><br/>
                	<?php if (!empty($message)) {echo "<p class=\"message\">" . $message . "</p>";} ?>
                	
					<?php if (!empty($errors)) { display_errors($errors); } ?>
					
                    <form action="index.php" method="post">
                        <fieldset>
                            <legend>Login details:</legend>
                       <table align="center">
                        <tr>
                            <td> <label for = 'username'>Username*:</label><input name="username" maxlength="30" type="text" value="<?php echo htmlentities($username); ?>"  /> </td>
                        </tr>
                        <tr>
                            <td><label for = 'password'>Password*:</label><input name="password" maxlength="30" type="password" value="<?php echo htmlentities($password); ?>" /></td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input name="submit" type="submit" value="Login"/></td>
                        </tr>
                       </table>
                       </fieldset>
                   
                    </form>
                </td>
            </tr>
            <tr>
                <td height="120"></td>
            </tr>
            <tr>
                <td height="70"><img src="image/footer.png" alt="footer" width="800" height="70"/></td>
            </tr>
            
        </table>
    </body>
</html>
<?php
	if(isset($connection))
	{
	mysql_close($connection);
	}
?>
