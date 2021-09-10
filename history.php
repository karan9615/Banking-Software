<?php
$server = 'localhost:3307';
$user = 'root';
$password = 'Karan@25';
$conn = new mysqli($server,$user,$password);
include 'navbar.php';
$name = $_GET["name"];
$acc = $_GET["acc"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <style>
       
       p {
           font-size: 1.3em;
           font-weight: bolder;
           margin:0;
           text-align: center;
           width: 50%;
           margin-left: 25%;
           border-radius: 23px;
           padding : .5%;
       }
       p span {         
           font-weight: bold; 
           color: black;
       }
    </style>
</head>
<body>

<p style="margin-top: 2%;" class="text-light bg-danger"><span>Name: </span><?php echo $name;?></p>
    <p  class="text-light bg-info"><span>Account number: </span><?php echo $acc;?></p>
<table class="table bg-dark text-light mt-5 text-center" id="myTable">
    <thead>
      <tr class="bg-warning text-dark" style="font-family: cursive;font-size: 1.5em;">
      <th scope="col">Date & Time</th>
        <th scope="col">Debit</th>
        <th scope="col">Credit</th>
        <th scope="col">Current Balance</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $sql = "SELECT * FROM `basic banking system`.`history` WHERE `acc_no`='$acc' ORDER BY `Time` DESC";
      $result = $conn->query($sql);
      while($row = mysqli_fetch_assoc($result)){
        $bal = $row["curr_b"];
        $credit = $row["credit"];
        $debit = $row["debit"];
        $last = $row["Time"];
        echo "<tr>
        <th scope='row'>$last</th>
        <td>$debit</td>
        <td>$credit</td>
        <td>$bal</td>
        </tr>";
      }
      ?>
    </tbody>
  </table>
</body>
</html>