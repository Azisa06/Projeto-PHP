<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/tecnicos.php';
?>

<div class="container mt-5">
    <h2>Gerenciamento de Técnicos</h2>
    <a href="novo_tecnico.php" class="btn btn-success mb-3">Novo Técnico</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>

        <?php
            $tecnicos = todosTecnicos(); 
            foreach ($tecnicos as $t):?>
            <tr>
                <td><?= $t['id']?></td>
                <td><?= $t['nome']?></td>
                <td><?= $t['email']?></td>
                <td>
                    <a href="editar_tecnico.php?id=<?= $t['id']?>" class="btn btn-warning">Editar</a>
                    <a href="excluir_tecnico.php?id=<?= $t['id']?>" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>