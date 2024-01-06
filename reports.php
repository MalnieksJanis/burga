<?php
session_start();

// Pārbaudīt, vai lietotājs ir ielgojies
if (!isset($_SESSION['username'])) {
    // Ja nav ielogošanās, novirzīt uz ielogošanās lapu vai veikt citus pasākumus
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-BURGA ADMINISTRAORA FUNKCIJAS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="min-vh-100 d-flex flex-column">

    <!-- Navigation menu -->
    <?php include 'navigation.php'; ?>

    <div class="container mt-3">
        <!-- Reports form -->
        <h1>Atskaites</h1>

        <!-- Buttons and their descriptions -->
        <div class="row mt-4">
            <!-- Button 1 -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Atskaite par pēdējā mēnesi pievienotajām precēm burgā</h3>
                        <p>Paskaidrojums par to, ko poga darīs.</p>
                        <button type="button" id="report1" class="btn btn-primary">Lejupielādēt csv</button>
                    </div>
                </div>
            </div>

            <!-- Button 2 -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Atskaite par pēdējo sešu mēnešu laikā pievienotajām precēm</h3>
                        <p>sdgthsdfs</p>
                        <button type="button" id="report2" class="btn btn-primary">Lejupielādēt csv</button>
                    </div>
                </div>
            </div>

            <!-- Button 3 -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Atskaite par pirktajām precēm Burgā</h3>
                        <p>sdafgergwe</p>
                        <button type="button" id="report3" class="btn btn-primary">Lejupielādēt csv</button>
                    </div>
                </div>
            </div>

            <!-- Button 4 -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3>Atskaite par kopējiem ieņēmumiem.</h3>
                        <p>Atskaite, kas salīdzina iepirkuma cenu pret pārdoto.</p>
                        <button type="button" id="report4" class="btn btn-primary">Lejupielādēt csv</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript links -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Your JavaScript code -->
    <script>
        $(document).ready(function () {
            $("#report1").click(function () {
                invokeProcedure("report1");
            });

            $("#report2").click(function () {
                invokeProcedure("report2");
            });

            $("#report3").click(function () {
                invokeProcedure("report3");
            });

            $("#report4").click(function () {
                invokeProcedure("report4");
            });

            function invokeProcedure(reportType) {
                $.ajax({
                    url: "generate_report.php",
                    method: "POST",
                    data: { report_type: reportType },
                    success: function (response) {
                        console.log(response);
                        downloadFile(reportType);
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            function downloadFile(reportType) {
                window.location.href = 'generate_report.php?report_type=' + reportType;
            }
        });
    </script>
</body>
<?php include 'footer.php'; ?>

</html>
