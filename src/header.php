<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./src/style.css">
  <script src="./src/script.js" defer></script>
  <title><?php  echo $_GET['page'];?></title>
</head>

<body>
  <h1>Let's try some php in html</h1>
   <div class="nav">
    <ul>
      <li>
            <a href="index.php?page=Home Page">About Page</a>
      </li>
      <li>
            <a href="input.php?page=Input Data Page">Input Data Page</a>
      </li>
      <li>
            <a href="search.php?page=Search Data Page">Search Page</a>
      </li>
      <li>
            <a href="update.php?page=Update Data Page">Change Your Data</a>
      </li>
      <li>
            <a href="delete.php?page=Delete Data Page">Delete Selected Data</a>
      </li>
        </ul>
  </div>
  