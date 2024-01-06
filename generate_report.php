<?php
include 'includes/db.php';
require_once 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function generateReport($procedureName, $conn)
{
    try {
        $stmt = $conn->prepare("CALL $procedureName()");
        $stmt->execute();

        if ($stmt->errno) {
            echo "Error number: " . $stmt->errno . "<br>";
            echo "Error message: " . $stmt->error . "<br>";
            exit();
        }

        $result = $stmt->get_result();

        $objPHPExcel = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $objPHPExcel->getActiveSheet()->setTitle('Atskaite');

        $row = 1;
        while ($row_data = $result->fetch_assoc()) {
            $col = 0;
            foreach ($row_data as $key => $value) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
            $row++;
        }

        $timestamp = date("d.m.Y_H-i-s");
        $filenameWithTimestamp = 'C:/Users/malni/Downloads/' . $procedureName . '_' . $timestamp . '.xlsx';

        $objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
        $objWriter->save($filenameWithTimestamp);

        ob_clean();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filenameWithTimestamp . '"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Pārbaudam, vai POST pieprasījumā ir definēts "report_type"
if (!isset($_POST['report_type'])) {
    echo "Error: report_type is not set in the POST request.";
    exit();
}

// Iegūstam datu bāzes pieslēgumu
$db = DB::getInstance();
$conn = $db->getConnection();

// Pārbauda datu bāzes pieslēguma veiksmīgumu
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Izsaucam procedūru atkarībā no padotā report_type
$procedureName = "";
if ($_POST['report_type'] == 'report1') {
    $procedureName = "sagatavot_atskaiti";
} elseif ($_POST['report_type'] == 'report2') {
    $procedureName = "sagatavot_sestu_menesu_atskaiti";
} elseif ($_POST['report_type'] == 'report3') {
    $procedureName = "sagatavot_pirkumu_vestures_informaciju";
}

// Pārbauda, vai procedūras nosaukums ir definēts
if (empty($procedureName)) {
    echo "Error: Procedure name is not set.";
    exit();
}

// Izveido atskaiti un saglabā to
generateReport($procedureName, $conn);

// Aizveram datu bāzes pieslēgumu
$conn->close();
?>
