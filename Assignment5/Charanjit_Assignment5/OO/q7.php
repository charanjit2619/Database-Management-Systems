<!DOCTYPE html>
<html>
<head>
	<title>DBMS Example</title>
	<style>
		h1 {
			font-size: 36px;
			text-align: center;
			margin-top: 50px;
		}
		p {
			font-size: 24px;
			text-align: center;
			margin-top: 20px;
		}
		table {
			border: 1px solid black;
			margin: 0 auto;
			font-size: 24px;
			text-align: center;
		}
	</style>
</head>
<body>
	<h1>CPSC 6620</h1>
	<p>Query 7 : Use regular expression pattern matching to show name, owner, and birth date of the pets whose names start with 'F' and end with 'y' or 'r' in table pet.</p>

	<?php
	$servername = "mysql1.cs.clemson.edu";
	$username = "charanjit2619";
	$password = "cpsc46206620";
	$dbname = "Menagerie";

	// Create database connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check database connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	// Query the database
	$sql = "SELECT name, owner, birth FROM pet WHERE name
	REGEXP '^F' AND name REGEXP '[ry]$';";
	$result = $conn->query($sql);

	// Display results as a table
	if ($result->num_rows > 0) {
		echo "<table border='1'>";
		echo "<tr>";
		$row = $result->fetch_assoc();
		foreach ($row as $key => $value) {
			echo "<td>" . $key . "</td>";
		}
		echo "</tr>";
		foreach ($row as $key => $value) {
			if (empty($value)) {
				echo "<td>NULL</td>";
			} else {
				echo "<td>" . $value . "</td>";
			}
		}
		echo "</tr>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			foreach ($row as $key => $value) {
				if (empty($value)) {
					echo "<td>NULL</td>";
				} else {
					echo "<td>" . $value. "</td>";
				}
			}
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "No Result Returned";
	}

	// Display the number of rows affected
	echo "<p>" . $conn->affected_rows . " rows were affected.</p>";

	$conn->close();
	?>

</body>
</html>
