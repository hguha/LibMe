<?php session_start(); ?>
<head>
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="user-dashboard.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
</head>

<div class="header">
<?echo("<div class='title'>Welcome to LibMe, ".$_SESSION["user"]["first_name"]."!</div>");?>
<br><a href='./logout.php' class='buttons'>Logout</a>
<br><a href='./user-dashboard.php' class='buttons'>Back To Home</a>
<form action="book-list.php" method="post">
<select name="type">
  <!-- <option value="keywords">Keyword</option> -->
  <option value="author">Author</option>
  <option value="title">Title</option>
  <option value="isbn">ISBN</option>
</select>
<input placeholder="Search for books by Name, Author, or ISBN" name="content"></input></a>
</div>
