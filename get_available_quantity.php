<?php
include 'includes/db.php';
$db = DB::getInstance()->getConnection();

if (isset($_POST['produktaId'])) {
    $produktaId = $db->real_escape_string($_POST['produktaId']);

    // Pieprasījums, lai iegūtu pieejamo daudzumu
    $query = "SELECT daudzums FROM produkts WHERE produkta_id = '$produktaId'";
    $result = $db->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        echo $row['daudzums'];
    } else {
        echo 0; // Kļūda gadījumā atgriežam 0
    }
} else {
    echo 0; // Ja produkta ID nav nosūtīts, atgriežam 0
}

$db->close();
?>
