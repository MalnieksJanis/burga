<?php
session_start(); // Sāk sesiju

// Izlogošanās skripts
if (isset($_POST['logout'])) {
    // Sesijas iznīcināšana un citas izlogoties darbības
    session_destroy();
    // Papildus varat veikt novirzīšanu uz citu lapu
    header("Location: index.php"); // Piemērs - novirzīt uz ielogoties lapu
    exit();
}
?>