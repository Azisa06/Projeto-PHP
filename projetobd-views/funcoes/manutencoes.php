<?php

    declare(strict_types=1);

    require_once '../config/bancodedados.php';

    function gerarDadosGraficos(): array{
        global $pdo;
        $stmt = $pdo->query("SELECT s.id, s.nome, SUM(s.preco) as Total FROM servico s "); // INNER JOIN equipamento e ON e.id = s.equipamento_id GROUP BY e.id
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    function buscarManutencoes(): array{
        global $pdo;
        $stmt = $pdo->query("SELECT m. *, m.nome as nome_categoria FROM manutencao m");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarManutencaoPorId(int $id): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT m. *, m.nome as nome_categoria FROM manutencao m WHERE m.id = ?");
        $stmt->execute([$id]);
        $manutencao = $stmt->fetch(PDO::FETCH_ASSOC);
        return $manutencao ? $manutencao : null;
    }

    function cadastrarManutencao(string $nome, int $tecnico_id, int $servico_id, int $equipamento_id, string $data_criacao, string $data_fim): bool{
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO servico (nome, descricao, preco, data_criacao) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $tecnico_id, $servico_id, $equipamento_id, $data_criacao, $data_fim]);
    }

    function alterarManutencao(string $nome, string $descricao, float $preco, string $data_criacao, int $id): bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE servico SET nome = ?, descricao = ?, preco = ?, data_criacao = ? WHERE id = ?");
        return $stmt->execute([$nome, $descricao, $preco, $data_criacao, $id]);
    }

    function excluirManutencao(int $id): bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM servico WHERE id = ?");
        return $stmt->execute([$id]);
    }
?>