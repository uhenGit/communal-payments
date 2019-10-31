<?php 
session_start();
require 'src/header.php';
if (isset($_SESSION['appNumber'])) {
  echo "<h2>If You want to delete data for appartment number {$_SESSION['appNumber']} from selected month, follow the rule bellow</h2>
<div class='about'>
  <p class='description'>To delete data, choose month and year in the right side of the screen:<img src='./img/delete.png' alt='delete'></p>
  <form class='imgs' action='result.php' method='post'>
    <label class='require' for='del'>This action will delete ALL data of the month</label>  
    <input type='date' name='del' placeholder='09.2019'>
    <input type='submit' name='submit' value='delete data'>
  </form>
</div>";
} else {
  echo "<h3 class='red'>Please input Your appartment number first <a href='./index.php'>here</a></h3>";
}
 require 'src/footer.php';?>
