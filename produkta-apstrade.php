<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'edit') {
        $productId = $_POST['id'];
        $newName = $_POST['newName'];
        $newQuantity = $_POST['newQuantity'];
        $newPurchasePrice = $_POST['newPurchasePrice'];
        $newSalePrice = $_POST['newSalePrice'];
        $newReceiptNumber = $_POST['newReceiptNumber'];
        $newDeliveryDate = $_POST['newDeliveryDate'];
        $newCategory = $_POST['newCategory'];

        $db = DB::getInstance();
        $conn = $db->getConnection();

        // UPDATE pieprasījums
        $updateQuery = "UPDATE produkts SET
            nosaukums = '$newName',
            daudzums = '$newQuantity',
            iepirkuma_cena = '$newPurchasePrice',
            pardosanas_cena = '$newSalePrice',
            ceka_nr = '$newReceiptNumber',
            piegades_datums = '$newDeliveryDate',
            kategorija = '$newCategory'
            WHERE produkta_id = $productId";

        $result = $conn->query($updateQuery);

        if ($result) {
            $response = ['success' => true, 'message' => 'Izmaiņas veiksmīgi saglabātas'];
        } else {
            $response = ['success' => false, 'message' => 'Kļūda datubāzes atjaunināšanā'];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    // citi "action" gadījumi...
}
?>
