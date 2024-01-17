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
echo 'Lietotāja ID: ' . $_SESSION['username'] . '<br>';
    echo 'Loma: ' . $_SESSION['role'];

include 'includes/db.php';
include 'includes/session_logof.php';
$db = DB::getInstance()->getConnection();

// Iegūstam datus no produktu_saraksts tabulas
$query = "SELECT * FROM produktu_saraksts";
$result = $db->query($query);

// Iegūstam datus no nauda tabulas
$queryNauda = "SELECT * FROM nauda";
$resultNauda = $db->query($queryNauda);

// Iegūstam pēdējo inventarizācijas datumu no produktu_saraksts tabulas
$queryInventarizacijaProdukti = "SELECT inventarizacijas_datums AS pedeja_inventarizacija FROM produktu_saraksts";
$resultInventarizacijaProdukti = $db->query($queryInventarizacijaProdukti);
$rowInventarizacijaProdukti = $resultInventarizacijaProdukti->fetch_assoc();
$pedejaInventarizacijaProdukti = $rowInventarizacijaProdukti['pedeja_inventarizacija'];

// Iegūstam pēdējo inventarizācijas datumu no nauda tabulas
$queryInventarizacijaNauda = "SELECT inventarizacijas_datums AS pedeja_inventarizacija FROM nauda";
$resultInventarizacijaNauda = $db->query($queryInventarizacijaNauda);
$rowInventarizacijaNauda = $resultInventarizacijaNauda->fetch_assoc();
$pedejaInventarizacijaNauda = $rowInventarizacijaNauda['pedeja_inventarizacija'];

// Pārbaude, vai forma ir nosūtīta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pārbaude, vai ir iegūti dati no formas
    if (isset($_POST['submit'])) {
        // Pēdējā inventarizācijas datums
        $pedejaInventarizacija = date("Y-m-d H:i:s");
        // Iegūstam datus no formas par produktiem
        $produktaDaudzumsRealais = $_POST['produktuDaudzumsRealais'];
        $naudasDaudzumsRealais = $_POST['naudasDaudzumsRealais'];
        // Iegūstam dienas datumu no formas
        $inventarizacijasDatums = $_POST['inventarizacijasDatums'];

        // Saglabājam pēdējo inventarizācijas datumu tabulās
        $queryInventarizacija = "UPDATE produktu_saraksts SET pedeja_inventarizacija = ?, inventarizacijas_datums = ?";
        $stmtProdukti = $db->prepare($queryInventarizacija);
        $stmtProdukti->bind_param("ss", $pedejaInventarizacija, $inventarizacijasDatums);
        $stmtProdukti->execute();

        $queryInventarizacijaNauda = "UPDATE nauda SET pedeja_inventarizacija = ?, inventarizacijas_datums = ?";
        $stmtNauda = $db->prepare($queryInventarizacijaNauda);
        $stmtNauda->bind_param("ss", $pedejaInventarizacija, $inventarizacijasDatums);
        $stmtNauda->execute();

        // Pārbaude, vai ievadītais produkta daudzums atbilst tam, kas ir reali burgā
        $queryProdukts = "SELECT nosaukums, kop_daudzums FROM produktu_saraksts";
        $resultProdukts = $db->query($queryProdukts);

        while ($rowProdukts = $resultProdukts->fetch_assoc()) {
            $nosaukums = $rowProdukts['nosaukums'];
            $realaisDaudzums = $rowProdukts['kop_daudzums'];

            if (isset($produktaDaudzumsRealais[$nosaukums]) && $produktaDaudzumsRealais[$nosaukums] != $realaisDaudzums) {
                // Saglabā nesakritību datubāzē
                $sqlInsert = "INSERT INTO nesakritibas (produkta_nosaukums, realais_daudzums, ievaditais_daudzums) VALUES (?, ?, ?)";
                $stmtInsert = $db->prepare($sqlInsert);
                $stmtInsert->bind_param("sii", $nosaukums, $realaisDaudzums, $produktaDaudzumsRealais[$nosaukums]);
                $stmtInsert->execute();

                // Izveido pop-up formu
                echo '<script>';
                echo 'var nosaukums = "' . $nosaukums . '";';
                echo 'var realaisDaudzums = ' . $realaisDaudzums . ';';
                echo 'alert("Produkta " + nosaukums + " daudzums nav precīzi vienāds ar reālo daudzumu (" + realaisDaudzums + "). Lūdzu, pārbaudiet un labojiet!");';
                echo 'var vardsUzvards = prompt("Lūdzu, ievadiet savu vārdu un uzvārdu:");';
                echo 'var naudasDaudzums = prompt("Ievadiet monētu daudzumu un vērtību kā komentāru (piemēram, 5 cents, 10, 0.05):");';
                echo 'document.getElementById("vardsUzvards").value = vardsUzvards;';
                echo 'document.getElementById("komentars").value = naudasDaudzums;';
                echo 'document.getElementById("popupForm").submit();';
                echo '</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BURGA DEZURFUKSA FUNKCIJAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex flex-column">

    <!-- Navigācijas izvēlne -->
    <?php include 'navigation_lietotajs.php'; ?>

    <div class="container mt-3">
        <!-- Forma ar atskaitēm -->
        <h1 class="text-center">Dienas atskaite</h1>

        <div class="row justify-content-center">
            <!-- Kreisais konteiners -->
            <div class="col-md-4 text-center">
                <h2>Teorētiski</h2>
                <div class="col-md-12">
                    <h3>Burgas preces</h3>
                    <p class="text-center">Pēdējā preču inventarizācija: <?php echo $pedejaInventarizacijaProdukti; ?></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nosaukums</th>
                                <th scope="col">Daudzums</th>
                                <th scope="col">Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['nosaukums']; ?></td>
                                    <td><?php echo $row['kop_daudzums']; ?></td>
                                    <td><?php echo $row['pardosanas_cena']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <h3>Nauda kasē</h3>
                    <p class="text-center">Pēdējā naudas inventarizācija: <?php echo $pedejaInventarizacijaNauda; ?></p>
                    <!-- Saturs par naudu -->

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nosaukums</th>
                                <th scope="col">Monetas daudzums</th>
                                <th scope="col">Vērtība</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($rowNauda = $resultNauda->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $rowNauda['nosaukums']; ?></td>
                                    <td><?php echo $rowNauda['monetas_daudzums']; ?></td>
                                    <td><?php echo $rowNauda['vertiba']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Saturs par Burgas precēm -->
            </div>

            <!-- Salīdzināšanas konteiners -->
            <div class="col-md-5 text-center">
                <h2>Reāli burgā</h2>
                <div class="col-md-12">
                    <h3>Pēc salīdzināšanas</h3>
                    <form action="insert_data.php" method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nosaukums</th>
                                    <th scope="col">Daudzums</th>
                                    <th scope="col">Cena</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Atkārtoti izmantojam rezultātu kopu
                                $result->data_seek(0);
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['nosaukums']; ?></td>
                                        <td>
                                            <label for="produktuDaudzumsRealais_<?php echo $row['nosaukums']; ?>">
                                                <input type="number" class="form-control" id="produktuDaudzumsRealais_<?php echo $row['nosaukums']; ?>" name="produktuDaudzumsRealais[<?php echo $row['nosaukums']; ?>]" required>
                                            </label>
                                        </td>
                                        <td><?php echo $row['pardosanas_cena']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary" name="submitProdukti">Apstiprināt produkta daudzumu</button>
                        <div ></div>
                    </form>
                    
                    <h3>Nauda pēc salīdzinšanas</h3>
                    <!-- Saturs par naudu -->
                    <form action="insert_data.php" method="post">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nosaukums</th>
                                    <th scope="col">Monētas daudzums</th>
                                    <th scope="col">Vērtība</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Atkārtoti izmantojam rezultātu kopu
                                $resultNauda->data_seek(0);
                                while ($row = $resultNauda->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['nosaukums']; ?></td>
                                        <td>
                                            <label for="naudasDaudzumsRealais_<?php echo $row['nosaukums']; ?>">
                                                <input type="number" class="form-control" id="naudasDaudzumsRealais_<?php echo $row['nosaukums']; ?>" name="naudasDaudzumsRealais[<?php echo $row['nosaukums']; ?>]" required>
                                            </label>
                                        </td>
                                        <td><?php echo $row['vertiba']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary" name="submitNauda">Apstiprināt naudas daudzumu</button>
                    </form>
                    <!-- Papildināta forma ar pop-up logu -->
                    <div id="popup" style="display:none;">
                        <form id="popupForm" action="insert_data.php" method="post">
                            <input type="hidden" id="vardsUzvards" name="vardsUzvards" value="">
                            <input type="hidden" id="komentars" name="komentars" value="">
                                                       <div ></div>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- JavaScript saites -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<?php include 'footer.php'; ?>
</html>
