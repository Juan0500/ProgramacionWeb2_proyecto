<?php
require_once("conexao.php");

function inserirUsuario($nome, $idade, $pontuacao) {
    $pdo = conectar();
    try {
        $sql = "INSERT INTO usuario (nome, idade, pontuacao) VALUES (:nome, :idade, :pontuacao)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':pontuacao', $pontuacao);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false; 
    }
}

function editarUsuario($id, $nome, $idade, $pontuacao) {
    $pdo = conectar();
    try {
        $sql = "UPDATE usuario SET nome = :nome, idade = :idade, pontuacao = :pontuacao WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':pontuacao', $pontuacao);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function deletarUsuario($id) {
    $pdo = conectar();
    try {
        $sql = "DELETE FROM usuario WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function listarUsuarios() {
    $pdo = conectar();
    try {
        $sql = "SELECT * FROM usuario ORDER BY pontuacao DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function calcularStatusAura($pontuacao) {
    if ($pontuacao < 0) {
        return "Aura Negativa";
    } elseif ($pontuacao >= 0 && $pontuacao <= 100) {
        return "Aura NPC";
    } elseif ($pontuacao > 100 && $pontuacao <= 500) {
        return "Aura Pura";
    } else {
        return "Aura + Lego";
    }
}

function modificarAura($id, $valor) {
    $pdo = conectar();
    try {
        $sql = "UPDATE usuario SET pontuacao = pontuacao + :valor WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
?>
