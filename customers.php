<?php
error_reporting(0);
session_start();
include 'Session.php';
include 'navbar.php';
$conn = $_SESSION["conn"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Banking System</title>
    <!-- My css -->
    <style>
      table {
        font-family: sans-serif;
      }
      thead{
        font-size: 140%;
        font-family: cursive;
      }
      table th,td {
        vertical-align: middle;
      }
      #searchbar {
        width: 50%;
        margin: 2% 25%;
      }
      
    </style>
    <!-- Bootstrap styles package -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
<form class="d-flex" id="searchbar">
        <input class="form-control me-2" type="search" id="myInput" placeholder="Search by account number" aria-label="Search" id="searchTxt" onkeyup="myFunction();">
        <button class="btn btn-outline-success" type="submit" >Filter</button>
</form>
<!-- Showing details of all customers using table -->
<table class="table bg-dark text-white mt-5 text-center" id="myTable">
    <thead>
      <tr class="bg-warning text-dark" style="font-family: cursive;font-size: 1.1em;">
        <th scope="col" colspan="2">Account No.</th>
        <th scope="col">Name</th>
        <th scope="col">Current Balance</th>
        <th scope="col">Operations</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $sql = "SELECT * FROM `basic banking system`.`customers`;";
      $result = $conn->query($sql);
      while($row = mysqli_fetch_assoc($result)){
        $acc = $row["acc_no"];
        $name = $row["name"];
        $bal = $row["balance"];
        $last = $row["last_transaction"];
        echo "<tr>
        <th scope='row' colspan='2'>$acc</th>
        <td>$name</td>
        <td>$bal</td>
        <td><a class='btn btn-danger' style='width: 30%;'href='insertion.php?ba=$bal&aa=$acc'>Transfer Money</a><a href='history.php?name=$name&acc=$acc' class='btn btn-success' style='width: 40%; margin-left: 2%;' >Transaction History</a></td>

      </tr>";
      }
      ?>
    </tbody>
  </table>

    <!-- Bootstrap script package -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, th, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    th = tr[i].getElementsByTagName("th")[0];
    if (th) {
      txtValue = th.textContent || th.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
</body>
</html>