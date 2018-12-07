<?php # Script 3.7 - index.php #2

// This function outputs theoretical HTML
// for adding ads to a Web page.
function create_ad() {
  echo '<div class="alert alert-info" role="alert"><p>This is Assignment 2!This is Assignment 2!This is Assignment 2!This is Assignment 2!This is Assignment 2!</p></div>';
} // End of the function definition.

$page_title = 'Assignment 1!';
include('includes/header.html');

// Call the function:
create_ad();
?>

<div class="page-header"><h1>Content Header</h1></div>
<p>This is Assignment # 2</p>

<p>HEY!!!!! Welcome to Assignment #2 pease enjoy.</p>

<?php
// Call the function again:
create_ad();

include('includes/footer.html');
?>