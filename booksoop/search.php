<?php
require_once('Books.php');
include('DbConnect.php');

$conn = new DbConnect();
$dbConnection = $conn->connect();
$instanceBooks = new Books($dbConnection);
$books = $instanceBooks->getBooks();
$selBooks = [];


if ((isset($_GET['nazev']) && $_GET['nazev'] !== '') || (isset($_GET['jmeno']) && $_GET['jmeno'] !== '') || (isset($_GET['prijmeni']) && $_GET['prijmeni'] !== '') || (isset($_GET['isbn']) && $_GET['isbn'] !== '')) {
    $selNazev = $_GET['nazev'];
    $selJmeno = $_GET['jmeno'];
    $selPrijmeni = $_GET['prijmeni'];
    $selIsbn = $_GET['isbn'];
    $selBooks = $instanceBooks->filterBooks($selNazev, $selJmeno, $selPrijmeni, $selIsbn);
} 

?>


<!-- HTML -->
</html>

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
        <h2 class="h2 text-center my-3">Vyhledávání</h2>
        <form action="search.php" method="get">
            <input class="form-control my-2" name="nazev" type="text" placeholder="Zadejte název knihy" />
            <input class="form-control my-2" name="jmeno" type="text" placeholder="Zadejte jméno autora" />
            <input class="form-control my-2" name="prijmeni" type="text" placeholder="Zadejte příjmení autora" />
            <input class="form-control my-2" name="isbn" type="text" placeholder="Zadejte ISBN knihy" />
            <input class="btn btn-secondary my-2" value='Odeslat' type="submit" />
        </form>
        <?php
        if ($selBooks != []) {

        ?>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Id</th>
                    <th>Název</th>
                    <th>Jméno autora</th>
                    <th>Příjmení autora</th>
                    <th>Popis</th>
                    <th>ISBN</th>
                </tr>
                
                <?php foreach ($selBooks as $book): ?>
                    <tr>
                        <td><?php echo $book['id_knihy']; ?></td>
                        <td><?php echo $book['nazev']; ?></td>
                        <td><?php echo $book['jmeno']; ?></td>
                        <td><?php echo $book['prijmeni']; ?></td>
                        <td><?php echo $book['popis']; ?></td>
                        <td><?php echo $book['isbn']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php
        } else { ?>
            <p>Žádné knihy k zobrazení</p>
        <?php
        }
        ?>
        

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>