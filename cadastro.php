<?php
// cadastro.php - Bruno
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .container {
            width: 300px;
            margin: 80px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
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
    </style>
</head>

<body>

<div class="container">
    <h2>Cadastro de Usuário</h2>

    <form action="processa.php" method="POST">

        <input type="hidden" name="inserir" value="1">

        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Idade:</label>
        <input type="number" name="idade" required>

        <label>Pontuação:</label>
        <input type="number" name="pontuacao" required>

        <button type="submit">Cadastrar</button>

    </form>
</div>

</body>
</html>