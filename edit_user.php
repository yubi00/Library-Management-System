<?php require_once("db_connection.php"); ?>



<?php
//edit form  processing
	if(isset($_POST['update']))
	{
		
		$userid=$_GET['sid'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		
		
		
		//Modifying the old records with the new one 
		$edit_query="UPDATE user SET
						User_Name='{$username}',
						User_Password={$password}
						WHERE User_ID={$userid}";
						
		$edit_result=mysql_query($edit_query, $connection);
		echo "records updated successfully"; 
		
		
	}
?>

<?php
	//delete form processing
	if(isset($_POST['delete']))
	{
		$id=$_GET['sid'];
		
		$delete_data="DELETE FROM user WHERE User_ID={$id} LIMIT 1";
		$delete_query=mysql_query($delete_data, $connection);
		
		
		
		//deleting corressponding book loan records of the deleted user 
		
		$delete_bookinfo=mysql_query("DELETE FROM book_info WHERE User_ID={$id} LIMIT 1", $connection);
		echo "deleted successfully" ; 
		
		//if delete process successful, redirect to user page
		header("Location: admin.php?id=1");
		
		
	}

?>

<?php
	if(isset($_POST['add']))
	{
			header("Location: add_user.php");
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
					<?php
					//Retrieving sid from the link 
					$user_id=$_GET["sid"];
					?>
					
					<?php
						$query="SELECT * FROM user ";
						$query.="WHERE User_ID= ";
						$query.=$user_id;
						$result_array=mysql_query($query, $connection);
							if(!$result_array)
							{
								die("Query submission failed!".mysql_error());
							}
						
						//fetch array
						$row=mysql_fetch_array($result_array);
					?>
					
					<form   method = "post">
						<fieldset>
							<legend>Update User</legend>
							UserID:   <input type = "text" name = "userid" size= "15" value="<?php echo $row["User_ID"]; ?>"/> <br/>
							Username: <input type = "text" name= "username" size = "30" value="<?php echo $row["User_Name"]; ?>"/ > <br />
							Password: <input type = "text" name="password" size = "30" value = "<?php echo $row["User_Password"]; ?>"/ > <br />
							<p></p>
							<input type = "submit" name="update" value ="Update"/>
							<input type =  "submit" name="delete" value = "Delete"/>
							<input type = "submit" name="add" value = "Create New User"/>
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

