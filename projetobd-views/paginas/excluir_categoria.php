<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/categorias.php';

    $id = $_GET['id'];
    if (!$id) { //se o usuário n informar o id, ele será redirecionado à página de serviços
        header('Location: categorias.php');
        exit();
    }

    $categoria = buscarCategoriaPorId($id);
    if (!$categoria) { //se o usuário n informar o serviço, ele será redirecionado à página de serviços
        header('Location: categorias.php');
        exit();
    }

    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try{
            $id = intval($_POST['id']);
            if (empty($id)) {
                header('Location: categorias.php');
                exit();
            } else{
                if (excluirCategoria($id)) {
                    header('Location: categorias.php');
                    exit();
                } else{
                    $erro = "Erro ao excluir o serviço!";
                }
            }
        }catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Excluir Categoria</h2>
    
    <p>Tem certeza de que deseja excluir a categoria abaixo?</p>
    <ul>
        <li><strong>Nome:</strong> <?=$categoria['nome']?> </li>
    </ul>
    <form method="post">
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="categorias.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
