
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
        <a class="navbar-brand mx-auto" href="admin_help.php"><img src="image/vapenis.png" alt="Burga ikona" class="adaptive-icon"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="add_products.php">Pievienot preces</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="update_products.php">Izmainīt preces</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports.php">Atskaites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_help.php">HELP ADMIN</a>
                </li>
                <li class="nav-item mr-auto">
                <a type="submit" name="logout" href="index.php"  class="btn btn-danger ml-2">Iziet</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
