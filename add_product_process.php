<?php
session_start();
include 'includes/db.php';

// Izveidojam datubāzes pieslēgumu
$db = DB::getInstance();
$conn = $db->getConnection();

// Pārbauda, vai forma ir nosūtīta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Iegūst formā ievadītās vērtības, veic nepieciešamos drošības pasākumus
    $nosaukums = htmlspecialchars($conn->real_escape_string($_POST["nosaukums"]));
    $daudzums = intval($_POST["daudzums"]);
    $iepirkuma_cena = floatval($_POST["iepirkuma_cena"]);
    $pardosanas_cena = floatval($_POST["pardosanas_cena"]);
    $piegades_datums = $_POST["piegades_datums"];
    $kategorija = htmlspecialchars($conn->real_escape_string($_POST["kategorija"]));
    $ceka_nr = htmlspecialchars($conn->real_escape_string($_POST["ceka_nr"]));

    // Izveido SQL vaicājumu, lai pievienotu ierakstu datubāzē
    $sql = "INSERT INTO produkts (nosaukums, daudzums, iepirkuma_cena, pardosanas_cena, piegades_datums, kategorija, ceka_nr) 
            VALUES ('$nosaukums', $daudzums, $iepirkuma_cena, $pardosanas_cena, '$piegades_datums', '$kategorija', '$ceka_nr')";

    // Pārbauda, vai dati veiksmīgi pievienoti datubāzē
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Dati veiksmīgi pievienoti datubāzei";
    } else {
        $_SESSION['message'] = "Kļūda datu pievienošanā datubāzē: " . $conn->error;
    }

    // Aizver savienojumu ar datubāzi
    $conn->close();

    // Pāradresē uz add_products.php
    header("Location: add_products.php");
    exit();
}
?>
