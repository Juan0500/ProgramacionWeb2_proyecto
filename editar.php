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
    <title>Aura Rank</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .container {
            width: 400px;
            margin: 80px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        input, button {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        .cancelar {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
        
        h1 {
            text-align: center;
            font-size: 3.5em;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Aura Rank</h1>
        <h2>Editar Usuario</h2>

        <form action="processa.php" method="POST">
            <input type="hidden" name="atualizar" value="1">
         
            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
           
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required><br><br>
            
            <label>Idade:</label>
            <input type="number" name="idade" value="<?php echo $usuario['idade']; ?>" required><br><br>
            
            <label>Pontuação:</label>
            <input type="number" step="0.01" name="pontuacao" value="<?php echo $usuario['pontuacao']; ?>" required><br><br>
            
            <input type="submit" value="Salvar">
            
            <a href="index.php">Cancelar</a>
        </form>
    </div>
</body>
</html>