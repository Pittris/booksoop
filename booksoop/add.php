<?php 
 
include('DbConnect.php'); 
require_once('Books.php');

$conn = new DbConnect(); 
$dbConnection = $conn->connect(); 

$instanceBooks = new Books($dbConnection);

if (isset($_POST['add'])){
  $nazev = $_POST['nazev'];
  $jmeno = $_POST['jmeno'];
  $prijmeni = $_POST['prijmeni'];
  $popis = $_POST['popis'];
  $isbn = $_POST['isbn'];
  $instanceBooks->addBook($nazev, $jmeno, $prijmeni, $popis, $isbn);
  header("Location: dbKnih.php");
  exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="./favicon.ico"/>
  <title>Knihy</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Knihy</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="add.php">Přidej knihu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dbKnih.php">Seznam knih</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="search.php">Hledej knihu</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <h2 class="h2 text-center my-3">Přidání nové knihy</h2>
  
  <form action="add.php" method="post">
    <input type="text" name="nazev" value=""class="form-control my-2" required placeholder="Název knihy" >
    <input type="text" name="jmeno" value="" class="form-control my-2" required placeholder="Jméno autora" >
    <input type="text" name="prijmeni" value="" class="form-control my-2" required placeholder="Příjmení autora" >
    <textarea type="text" name="popis" rows="4" value="" class="form-control my-2" required placeholder="Popis knihy" ></textarea>
    <input type="text" name="isbn" value="" class="form-control my-2" required placeholder="ISBN" >
    <input type="submit" value="Vlož knihu" class="btn btn-secondary my-2" name="add" >
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>  
</body>
</html>
 