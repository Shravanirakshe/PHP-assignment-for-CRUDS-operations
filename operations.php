<!DOCTYPE html>
<html>
	<head>
		<title>Operations</title>
	</head>
	
	<body>
		<?php
			
			$con = new mysqli("localhost", "root", "", "student");
	
			if($con->connect_error) 
			{
				die("Connection failed: " . $con->connect_error);
			}
			else 
			{
				echo "Connection successful<br>";
			}
		
			if(array_key_exists("submitInsert", $_POST))
			{
				$nameInsert = $_POST["nameInsert"];
				$rollNoInsert = $_POST["rollNoInsert"];
				$marksInsert = $_POST["marksInsert"];

				$sql = "INSERT INTO details(rollNo, name, marks) VALUES ('$rollNoInsert', '$nameInsert', '$marksInsert')";

				if($con->query($sql) == TRUE)
				{
					echo "Record inserted successfully";
				}
				else
				{
					echo "Error: " . $sql . "<br>" . $con->error;
				}
			}
			else if(array_key_exists("submitDelete", $_POST))
			{
				$rollNoDelete = $_POST["rollNoDelete"];

				$sql = "DELETE FROM details WHERE rollNo=$rollNoDelete";
				if($con->query($sql) == TRUE)
				{
					echo "Record deleted successfully";
				}
				else
				{
					echo "Error: " . $sql . "<br>" . $con->error;
				}
			}

			else if(array_key_exists("submitSearch", $_POST))
			{
				$rollNoSearch = $_POST["rollNoSearch"];

				$sql = "SELECT * FROM details WHERE rollNo=$rollNoSearch";
				$result = $con->query($sql);

				if($result->num_rows > 0)
				{
					echo "<table border=1>";
					echo "<tr><th>Roll No.</th><th>Name</th><th>Marks</th></tr>";
					while($row = $result->fetch_assoc())
					{
						echo "<tr><td>" . $row["rollNo"] . "</td><td>" . $row["name"] . "</td><td>" . $row["marks"] . "</td></tr>"; 
					}
					echo "</table>";
				}
				else
				{
					echo "No results";
				}
			}

			else if(array_key_exists("submitUpdate", $_POST))
			{
				$rollNoUpdate = $_POST["rollNoUpdate"];
				$marksUpdate = $_POST["marksUpdate"];

				$sql = "UPDATE details SET marks=$marksUpdate WHERE rollNo=$rollNoUpdate";
				if($con->query($sql) == TRUE)
				{
					echo "Record updated successfully";
				}
				else
				{
					echo "Error: " . $sql . "<br>" . $con->error;
				}
			}

			else if($_REQUEST['param'] != null)
			{
				$sql = "SELECT * FROM details";
				$result = $con->query($sql);

				if($result->num_rows > 0)
				{
					echo "<table border=1>";
					echo "<tr><th>Roll No.</th><th>Name</th><th>Marks</th></tr>";
					while($row = $result->fetch_assoc())
					{
						echo "<tr><td>" . $row["rollNo"] . "</td><td>" . $row["name"] . "</td><td>" . $row["marks"] . "</td></tr>"; 
					}
					echo "</table>";
				}
				else
				{
					echo "No results";
				}
			}			
			
			$con->close();
		?>
	</body>
</html>
