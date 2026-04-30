<?php
function conectar() {
    try {
        return new PDO("mysql:host=127.0.0.1;dbname=db_users;charset=utf8mb4", "root", "");
        // "charset=utf8mb4" es para evitar problemas con caracteres especiales como: emojis, tildes, etc
    } catch (PDOException $e) {
        die("Error | " . $e->getMessage());
    }
}
?>
