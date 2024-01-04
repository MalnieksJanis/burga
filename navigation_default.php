<!-- Navigācijas izvēlne ar Bootstrap klašu izmantošanu -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
        <a class="navbar-brand" href="help.php"><img src="image/vapenis.png" alt="Burga ikona" class="adaptive-icon"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto"> <!-- Izmantojiet mx-auto, lai izvietotu <ul> centrā -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Sākums</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help.php">Lietotāja rokasgrāmata</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
