<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/servicos.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $preco = floatval($_POST['preco']);
            $data = ($_POST['data']);
            if(empty($nome) || empty($preco) || empty($data)){
                $erro = "Informe os valores obrigatórios!";
            } else{
                if (cadastrarServico($nome, $descricao, $preco, $data)){
                    header('Location: servicos.php');
                    exit();
                } else{
                    $erro = 'Erro ao cadastrar serviço!';
                }
            }
        }catch (Exception $e){
            $erro = "Erro: " .$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Cadastrar Serviço</h2>
    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif;?>

<div class="container mt-5">
    <h2>Criar Novo Serviço</h2>

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
        <button type="submit" class="btn btn-primary">Criar Serviço</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
