<?php # Script 9.4 - view_users.php
// This script retrieves all the records from the users table.

$page_title = 'Display Users';
include('includes/header.html');

// Page header:
echo '<h1>Display Users</h1>';

require('mysqli_connect.php'); // Connect to the db.

// Make the query:
$q = "SELECT CONCAT(first_name, ' ', last_name) AS UserName, username AS User_Handle FROM users";
$r = @mysqli_query($dbc, $q); // Run the query.

$num = mysqli_num_rows($r);

if ($r) { // If it ran OK, display the records.

echo "<p>There are currently $num registered users.</p>\n";
	// Table header.
	echo '<table width="60%">
	<thead>
	<tr>
		<th align="left">User handle</th>
		<th align="left">User Name</th>
	</tr>
	</thead>
	<tbody>
';

	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['UserName'] . '</td><td align="left">' . $row['User_Handle'] . '</td></tr>
		';
		
	}

	echo '</tbody></table>'; // Close the table.

	mysqli_free_result ($r); // Free up the resources.

} else { // If it did not run OK.

	// Public message:
	echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';

	// Debugging message:
	echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

} // End of if ($r) IF.

mysqli_close($dbc); // Close the database connection.

include('includes/footer.html');
?>