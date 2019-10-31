<?php
session_start();
if (isset($_POST['appNum'])) {
    $_SESSION['appNumber'] = $_POST['appNum'];
}
if (isset($_GET['del'])) {
    unset($_SESSION['appNumber']);
 }
require './src/header.php';?>
<h2>Here will be some information for user from appartment number <?php echo $_SESSION['appNumber']?></h2>
<div class="about">
    <!-- <p class="description">On this site You can input Your meters data, which will be linked to your appartment number. Then the programm will counts how many You spent for electricity, water, gas etc. And displayed those costs on Result Page. If You want, You could change some data at <a href="update.php">Change Your Data</a> page (You'll see an instrucnion). And, off course, You can delete all data from selected month</p> -->
   <div class="description">
        <p>On this site You can do some actions with Your meter data, which will be linked to your appartment number:</p>
        <ul>
            <li>You can set a new data for current month at <a href="input.php">Input Data Page</a>;</li>
            <li>Also, You can change some data at <a href="update.php">Change Your Data</a> page;</li>
            <li>And, off course, You delete all data from selected month at <a href="delete.php">Delete Selected Data</a> page</li>
        </ul>
        <p>On each page You'll see an instruction, what You should do. Then the programm will do all the operations and display results on Result Page.</p>
   </div>
    <div class="imgs">
        <img src="./img/electricity.png" alt="electric lamp">
        <img src="./img/gas.png" alt="gas">
        <img src="./img/water.png" alt="water">
    </div>
</div>
<?php
if (isset($_SESSION['appNumber']) && strlen($_SESSION['appNumber'])>0) {
    //var_dump($_SESSION);
   echo('<div class="btnWrap"><a class="delBtn" href="about.php?del=true">Change app number</a></div>');
}
 else {
   echo('<form action="about.php" method="post">
    <label for="appNum" class="require">Enter Your appartment number</label>
    <input type="text" name="appNum" required>
    <input type="submit" value="Send">
</form>');
}
var_dump(date('d')-20);
require './src/footer.php';
?>
