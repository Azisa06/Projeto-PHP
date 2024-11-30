<?php
    declare(strict_types = 1);

    require_once('../config/bancodedados.php');

    function login(string $email, string $senha){
        global $pdo;

        //Inserção do usuário adm
        $statement = $pdo->query("SELECT * FROM usuario WHERE email = 'adm@adm.com'"); //query faz cosulta sem passagem de parâmetros
        $usuario = $statement->fetchALL(PDO::FETCH_ASSOC); //quando usar query, usar fetchALL
        //verifica se o usuário existe, se não existir, vamos criar
        if(!$usuario){
            novoUsuario('Administrador', 'adm@adm.com', 'adm', 'adm');
        }

        //verificar email e senha do usuário
        $statement = $pdo->prepare("SELECT * FROM usuario WHERE email = ?");
        //validar os valores com EXPRESSÕES REGULARES - validar se é um email
        $statement->execute([$email]);
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);
        if($usuario && password_verify($senha, $usuario['senha'])){
            return $usuario;
        } else{
            return null;
        }
    }
    
    function novoUsuario(string $nome, string $email, string $senha, string $nivel):bool{
        global $pdo;
        $senha_criptografada = password_hash($senha, PASSWORD_BCRYPT);
        $statement = $pdo->prepare("INSERT INTO usuario (nome, email, senha, nivel) VALUES (?, ?, ?, ?)");
        return $statement->execute([$nome, $email, $senha_criptografada, $nivel]);
    }
    
    function excluirUsuario(int $id):bool{
        global $pdo;
        $statement = $pdo->prepare("DELETE FROM usuario WHERE id = ?");
        return $statement->execute([$id]);
    }
    
    function todosUsuarios(): array{
        global $pdo;
        $statement = $pdo->query(" SELECT * FROM usuario WHERE nivel <> 'adm' ");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function retornaUsuarioPorId(int $id): ?array{
        global $pdo;
        $statement = $pdo->prepare("SELECT * FROM usuario WHERE id = ? AND nivel <> 'adm'");
        $statement->execute([$id]);
        $usuario = $statement->fetch(PDO::FETCH_ASSOC);
        return $usuario ? $usuario : null;
    }
?>