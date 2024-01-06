<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>BURGA</title>
</head>

<body class="min-vh-100 d-flex flex-column">
 <?php include 'navigation_default.php'; ?>

 <div class="container mt-auto">
        <div class="row d-flex align-items-center">
            <div class="col-md-6 offset-md-3 text-center">
                <h1>Vietnes rokasgrāmata</h1>

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
                            <h3>Liela izmēra ekrānā</h3>
            <img src="image/L1.png" alt="Attēls 1" class="img-fluid">
            <p> Navigācijas pogas: Sākums, Lietotāja rokasgrāmata</p>
            <p>Sākums ir vietnes noklusējma lapa uz kuras uzspiežot nonāks pie izvēles iegādāties preces vai autorizēties</p>
            <p>Lietotāja rokasgrāmata aizvedīs uz vietnes pieejamo funkciju paskaidrojumiem un pamācībām</p>
            <p> Ikona ir Fraternitas Lataviensis vapenis. uzpiežot uz tā nonāks uz lietotāja rokasgrāmatu no kuras sīkāk ar visu var iepazīties</p>

            
            <!-- Virsraksts 2 -->
            <h3>Planšetes rezīmā un mazāk (navigācijas pogas paslēptas) </h3>
            <img src="image/L2.png" alt="Attēls 2" class="img-fluid">
            

            <!-- Virsraksts 3 -->
            <h3>Planšetes rezīmā un mazāk (navigācijas pogas redzamas) </h3>
            <img src="image/L3.png" alt="Attēls 3" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <!-- Pievienot preces -->
            <!-- Preču pirkšana -->
<div class="card">
    <div class="card-header" id="precesPirkanaHeading">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#precesPirkanaCollapse" aria-expanded="true" aria-controls="precesPirkanaCollapse">
                Preču Pirkšana
            </button>
        </h2>
    </div>

    <div id="precesPirkanaCollapse" class="collapse" aria-labelledby="precesPirkanaHeading" data-parent="#saturaRaditajs">
        <div class="card-body">
            <h5>Preču Pirkšana</h5>
            <img src="image/e1.png" alt="Attēls Preču Pirkšana" class="img-fluid">
            <p>Lapas mērķis ir nodrošināt vienkāršu preču iegādes procesu. satur informāciju par pieejamajam precēm un to cenu, pirkuma grozu un izpildes pogām. </p>
        </div>
    </div>
</div>

<!-- Preču saraksts -->
<div class="card">
    <div class="card-header" id="precesSarakstsHeading">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#precesSarakstsCollapse" aria-expanded="true" aria-controls="precesSarakstsCollapse">
                Preču Saraksts
            </button>
        </h2>
    </div>

    <div id="precesSarakstsCollapse" class="collapse" aria-labelledby="precesSarakstsHeading" data-parent="#saturaRaditajs">
        <div class="card-body">
            <h5>Preču Saraksts</h5>
            <img src="image/e2.png"  alt="Attēls Preču Saraksts" class="img-fluid">
            <p>Preču saraksts satur informāciju par pieejamajām precēm burgā. Daudzums un cena ir atbilstoši pieejamībai un preces vienības cenai.</p>
        </div>
    </div>
</div>

<!-- Prēču grozs -->
<div class="card">
    <div class="card-header" id="precuGrozsHeading">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#precuGrozsCollapse" aria-expanded="true" aria-controls="precuGrozsCollapse">
                Preču Grozs
            </button>
        </h2>
    </div>

    <div id="precuGrozsCollapse" class="collapse" aria-labelledby="precuGrozsHeading" data-parent="#saturaRaditajs">
        <div class="card-body">
            <h5>Preču Grozs</h5>
            <img src="image/e3.png" alt="Attēls Prēču Grozs" class="img-fluid">
            <p> Prēču grozs ietver pogas "Pievienot Grozam" un "Pirkt". Informācija par precēm grozā, kopējo summa par precēm grozā.</p>
        </div>
    </div>
</div>

<!-- Prēču pasūtīšana -->
<div class="card">
    <div class="card-header" id="precuPasutisanaHeading">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#precuPasutisanaCollapse" aria-expanded="true" aria-controls="precuPasutisanaCollapse">
                Prēču pasūtīšana
            </button>
        </h2>
    </div>

    <div id="precuPasutisanaCollapse" class="collapse" aria-labelledby="precuPasutisanaHeading" data-parent="#saturaRaditajs">
        <div class="card-body">
            <h5>Preci izvēlas no saraksta</h5>
            <img src="image/u1.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Pieejamo preču nosaukums</p>
        
            <h5>Daudzuma ievadīšana</h5>
            <img src="image/u2.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Ievada vēlamo preču daudzumu</p>

            <h5>Pogas "Pievienot grozam" nospiešana</h5>
            <img src="image/u3.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Nospiežot pogu "Pievienot grozam" izveidojas vēlamo pirkumu saraksts. Visdrošāk grozā saliktās preces tiek savāktas un liktias vienuviet.</p>

            <h5>Pirkumu kopsumma</h5>
            <img src="image/u4.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Zem groza satura ir naudas daudzums kāds pēc pirkuma veikšanas ir jāievieto burgas kasē. Preces ir jāpaņem no burgas precīzi tik, cik ir pirkuma grozā.</p>

            <h5>Poga "Pirkt"</h5>
            <img src="image/u5.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Pēc pogas nospiešanas pirkums ir reģistrēts sistēmā</p>
        </div>
    </div>
</div>

<!-- Paziņojumu paskaidrojumi -->
<div class="card">
    <div class="card-header" id="pazinojumuPaskaidrojumiHeading">
        <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#pazinojumuPaskaidrojumiCollapse" aria-expanded="true" aria-controls="pazinojumuPaskaidrojumiCollapse">
                Paziņojumu paskaidrojumi
            </button>
        </h2>
    </div>

    <div id="pazinojumuPaskaidrojumiCollapse" class="collapse" aria-labelledby="pazinojumuPaskaidrojumiHeading" data-parent="#saturaRaditajs">
        <div class="card-body">
            <h5>Pēc pogas "Pievienot grozam" nospiešanas</h5>
            <img src="image/a1.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Pēc pogas nospiešanas "Pievienot grozam" paziņojums (attēlā) parādās, ja nav izvēlēts preces nosaukums kādu vēlas iegādāties. Preču grozs netiek aizpidīts.</p>

            <h5>Pēc pogas "Pievienot grozam" nospiešanas</h5>
            <img src="image/a2.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Pēc pogas nospiešanas "Pievienot grozam" paziņojums (attēlā) parādās, ja nav izvēlēts preces daudzums kādu vēlas iegādāties. Preču grozs netiek aizpidīts.</p>

            <h5>Pēc pogas "Pievienot grozam" nospiešanas</h5>
            <img src="image/a3.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Pēc pogas nospiešanas "Pievienot grozam" paziņojums (attēlā) parādās, ja nav burgā pieejams preču daudzums. </p>

            <h5>Pēc pogas "Pirkt" nospiešanas</h5>
            <img src="image/a4.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Ja poga "Pirkt" ir nospiesta, ja preču grozs ir tukšs, parādās (attēlā) paziņojums</p>

            <h5>Poga "Pirkt"</h5>
            <img src="image/a5.png" alt="Attēls Prēču pasūtīšana" class="img-fluid">
            <p>Ja poga "Pirkt" ir nospiesta, ja pirkums ir sekmīgi veikts, parādās (attēlā) paziņojums</p>
    </div>
</div>



                    </div>

                    <!-- Izmainīt preces -->
                    <div class="card">
                        <div class="card-header" id="izmainitPrecesHeading">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#izmainitPrecesCollapse" aria-expanded="true" aria-controls="izmainitPrecesCollapse">
                                    Visparīgi
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
