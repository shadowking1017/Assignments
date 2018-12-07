<?php # Script 9.4 - view_users.php
// This script retrieves all the records from the users table.
$page_title = 'View the Current Users';
include('includes/header.html');
echo '<h1>Registered Users</h1>';

require('mysqli_connect.php');

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM users";
	$r = @mysqli_query($dbc, $q);
	$row = @mysqli_fetch_array($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}


// Make the query:
$q = "SELECT last_name, first_name, user_id FROM users";
$r = @mysqli_query($dbc, $q); // Run the query.
$num = mysqli_num_rows($r);

if ($r) { // If it ran OK, display the records.
// Table header:
echo '<table width="60%">
<thead>
<tr>
	<th align="left"><strong>Edit</strong></th>
	<th align="left"><strong>Delete</strong></th>
	<th align="left"><strong><a href="user_handle.php?sort=fn">First Name</a></strong></th>
	<th align="left"><strong><a href="user_handle.php?sort=fn">First Name</a></strong></th>
</tr>
</thead>
<tbody>
';

	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
		<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
		<td align="left">' . $row['last_name'] . '</td>
		<td align="left">' . $row['first_name'] . '</td>
		<td align="left">' . $row['dr'] . '</td>
	</tr>
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