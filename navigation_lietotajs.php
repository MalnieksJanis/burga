
<!-- Navigācijas izvēlne ar Bootstrap klašu izmantošanu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-center">
    <style>
        .adaptive-icon {
            width: 30px; /* Set your desired width */
            height: 30px; /* Set your desired height */
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="container d-flex justify-content-center align-items-center">
        <!-- Bootstrap klašu izmantošana -->
        <a class="navbar-brand mx-auto" href="help_lietotajs.php"><img src="image/vapenis.png" alt="Burga ikona" class="adaptive-icon"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Izmantojiet justify-content-center, lai centretu <ul> -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dienas_atskaite.php">Dienas atskaite</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buyer.php">Pirkt preci</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help_lietotajs.php">HELP</a>
                </li>
                <li class="nav-item mr-auto">
                    <a type="submit" name="logout" href="index.php" class="btn btn-danger ml-2">Iziet</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
