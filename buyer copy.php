<?php
include 'includes/db.php';
$db = DB::getInstance()->getConnection();

$query = "SELECT * FROM produkts";
$result = $db->query($query);

if (isset($_POST['pirkumaDati'])) {
    // Dekodē JSON datus
    $pirkumaDati = json_decode($_POST['pirkumaDati'], true);

    // Ieraksta katru pirkumu atsevišķi datubāzē
    foreach ($pirkumaDati as $pirkums) {
        $nosaukums = $db->real_escape_string($pirkums['nosaukums']); // Izvairās no SQL ievainojamībām
        $daudzums = $pirkums['daudzums'];
        $cena = $pirkums['cena'];
        $datums_pirkts = date('Y-m-d');

        // Ieraksta datus datubāzē
        $query = "INSERT INTO nopirkta_prece (produkta_id, daudzums, cena, datums_pirkts) 
                  SELECT produkta_id, $daudzums, $cena, '$datums_pirkts' FROM produkts 
                  WHERE nosaukums = '$nosaukums'";

        $result = $db->query($query);

        if (!$result) {
            // Kļūdas apstrāde, ja datu ieraksts neizdodas
            echo "Kļūda: " . $db->error;
            exit();
        }
    }

    // Atbrīvo resursus
    $result->free_result();
    $db->close();

    echo "success"; // Atgriež atbildi par veiksmīgu darbību
} else {
    echo "No access"; // Ja POST dati nav saņemti, atgriež piekļuves kļūdu
}

?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Pircejs</title>
</head>
<body class="min-vh-100 d-flex flex-column">

<div class="container-fluid mt-5">
    <div class="row">

        <!-- Kataloga kolonna (kreisajā pusē) -->
        <div class="col-md-4">
            <h2 class="text-center">Produkti</h2>
            
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
                            <td><?php echo $row['daudzums']; ?></td>
                            <td><?php echo $row['pardosanas_cena']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Jaunu preču pievienošanas kolonna (labajā pusē) -->
        <div class="col-md-8">
            <h2 class="text-center">Pirkt preces</h2>
            <p>Jūsu sadaļa ar jaunu preču pievienošanu šeit.</p>

            <!-- Tabula, kurā tiek pievienotas jaunas preces -->
            <table class="table" id="precesTabula">
                <thead>
                    <tr>
                        <th>Nosaukums</th>
                        <th>Daudzums</th>
                        <th>Cena</th>
                        <th>Darbības</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Šeit tiks ievietotas jaunās rindas dinamiski -->
                </tbody>
            </table>

            <!-- Poga, kas izsauc funkciju, lai pievienotu jaunu rindu tabulā -->
            <button type="button" class="btn btn-success" onclick="pievienotPreci()">
                Pievienot preci
            </button>
            <div class="mt-3">
                <p><strong>Kopējais preču daudzums: </strong><span id="kopejaisDaudzums">0</span></p>
                <p><strong>Kopējā summa: </strong><span id="kopejaSumma">0.00</span></p>
                <button type="button" class="btn btn-primary" onclick="pirkt()">Pirkt</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    var unikalaID = 1;
    window.onload = function () {
        var dropdown = document.querySelector("select[name='nosaukums[]']");
        aizpilditProduktuNosaukumuDropdown(dropdown);
    };

    function aizpilditProduktuNosaukumuDropdown(dropdown) {
    <?php
    $queryProdukti = "SELECT produkta_id, nosaukums, pardosanas_cena FROM produkts";
    $resultProdukti = $db->query($queryProdukti);

    while ($rowProdukts = $resultProdukti->fetch_assoc()) {
        echo "console.log('Nosaukums: " . $rowProdukts['nosaukums'] . " Cena: " . $rowProdukts['pardosanas_cena'] . "');\n";
        echo "dropdown.options.add(new Option('" . $rowProdukts['nosaukums'] . "', '" . $rowProdukts['pardosanas_cena'] . '|' . $rowProdukts['produkta_id'] . "'));\n";
    }

    $resultProdukti->free_result();
    ?>
    dropdown.onchange = function () {
        updateCena(this);
    };
    updateCena(dropdown);
}

    function updateCena(selectElement) {
        var selectedOption = selectElement.value.split("|");
        var cena = parseFloat(selectedOption[0]);
        var produktaId = selectedOption[1];
        var cenaLauks = selectElement.parentElement.nextElementSibling.getElementsByClassName('cena')[0];
        var cenaSpan = selectElement.parentElement.nextElementSibling.getElementsByClassName('cena-span')[0];

        cenaLauks.value = cena;
        cenaSpan.innerText = cena.toFixed(2);
        updateSum();
    }

    function pievienotPreci() {
    var unikalaID = Date.now(); // Jauna unikāla vērtība, lai identificētu jaunās rindas

    var newRow = "<tr id='rinda" + unikalaID + "'>";
    newRow += "<td><select name='nosaukums[]'></select></td>";
    newRow += "<td><input type='number' name='daudzums[]' min='1' onchange='updateSum()'></td>";

    // Izvietojam slēpto lauku ar nosaukumu "cena[]" un ievietojam vērtību
    newRow += "<td><input type='hidden' name='cena[]' class='cena' value=''>";
    newRow += "<span class='cena-span'></span></td>";

    newRow += "<td><button type='button' class='btn btn-danger' onclick='dzestRindu(" + unikalaID + ")'>Dzēst</button></td>";
    newRow += "</tr>";

    document.getElementById("precesTabula").getElementsByTagName('tbody')[0].innerHTML += newRow;
    updateSum();
    var dropdown = document.getElementById("rinda" + unikalaID).getElementsByTagName("select")[0];
    aizpilditProduktuNosaukumuDropdown(dropdown);
}

function dzestRindu(id) {
    var row = document.getElementById("rinda" + id);
    row.parentNode.removeChild(row);
    updateSum();
}

    function updateSum() {
        var kopejaisDaudzums = 0;
        var kopejaSumma = 0;

        // Iterēt cauri visām rindām un iegūt dati
        var tabula = document.getElementById("precesTabula");
        var rindas = tabula.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        for (var i = 0; i < rindas.length; i++) {
            var daudzumsLauks = rindas[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0];
            var cenaLauks = rindas[i].getElementsByTagName('td')[2].getElementsByClassName('cena')[0];
            var cenaSpan = rindas[i].getElementsByTagName('td')[2].getElementsByClassName('cena-span')[0];

            var daudzums = parseInt(daudzumsLauks.value) || 0;

            // Iegūt vērtību no slēptā lauka un ievietot span
            var cena = parseFloat(cenaLauks.value) || 0;
            cenaSpan.innerText = cena.toFixed(2);

            kopejaisDaudzums += daudzums;
            kopejaSumma += daudzums * cena;
        }

        // Atjaunot kopējo preču daudzumu un summu
        document.getElementById("kopejaisDaudzums").innerText = kopejaisDaudzums;
        document.getElementById("kopejaSumma").innerText = kopejaSumma.toFixed(2);
    }

    function pirkt() {
        var tabula = document.getElementById("precesTabula");
        var rindas = tabula.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

        var pirkumaDati = [];

        for (var i = 0; i < rindas.length; i++) {
            var nosaukums = rindas[i].getElementsByTagName('td')[0].getElementsByTagName('select')[0].value;
            var daudzums = parseInt(rindas[i].getElementsByTagName('td')[1].getElementsByTagName('input')[0].value);
            var cena = parseFloat(rindas[i].getElementsByTagName('td')[2].getElementsByClassName('cena')[0].value);

            pirkumaDati.push({
                nosaukums: nosaukums,
                daudzums: daudzums,
                cena: cena
            });
        }

        // Sūta pirkuma datus uz serveri izmantojot AJAX
        $.ajax({
            type: "POST",
            url: "ierakstit_pirkumu.php", // Jāizveido šis fails, kas apstrādās datus un ieraksta datubāzē
            data: {
                pirkumaDati: JSON.stringify(pirkumaDati)
            },
            success: function(response) {
                alert("Pirkums veikts un ierakstīts datubāzē!");
                // Jebkura papildu darbība pēc pirkuma veikšanas
            },
            error: function(error) {
                console.error("Kļūda pirkuma ierakstīšanā: ", error);
                alert("Radusies kļūda! Lūdzu, sazinieties ar administratoru.");
            }
        });
    }

    if (window.jQuery) {
        // jQuery ir ielādēts
        console.log("jQuery ir ielādēts!");
    } else {
        // jQuery nav ielādēts
        console.log("jQuery nav ielādēts!");
    }
</script>
</body>
<?php include 'footer.php'; ?>
</html>

<?php
$result->free_result();
$db->close();
?>
