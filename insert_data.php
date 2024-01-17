<?php
include 'includes/db.php';
$db = DB::getInstance()->getConnection();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which form was submitted
    if (isset($_POST['submitProdukti'])) {
        // Process product quantity form data
        $produktaDaudzumsRealais = $_POST['produktuDaudzumsRealais'];

        // Check if product data is received from the form
        if (empty($produktaDaudzumsRealais)) {
            die("Kļūda: Nav saņemti dati par produktiem no formas.");
        }

        // Save product data to the database
        foreach ($produktaDaudzumsRealais as $nosaukums => $daudzums) {
            if (!is_numeric($daudzums)) {
                die("Kļūda: Produktu daudzums ir jābūt skaitlim.");
            }
            $query = "UPDATE produktu_saraksts SET kop_daudzums = ?, inventarizacijas_datums = sysdate() WHERE nosaukums = ?";
            $stmtProdukti = $db->prepare($query);
            $stmtProdukti->bind_param("is", $daudzums, $nosaukums);
            if (!$stmtProdukti->execute()) {
                die("SQL kļūda: " . $stmtProdukti->error);
            }
        }
    }

    if (isset($_POST['submitNauda'])) {
        // Process cash quantity form data
        $naudasDaudzumsRealais = $_POST['naudasDaudzumsRealais'];

        // Check if cash data is received from the form
        if (empty($naudasDaudzumsRealais)) {
            die("Kļūda: Nav saņemti dati par naudu no formas.");
        }

        // Save cash data to the database
        foreach ($naudasDaudzumsRealais as $nosaukums => $daudzums) {
            if (!is_numeric($daudzums)) {
                die("Kļūda: Naudas daudzums ir jābūt skaitlim.");
            }
            $query = "UPDATE nauda SET monetas_daudzums = ?, inventarizacijas_datums = sysdate() WHERE nosaukums = ?";
            $stmtNauda = $db->prepare($query);
            $stmtNauda->bind_param("is", $daudzums, $nosaukums);
            if (!$stmtNauda->execute()) {
                die("SQL kļūda: " . $stmtNauda->error);
            }
        }
    }

    // Additional actions after saving data
    header("Location: dienas_atskaite.php");
    exit();
}
?>
