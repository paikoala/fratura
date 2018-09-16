<?php

$host = 'localhost';

$username = 'root';

$pass = '';

$dbname = 'codeigniter';

define( 'MYSQL_HOST', $host );

define( 'MYSQL_USER', $username );

define( 'MYSQL_PASSWORD', $pass );

define( 'MYSQL_DB_NAME', $dbname );



try

{

    $PDO = new PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD );

}

catch ( PDOException $e )

{

    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();

}


$numFraseRand = rand(1, 24);

$sqw = "SELECT * from frases WHERE id = '$numFraseRand'";

$fraseAleatoria = $PDO->query( $sqw );

$resultadofrase = $fraseAleatoria;



?>