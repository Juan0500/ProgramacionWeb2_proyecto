<?php
require_once("funcoes.php");

$id = $_GET['id'] ?? null;
if (!$id) {
    header("location: categorias.php");
    exit;
}
$categoria = buscarCategoriaAuraPorId($id);

if (!$categoria) {
    header("location: categorias.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Aura Rank</title>
    <link rel="icon" href="./images/goku.png" />

    <style>
        * {
            box-sizing: border-box;
        }

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

        .titulo-com-imagem {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .titulo-com-imagem img {
            height: 80px;
            width: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titulo-com-imagem">
            <img src="./images/goku.png" alt="Goku">
            Aura Rank
            <img src="./images/goku.gif" alt="Goku">
        </h1>

        <h2>Editar Categoria de Aura</h2>

        <form action="processa.php" method="POST">
            <input type="hidden" name="atualizar_categoria" value="1">

            <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($categoria['nome']); ?>" required>

            <label>Pontuacao Minima:</label>
            <input type="number" name="pontuacao_minima" value="<?php echo $categoria['pontuacao_minima']; ?>" required>

            <label>Pontuacao Maxima:</label>
            <input type="number" name="pontuacao_maxima" value="<?php echo $categoria['pontuacao_maxima']; ?>" required>

            <input type="submit" value="Salvar">

            <a href="categorias.php" class="cancelar">Cancelar</a>
        </form>
    </div>
</body>
</html>