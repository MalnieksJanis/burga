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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>E-burgs</title>
</head>

<body class="min-vh-100 d-flex flex-column">
    <?php include 'navigation.php'; ?>

    <div class="container mt-auto">
        <div class="row d-flex align-items-center">
            <div class="col-md-6 offset-md-3 text-center">
                <p>Help prieks admin</p>

                <!-- Satura rādītājs -->
                <div class="accordion" id="saturaRaditajs">

                    <!-- Navigācija -->
                    <div class="card">
                        <div class="card-header" id="navigacijaHeading">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#navigacijaCollapse" aria-expanded="true" aria-controls="navigacijaCollapse">
                                    Navigācija
                                </button>
                            </h2>
                        </div>

                        <div id="navigacijaCollapse" class="collapse" aria-labelledby="navigacijaHeading" data-parent="#saturaRaditajs">
                            <div class="card-body">
                                Apraksts par navigāciju, iespējams ar attēlu vai papildu informāciju.
                            </div>
                        </div>
                    </div>

                    <!-- Pievienot preces -->
                    <div class="card">
                        <div class="card-header" id="pievienotPrecesHeading">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#pievienotPrecesCollapse" aria-expanded="true" aria-controls="pievienotPrecesCollapse">
                                    Pievienot preces
                                </button>
                            </h2>
                        </div>

                        <div id="pievienotPrecesCollapse" class="collapse" aria-labelledby="pievienotPrecesHeading" data-parent="#saturaRaditajs">
                            <div class="card-body">
                                Apraksts par PIEVIENOT PRECES, iespējams ar attēlu vai papildu informāciju.
                            </div>
                        </div>
                    </div>

                    <!-- Izmainīt preces -->
                    <div class="card">
                        <div class="card-header" id="izmainitPrecesHeading">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#izmainitPrecesCollapse" aria-expanded="true" aria-controls="izmainitPrecesCollapse">
                                    Izmainīt preces
                                </button>
                            </h2>
                        </div>

                        <div id="izmainitPrecesCollapse" class="collapse" aria-labelledby="izmainitPrecesHeading" data-parent="#saturaRaditajs">
                            <div class="card-body">
                                Apraksts par IZMIANĪT PRECES, iespējams ar attēlu vai papildu informāciju.
                            </div>
                        </div>
                    </div>

                    <!-- Līdzīgi pievienojiet citas sadaļas ar dropdown -->
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
