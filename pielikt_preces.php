<?php
// Iekļaut datu bāzes pieslēgšanās failu
include 'includes/db.php'; // Ja šis fails ir jūsu datu bāzes pieslēgšanās kontroliera fails

// Pārbaudīt, vai formas dati ir nosūtīti
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Saņemt datus no formas
    $nosaukums = $_POST['nosaukums'];
    $daudzums = $_POST['daudzums'];
    $iepirkuma_cena = $_POST['iepirkuma_cena'];
    $pardosanas_cena = $_POST['pardosanas_cena'];
    $piegades_datums = $_POST['piegades_datums'];
    $kategorija = $_POST['kategorija'];
    $ceka_nr = $_POST['ceka_nr']; // Jaunais lauks

    // Izveidot datu bāzes objektu
    $db = DB::getInstance()->getConnection();

    // Sagatavot SQL pieprasījumu
    $query = "INSERT INTO produkts (nosaukums, daudzums, iepirkuma_cena, pardosanas_cena, piegades_datums, kategorija, ceka_nr) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Izveidot sagatavošanas izteiksmi
    $stmt = $db->prepare($query);

    // Saistīt parametrus ar mainīgajiem
    $stmt->bind_param("siddssi", $nosaukums, $daudzums, $iepirkuma_cena, $pardosanas_cena, $piegades_datums, $kategorija, $ceka_nr);

    // Izpildīt pieprasījumu
    $stmt->execute();

    // Pārbaudīt, vai pievienošana bija veiksmīga
    if ($stmt->affected_rows > 0) {
        echo "Pirkt prece tika veiksmīgi pievienota!";
    } else {
        echo "Kļūda: Prece netika pievienota.";
    }

    // Aizvērt sagatavošanas izteiksmi
    $stmt->close();

    // Aizvērt datu bāzes savienojumu
    $db->close();
}
?>
