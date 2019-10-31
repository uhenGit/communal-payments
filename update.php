<?php 
session_start();
require './src/header.php';
if (isset($_SESSION['appNumber'])) {
   echo "<h2>If You want to change some data for the appartment number {$_SESSION['appNumber']}, follow the rules below</h2>
<div class='about'>
    <p class='description'>To change selected data, choose month and year, then enter your data in the right side of the screen: <img src='./img/update.png' alt='update'></p>
    <form class='imgs' action='result.php' method='post'>
        <label class='require' for='update'>Select date: </label>  
        <input type='date' name='update' required>
        <label for='elUpdate'>Enter new electricity value: </label>
        <input type='text' name='elUpdate'>
        <label for='gasUpdate'>Enter new gas value: </label>
        <input type='text' name='gasUpdate'>
        <label for='waterUpdate'>Enter new water value: </label>
        <input type='text' name='waterUpdate'>
        <input type='submit' name='submit' value='upgate data'>
    </form>
</div>";
} else {
    echo "<h3 class='red'>Please input Your appartment number first <a href='./index.php'>here</a></h3>";
}
require './src/footer.php';?>
