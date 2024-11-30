<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';  
    require_once '../funcoes/equipamentos.php';
    
    $equipamentos = buscarEquipamentos(); //faz um array com todos os equipamentos do banco de dados
?>

<div class="container mt-5">
    <h2>Gerenciamento de Equipamentos</h2>
    <a href="novo_equipamento.php" class="btn btn-success mb-3">Novo Equipamento</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipamentos as $e): ?>
            <tr>
                <td><?= $e['id']?></td>
                <td><?= $e['nome']?></td>
                <td><?= $e['descricao']?></td>
                <td><?= $e['nome_categoria']?></td>
                <td>
                    <a href="editar_equipamento.php?id=<?= $e['id']?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_equipamento.php?id=<?= $e['id']?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
