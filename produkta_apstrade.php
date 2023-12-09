<?php
include 'includes/db.php';
include 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the action is 'edit'
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        // Check if the required fields are set
        if (isset($_POST['productId'], $_POST['newName'], $_POST['newQuantity'])) {
            $productId = $conn->real_escape_string($_POST['productId']);
            $newName = $conn->real_escape_string($_POST['newName']);
            $newQuantity = $conn->real_escape_string($_POST['newQuantity']);

            // Update the database
            $query = "UPDATE produkts SET nosaukums = '$newName', daudzums = '$newQuantity' WHERE produkta_id = $productId";
            $result = $conn->query($query);

            if ($result) {
                // Redirect to the same page after the update
                header('Location: your_page.php');
                exit();
            } else {
                echo "Error updating data: " . $conn->error;
            }
        }
    }
}
?>
