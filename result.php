<?php
session_start();
require './src/header.php';
include './src/link.php';

if (isset($_SESSION['appNumber'])) {
  $appNum = $_SESSION['appNumber'];
  $app = 'kommun' . $appNum;
  $resApp = 'res' . $appNum;
  
  // 1 INSERT NEW DATA FROM home.php AND SOME MATH ACTIONS
if (isset($_POST['el']) && isset($_POST['gas']) && isset($_POST['water'])) {
$newEl = $_POST['el'];
$newGas = $_POST['gas'];
$newWater = $_POST['water'];

$year = date('Y');
$month = date('m');
if (strlen($month) < 2) {
  $month = "0" . $month;
}
$prevMonth = date('m')-1;
if (strlen($prevMonth) < 2) {
  $prevMonth = "0" . $prevMonth;
}
$prPrMonth = $prevMonth-1;
if (strlen($prPrMonth) < 2) {
  $prPrMonth = "0" . $prPrMonth;
}
var_dump($prPrMonth);
$prevDateID = $year.'.'.$prPrMonth;
$day = date('d');
if (strlen($day) < 2) {
  $day = "0" . $day;
}
$dateID = $year.'.'.$prevMonth;
$selectDateID = 
mysqli_set_charset($link, 'utf8') or die('Unknown charset');
// 1-1 INSERT NEW DATA
$insData = "INSERT INTO $app (dateID, `electricity`, `gas`, `water`) VALUES ($dateID,$newEl,$newGas,$newWater)";
$insResult = mysqli_query($link, $insData);
if ($insResult) {
  echo '<h2>All\'s well</h2>';
} else {
  echo 'insertion error' . mysqli_error($link);
}
// 1-2 SELECT NEW AND PREV DATA AND TAXES
$taxStr = "SELECT elTax, altElTax, gasTax, waterTax FROM tax WHERE appNum = $appNum";
$taxQuery = mysqli_query($link, $taxStr) or die('tax query error ' . mysqli_error($link));
$taxQueryData = mysqli_fetch_assoc($taxQuery);
$elTax = $taxQueryData['elTax'];
$altElTax = $taxQueryData['altElTax'];
$gasTax = $taxQueryData['gasTax'];
$waterTax = $taxQueryData['waterTax'];
$lastData = "SELECT dateID, electricity, gas, water FROM $app ORDER BY `id` DESC LIMIT 2";
$selectLast = mysqli_query($link, $lastData) or die(mysqli_error($link));
$data = [];
while ($row = mysqli_fetch_assoc($selectLast)) {
  $data[$row['dateID']] = $row;
}
// // 1-3 MATH OPERATIONS
$resElDelta = $data[$dateID]['electricity'] - $data[$prevDateID]['electricity'];
if ($resElDelta > 100) {
  $resEl = 100 * $elTax + ($resElDelta - 100) * $altElTax;
} else {
  $resEl = $resElDelta * $elTax;
}
$resGasDelta = $data[$dateID]['gas'] - $data[$prevDateID]['gas'];
$resGas = $resGasDelta * $gasTax;
$resWaterDelta = $data[$dateID]['water'] - $data[$prevDateID]['water'];
$resWater = $resWaterDelta * $waterTax;
if ($resEl && $resGas && $resWater) {
  $resAppStr = "INSERT INTO $resApp (dateID, absEl, absGas, absWater, elTax, altElTax, gasTax, waterTax) VALUES ($dateID, $resElDelta, $resGasDelta, $resWaterDelta, $elTax, $altElTax, $gasTax, $waterTax)";
  $resAppQuery = mysqli_query($link, $resAppStr);
  echo "<p> {$resEl} </p><p> {$resGas} </p><p> {$resWater} </p>";
}
else {
  echo "<h3>Input your Data first</h3>";
}
}
//UPDATE DATA BY dateID from update.php
elseif (isset($_POST['update'])) {
  $upDateID = $_POST['update'];
  $subUpdateID = substr($upDateID, 0, 4) .".". substr($upDateID, 5, 2);
$beforUpdate = "SELECT electricity, gas, water FROM $app WHERE `dateID` = {$subUpdateID}";
$queryBeforUpdate = mysqli_query($link, $beforUpdate);
$dataBeforUpdate = mysqli_fetch_assoc($queryBeforUpdate);
if (strlen($_POST['elUpdate'])>0) {
  $updateEl = $_POST['elUpdate'];
} else {
  $updateEl = $dataBeforUpdate['electricity'];
}
if (strlen($_POST['gasUpdate'])>0) {
  $updateGas = $_POST['gasUpdate'];
} else {
  $updateGas = $dataBeforUpdate['gas'];
}
if (strlen($_POST['waterUpdate'])>0) {
  $updateWater = $_POST['waterUpdate'];
} else {
  $updateWater = $dataBeforUpdate['water'];
}
$afetrUpdate = "UPDATE $app SET electricity = $updateEl, gas = $updateGas, water = $updateWater WHERE dateID = {$subUpdateID}";
$queryAfterUpdate = mysqli_query($link, $afetrUpdate) or die (mysqli_error($link));
echo "<h2>Data from {$subUpdateID} succesfully update</h2>";
} 
//DELETE DATA BY dateID from home.php
elseif (isset($_POST['del'])) {
  $delStr = $_POST['del'];
  $delMonth = substr($delStr, 0, 4) . "." . substr($delStr, 5, 2);
  $delData = "DELETE FROM $app WHERE `dateID` = {$delMonth}";
  $delRes = mysqli_query($link, $delData) or die (mysqli_error($link));
  echo mysqli_affected_rows($link);
  echo "<h2>All data from {$delMonth} succesfully delete</h2>";
}
} else {
  echo "<h3 class='red'>Please input Your appartment number first <a href='./index.php'>here</a></h3>";
}
require './src/footer.php'; ?>
