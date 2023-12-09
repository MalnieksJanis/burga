<?php
include 'includes/db.php';
$db = DB::getInstance()->getConnection();

$query = "SELECT * FROM produktu_saraksts";
$result = $db->query($query);

$queryProduktiSaraksts = "SELECT nosaukums, kop_daudzums, pardosanas_cena FROM produktu_saraksts";
$resultProduktiSaraksts = $db->query($queryProduktiSaraksts);

$produktuNosaukumi = [];
while ($rowProduktiSaraksts = $resultProduktiSaraksts->fetch_assoc()) {
    $produktuNosaukumi[] = $rowProduktiSaraksts;
}



?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Pircejs</title>
    <script>
        var produktuNosaukumi = <?php echo json_encode($produktuNosaukumi); ?>;
        
        document.addEventListener("DOMContentLoaded", function() {
            var dropdown = document.querySelector("select[name='nosaukums']");
            dropdown.innerHTML = "";
            dropdown.options.add(new Option('Izvēlies produktu', ''));
            aizpilditProduktuNosaukumuDropdown(dropdown, produktuNosaukumi);
            
            dropdown.onchange = function () {
                updateCena(this);
            };

            pievienotPreci();
        });

        function aizpilditProduktuNosaukumuDropdown(dropdown, nosaukumi) {
            if (dropdown) {
                dropdown.innerHTML = "";
                dropdown.options.add(new Option('Izvēlies produktu', ''));
                
                for (var i = 0; i < nosaukumi.length; i++) {
                    dropdown.options.add(new Option(nosaukumi[i].nosaukums, nosaukumi[i].nosaukums + '|' + nosaukumi[i].kop_daudzums + '|' + nosaukumi[i].pardosanas_cena));
                }

                dropdown.onchange = function () {
                    updateCena(this);
                };
                updateCena(dropdown);
            }
        }

        function updateCena(dropdown) {
            var selectedOption = dropdown.options[dropdown.selectedIndex].value.split('|');
            document.getElementById('cena').value = selectedOption[2];
        }

        function pievienotPreci() {
        var dropdown = document.getElementById('nosaukums');
        var nosaukums = dropdown.options[dropdown.selectedIndex].value;
        
        // Check if a product is selected before proceeding
        if (!nosaukums) {
            return; // Do nothing if no product is selected
        }

        var daudzums = parseInt(document.getElementById('daudzums').value);
        var cena = parseFloat(document.getElementById('cena').value);

        if (daudzums <= 0) {
            alert("Norādiet derīgu daudzumu.");
            return;
        }

        var maxDaudzums = parseInt(nosaukums.split('|')[1]);
        if (daudzums > maxDaudzums) {
            alert("Norādītais daudzums pārsniedz pieejamo daudzumu noliktavā.");
            return;
        }

        var summa = (daudzums * cena).toFixed(2);

        var ieteikumi = document.getElementById('ieteikumi');
        var jaunaPozicija = document.createElement('div');
        jaunaPozicija.classList.add('list-group-item');
        jaunaPozicija.innerHTML = `<span>${nosaukums} - ${daudzums} Gab. - ${cena}€ - Summa:  ${summa} €</span> <button type="button" class="btn btn-danger btn-sm float-right" onclick="dzestPreci(this)">Dzēst</button>`;
        
        ieteikumi.appendChild(jaunaPozicija);

        // Pārbaudīt, vai grozs ir redzams
        var grozs = document.getElementById('ieteikumi');
        if (grozs.style.display === 'none' || grozs.style.display === '') {
            grozs.style.display = 'block';
            document.getElementById('summa').style.display = 'block';
        }

        document.getElementById('summa').innerText = "Kopsumma: " + aprēķinātKopsummu();
    }

function aprēķinātKopsummu() {
    var summa = 0;
    var ieteikumi = document.getElementById('ieteikumi').getElementsByClassName('list-group-item');
    
    for (var i = 0; i < ieteikumi.length; i++) {
        var precesInfo = ieteikumi[i].innerText.split('-');
        var cena = parseFloat(precesInfo[2]);
        var daudzums = parseFloat(precesInfo[1].split('g')[0].trim());
        
        summa += cena * daudzums;
    }
    
    return summa.toFixed(2);
}

        function dzestPreci(button) {
            button.parentNode.remove();
            document.getElementById('summa').innerText = "Summa: " + aprēķinātKopsummu();
            
        }

        function iztuksoGrozu() {
    var ieteikumi = document.getElementById('ieteikumi');
    ieteikumi.innerHTML = "";
    document.getElementById('summa').innerText = "Summa: 0.00";
    

    // Slēpt groza un summas divu
    ieteikumi.style.display = 'none';
    document.getElementById('summa').style.display = 'none';

    // Parādīt paziņojumu
    alert("Paldies par pirkumu!");
}
function pirkt() {
    // Collect data from the shopping cart
    var ieteikumi = document.getElementById('ieteikumi').getElementsByClassName('list-group-item');
    var pirkumaData = [];

    for (var i = 0; i < ieteikumi.length; i++) {
        var precesInfo = ieteikumi[i].innerText.split('-');
        var nosaukums = precesInfo[0].trim();
        var daudzums = parseFloat(precesInfo[1].split('Gab.')[0].trim());
        var cena = parseFloat(precesInfo[2]);
        // var summa = parseFloat(precesInfo[3].split('Summa:')[1].trim());

        pirkumaData.push({
            nosaukums: nosaukums,
            daudzums: daudzums,
            cena: cena,
            // summa: summa
        });
    }

    // Send an AJAX request to a PHP script to handle the purchase
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'saglabat_pirkumu.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function () {
        if (xhr.status === 200) {
            // On successful purchase, clear the shopping cart
            document.getElementById('ieteikumi').innerHTML = '';
            document.getElementById('summa').innerText = 'Summa: 0.00';

            // Show a thank you message or redirect the user
            alert('Paldies par pirkumu!');
        } else {
            // Handle error
            console.error('Purchase failed. Status: ' + xhr.status);
        }
    };

    // Convert the data to JSON and send the request
    xhr.send(JSON.stringify(pirkumaData));
}
    </script>
</head>
<body class="min-vh-100 d-flex flex-column">
    <?php include 'navigation_default.php'; ?>
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
                            <td><?php echo $row['kop_daudzums']; ?></td>
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
    <h2 class="text-center">Pirkuma forma</h2>
    <div id="ieteikumi" class="list-group">
        <!-- Šeit tiks pievienoti produkti -->
    </div>
    <form id="pirkumaForma">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nosaukums">Izvēlies produktu</label>
                <select class="form-control" name="nosaukums" id="nosaukums">
                    <option value="">Izvēlies produktu</option>
                    <!-- Dropdown ar produktu nosaukumiem tiks aizpildīts ar JavaScript -->
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="daudzums">Daudzums</label>
                <input type="number" class="form-control" id="daudzums" name="daudzums" placeholder="Daudzums">
            </div>
            <div class="form-group col-md-3">
                <label for="cena">Cena</label>
                <input type="text" class="form-control" id="cena" name="cena" placeholder="Cena" readonly>
            </div>
        </div>
        <button type="button" class="btn btn-primary" onclick="pievienotPreci()">Pievienot grozam</button>
    </form> 
    
    <div id="summa" class="mt-3" style="display: none;">Summa: 0.00</div>
    <button type="button" class="btn btn-success" onclick="pirkt()">PIRTK</button>
   
</div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
<?php include 'footer.php'; ?>
</html>

<?php
$resultProduktiSaraksts->free_result();
$result->free_result();
$db->close();
?>