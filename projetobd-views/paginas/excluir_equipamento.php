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
    if (!$equipamento) { //se o usuário n informar o equipamentos, ele será redirecionado à página de equipamentos
        header('Location: equipamentos.php');
        exit();
    }

    $categorias = buscarCategorias(); //retorna todas as categorias do bd

    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try{
            $id = intval($_POST['id']);
            if (empty($id)) {
                header('Location: equipamentos.php');
                exit();
            } else{
                if (excluirEquipamento($id)) {
                    header('Location: equipamentos.php');
                    exit();
                } else{
                    $erro = "Erro ao excluir o equipamento!";
                }
            }
        }catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Excluir Equipamento</h2>
    
    <p>Tem certeza de que deseja excluir o equipamento abaixo?</p>
    <ul>
        <li><strong>Nome:</strong> <?=$equipamento['nome']?> </li>
        <li><strong>Descrição:</strong> <?=$equipamento['descricao']?> </li>
        <li><strong>Categoria:</strong> <?=$equipamento['nome_categoria']?> </li>
    </ul>
    <form method="post">
        <input type="hidden" name="id" value="<?=$id?>">
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="equipamentos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
