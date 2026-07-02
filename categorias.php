<?php
require_once("funcoes.php");

$categorias = listarCategoriasAura();

$mensagem = '';
if (isset($_GET['salvar'])) {
    if ($_GET['salvar'] === 'OK') {
        $mensagem = '<p style="color:green;">Operacao realizada com sucesso.</p>';
    } else {
        $mensagem = '<p style="color:red;">Erro na operacao.</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Aura Rank</title>
    <link rel="icon" href="./images/goku.png" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .container {
            width: 90%;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn-cadastro {
            display: inline-block;
            margin-bottom: 15px;
            background: #007bff;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
        }
        .btn-cadastro:hover {
            background: #0056b3;
            text-decoration: none;
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

        <h2>Categorias de Aura</h2>

        <?php echo $mensagem; ?>

        <p>
            <a href="cadastro_categoria.php" class="btn-cadastro">Cadastrar nova categoria</a>
            &nbsp;|&nbsp;
            <a href="index.php">Voltar para usuarios</a>
        </p>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Pontuacao Minima</th>
                    <th>Pontuacao Maxima</th>
                    <th>Acoes</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categorias)): ?>
                    <tr>
                        <td colspan="5">Nenhuma categoria encontrada.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($categorias as $categoria): ?>
                        <tr>
                            <td><?php echo $categoria['id']; ?></td>
                            <td><?php echo htmlspecialchars($categoria['nome']); ?></td>
                            <td><?php echo $categoria['pontuacao_minima']; ?></td>
                            <td><?php echo $categoria['pontuacao_maxima']; ?></td>
                            <td>
                                <a href="editar_categoria.php?id=<?php echo $categoria['id']; ?>">Editar</a> /
                                <a href="processa.php?deletar_categoria=1&id=<?php echo $categoria['id']; ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>