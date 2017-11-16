<?php require_once("session.php"); ?>
<?php require_once("db_connection.php"); ?>



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
					$id = $_GET['id']; 
					
					if(!isset($id))
					{
						echo "The value is not set"; 
					}
					
					
					
					switch($id)
					{
						case 1: //students profile page
						
						
						
						//Retrieving students information from a database 
						$result_array=mysql_query("SELECT * FROM user", $connection);
						if(!$result_array)
						{
							die("Data retrieval failed!".mysql_error());
						}
						
						echo "<strong>User_ID</strong>"."-------"."<strong>User_Name</strong>"."-------------"."<strong>User_Password</strong>". "<br/>"; 
						
						while($row=mysql_fetch_array($result_array))
						{
							echo $row["User_ID"]."----------".$row["User_Name"]."--------".$row["User_Password"]."----------". "<a href = \"edit_user.php?sid=".$row["User_ID"];
							echo "\">"; 
							echo "edit"; 
							echo "</a>"; 
							
							echo "-----". "<a href = \"edit_user.php?sid=".$row["User_ID"];
							echo "\">";
							echo "delete"; 
							echo "</a>";
							echo "<hr></hr>"; 
							
							
						
						}
						
					
							
						break; 
						
						case 2:
						
						
						//Retrieving Book information from a database 
						$result_array=mysql_query("SELECT * FROM book, book_category WHERE book.BC_ID= book_category.BC_ID", $connection);
						if(!$result_array)
						{
							die("Data retrieval failed!".mysql_error());
						}
						
						echo "<strong>Book ID</strong>"."-------"."<strong>Book Title</strong>"."-------------"."<strong>Author</strong>". "<br/>"; 
						
						while($row=mysql_fetch_array($result_array))
						{
							echo $row["Book_ID"]."----------".$row["Book_Name"]."--------".$row["Book_Author"]."----------".$row["Book_Genre"]."-----". $row["Book_Quantity"]."<a href = \"edit_book.php?bid=".$row["Book_ID"];
							echo "\">"; 
							echo "edit"; 
							echo "</a>"; 
							
							echo "-----". "<a href = \"edit_book.php?bid=".$row["Book_ID"];
							echo "\">";
							echo "delete"; 
							echo "</a>";
							echo "<hr></hr>"; 
							
							
						
						}
						break; 
						
						case 3:
						echo "Staff page"; 
						
						//Retrieving staff information from a database 
						$result_array=mysql_query("SELECT * FROM staff", $connection);
						if(!$result_array)
						{
							die("Data retrieval failed!".mysql_error());
						}
						
						echo "<strong>Staff ID</strong>"."-------"."<strong>Staff Name</strong>"."-------------"."<br/>"; 
						
						while($row=mysql_fetch_array($result_array))
						{
							echo $row["Staff_ID"]."----------".$row["Staff_Name"]."--------".$row["Staff_Password"]."----------". "<a href = \"edit_staff.php?staff=".$row["Staff_ID"];
							echo "\">"; 
							echo "edit"; 
							echo "</a>"; 
							
							echo "-----". "<a href = \"edit_staff.php?staff=".$row["Staff_ID"];
							echo "\">";
							echo "delete"; 
							echo "</a>";
							echo "<hr></hr>"; 
							
							
						
						}
						break; 
						
						case 4: 
						echo "Student loan records page". "<br/>"; 
						
						//Retrieving student loan  information from a database 
						$result_array=mysql_query("SELECT * FROM booking_info, book, user WHERE booking_info.Book_ID= book.Book_ID AND  booking_info.User_ID= user. User_ID ", $connection);
						
						if(!$result_array)
						{
							die("Data retrieval failed!".mysql_error());
						}
						
						echo "<strong>Booking ID</strong>"."----"."<strong>User Name</strong>"."---"."<strong>Book Name</strong>". "-----"."<strong>Staff Name</strong>"."-----"."<strong>From Date</strong>"."----"."<strong>To Date</strong>"."<br/>"; 
						
						while($row=mysql_fetch_array($result_array))
						{
							echo $row["Booking_ID"]."-----".$row["User_Name"]."----".$row["Book_Name"]."----".$row["From_Date"]."------". $row["To_Date"]."<br />";
							echo "<hr></hr>"; 
							
							
						
						}
						break;
						
						default: 
						echo "page not found"; 
						break; 
					
					
					
					}
					
					
					
					
					 
					?> 
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
