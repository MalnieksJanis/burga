<?php
session_start();

// Pārbaudīt, vai lietotājs ir ielgojies
if (!isset($_SESSION['username'])) {
    // Ja nav ielogošanās, novirzīt uz ielogošanās lapu vai veikt citus pasākumus
    header("Location: login.php");
    exit();
}

// Iegūstam informāciju par lietotāju no sesijas
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BURGA ADMINISTRAORA FUNKCIJAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- JavaScript funkcijas -->
    <script>
        function deleteProduct(productId) {
            // Izdzēšam produktu
            if (confirm("Vai tiešām vēlaties dzēst šo produktu?")) {
                fetch("produkta-apstrade.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: "action=delete&id=" + productId,
                    })
                    .then(response => response.json())
                    .then(data => {
                        // atjauno lapu vai veic citas nepieciešamās darbības
                    })
                    .catch(error => console.error("Error:", error));
            }
        }

        <!-- Labot produktu funkcija -->
function editProduct(productId) {
    // Iegūstam jaunās vērtības no lietotāja
    var newName = prompt("Ievadiet jauno nosaukumu:");
    var newQuantity = prompt("Ievadiet jauno daudzumu:");
    var newPurchasePrice = prompt("Ievadiet jauno iepirkuma cenu:");
    var newSalePrice = prompt("Ievadiet jauno pārdošanas cenu:");
    var newReceiptNumber = prompt("Ievadiet jauno ceka numuru:");
    var newDeliveryDate = prompt("Ievadiet jauno piegādes datumu:");
    var newCategory = prompt("Ievadiet jauno kategoriju:");

    // Izdzēšam produktu
    if (
        newName !== null &&
        newQuantity !== null &&
        newPurchasePrice !== null &&
        newSalePrice !== null &&
        newReceiptNumber !== null &&
        newDeliveryDate !== null &&
        newCategory !== null
    ) {
        // Izsaucam servera pusi, lai veiktu izmaiņas
        fetch("produkta-apstrade.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: "action=edit&id=" + productId +
                    "&newName=" + newName +
                    "&newQuantity=" + newQuantity +
                    "&newPurchasePrice=" + newPurchasePrice +
                    "&newSalePrice=" + newSalePrice +
                    "&newReceiptNumber=" + newReceiptNumber +
                    "&newDeliveryDate=" + newDeliveryDate +
                    "&newCategory=" + newCategory,
            })
            .then(response => response.json())
            .then(data => {
                // atjauno lapu vai veic citas nepieciešamās darbības
            })
            .catch(error => console.error("Error:", error));
    }
}

        function toggleEditMode(rowId) {
        var row = document.getElementById("row_" + rowId);
        var cells = row.getElementsByTagName("td");

        for (var i = 0; i < cells.length - 1; i++) { // Exclude the last cell with action buttons
            var cellValue = cells[i].innerText;

            // Replace cell content with input fields
            cells[i].innerHTML = "<input type='text' value='" + cellValue + "'>";
        }

        // Change the "Labot" button to "Saglabāt" (Save) button
        var editButton = row.querySelector(".btn-warning");
        editButton.innerText = "Saglabāt";
        editButton.setAttribute("onclick", "saveChanges(" + rowId + ")");
    }

    function saveChanges(rowId) {
        var row = document.getElementById("row_" + rowId);
        var cells = row.getElementsByTagName("td");

        var newData = {};
        for (var i = 0; i < cells.length - 1; i++) {
            var input = cells[i].querySelector("input");
            newData["column_" + i] = input.value;

            // Replace input field with the new cell value
            cells[i].innerText = input.value;
        }

        // Change the "Saglabāt" (Save) button back to "Labot" (Edit) button
        var editButton = row.querySelector(".btn-warning");
        editButton.innerText = "Labot";
        editButton.setAttribute("onclick", "toggleEditMode(" + rowId + ")");

        // Perform an AJAX request to save the changes on the server
        // You need to implement the server-side logic to handle the update
        // ...

        // Optional: Notify the user that changes were saved
        alert("Changes saved successfully!");
    }
    </script>
</head>

<body class="min-vh-100 d-flex flex-column">

    <!-- Navigācijas izvēlne -->
    <?php include 'navigation.php'; ?>

    <div class="container mt-3">
        <!-- Forma ar atskaitēm -->
        <h1>Apteidot produktus</h1>
        <!-- Forma ar atskaitēm un produktu datiem -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nosaukums</th>
                    <th>Daudzums</th>
                    <th>Iepirkuma cena</th>
                    <th>Pārdošanas cena</th>
                    <th>Piegādes datums</th>
                    <th>Kategorija</th>
                    <th>Ceka nr</th>
                    <th>Darbības</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'includes/db.php';

                // Izgūstam produktu datus no datubāzes un attēlojam tos
                $db = DB::getInstance();

                $conn = $db->getConnection();
                $result = $conn->query("SELECT * FROM produkts");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<tr id='row_" . $row['produkta_id'] . "'>";
                    echo "<td>" . $row['nosaukums'] . "</td>";
                    echo "<td>" . $row['daudzums'] . "</td>";
                    echo "<td>" . $row['iepirkuma_cena'] . "</td>";
                    echo "<td>" . $row['pardosanas_cena'] . "</td>";
                    echo "<td>" . $row['piegades_datums'] . "</td>";
                    echo "<td>" . $row['kategorija'] . "</td>";
                    echo "<td>" . $row['ceka_nr'] . "</td>";
                    echo "<td>
                    <button class='btn btn-danger' onclick='deleteProduct(" . $row['produkta_id'] . ")'>Dzēst</button>
                    <button class='btn btn-warning' onclick='toggleEditMode(" . $row['produkta_id'] . ")'>Labot</button>
                  </td>";
                 echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript saites -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>
<?php include 'footer.php'; ?>

</html>
