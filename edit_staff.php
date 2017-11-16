<?php require_once("db_connection.php"); ?>

<?php
//edit form  processing
	if(isset($_POST['update']))
	{
		
		
		$staffid=$_GET['staff'];
		$staffname=$_POST['staffname'];
		$staffpassword=$_POST['staffpassword'];
		
		
		//Modifying the old records with the new one 
		$edit_query="UPDATE staff SET
						Staff_Name='{$staffname}',
						Staff_Password={$staffpassword}	
						WHERE Staff_ID={$staffid}";
						
		$edit_result=mysql_query($edit_query, $connection);
		echo "records updated successfully"; 
		
		
	}
?>
<?php
	//delete form processing
	if(isset($_POST['delete']))
	{
		$id=$_GET['staff'];
		
		$delete_data="DELETE FROM staff WHERE Staff_ID={$id} LIMIT 1";
		$delete_query=mysql_query($delete_data, $connection);
		
		
		
		//deleting corressponding book loan records of the deleted staff 
		
		$delete_booking=mysql_query("DELETE FROM book_info WHERE Staff_ID={$id} LIMIT 1", $connection);
		
		
		//if delete process successful, redirect to staff page
		header("Location: admin.php?id=3");
		
		
	}

?>
<?php
	if(isset($_POST['add']))
	{
			header("Location: add_staff.php");
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
					$staff_id=$_GET["staff"];
					?>
					
					<?php
						$query="SELECT * FROM staff ";
						$query.="WHERE Staff_ID= ";
						$query.=$staff_id;
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
							<legend>Update Staff</legend>
							UserID:   <input type = "text" name = "staffid" size= "15" value="<?php echo $row["Staff_ID"]; ?>"/> <br/>
							Username: <input type = "text" name= "staffname" size = "30" value="<?php echo $row["Staff_Name"]; ?>"/ > <br />
							Password: <input type = "text" name="staffpassword" size = "30" value = "<?php echo $row["Staff_Password"]; ?>"/ > <br />
							<p></p>
							<input type = "submit" name="update" value ="Update"/>
							<input type = "submit" name="delete" value ="Delete"/>
							<input type = "submit" name="add" value ="Add New Records"/>
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


