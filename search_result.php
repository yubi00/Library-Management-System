<?php require_once("session.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("db_connection.php"); ?>

<?php 
	if(isset($_POST['submit']))
	{
		//checking if the current user has taken max no of books
		$loggedin_user=$_SESSION['User_id'];
		$maxbook_query="SELECT Book_Taken FROM user WHERE User_ID={$loggedin_user} LIMIT 1";
							
		$bookingquery="SELECT * FROM booking_info";
						
							
		$maxbook_result=mysql_query($maxbook_query, $connection);
							
							
		$maxbook_data=0;
		while($rows=mysql_fetch_array($maxbook_result))
		{
			$maxbook_data=$rows['Book_Taken'];
			//echo $max_book_data;
		}
		
		//if max books taken i.e. 2, no reserve buttons should be shown, but renew should be
		$start_reserve=0;
		if($maxbook_data<2)
		{
			$start_reserve=1; //making a boolean for button "reserve" display
		}
		else if($maxbook_data==2)
		{
			$start_reserve=0;
		}
							
		//checking the book list if it matches with the book previously taken by the user
		//this code show "renew" button if necessary
							
							
		//this is the end of 
						
		
		$dropdown1_value=$_POST['dropdown1'];
		$word = $_POST['search']; 
		if($dropdown1_value=="Keyword" or $dropdown1_value=="Title")
		{
			$holder="Book_Name";
		}
		else if($dropdown1_value=="Author")
		{
			$holder="Book_Author";
		}
		
			$terms = explode(" ", $word); //explode funtion take the whole keywords as different terms in an array
						
			$query = "SELECT * FROM book WHERE";
			$i= 0; 
													
			foreach($terms as $each)
			{
				$i++; 
				if($i==1)
				{
					$query.=" {$holder} LIKE '%$each%' "; 
				}
				else
				{
					$query.="OR {$holder} LIKE '%$each%' "; 
				}
			}
			$query = mysql_query($query);
			$numrow = mysql_num_rows($query); 	
			
			$start_renew = 0; 

		
		
	}

 
?>

<?php
	//reserving a book
	if(isset($_POST['reserve']))
	{
		
		$user = $_SESSION['User_Name'];
		
		$userid = $_SESSION['User_id']; 
		$bookid = $_POST['bid'];
		
		echo $user; 
		echo $userid; 
		echo $bookid; 
		 
		$current_date = date("Y-m-d"); //current date 
		$booking = "INSERT INTO booking_info (User_ID, Book_ID,From_Date)
					VALUES ('{$userid}', '{$bookid}','{$current_date}')" ;
					
		$booking_result = mysql_query($booking, $connection); 
		
		$booktaken = "SELECT Book_Taken FROM user WHERE User_ID = {$userid} LIMIT 1"; 
		
		$maxbook_result=mysql_query($booktaken, $connection);
							
		$user_select=mysql_query("SELECT Book_Taken FROM user WHERE User_ID={$userid} LIMIT 1", $connection);
		$row8=mysql_fetch_array($user_select);
							
		//adding 1 to book taken
		$added_value=$row8['Book_Taken']+1;
		$query8="UPDATE user SET
				Book_Taken={$added_value}
				WHERE User_ID={$userid}";
		$carry_out=mysql_query($query8,$connection);
		
		echo "book reserve"; 
		header("Location: main_catalogue.php"); 
		exit; 
	}
	


?>

<?php

	//renewing a book 
	if(isset($_POST['renew']))
	{
			$userid = $_SESSION['User_id']; 
			$bookingdate = "SELECT To_Date FROM booking_info WHERE User_ID={$userid} LIMIT 1";
			$bookingdate_query = mysql_query($bookingdate, $connection);
			
			$row9 = mysql_fetch_array($bookingdate_query);
			
			
			//adding 5 days to To_Date
			$added_date = $row9['To_Date']; 
			echo $added_date; 
			echo "<br/>"; 
			
			
		
	}


?>


<html>
    <head>
        <title>Search Results</title>
    </head>
    <body>
        <table border="0" width="800" height="700" align="center" cellspacing="0" cellpadding="0">
            <tr>
                <td height="150" ><img src="image/banner.png" alt="islington banner" width="800" height="150"/></td>
            </tr>
            <tr>
                <td height="10" ><img src="image/stripe.png" alt="stripe" width="800" height="10"/></td>
            </tr>
            <tr>
                <td height="20" >
					
					<?php 
						$user=$_SESSION['User_Name'];
						echo "Hello ". $user;
					?>
					<a href = "user_logout.php">logout?</a>
					<b>Search the Library Catalogue</b>
                    <form action = "search_result.php" align="left" method = "post">
                        <input action="./search_result.php" type="text"  name = "search" size="50" value="<?php if(isset($_GET['search']))echo $_GET['search'];  ?>"/>
                        <select name = "dropdown1">
                            <option value="Keyword" name="keyword">Keyword</option>
                            <option value="Title" name="title">Title</option>
                            <option value="Author" name="author">Author</option>
                        </select>
                        <input type="submit" value="Search" name="submit"/>
                    </form>
                </td>
            </tr>
            <tr>
                
                <td>
				<?php
					
				
					if(!isset($_POST['submit']))
					{
							//checking if the current user has taken max no of books
							$current_user=$_SESSION['User_id'];
							$max_book_query="SELECT Book_Taken FROM user WHERE User_ID={$current_user} LIMIT 1";
							
							$booking_query="SELECT * FROM booking_info";
						
							
							$max_book_result=mysql_query($max_book_query, $connection);
							
							
							$max_book_data=0;
							echo "<strong>Book ID</strong>"."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<strong>Book_Name</strong>"."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<strong>Book_Author</strong>"."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<strong>Book_Quantity</strong>"."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"."<strong>Availability</strong>";
							
							while($row=mysql_fetch_array($max_book_result))
							{
								$max_book_data=$row['Book_Taken'];
								//echo $max_book_data;
							}
							
							//if max books taken i.e. 2, no reserve buttons should be shown, but renew should be
							$start_reserve_button=0;
							if($max_book_data<2)
							{
								$start_reserve_button=1; //making a boolean for button "reserve" display
							}
							else if($max_book_data==2)
							{
								$start_reserve_button=0;
							}
							
							//checking the book list if it matches with the book previously taken by the user
							//this code show "renew" button if necessary
							
							
							//this is the end of 
						
							$search_word=$_GET['search'];
							$search_id=$_GET['id'];
							
							$hold = ""; 
							
							if($search_id==1 or $search_id==2)
							{
								$hold = "Book_Name"; 
							}
							else if($search_id==3)
							{
								$hold = "Book_Author"; 
							}
							$terms = explode(" ", $search_word); //explode funtion take the whole keywords as different terms in an array
							
							$db_query = "SELECT * FROM book WHERE";
							$i= 0; 
												
							foreach($terms as $each)
							{
								$i++; 
								if($i==1)
								{
									$db_query.=" {$hold} LIKE '%$each%' "; 
								}
								else
								{
									$db_query.="OR {$hold} LIKE '%$each%' "; 
								}
							}
							$db_query = mysql_query($db_query);
							$numrows = mysql_num_rows($db_query); 	
							
							$start_renew_button=0;
							if(isset($numrows))
							{
								if($numrows > 0)
								{
									while($row_last= mysql_fetch_array($db_query))
									{
										$booking_result=mysql_query($booking_query, $connection);
										
										while($row2=mysql_fetch_array($booking_result))
										{
											if($row2['User_ID']==$current_user)
											{
												if($row2['Book_ID']==$row_last['Book_ID'])
												{
													$start_renew_button=1;
												}
											}
										}
										
										
										
										
										echo "<form method=\"post\">";
										echo "<input type=\"text\" name=\"bid\" value=\"{$row_last['Book_ID']}\" size=\"1\">"."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
										echo $row_last['Book_Name']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$row_last['Book_Author']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$row_last['Book_Quantity']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; 
										
										//checking availability section
										$booking_query="SELECT * FROM booking_info";
										$book_available=mysql_query($booking_query);
										
										$book_counter=0;
										$final_book_counter=0;
										while($row_ava=mysql_fetch_array($book_available))
										{
											if($row_last['Book_ID']==$row_ava['Book_ID'])
											{
												$book_counter+=1;
											}
										}
										$final_book_counter=$row_last['Book_Quantity']-$book_counter;
										if($final_book_counter>0)
										{
											echo " Available";
											
											//if only available reserve button appears
											if($start_renew_button==1)
											{
												echo"<input type = \"submit\" value=\"Renew\" name=\"renew\"> ";    
												
											}
											else if($start_reserve_button==1)
											{
												echo"<input type = \"submit\" name=\"reserve\" value=\"reserve\" >  ";    
												
											}
										}
										else
										{
											echo " Unavailable";
											
											//even if book is unavailable, user can renew the book he's got
											if($start_renew_button==1)
											{
												echo"<input type = \"submit\" value=\"Renew\" name=\"renew\" >  ";    
												
											}
										}

										//end of checking availability section
										
										
										
										$start_renew_button=0;
										echo "<br/>";
										
										echo "</form>";
										
									
										
									}
								}
								else
								{
									echo "No results found for {$search_word}"; 
								}
							}
						
					}
					
					if(isset($numrow))
					{
						if($numrow > 0)
						{
							while($last_row= mysql_fetch_array($query))
							{
								$booking_result_query=mysql_query($bookingquery, $connection);
								
								while($second_row=mysql_fetch_array($booking_result_query))
								{
									if($second_row['User_ID']==$loggedin_user)
									{
										if($second_row['Book_ID']==$last_row['Book_ID'])
										{
											$start_renew=1;
										}
									}
								}
								
								echo "<form method=\"post\">";
								echo "<input type = \"text\" name=\"bid\" value=\"{$last_row['Book_ID']}\" size=\"1\">";
								echo $last_row['Book_Name']."&nbsp".$last_row['Book_Author']."&nbsp".$last_row['Book_Quantity'];
								
								//checking availability section
								$bookingquery="SELECT * FROM booking_info";
								$book_availability=mysql_query($bookingquery);
										
								$bookcounter=0;
								$finalbook_counter=0;
								while($row_avai=mysql_fetch_array($book_availability))
								{
									if($last_row['Book_ID']==$row_avai['Book_ID'])
									{
										$bookcounter+=1;
									}
								}
								$finalbook_counter=$last_row['Book_Quantity']-$bookcounter;
								
								if($finalbook_counter > 0)
								{
									echo "Available"; 
									//if only available reserve button appears
									
									if($start_renew==1)
									{
										echo"<input type = \"submit\" value=\"Renew\" name=\"renew\" >  ";    
												
									}
									else if($start_reserve==1)
									{
										echo"<input type = \"submit\" value=\"Reserve\" name=\"reserve\" >  ";    
												
									}
									
								}
								else
								{
									echo " Unavailable";
									
									//even if book is unavailable, user can renew the book he's got
									if($start_renew==1)
									{
										echo"<input type = \"submit\" value=\"Renew\" name=\"renew\" >  ";    
										
									}
								}

								//end of checking availability section
								
										
								$start_renew=0;
								echo "<br/>";
								echo "</form>";
							}
						}
						else
						{
							echo "No results found for {$word}"; 
						}
					}
					
		
						
				?>
					
                   
                </td>
                
            </tr>
            
            <tr>
                <td height="70" ><img src="image/footer.png" alt="footer" width="800" height="70"/></td>
            </tr>
            
        </table>
    </body>
</html>
<?php mysql_close($connection); ?>


