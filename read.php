<?php
	require('database.php');

	// CREATE new user
	if ($_GET["show"] == "all") {
		try {
			$statement = $pdo->prepare(
				'SELECT * FROM users;'
			);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_OBJ);

		} catch (PDOException $e) {
			echo "<h4 style='color:red;'>" . $e->getMessage() . "</h4>";
		}
	} elseif ($_GET["show"] == "one" && isset($_GET["id"])) {
		$id = $_GET["id"];
		try {
			$statement = $pdo->prepare(
				'SELECT * FROM users WHERE id = :id;'
			);
			$statement->execute(['id' => $id]);
			$results = $statement->fetchAll(PDO::FETCH_OBJ);

		} catch (PDOException $e) {
			echo "<h4 style='color:red;'>" . $e->getMessage() . "</h4>";
		}
	}

?>

<html>
	<head>

	</head>
	<body>
		<table>
			<tr>
				<th>id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Age</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>	
			<?php foreach ($results as $result) { ?>
				<tr>
					<td><?php echo $result->id; ?></td>
					<td><?php echo $result->first_name; ?></td>
					<td><?php echo $result->last_name; ?></td>
					<td><?php echo $result->age; ?></td>
					<td><a href="/update.php?id=<?php echo $result->id ?>">Edit</a></td>
					<td><a href="/delete.php?id=<?php echo $result->id ?>" onclick="confirm()">Delete</a></td>
				</tr>
			<?php } ?>
		</table>
	</body>
</html>