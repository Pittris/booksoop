<?php

class Books
{
    private $dbConn;

    // konstruktor, vytvoří spojení s Db
    public function __construct($dbConn)
    {
        $this->dbConn = $dbConn;
    }

    // getter pole všech knih
    public function getBooks()
    {
        $stmt = $this->dbConn->prepare("SELECT * FROM knihy");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filterBooks($nazev, $jmeno, $prijmeni, $isbn)
    {
        // Základní SQL dotaz
        $sql = "SELECT * FROM knihy WHERE 1";
        $params = [];

        // Přidání podmínek pro filtraci podle parametrů
        if (trim('řetězec') !== "") {
            $sql .= " AND nazev LIKE :nazev";
            $params[':nazev'] = '%' . $nazev . '%';
        }

        if (trim('řetězec') !== "") {
            $sql .= " AND jmeno LIKE :jmeno";
            $params[':jmeno'] = '%' . $jmeno . '%';
        }

        if (trim('řetězec') !== "") {
            $sql .= " AND prijmeni LIKE :prijmeni";
            $params[':prijmeni'] = '%' . $prijmeni . '%';
        }
        

        if (trim('řetězec') !== "") {
          $sql .= " AND isbn LIKE :isbn";
          $params[':isbn'] = '%' . $isbn . '%';
      }

        // Příprava SQL dotazu
        $stmt = $this->dbConn->prepare($sql);

        // Bindování parametrů (pouze pokud byly parametry přidány)
        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value, PDO::PARAM_STR);
        }

        // Vykonání SQL dotazu
        $stmt->execute();

        // Návrat výsledků jako pole asociativních polí
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteBook($id_knihy)
    {
        $sql = "DELETE FROM knihy WHERE id_knihy = :id_knihy";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':id_knihy', $id_knihy, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getBook($id_knihy)
    {
        $sql = "SELECT * FROM knihy WHERE id_knihy = :id_knihy";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':id_knihy', $id_knihy, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBook($id_knihy, $nazev, $jmeno, $prijmeni, $popis, $isbn)
    {
        $sql = "UPDATE knihy SET nazev = :nazev, jmeno = :jmeno, prijmeni = :prijmeni, popis = :popis, isbn = :isbn WHERE id_knihy = :id_knihy";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':id_knihy', $id_knihy, PDO::PARAM_INT);
        $stmt->bindParam(':nazev', $nazev, PDO::PARAM_STR);
        $stmt->bindParam(':jmeno', $jmeno, PDO::PARAM_STR);
        $stmt->bindParam(':prijmeni', $prijmeni, PDO::PARAM_STR);
        $stmt->bindParam(':popis', $popis, PDO::PARAM_STR);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Metoda pro přidání nové knihy
    public function addBook($nazev, $jmeno, $prijmeni, $popis, $isbn)
    {
        $sql = "INSERT INTO knihy (nazev, jmeno, prijmeni, popis, isbn) VALUES (:nazev, :jmeno, :prijmeni, :popis, :isbn)";
        $stmt = $this->dbConn->prepare($sql);
        $stmt->bindParam(':nazev', $nazev, PDO::PARAM_STR);
        $stmt->bindParam(':jmeno', $jmeno, PDO::PARAM_STR);
        $stmt->bindParam(':prijmeni', $prijmeni, PDO::PARAM_STR);
        $stmt->bindParam(':popis', $popis, PDO::PARAM_STR);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
