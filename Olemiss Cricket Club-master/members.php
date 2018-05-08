<?php 
	require_once("session.php"); 
	require_once("included_functions.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

	
	//****************  Add Query
	$query = "SELECT userID, fname, lname, phone from Users order by lname";
	$result = $mysqli->query($query);


	//  Execute query
				
				
	if ($result && $result->num_rows > 0) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Current Active Members</h2>";
		echo "<table>";
		echo "<tr><th>Name</th><th></th><th>Contact Info </th></tr>";
		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			//Output FirstName and LastName
			 echo "<td style='text-align:center'>".htmlentities($row["fname"])." ".htmlentities($row["lname"])." ".htmlentities($row["phone"])."</td>";
	


			echo "</tr>";

		}
		
		echo "</table>";
		echo "<br /><br /><a href='signup.php'> JOIN THE CLUB </a> | <a href='signin.php'>LOG IN </a>";
		echo "</center>";
		echo "</div>";
	}


?>