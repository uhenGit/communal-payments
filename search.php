<?php 
session_start();
require 'src/header.php';
if (isset($_SESSION['appNumber'])) {
  echo "<h2>Dear user from appartment number {$_SESSION['appNumber']}, if You want to find data from selected month, follow the rule bellow</h2>
<div class='about'>
  <p class='description'>To find data, choose month and year in the right side of the screen:<img src='./img/search.png' alt='search'></p>
  <form class='imgs' action='result.php' method='post'>
    <label class='require' for='find'>this will be delete ALL data of the month</label>  
    <input type='date' name='find' placeholder='09.2019'>
    <input type='submit' name='submit' value='search data'>
  </form>
</div>";
} else {
  echo "<h3 class='red'>Please input Your appartment number first <a href='./index.php'>here</a></h3>";
}
 require 'src/footer.php';?>