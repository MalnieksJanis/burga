

<?php
include 'includes/db.php'; // Jūsu datu bāzes pieslēgšanās kontroliera fails

$db = DB::getInstance()->getConnection();

$query = "SELECT nosaukums FROM produkts";
$result = $db->query($query);

$options = "";
while ($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['nosaukums'] . "'>" . $row['nosaukums'] . "</option>";
}

echo $options;

$result->free_result();
$db->close();
?>
