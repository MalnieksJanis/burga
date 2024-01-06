<?php
// includes/session.php

// Sākt sesiju
session_start();

// Ja lietotājs nav autorizējies, pāradresēt uz autorizācijas lapu
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Jūsu autorizācijas lapa
    exit();
}

session_start(); // Sāk sesiju

// Izlogošanās skripts
if (isset($_POST['logout'])) {
    // Sesijas iznīcināšana un citas izlogoties darbības
    session_destroy();
    // Papildus varat veikt novirzīšanu uz citu lapu
    header("Location: login.php"); // Piemērs - novirzīt uz ielogoties lapu
    exit();
}
?>