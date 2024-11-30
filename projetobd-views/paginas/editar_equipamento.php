<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/equipamentos.php';
    require_once '../funcoes/categorias.php';

    $id = $_GET['id'];
    if (!$id) { //se o usuário n informar o id, ele será redirecionado à página de equipamentos
        header('Location: equipamentos.php');
        exit();
    }

    $equipamento = buscarEquipamentoPorId($id);
    if (!$equipamento) { //se o usuário n informar o produto, ele será redirecionado à página de equipamentos
        header('Location: equipamentos.php');
        exit();
    }

    $categorias = buscarCategorias(); //retorna todas as categorias do bd

    $erro = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $categoria_id = intval($_POST['categoria_id']);
            $id = intval($_POST['id']);
            if (empty($nome)) {
                $erro = "Preencha os campos obrigatórios!";
            } else{
                if (alterarEquipamento($id, $nome, $descricao, $categoria_id)){
                    header('Location: equipamentos.php');
                    exit();
                } else{
                    $erro = "Erro ao alterar o equipamento!";
                }
            }
        }catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Editar Equipamento</h2>

    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif;?>

    <form method="post">
        <input type="hidden" name="id" value="<?=$id?>"/> <!-- armazeno aqui o id do equipamento-->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" value="<?= $equipamento['nome']?>" id="nome" class="form-control" value="" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" required>
                <?= $equipamento['descricao']?> 
            </textarea>
        </div>
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                <?php foreach ($categorias as $c):?>  
                    <option value="<?= $c['id']?>"
                    <?= $c['id'] == $equipamento['categoria_id'] ? 'selected' : ''?>> <!-- se o id da categoria que estou exibindo é igual ao do equipamento, vou exibir selected, senão n exibe nada -->
                        <?= $c['nome']?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Equipamento</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
