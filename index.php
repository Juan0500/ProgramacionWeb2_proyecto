<?php
require_once("funcoes.php");

$usuarios = listarUsuarios();

$mensagem = '';
if (isset($_GET['salvar'])) {
    if ($_GET['salvar'] == 'OK') {
        $mensagem = '<p style="color:green;">Operacao realizada com sucesso.</p>';
    } else {
        $mensagem = '<p style="color:red;">Erro na operacao.</p>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <?php echo $mensagem; ?>
    <p><a href="cadastro.php">Cadastrar novo usuario</a></p>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
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
                        <td><?php echo $usuario['idade']; ?></td>
                        <td><?php echo $usuario['pontuacao']; ?></td>
                        <td><?php echo calcularStatusAura($usuario['pontuacao']); ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a> /
                            <a href="processa.php?deletar=1&id=<?php echo $usuario['id']; ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>