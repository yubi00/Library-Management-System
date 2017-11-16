<?php require_once("session.php"); ?>
<?php confirm_logged_in(); ?>
<?php
	if(isset($_POST['submit']))
	{
		$dropdown1_value=$_POST['dropdown1'];
		$word = $_POST['search']; 
			if($dropdown1_value=="Keyword")
			{
				$id=1;
				header("Location: search_result.php?search={$word}&id={$id}");
				exit; 
			}
		
	}
	if(isset($_POST['submit']))
	{
		$dropdown1_value=$_POST['dropdown1'];
		$word = $_POST['search']; 
			if($dropdown1_value=="Title")
			{
				$id=2;
				header("Location: search_result.php?search={$word}&id={$id}");
				exit; 
			}
		
	}
	if(isset($_POST['submit']))
	{
		$dropdown1_value=$_POST['dropdown1'];
		$word = $_POST['search']; 
			if($dropdown1_value=="Author")
			{
				$id=3;
				header("Location: search_result.php?search={$word}&id={$id}");
				exit; 
			}
		
	}
?>
<html>
    <head>
        <title>Online Library Catalogue</title>
    </head>
    <body>
        <table border="0" width="800" height="700" align="center" cellspacing="0" cellpadding="0">
            <tr>
                <td height="150" colspan="2"><img src="image/banner.png" alt="islington banner" width="800" height="150"/></td>
            </tr>
            <tr>
                <td height="10" colspan="2"><img src="image/stripe.png" alt="stripe" width="800" height="10"/></td>
            </tr>
            <tr>
                <td height="50" colspan="2">
                <?php 
					$user=$_SESSION['User_Name'];
                 echo "Hello ". $user;
                ?>
                <a href = "user_logout.php">logout?</a><br />
                </td>
            </tr>
            <tr>
                <td width="300">
                    <img src="image/library.png" width="300" height="300" alt="library"/>
                </td>
                <td height="300" width="500"><br/>
                    <h1>Seach the Library Catalogue</h1>
                    
         
                    <form  align="left"  method =  "post"  >
                        <input  type="text" name="search"  size="50">
                        <select name="dropdown1">
                            <option value="Keyword">Keyword</option>
                            <option value="Title">Title</option>
                            <option value="Author">Author</option>
                        </select>
                        <input type="submit" value="Search" name="submit"/>
                    </form>
 
                </td>
                
            </tr>
            <tr>
                <td height="120" colspan="2">

				</td>
            </tr>
            <tr>
                <td height="70" colspan="2"><img src="image/footer.png" alt="footer" width="800" height="70"/></td>
            </tr>
            
        </table>
    </body>
</html>


