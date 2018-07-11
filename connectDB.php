<?php
function connect()
{
    try {
        $pdo = new PDO('mysql:host=localhost; dbname=short_url', 'root', '');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $pdo;
}