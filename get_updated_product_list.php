

<?php
// Include your database connection logic
include 'includes/db.php';

// Query to fetch the updated product list
$query = "SELECT nosaukums, kop_daudzums, pardosanas_cena FROM produktu_saraksts";
$result = $db->query($query);

// Build the HTML content for the updated product list
$html = '<table class="table">
            <thead>
                <tr>
                    <th scope="col">Nosaukums</th>
                    <th scope="col">Daudzums</th>
                    <th scope="col">Cena</th>
                </tr>
            </thead>
            <tbody>';
while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . $row['nosaukums'] . '</td>
                <td>' . $row['kop_daudzums'] . '</td>
                <td>' . $row['pardosanas_cena'] . '</td>
            </tr>';
}
$html .= '</tbody></table>';

// Send the HTML content as the response
echo $html;

// Close the database connection
$result->free_result();
$db->close();
?>
