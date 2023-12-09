<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/db.php';

// Pārbaude, vai tabula "pirkumu_vesture" eksistē
$db = DB::getInstance()->getConnection();
$checkTableQuery = "SHOW TABLES LIKE 'pirkumu_vesture'";
$tableExists = $db->query($checkTableQuery);

if ($tableExists->num_rows == 0) {
    // Tabula vēl neeksistē, izveidojiet to
    $createTableQuery = "CREATE TABLE pirkumu_vesture (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nosaukums VARCHAR(255) NOT NULL,
        daudzums INT NOT NULL,
        cena DECIMAL(10, 2) NOT NULL,
        datums_pirkts DATE NOT NULL
    )";
    
    $createTableResult = $db->query($createTableQuery);

    // Pārbaude, vai tabulas izveidošana bija veiksmīga
    if (!$createTableResult) {
        $response = array('success' => false, 'error' => 'Tabulas izveidošana neizdevās: ' . $db->error);
        echo json_encode($response);
        exit();
    }
}

// Datubāzes darbības turpinājums...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = DB::getInstance()->getConnection();

    // Iegūt pirkuma datus no POST pieprasījuma
    $pirkumaDati = $_POST['pirkumaDati'];

    // Saglabāt katru produktu datu bāzē
    foreach ($pirkumaDati as $pirkums) {
        $nosaukums = $db->real_escape_string($pirkums['nosaukums']);
        $daudzums = $pirkums['daudzums'];
        $cena = $pirkums['cena'];
        $datums = date('Y-m-d');

        $query = "INSERT INTO pirkumu_vesture (nosaukums, daudzums, cena, datums_pirkts) VALUES ('$nosaukums', $daudzums, $cena, '$datums')";
        
        $result = $db->query($query);

        // Pārbaude, vai datu ievade bija veiksmīga
        if (!$result) {
            $response = array('success' => false, 'error' => 'Ievadīšana datubāzē neizdevās: ' . $db->error);
            echo json_encode($response);
            exit();
        }
    }

    // Pēc ievadīšanas atgriezt sarakstu ar ievietotajām precēm
    $selectQuery = "SELECT * FROM pirkumu_vesture";
    $selectResult = $db->query($selectQuery);

    if (!$selectResult) {
        $response = array('success' => false, 'error' => 'Datu atlase neizdevās: ' . $db->error);
        echo json_encode($response);
        exit();
    }

    $purchasedItems = array();
    while ($row = $selectResult->fetch_assoc()) {
        $purchasedItems[] = $row;
    }

    $response = array('success' => true, 'purchasedItems' => $purchasedItems);
    echo json_encode($response);
} else {
    // Ja pieprasījums nav POST, atgriezt kļūdas atbildi
    $response = array('success' => false, 'error' => 'Nederīgs pieprasījums');
    echo json_encode($response);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
?>
