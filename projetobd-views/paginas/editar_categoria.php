
<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/categorias.php';

    $id = $_GET['id'];
    if (!$id) { //se o usuário n informar o id, ele será redirecionado à página de categorias
        header('Location: categorias.php');
        exit();
    }

    $categoria = buscarCategoriaPorId($id);
    if (!$categoria) { //se o usuário n informar a categoria, ele será redirecionado à página de categorias
        header('Location: categorias.php');
        exit();
    }

    $erro = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $nome = $_POST['nome'];
            if (empty($nome)) {
                $erro = "Preencha os campos obrigatórios!";
            } else{
                if (alterarCategoria($nome, $id)){
                    header('Location: categorias.php');
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
    <h2>Editar Categoria</h2>

    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif;?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Categoria</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
