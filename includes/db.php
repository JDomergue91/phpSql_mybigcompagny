<?php
    // commentaire sur une ligne

    # commentaire sur une ligne

    /* commentaire sur plusieurs ligne
    une autre ligne
    */
    define("SERVER", "localhost");
    define("DB", "mybigcompany");
    define("USER", "root");
    define("PASSWORD", "");
$db = new PDO('mysql:host='.SERVER.';dbname='.DB, USER, PASSWORD);
?>