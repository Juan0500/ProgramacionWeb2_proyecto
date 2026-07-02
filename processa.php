<?php
require_once("funcoes.php");

if ($_POST) {
    //Inserir Novo Usuario
    if (isset($_POST['inserir'])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $pontuacao = $_POST["pontuacao"];
        $categoriaId = buscarCategoriaIdPorPontuacao($pontuacao);

        $resultado = inserirUsuario($nome, $email, $senha, $pontuacao, $categoriaId);

        if ($resultado) {
            $novoId = conectar()->query("SELECT MAX(id) FROM usuario")->fetchColumn();
            inserirHistoricoPontuacao($novoId, "Cadastro inicial", $pontuacao);
            header("location: index.php?salvar=OK");
        } else {
            header("location: index.php?salvar=ERROR");
        }
    }

    //Atualizar um Usuario
    if (isset($_POST['atualizar'])) {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $pontuacao = $_POST["pontuacao"];
        $categoriaId = buscarCategoriaIdPorPontuacao($pontuacao);

        $usuario = buscarUsuarioPorId($id);
        if ($usuario && $usuario['senha'] === $senha) {
            $resultado = editarUsuario($id, $nome, $email, $usuario['senha'], $pontuacao, $categoriaId);
        } else {
            $resultado = false;
        }

        if ($resultado) {
            header("location: index.php?salvar=OK");
        } else {
            header("location: index.php?salvar=ERROR");
        }
    }

    // Inserir Nova Categoria de Aura 
    if (isset($_POST['inserir_categoria'])) {
        $nome = $_POST["nome"];
        $pontuacaoMinima = $_POST["pontuacao_minima"];
        $pontuacaoMaxima = $_POST["pontuacao_maxima"];

        $resultado = inserirCategoriaAura($nome, $pontuacaoMinima, $pontuacaoMaxima);

        if ($resultado) {
            header("location: categorias.php?salvar=OK");
        } else {
            header("location: categorias.php?salvar=ERROR");
        }
    }

    // Atualizar Categoria de Aura
    if (isset($_POST['atualizar_categoria'])) {
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $pontuacaoMinima = $_POST["pontuacao_minima"];
        $pontuacaoMaxima = $_POST["pontuacao_maxima"];

        $resultado = editarCategoriaAura($id, $nome, $pontuacaoMinima, $pontuacaoMaxima);

        if ($resultado) {
            header("location: categorias.php?salvar=OK");
        } else {
            header("location: categorias.php?salvar=ERROR");
        }
    }
} else if ($_GET) {

    //Deletar um Usuario
    if (isset($_GET["deletar"])) {
        $id = $_GET["id"]; //para Marcos: assim deve se chamar o parámetro na URL para receber o ID.

        $resultado =  deletarUsuario($id); //para William: asim deveria se chamar a função de deletar um usuario

        if ($resultado) {
            header("location: index.php?salvar=OK");
        } else {
            header("location: index.php?salvar=ERROR");
        }
    }

    // Deletar uma Categoria de Aura 
    if (isset($_GET["deletar_categoria"])) {
        $id = $_GET["id"];

        $resultado = deletarCategoriaAura($id);

        if ($resultado) {
            header("location: categorias.php?salvar=OK");
        } else {
            header("location: categorias.php?salvar=ERROR");
        }
    }
} else {
    header("location: index.php");
}