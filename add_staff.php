<?php require_once("db_connection.php"); ?>

<?php
//insert form  processing
	if(isset($_POST['add']))
	{
		
		
		$staffid=$_POST['staffid'];
		$staffname=$_POST['staffname'];
		$staffpassword=$_POST['staffpassword'];
		
		//Adding new staff 
		$add_records = "INSERT INTO staff(Staff_ID, Staff_Name, Staff_Password)
					VALUES ({$staffid}, '{$staffname}', '{$staffpassword}')" ; 
	
	
		$add_result = mysql_query($add_records, $connection); 
		
		
	
		echo "records added successfully"; 
		
		
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
							<legend>Add Staff</legend>
							UserID:   <input type = "text" name = "staffid" size= "15" value=""/> <br/>
							Username: <input type = "text" name= "staffname" size = "30" value=""/ > <br />
							Password: <input type = "text" name="staffpassword" size = "30" value = ""/ > <br />
							<p></p>
							
							<input type = "submit" name="add" value ="Save"/>
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


