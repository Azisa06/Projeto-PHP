<?php

    declare(strict_types=1);

    require_once '../config/bancodedados.php';

    function gerarDadosGraficos(): array{
        global $pdo;
        $stmt = $pdo->query("SELECT s.id, s.nome, SUM(s.preco) as Total FROM servico s "); // INNER JOIN equipamento e ON e.id = s.equipamento_id GROUP BY e.id
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    function buscarServicos(): array{
        global $pdo;
        $stmt = $pdo->query("SELECT s. *, s.nome as nome_categoria FROM servico s");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarservicoPorId(int $id): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT s. *, s.nome as nome_categoria FROM servico s WHERE s.id = ?");
        $stmt->execute([$id]);
        $servico = $stmt->fetch(PDO::FETCH_ASSOC);
        return $servico ? $servico : null;
    }

    function cadastrarServico(string $nome, string $descricao, float $preco, string $data_criacao): bool{
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO servico (nome, descricao, preco, data_criacao) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nome, $descricao, $preco, $data_criacao]);
    }

    function alterarServico(string $nome, string $descricao, float $preco, string $data_criacao, int $id): bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE servico SET nome = ?, descricao = ?, preco = ?, data_criacao = ? WHERE id = ?");
        return $stmt->execute([$nome, $descricao, $preco, $data_criacao, $id]);
    }

    function excluirServico(int $id): bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM servico WHERE id = ?");
        return $stmt->execute([$id]);
    }
?>