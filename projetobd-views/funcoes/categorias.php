<?php
    declare(strict_types=1);

    require_once "../config/bancodedados.php";

    function buscarCategorias(): array {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM categoria");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function todasCategorias(): array{
        global $pdo;
        $statement = $pdo->query(" SELECT id, nome FROM categoria");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function criarCategorias(string $nome): bool{
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO categoria (nome) VALUES (?)");
        return $stmt->execute([$nome]);
    }

    function buscarCategoriaPorId(int $id): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT c. *, c.nome as nome_categoria FROM categoria c WHERE c.id = ?");
        $stmt->execute([$id]);
        $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
        return $categoria ? $categoria : null;
    }

    function alterarCategoria(string $nome, int $id): bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE categoria SET nome = ? WHERE id = ?");
        return $stmt->execute([$nome, $id]);
    }

    function excluirCategoria(int $id): bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM categoria WHERE id = ?");
        return $stmt->execute([$id]);
    }
?>