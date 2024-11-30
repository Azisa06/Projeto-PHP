<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/categorias.php';   
?>

<div class="container mt-5">
    <h2>Gerenciamento de Categorias</h2> <!--arrumar para ficar parecido com o categorias_hab-->
    <a href="nova_categoria.php" class="btn btn-success mb-3">Nova Categoria</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $categorias = todasCategorias(); 
                foreach ($categorias as $c):?>
                <tr>
                    <td><?= $c['id']?></td>
                    <td><?= $c['nome']?></td>
                    <td>
                        <a href="editar_categoria.php?id=<?= $c['id']?>" class="btn btn-warning">Editar</a>
                        <a href="excluir_categoria.php?id=<?= $c['id']?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'rodape.php'; ?>
