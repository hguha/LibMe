<?php session_start(); ?>
<head>
	<link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/user-dashboard.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css">
</head>

<div class="header">
<?php echo("<div class='title'>Welcome to LibMe, ".$_SESSION["user"]["first_name"]."!</div>");?>
<br><a href='environment/logout.php' class='buttons'>Logout</a>
<br><a href='./user-dashboard.php' class='buttons'>Back To Home</a>
<form action="book-list.php" method="post">
<select class="select-css" name="type">
    <!-- will enable when I figure out how to actually do keyword searches -->
  <option value="keywords">Keyword</option>
  <option value="author">Author</option>
  <option value="title">Title</option>
  <option value="isbn">ISBN</option>
</select>
<input placeholder="Search for books by Name, Author, or ISBN" name="content"></input></a>
</div>
