<?php
error_reporting(0);
session_start();
$server = 'localhost:3307';
$user = 'root';
$password = 'Karan@25';
$conn = new mysqli($server,$user,$password);

include 'navbar.php';

if(isset($_POST["transfer"]))
{

$acc = $_POST["acc"];
$amt = $_POST["amt"];

$ba = $_SESSION["ba"];
$aa = $_SESSION["aa"];

if($amt <= $ba and $aa!=$acc){
  $dec = $ba-$amt;
 $sql = "INSERT INTO `basic banking system`.`history`(`debit`, `curr_b` ,`acc_no`) VALUES ('$amt','$dec','$aa')";
 $result = $conn->query($sql);
  $sql ="UPDATE `basic banking system`.`customers` SET `balance`='$dec' WHERE `acc_no`='$aa'";
$result = $conn->query($sql);

if($result = true)
{
  $sql = "SELECT `balance` FROM `basic banking system`.`customers` WHERE `acc_no`='$acc'";
  $result = $conn->query($sql);
  $dd = $amt;
  while($row = mysqli_fetch_array($result))
  {
      $amt += $row['balance'];
  }
  $sql = "UPDATE `basic banking system`.`customers` SET `balance`='$amt' WHERE `acc_no`='$acc'";
  $result = $conn->query($sql);
  if($result = true)
  {
      
 $sql = "INSERT INTO `basic banking system`.`history`(`credit`,`curr_b`, `acc_no`) VALUES ('$dd','$amt','$acc')";
 $result = $conn->query($sql);
      if($result = true){
      echo "<script>
      document.write(`<p align='center' style='font-weight: bold; font-size: 2em;color: Green;font-family: sans-serif;'><img src='https://www.med-bay.com/images/2019/check.gif' style='height: 10%; width: 10%;' />Successfully Transfered</p>`);
      </script>";
      }
  }
}
}
else {
    if(isset($_POST["transfer"])){
     echo "<script>
     document.write(`<p align='center' style='font-weight: bold;margin-top: 1%; font-size: 2em;color: red;font-family: sans-serif;'><img src='data:image/png;base64,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' style='height: 5%; width: 5%;' />Enter Correct Details</p>`);
     </script>";
    }
}
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Transfer Palate</title>

    <style>
    body {
        background: white;
    }

    .btn-danger {
        color: #fff;
        background-color: #5030e2;
        border-color: #5030e2;
        font-weight: bold;
        margin-top: 10%;
        margin-left: 25%;
        outline: 0;
        box-shadow: inset 3px 3px 20px -3px rgb(0, 0, 0, .5);
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        width: 50%;
        height: 3em;
        transition: all ease-in-out .3s;
    }

    .btn-danger:hover {
        color: #000000;
        background-color: #b4d110;
        border-color: #b4d110;
        width: 51%;
        box-shadow: -1px 2px 20px 6px grey;
        margin-left: 24.5%;
        font-weight: bolder;
    }

    input {
        margin-top: 5%;
        border-radius: 23px;
        outline: 0;
        font-family: ui-sans-serif;
        font-size: 16px;
        line-height: 1;
        padding: 3%;
        width: 100%;
        border-style: none;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        font-weight: 550;
    }

    input:hover {
        border-color: skyblue;
        box-shadow: 1px 1px 13px 3px skyblue;
    }

    input:focus {
        border-color: skyblue;
        box-shadow: 1px 1px 13px 3px skyblue;
        color: rgb(245, 0, 143);
    }


    form {
        border-radius: 23px;
        height: 150%;
        margin-top: 3%;
        width: 50%;
        margin-left: 28%;
        border-style: double;
        border-color: cyan;
        background: linear-gradient(#0d3d8e, #ff9898);
        padding: 3%;
    }

    form h3 {
        color: #8cffc4;
        text-align: center;
        font-size: 221%;
        font-family: cursive;
        font-weight: bolder;
        letter-spacing: 5px;
    }

    hr {
        background-color: #21306d;
        padding: 3px;
    }
    </style>
</head>

<body>

    <div id="container">
        <form action="transfer_font.php" method="POST">
            <h3>TRANSFER MONEY</h3>
            <hr>
            <input type="number" value="acc_no" id="acc" name="acc" placeholder="Enter Account Number" autofocus
                required>
            <input type="number" value="amount" id="amt" name="amt" placeholder="Enter Amount" required>
            <button name="transfer" class="btn btn-danger">Transfer</button>
        </form>

    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
    -->

    <!-- My js files -->
    
</body>

</html>