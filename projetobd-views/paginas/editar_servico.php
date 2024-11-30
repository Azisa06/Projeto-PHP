<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/servicos.php';

    $id = $_GET['id'];
    if (!$id) { //se o usuário n informar o id, ele será redirecionado à página de serviços
        header('Location: servicos.php');
        exit();
    }

    $produto = buscarServicoPorId($id);
    if (!$produto) { //se o usuário n informar o serviço, ele será redirecionado à página de equipamentos
        header('Location: servicos.php');
        exit();
    }

    $erro = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $preco = floatval($_POST['preco']);
            $data = ($_POST['data']);
            if(empty($nome) || empty($preco) || empty($data)){
                $erro = "Preencha os campos obrigatórios!";
            } else{
                if (alterarServico($nome, $descricao, $preco, $data, $id)){
                    header('Location: servicos.php');
                    exit();
                } else{
                    $erro = "Erro ao alterar o serviço!";
                }
            }
        }catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Editar Serviço</h2>

    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif;?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="preco" name="preco" id="preco" class="form-control" step = "0.1" required>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" name="data" id="data" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Serviço</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>