<?php
include 'includes/db.php'; // Jūsu datu bāzes pieslēgšanās kontroliera fails

if (isset($_GET['nosaukums'])) {
    $nosaukums = $_GET['nosaukums'];

    $db = DB::getInstance()->getConnection();

    $query = "SELECT cena FROM produkts WHERE nosaukums = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $nosaukums);
    $stmt->execute();
    $stmt->bind_result($cena);

    if ($stmt->fetch()) {
        $preces_info = array('cena' => $cena);
        echo json_encode($preces_info);
    } else {
        echo json_encode(array('cena' => ''));
    }

    $stmt->close();
    $db->close();
}
?>
