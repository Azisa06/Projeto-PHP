<?php
    declare(strict_types = 1);

    require_once('../config/bancodedados.php');
    
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

    function buscarTecnicoPorId(int $id): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT t. *, t.nome as nome_tecnico FROM tecnico t WHERE t.id = ?");
        $stmt->execute([$id]);
        $tecnico = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tecnico ? $tecnico : null;
    }

    function alterarTecnico(string $nome, string $email, string $senha, int $id): bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE tecnico SET nome = ?, email = ?, senha = ? WHERE id = ?");
        return $stmt->execute([$nome, $email, $senha, $id]);
    }
?>