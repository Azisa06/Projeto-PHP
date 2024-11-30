<?php
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';   
    require_once '../funcoes/servicos.php';

    $servicos = buscarServicos(); //faz um array com todos os equipamentos do banco de dados
?>

<div class="container mt-5">
    <h2>Gerenciamento de Serviços</h2>
    <a href="novo_servico.php" class="btn btn-success mb-3">Novo Serviço</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Data de Início</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicos as $s): ?>
            <tr>
                <td><?= $s['id']?></td>
                <td><?= $s['nome']?></td>
                <td><?= $s['descricao']?></td>
                <td><?= $s['preco']?></td>
                <td><?= $s['data_criacao']?></td>
                <td>
                    <a href="editar_servico.php?id=<?= $s['id']?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_servico.php?id=<?= $s['id']?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
