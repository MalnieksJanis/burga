<?php
// includes/session.php

// Sākt sesiju
session_start();

// Ja lietotājs nav autorizējies, pāradresēt uz autorizācijas lapu
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Jūsu autorizācijas lapa
    exit();
}
?>