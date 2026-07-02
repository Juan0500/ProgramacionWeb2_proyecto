<?php
require_once("conexao.php");

function inserirUsuario($nome, $email, $senha, $pontuacaoAtual, $categoriaId) {
    $pdo = conectar();
    try {
        $sql = "INSERT INTO usuario (nome, email, senha, pontuacao_atual, fk_categoria_aura_id) 
                VALUES (:nome, :email, :senha, :pontuacao, :categoria)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':pontuacao', $pontuacaoAtual);
        $stmt->bindParam(':categoria', $categoriaId);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function editarUsuario($id, $nome, $email, $senha, $pontuacaoAtual, $categoriaId) {
    $pdo = conectar();
    try {
        $sql = "UPDATE usuario SET nome = :nome, email = :email, senha = :senha, 
                pontuacao_atual = :pontuacao, fk_categoria_aura_id = :categoria WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':pontuacao', $pontuacaoAtual);
        $stmt->bindParam(':categoria', $categoriaId);
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
        $sql = "SELECT * FROM usuario ORDER BY pontuacao_atual DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function listarUsuariosFiltro($nome = '', $categoriaId = '', $pontuacaoMin = '', $pontuacaoMax = '') {
    $pdo = conectar();
    try {
        $sql = "SELECT * FROM usuario WHERE 1=1";
        $params = [];

        if ($nome !== '') {
            $sql .= " AND nome LIKE :nome";
            $params[':nome'] = "%$nome%";
        }
        if ($categoriaId !== '') {
            $sql .= " AND fk_categoria_aura_id = :categoria";
            $params[':categoria'] = $categoriaId;
        }
        if ($pontuacaoMin !== '') {
            $sql .= " AND pontuacao_atual >= :min";
            $params[':min'] = $pontuacaoMin;
        }
        if ($pontuacaoMax !== '') {
            $sql .= " AND pontuacao_atual <= :max";
            $params[':max'] = $pontuacaoMax;
        }

        $sql .= " ORDER BY pontuacao_atual DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function buscarUsuarioPorId($id) {
    $pdo = conectar();
    try {
        $sql = "SELECT * FROM usuario WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

function modificarAura($id, $valor) {
    $pdo = conectar();
    try {
        $sql = "UPDATE usuario SET pontuacao_atual = pontuacao_atual + :valor WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function buscarCategoriaIdPorPontuacao($pontuacao) {
    $pdo = conectar();
    try {
        $sql = "SELECT id FROM categoria_aura 
                WHERE :pontuacao BETWEEN pontuacao_minima AND pontuacao_maxima 
                LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':pontuacao', $pontuacao);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado['id'] : null;
    } catch (PDOException $e) {
        return null;
    }
}

function calcularStatusAura($pontuacao) {
    $pdo = conectar();
    try {
        $sql = "SELECT nome FROM categoria_aura 
                WHERE :pontuacao BETWEEN pontuacao_minima AND pontuacao_maxima 
                LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':pontuacao', $pontuacao);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado ? $resultado['nome'] : "Sem categoria";
    } catch (PDOException $e) {
        return "Sem categoria";
    }
}

function inserirCategoriaAura($nome, $pontuacaoMinima, $pontuacaoMaxima) {
    $pdo = conectar();
    try {
        $sql = "INSERT INTO categoria_aura (nome, pontuacao_minima, pontuacao_maxima) 
                VALUES (:nome, :min, :max)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':min', $pontuacaoMinima);
        $stmt->bindParam(':max', $pontuacaoMaxima);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function listarCategoriasAura() {
    $pdo = conectar();
    try {
        $sql = "SELECT * FROM categoria_aura ORDER BY pontuacao_minima ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function buscarCategoriaAuraPorId($id) {
    $pdo = conectar();
    try {
        $sql = "SELECT * FROM categoria_aura WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

function editarCategoriaAura($id, $nome, $pontuacaoMinima, $pontuacaoMaxima) {
    $pdo = conectar();
    try {
        $sql = "UPDATE categoria_aura SET nome = :nome, pontuacao_minima = :min, 
                pontuacao_maxima = :max WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':min', $pontuacaoMinima);
        $stmt->bindParam(':max', $pontuacaoMaxima);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function deletarCategoriaAura($id) {
    $pdo = conectar();
    try {
        $sql = "DELETE FROM categoria_aura WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function inserirHistoricoPontuacao($usuarioId, $motivo, $pontos) {
    $pdo = conectar();
    try {
        $sql = "INSERT INTO historico_pontuacao (motivo, data_registro, pontos, fk_usuario_id) 
                VALUES (:motivo, NOW(), :pontos, :usuario)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':motivo', $motivo);
        $stmt->bindParam(':pontos', $pontos);
        $stmt->bindParam(':usuario', $usuarioId);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}

function listarHistoricoPorUsuario($usuarioId) {
    $pdo = conectar();
    try {
        $sql = "SELECT * FROM historico_pontuacao WHERE fk_usuario_id = :usuario ORDER BY data_registro DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $usuarioId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function listarConquistas() {
    $pdo = conectar();
    try {
        $sql = "SELECT * FROM conquista ORDER BY nome ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}

function vincularConquistaUsuario($usuarioId, $conquistaId) {
    $pdo = conectar();
    try {
        $sql = "INSERT INTO usuario_conquista (fk_usuario_id, fk_conquista_id) VALUES (:usuario, :conquista)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':usuario', $usuarioId);
        $stmt->bindParam(':conquista', $conquistaId);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}
?>