<?php
// Iekļaut datu bāzes pieslēgšanās failu
include 'includes/db.php'; // Aizstājiet ar jūsu datu bāzes pieslēgšanās faila nosaukumu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Iegūt lietotājvārdu un paroli no formas
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Veikt datu bāzes objektu
    $db = DB::getInstance()->getConnection();

    // Sagatavot SQL vaicājumu, lai iegūtu lietotāju ar norādīto lietotājvārdu un paroli
    $query = "SELECT * FROM lietotaji WHERE lietotajvards = ? AND parole = ?";
    
    // Paredzēta klauzula, lai pārbaudītu, vai izdevies sagatavot vaicājumu
    if ($stmt = $db->prepare($query)) {
        // Piesaistīt parametrus
        $stmt->bind_param("ss", $username, $password);

        // Izpildīt vaicājumu
        $stmt->execute();

        // Iegūt rezultātus
        $result = $stmt->get_result();

        // Pārbaudīt, vai ir atrasts lietotājs ar norādīto lietotājvārdu un paroli
        if ($result->num_rows > 0) {
            // Atrasts lietotājs
            $row = $result->fetch_assoc();
            $role = $row['loma'];

            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            // Nosūtīt lietotāju uz attiecīgo lapu atbilstoši lomai
            if ($role == 'administrators') {
                header("Location: administrator.php");
                exit();
            } elseif ($role == 'lietotajs') {
                header("Location: lietotajs.php");
                exit();
            }
        } else {
            // Ja nepareiza parole vai lietotājvārds, izvadīt kļūdas paziņojumu
            $error_message = "Nepareizs lietotājvārds vai parole.";
        }

        // Aizvērt prepared statement
        $stmt->close();
    } else {
        // Kļūda sagatavojot vaicājumu
        $error_message = "Kļūda sagatavojot vaicājumu: " . $db->error;
    }
}

?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Ielagties</title>
    <script>
    function redirectToIndex() {
        window.location.href = 'index.php';
    }
</script>
</head>
<body class="min-vh-100 d-flex flex-column">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Ielogoties</h2>
            <?php
            if (isset($error_message)) {
                echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
            }
            ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Lietotājvārds:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Parole:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Ielogoties</button>
                <button type="submit" class="btn btn-danger btn-block" onclick="redirectToIndex()">Iziet</button>
                
            </form>
            
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
