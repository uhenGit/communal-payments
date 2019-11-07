<?php 
session_start();
require 'src/header.php';
$prevDateID = date('m')-1 . date('.Y');
if (strlen($prevDateID) < 7) {
  $prevDateID = '0' . $prevDateID;
}
if (isset($_SESSION['appNumber'])) {
 echo "<h2>On this page You can set Your meter data from appartment number {$_SESSION['appNumber']} to DataBase</h2>
 <div class='about'>
  <p class='description'>
    If You want to register new data for {$prevDateID}, please input it in the right side of the screen <img src='./img/input.png' alt='input'>
  </p>
  <form class='imgs flexDirect' action='result.php' method='post'>
    <div class='flex50'>
    <label class='require' for='el'>Electricity: </label>
    <input type='text' name='el' required>
    <label class='require' for='gas'>Gas: </label>
    <input type='text' name='gas' required>
    <label class='require' for='water'>Water: </label>
    <input type='text' name='water' required>
    </div>
    <div class='flex50'>
    <label for='addHeat'>Add Heating: </label>
    <input class='add' type='text' name='addHeat'>
    <label for='addGar'>Add Garbage: </label>
    <input class='add' type='text' name='addGar'>
    <label for='addTv'>Add TV and Internet: </label>
    <input class='add' type='text' name='addTv'>
    
    </div>
    <input class='relative' type='submit' name='submit' value='Send Data'>
  </form>
</div>";
} else {
  echo "<h3 class='red'>Please input Your appartment number first <a href='./index.php'>here</a></h3>";
}
 $dateID = date('m.Y');

//echo "<h4>{$prevDateID}</h4>";
//var_dump($dateID);
require 'src/footer.php'; ?>
