<?php session_start(); ?>
<head>
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="user-dashboard.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
</head>

<div class="header">
<?echo("<div class='title'>Welcome to LibMe, ".$_SESSION["user"]["first_name"]."!</div>");?>
<br><a href='./logout.php' class='buttons'>Logout</i></a>
</div>
<form action="" method="post">
<select name="type">
  <option value="Keyword">Keyword</option>
  <option value="Author">Author</option>
  <option value="Title">Title</option>
  <option value="ISBN">ISBN</option>
</select>
<input placeholder="Search for books by Name, Author, or ISBN" name="content"></input></a>
<!-- List Checked Out Books -->

<?php
echo "<br>No Books Checked Out!"
?>