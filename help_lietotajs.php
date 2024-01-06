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
    <title>BURGA DEZURFUKSA FUNKCIJAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex flex-column">

    <!-- Navigācijas izvēlne -->
    <?php include 'navigation_lietotajs.php'; ?>

    <div class="container mt-auto">
        <div class="row d-flex align-items-center">
            <div class="col-md-6 offset-md-3 text-center">
                <h1>Rokasgrāmata dežūrfuksim</h1>

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
                                <!-- Virsraksts 1 -->
            <h3>Liela izmēra ekrānā</h3>
            <img src="image/nav1.png" alt="Attēls 1" class="img-fluid">
            <p>3 navigācijas pogas: Dienas atskaite, Pirkt preci un HELP</p>
            <p>Dienas atskaite: aizvedīs uz dežurfukša inventarizācijas lapu.</p>
            <p>Pirkt preci aizvedīs uz preču iegādes lapu.</p>
            <p>HELP: aizvedīs uz rokasgrāmatu lapu. Rokasgrāmatā var nokļūt arī uzspiežot uz navigācijas joslas ikonas</p>
            <p>Poga 'Iziet' veiks izlagošanos ārā no dezūrfuksim pieejamajām lapām/funkcijām</p>
            <!-- Virsraksts 2 -->
            <h3>Planšetes rezīmā un mazāk (navigācijas pogas paslēptas) </h3>
            <img src="image/nav2.png" alt="Attēls 2" class="img-fluid">
            

            <!-- Virsraksts 3 -->
            <h3>Planšetes rezīmā un mazāk (navigācijas pogas redzamas) </h3>
            <img src="image/nav3.png" alt="Attēls 3" class="img-fluid">
            
                            </div>
                        </div>
                    </div>

                  
                    <div class="card">
    <div class="card-header" id="pievienotPrecesHeading">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#pievienotPrecesCollapse" aria-expanded="true" aria-controls="pievienotPrecesCollapse">
                Dienas atskaite
            </button>
        </h2>
    </div>

    <div id="pievienotPrecesCollapse" class="collapse" aria-labelledby="pievienotPrecesHeading" data-parent="#saturaRaditajs">
        <div class="card-body">
            <h4>Dienas atskaite</h4>

            <!-- Virsraksts "Burgas preces" -->
            <h5>Burgas preces</h5>
            <img src="image/d1.png" alt="Burgas preces" class="img-fluid">
            <p>Satur informāciju par burgā pieejamajām precēm digitālā formātā.</p>
            <p>Pēdējais inventarizācijas datums: Satur informāciju, kad pēdējo reizi tika viekta inventarizācija</p>

            <!-- Virsraksts "Reāli burgā" -->
            <h5>Reāli burgā</h5>
            <img src="image/d2.png" alt="Reāli burgā" class="img-fluid">
            <p>Vieta, kuru nepieciešams aizpildīt veicot inventarizāciju, norādot preču daudzumu kāds reāli tiek izskaitīts burgā</p>

            <!-- Virsraksts "Apstiprināt produkta daudzumu" -->
            <h5>Apstiprināt produkta daudzumu</h5>
            <img src="image/d3.png" alt="Apstiprināt produkta daudzumu" class="img-fluid">
            <p>Nospiežot pogu, tiks veikta inventarizācija. Gadījumā, ja preču daudzums nesakrīt, būs jāaizpilda forma ar iemeslu par nesakrītību, kas tiks reģistrēta sistēmā.</p>
            <h4>Dienas atskaite</h4>

            <!-- Virsraksts "Burgas preces" -->
            <h5>nauda kasē teorētiski</h5>
            <img src="image/n1.png" alt="Burgas preces" class="img-fluid">
            <p>Satur informāciju par burgā esošo naudu digitālā formātā jeb pēc pēdējās inventrarizācijas</p>
            <p>Pēdējais inventarizācijas datums: Satur informāciju, kad pēdējo reizi tika viekta naudas inventarizācija</p>

            <!-- Virsraksts "Reāli burgā" -->
            <h5>Reāli burgā esošā nauda</h5>
            <img src="image/n2.png" alt="Reāli burgā" class="img-fluid">
            <p>Vieta, kuru nepieciešams aizpildīt burgā esošās naudas daudzumu. tas tiek darīts, lai noskaidrotu vai nav iztrūkums.</p>

            <!-- Virsraksts "Apstiprināt produkta daudzumu" -->
            <h5>Apstiprināt naudas daudzumu</h5>
            <img src="image/n3.png" alt="Apstiprināt produkta daudzumu" class="img-fluid">
            <p>Nospiežot pogu, tiks veikta inventarizācija. Gadījumā, ja naudas daudzums nesakrīt, būs jāaizpilda forma ar iemeslu par nesakrītību, kas tiks reģistrēta sistēmā.</p>
        </div>
    </div>
</div>

                    <!-- Izmainīt preces -->
                    <div class="card">
                        <div class="card-header" id="izmainitPrecesHeading">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#izmainitPrecesCollapse" aria-expanded="true" aria-controls="izmainitPrecesCollapse">
                                    VISPĀRIGI PAR VIETNI
                                </button>
                            </h2>
                        </div>

                        <div id="izmainitPrecesCollapse" class="collapse" aria-labelledby="izmainitPrecesHeading" data-parent="#saturaRaditajs">
                            <div class="card-body">
                                Vietne ir digitāls burgas dežūržurnāls ar papildus funkcijām: ekanoma uzskaites sistēma, preču katalogs, preču pasūtīšana, preču un naudas uzraudība.
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
