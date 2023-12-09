
<?php
include 'includes/db.php';

if (isset($_GET['produktaId'])) {
    $produktaId = $_GET['produktaId'];

    $query = "SELECT pardosanas_cena FROM produkts WHERE produkta_id = $produktaId";
    $result = $db->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $cena = $row['pardosanas_cena'];
        echo $cena;
    } else {
        echo "0"; // Ja cena nav pieejama vai radusies kļūda, atgriežam 0
    }
} else {
    echo "0"; // Ja produkta ID nav norādīts, atgriežam 0
}
?>
