<?php
require_once("funcoes.php");

$filtroNome = isset($_GET['nome']) ? $_GET['nome'] : '';
$filtroCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$filtroMin = isset($_GET['pontuacao_min']) ? $_GET['pontuacao_min'] : '';
$filtroMax = isset($_GET['pontuacao_max']) ? $_GET['pontuacao_max'] : '';

if ($filtroNome !== '' || $filtroCategoria !== '' || $filtroMin !== '' || $filtroMax !== '') {
    $usuarios = listarUsuariosFiltro($filtroNome, $filtroCategoria, $filtroMin, $filtroMax);
} else {
    $usuarios = listarUsuarios();
}

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
            font-size: 5.5em;
            color: #007bff;
        }

        .titulo-com-imagem {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .titulo-com-imagem img {
            height: 140px;
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

        <h2>Lista de Usuarios</h2>

        <?php echo $mensagem; ?>
        <p>
            <a href="cadastro.php">Cadastrar novo usuário</a>
            &nbsp;|&nbsp;
            <a href="categorias.php">Gerenciar categorias de aura</a>
        </p>

        <form action="index.php" method="GET" style="margin-bottom:15px;">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($filtroNome); ?>">

            <label>Categoria:</label>
            <select name="categoria">
                <option value="">Todas</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['id']; ?>" <?php echo ($filtroCategoria == $categoria['id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($categoria['nome']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Pontuação mínima:</label>
            <input type="number" name="pontuacao_min" value="<?php echo htmlspecialchars($filtroMin); ?>">

            <label>Pontuação máxima:</label>
            <input type="number" name="pontuacao_max" value="<?php echo htmlspecialchars($filtroMax); ?>">

            <button type="submit">Filtrar</button>
            <a href="index.php">Limpar filtros</a>
        </form>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Pontuacao</th>
                    <th>Status Aura</th>
                    <th>Acoes</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($usuarios)): ?>
                    <tr>
                        <td colspan="6">Nenhum usuario encontrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo $usuario['pontuacao_atual']; ?></td>
                            <td><?php echo calcularStatusAura($usuario['pontuacao_atual']); ?></td>
                            <td>
                                <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a> /
                                <a href="processa.php?deletar=1&id=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>