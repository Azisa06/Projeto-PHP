<?php

    declare(strict_types=1);

    require_once '../config/bancodedados.php';

    function buscarEquipamentos(): array{
        global $pdo;
        $stmt = $pdo->query("SELECT e. *, c.nome as nome_categoria FROM equipamento e INNER JOIN categoria c ON c.id = e.categoria_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarEquipamentoPorId(int $id): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT e. *, c.nome as nome_categoria FROM equipamento e INNER JOIN categoria c ON c.id = e.categoria_id WHERE e.id = ?");
        $stmt->execute([$id]);
        $equipamento = $stmt->fetch(PDO::FETCH_ASSOC);
        return $equipamento ? $equipamento : null;
    }

    function cadastrarEquipamento(string $nome, string $descricao, int $categoria_id): bool{
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO equipamento (nome, descricao, categoria_id) VALUES (?, ?, ?)");
        return $stmt->execute([$nome, $descricao, $categoria_id]);
    }

    function alterarEquipamento(int $id, string $nome, string $descricao, int $categoria_id): bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE equipamento SET nome = ?, descricao = ?, categoria_id = ? WHERE id = ?");
        return $stmt->execute([$nome, $descricao, $categoria_id, $id]);
    }

    function excluirEquipamento(int $id): bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM equipamento WHERE id = ?");
        return $stmt->execute([$id]);
    }
?>