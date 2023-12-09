<?php
include 'includes/db.php';
$db = DB::getInstance()->getConnection();

// Iegūstam datus no produktu_saraksts tabulas
$query = "SELECT * FROM produktu_saraksts";
$result = $db->query($query);


// Iegūstam datus no nauda tabulas
$queryNauda = "SELECT * FROM nauda";
$resultNauda = $db->query($queryNauda);

?>
<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BURGA ADMINISTRAORA FUNKCIJAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex flex-column">

    <!-- Navigācijas izvēlne -->
    <?php include 'navigation_lietotajs.php'; ?>

    <div class="container mt-3">
        <!-- Forma ar atskaitēm -->
        <h1 class="text-center">Dienas atskate</h1>

        <div class="row justify-content-center">
            <!-- Kreisais konteiners -->
            <div class="col-md-4 text-center">
                <h2>Teorētiski</h2>
                <div class="col-md-12">
                    <h3>Burgas preces</h3>
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
                                <label for="produktuDaudzumsRealais" >
                                <input type="number" class="form-control" id="produktuDaudzumsRealais" name="produktuDaudzumsRealais[<?php echo $row['nosaukums']; ?>]" required>
                                </label>
                            </td>
                            <td><?php echo $row['pardosanas_cena']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Apstiprināt</button>
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
                                <label for="naudasDaudzumsRealais" >
                                <input type="number" class="form-control" id="naudasDaudzumsRealais" name="naudasDaudzumsRealais[<?php echo $row['nosaukums']; ?>]" required>
                                </label>
                            </td>
                            <td><?php echo $row['vertiba']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Apstiprināt</button>
        </form>
    </div>
</div>


            <!-- Labais konteiners -->
            <div class="col-md-3 text-center">
                <h3>Komentāri</h3>
                <!-- Saturs par konetāriem -->
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
</body>

</html>