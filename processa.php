<?php
// Emanuel
require("funcoes.php");

if ($_POST) {
    //Inserir Novo Usuario
    if (isset($_POST['inserir'])) { //para Bruno: assim deve se chamar o input type "hidden" para identificar a ação
        $nome = $_POST["nome"]; //para Bruno: assim deve se chamar(name) o input nome
        $idade = $_POST["idade"]; //para Bruno: assim deve se chamar(name) o input idade
        $pontuacao = $_POST["pontuacao"]; //para Bruno: assim deve se chamar(name) o input pontuacao

        $resultado = inserirUsuario($nome, $idade, $pontuacao); //para William: asim deveria se chamar a função de criar um usuario

        if ($resultado) {
            header("location: index.php?salvar=OK");
        } else {
            header("location: index.php?salvar=ERROR");
        }
    }

    //Atualizar um Usuario
    if (isset($_POST['atualizar'])) { //para Marcos: assim deve se chamar o input type "hidden" para identificar a ação
        $id = $_POST["id"]; //para Marcos: assim deve se chamar o input type "hidden" para receber o ID.
        $nome = $_POST["nome"]; //para Bruno: assim deve se chamar(name) o input nome
        $idade = $_POST["idade"]; //para Bruno: assim deve se chamar(name) o input idade
        $pontuacao = $_POST["pontuacao"]; //para Bruno: assim deve se chamar(name) o input pontuacao

        $resultado =  editarUsuario($id, $nome, $idade, $pontuacao); //para William: asim deveria se chamar a função de editar um usuario

        if ($resultado) {
            header("location: index.php?salvar=OK");
        } else {
            header("location: index.php?salvar=ERROR");
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
} else {
    header("location: index.html");
}
