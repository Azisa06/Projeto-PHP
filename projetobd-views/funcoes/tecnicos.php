<?php
    declare(strict_types = 1);

    require_once('../config/bancodedados.php');

    /*function login(string $email, string $senha){
        global $pdo;

        //Inserção do usuário adm
        $statement = $pdo->query("SELECT * FROM tecnico WHERE email = 'adm@adm.com'"); //query faz cosulta sem passagem de parâmetros
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
    }*/
    
    function novoTecnico(string $nome, string $email, string $senha):bool{
        global $pdo;
        $senha_criptografada = password_hash($senha, PASSWORD_BCRYPT);
        $statement = $pdo->prepare("INSERT INTO tecnico (nome, email, senha) VALUES (?, ?, ?)");
        return $statement->execute([$nome, $email, $senha_criptografada]);
    }
    
    function excluirTecnico(int $id):bool{
        global $pdo;
        $statement = $pdo->prepare("DELETE FROM tecnico WHERE id = ?");
        return $statement->execute([$id]);
    }

    function todosTecnicos(): array{
        global $pdo;
        $statement = $pdo->query(" SELECT id, nome, email FROM tecnico"); // tentar dar um GROUP BY habilidade
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function retornaTecnicoPorId(int $id): ?array{
        global $pdo;
        $statement = $pdo->prepare("SELECT * FROM tecnico WHERE id = ?");
        $statement->execute([$id]);
        $tecnico = $statement->fetch(PDO::FETCH_ASSOC);
        return $tecnico ? $tecnico : null;
    }

    function buscarTecnicoPorId(int $id): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT t. *, t.nome as nome_tecnico FROM tecnico t WHERE t.id = ?");
        $stmt->execute([$id]);
        $tecnico = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tecnico ? $tecnico : null;
    }

    function alterarServico(string $nome, string $email, string $senha, int $id): bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE servico SET nome = ?, email = ?, senha = ? WHERE id = ?");
        return $stmt->execute([$nome, $email, $senha, $id]);
    }
?>