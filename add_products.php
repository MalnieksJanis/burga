<?php
session_start();
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jūsu Lapas Nosaukums</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex flex-column">


    <!-- Navigācijas izvēlne -->
    <?php include 'navigation.php'; ?>

    <div class="container mt-auto">
        <div class="row d-flex align-items-center">
            <div class="col-md-6 offset-md-3 text-center">
                <p>Tev ir pieeja administratora funkcijām.</p>
                   <!-- Izvada paziņojumus, ja ir kādi -->
                   <?php
                if (isset($_SESSION['message'])) {
                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['message'] . '</div>';
                    unset($_SESSION['message']);
                }
                ?>
                <!-- Forma, lai pievienotu preces -->
                <form action="add_product_process.php" method="POST">
        
                    <!-- Ievades lauki priekš preces informācijas -->
                    <div class="form-group">
                        <input type="text" class="form-control" name="nosaukums" placeholder="Nosaukums" required>
                    </div>
                    <div class="form-group">
                        <input type="decimal" class="form-control" name="daudzums" placeholder="Daudzums" required>
                    </div>
                    <div class="form-group">
                        <input type="decimal" class="form-control" name="iepirkuma_cena" placeholder="Iepirkuma cena" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="pardosanas_cena" placeholder="Pārdošanas cena" required>
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" name="piegades_datums" placeholder="Piegādes datums" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="kategorija" placeholder="Kategorija" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="ceka_nr" placeholder="ceka_nr" required>
                    </div>
                    <!-- Poga, lai iesniegtu formu -->
                    <button type="submit" name="submit" class="btn btn-primary">Pievienot preces</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <p class="mb-0">Ja radušies jautājumi, sazinieties ar <a href="mailto:malnieks.janis@gmail.com">Jāni Mālnieku</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
