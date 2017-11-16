<?php require_once("db_connection.php"); ?>

<?php
//edit form  processing
	if(isset($_POST['update']))
	{
		
		
		$bookid=$_GET['bid'];
		$bookname=$_POST['bookname'];
		$bookauthor=$_POST['bookauthor'];
		$bookcategory_id = $_POST['bookcategoryid'];
		$bookquantity = $_POST['bookquantity']; 
		
		
		
		//Modifying the old records with the new one 
		$edit_query="UPDATE book SET
						Book_Name='{$bookname}',
						Book_Author='{$bookauthor}',
						BC_ID = {$bookcategory_id},
						Book_Quantity = {$bookquantity}	
						WHERE Book_ID={$bookid}";
						
		$edit_result=mysql_query($edit_query, $connection);
		echo "records updated successfully"; 
		
		
	}
?>

<?php
	//delete form processing
	if(isset($_POST['delete']))
	{
		$bookid=$_GET['bid'];
		
		$delete_data="DELETE FROM book WHERE Book_ID={$bookid} LIMIT 1";
		$delete_query=mysql_query($delete_data, $connection);
		
		
		
		
		echo "deleted successfully" ; 
		
		//if delete process successful, redirect to book page
		header("Location: admin.php?id=2");
		
		
	}

?>
<?php
	if(isset($_POST['add']))
	{
			header("Location: add_book.php");
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
					//Retrieving bid from the link 
					$book_id=$_GET["bid"];
					?>
					
					<?php
						$query="SELECT * FROM book ";
						$query.="WHERE Book_ID= ";
						$query.=$book_id;
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
							<legend>Update Book</legend>
							Book ID:   <input type = "text" name = "bookid" size= "15" value="<?php echo $row["Book_ID"]; ?>"/> <br/>
							Title: <input type = "text" name= "bookname" size = "30" value="<?php echo $row["Book_Name"]; ?>"/ > <br />
							Author: <input type = "text" name="bookauthor" size = "30" value = "<?php echo $row["Book_Author"]; ?>"/ > <br />
							BC_ID: <input type = "text" name = "bookcategoryid" size = "30" value = "<?php echo $row["BC_ID"]; ?>"/><br/>
							Quantity: <input type = "text" name = "bookquantity" size = "30" value = "<?php echo $row["Book_Quantity"]; ?>"/> <br /> 
							<p></p>
							<input type = "submit" name="update" value ="Update"/>
							<input type = "submit" name="delete" value ="Delete"/>
							<input type = "submit" name="add" value ="Add New Book"/>
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


