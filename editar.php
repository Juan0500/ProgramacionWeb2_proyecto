<?php
require_once("funcoes.php");

$id = $_GET['id'];
$pdo = conectar();
$stmt = $pdo->prepare("SELECT * FROM usuario WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="processa.php" method="POST">
        <input type="hidden" name="atualizar" value="1">
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required><br><br>
        <label>Idade:</label>
        <input type="number" name="idade" value="<?php echo $usuario['idade']; ?>" required><br><br>
        <label>Pontuacao:</label>
        <input type="number" step="0.01" name="pontuacao" value="<?php echo $usuario['pontuacao']; ?>" required><br><br>
        <input type="submit" value="Salvar">
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>