<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/servicos.php';

    $id = $_GET['id'];
    if (!$id) { //se o usuário n informar o id, ele será redirecionado à página de serviços
        header('Location: servicos.php');
        exit();
    }

    $servico = buscarServicoPorId($id);
    if (!$servico) { //se o usuário n informar o serviço, ele será redirecionado à página de serviços
        header('Location: servicos.php');
        exit();
    }

    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try{
            $id = intval($_POST['id']);
            if (empty($id)) {
                header('Location: servicos.php');
                exit();
            } else{
                if (excluirServico($id)) {
                    header('Location: servicos.php');
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
    <h2>Excluir Serviço</h2>
    
    <p>Tem certeza de que deseja excluir o serviço abaixo?</p>
    <ul>
        <li><strong>Nome:</strong> <?=$servico['nome']?> </li>
        <li><strong>Descrição:</strong> <?=$servico['descricao']?> </li>
        <li><strong>Preço:</strong> <?=$servico['descricao']?> </li>
        <li><strong>Data:</strong> <?=$servico['data_criacao']?> </li>
    </ul>
    <form method="post">
        <input type="hidden" name="id" value="<?=$id?>">
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="servicos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>