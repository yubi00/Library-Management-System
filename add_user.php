<?php require_once("db_connection.php"); ?>

<?php 
	//Adding new records
	if(isset($_POST['add']))
	{
	$user_id = $_POST['userid']; 
	$username = $_POST['username']; 
	$password = $_POST['password']; 
	
	$add_records = "INSERT INTO user(User_ID, User_Name, User_Password)
					VALUES ({$user_id}, '{$username}', {$password})" ; 
	
	
	$add_result = mysql_query($add_records, $connection); 
	
	echo "Records added" ; 
	
	
	
	}



?>





<html>
    <head>
        <title>Islington Online Library Catalogue</title>
    </head>
    <body>
        <table border="1" width="800" height="700" align="center" cellspacing="1" cellpadding="1">
            <tr>
                <td height="150" colspan = "2"><img src="image/banner.png" alt="islington banner" width="800" height="150"/></td>
            </tr>
            <tr>
                <td height="10" colspan = "2"><img src="image/stripe.png" alt="stripe" width="800" height="10"/></td>
            </tr>
            <tr>
                <td height="40" colspan = "2"><a href = "logout.php">logout?</a></td>
            </tr>
            <tr>
                <td height="530" width = "200"><br/>
                <strong>Staff Panel</strong>
                
                   <table width = "100" align = "center" height = "200" border = "1" cellpadding="1" cellspacing="1">
					   <tr>
						   <td> <a href = "admin.php?id=1">Student</a></td>
					   </tr>
					   <tr>
						   <td><a href = "admin.php?id=2">Books</a></td>
					   </tr>
					   <tr>
						   <td><a href = "admin.php?id=3">Staffs</a></td>
					   </tr>
					   <tr>
						   <td><a href = "admin.php?id=4">Student Loan Records</a></td>
					   </tr>
                   </table>
                </td>
                <td>
					
					
					<form   method = "post">
						<fieldset>
							<legend>Add User</legend>
							UserID:   <input type = "text" name = "userid" size= "15" value=""/> <br/>
							Username: <input type = "text" name= "username" size = "30" value=""/ > <br />
							Password: <input type = "text" name="password" size = "30" value = ""/ > <br />
							<p></p>
							
							<input type = "submit" name="add" value = "Save"/>
						</fieldset>
					</form>
                </td>
            </tr>
           
            <tr>
                <td height="70" colspan = "2"><img src="image/footer.png" alt="footer" width="800" height="70"/></td>
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

