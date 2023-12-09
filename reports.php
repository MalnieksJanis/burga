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
    <title>E-BURGA ADMINISTRAORA FUNKCIJAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex flex-column">

    <!-- Navigācijas izvēlne -->
    <?php include 'navigation.php'; ?>

    <div class="container mt-3">
        <!-- Forma ar atskaitēm -->
        <h1>Atskaites</h1>

        <div class="container mt-3">
    <!-- Forma ar atskaitēm -->
    <h1>Atskaites</h1>

    <!-- Pogas un to paskaidrojumi -->
    <div class="row mt-4">
        <!-- Poga 1 -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>Atskaite par pēdējo mēnesi</h3>
                    <p>Paskaidrojums par to, ko poga darīs.</p>
                    <form action="generate_excel.php" method="post">
                        <input type="hidden" name="report_type" value="report1">
                        <button type="submit" class="btn btn-primary">Lejupielādēt XLSX</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Poga 2 -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>Atskaite par pēdējiem 6 mēnešiem</h3>
                    <p>sdgthsdfs</p>
                    <form action="generate_excel.php" method="post">
                        <input type="hidden" name="report_type" value="report2">
                        <button type="submit" class="btn btn-primary">Lejupielādēt XLSX</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Poga 3 -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>Atskaite par pirktajām precēm no veikala</h3>
                    <p>sdafgergwe</p>
                    <form action="generate_excel.php" method="post">
                        <input type="hidden" name="report_type" value="report3">
                        <button type="submit" class="btn btn-primary">Lejupielādēt XLSX</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Poga 4 -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h3>Atskaite par kopējiem ieņēmumiem.</h3>
                    <p>Atskaite, kas salīdzina iepirkuma cenu pret pārdoto.</p>
                    <form action="generate_excel.php" method="post">
                        <input type="hidden" name="report_type" value="report4">
                        <button type="submit" class="btn btn-primary">Lejupielādēt XLSX</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    </div>

    <!-- JavaScript saites -->
</body>
<?php include 'footer.php'; ?>
</html>
