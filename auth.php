<?php
// Iekļaut datu bāzes pieslēgšanās un citus nepieciešamos failus
include 'includes/db.php'; // Ja šis fails ir jūsu datu bāzes pieslēgšanās kontroliera fails

// Izveidot datu bāzes objektu
$db = DB::getInstance()->getConnection();

// Iegūstam ievadītos lietotājvārdu un paroli no formas
$username = $_POST['username'];
$password = $_POST['password'];

// Veicam lietotāja autentifikāciju
$query = "SELECT id, lietotajs, parole, loma FROM lietotaji WHERE lietotajs = ? AND parole = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$stmt->store_result();

// Pārbaudīt, vai lietotājs ir atrasts
if ($stmt->num_rows > 0) {
    // Iegūstam lietotāja datus
    $stmt->bind_result($userId, $username, $password, $role);
    $stmt->fetch();

    // Lietotājs atrasts, veicam nepieciešamās darbības (piemēram, pāradresējam uz atbilstošo lapu)
    if ($role == 'administrators') {
        header('Location: admin.php');
        exit();
    } elseif ($role == 'lietotajs') {
        header('Location: user.php');
        exit();
    }
} else {
    // Lietotājs netika atrasts, parādām pop-up logu ar paziņojumu
    echo "<script>alert('Lietotājs netika atrasts.');</script>";
}
?>
