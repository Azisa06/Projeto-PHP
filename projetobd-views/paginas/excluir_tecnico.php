<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/tecnicos.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $id = intval($_POST['id']);
            if (excluirTecnico($id)){ //dar uma olhada nesta função
                header('Location: tecnicos.php');
                exit();
            } else {
                $erro = "Erro ao excluir o técnico!";
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    } else {
        if (isset($_GET['id'])){
            $id = intval($_GET['id']);
            $tecnico = retornaTecnicoPorId($id); //dar uma olhada nesta função
            if ($tecnico == null){
                header('Location: tecnicos.php');
                exit();
            }
        } else {
            header('Location: tecnicos.php');
            exit();
        }
    }
?>

<div class="container mt-5">
    <h2>Excluir Técnico</h2>

    <p>Tem certeza de que deseja excluir o técnico abaixo?</p>

    <ul>
        <li><strong>Nome: <?= $tecnico['nome'] ?></strong> </li>
        <li><strong>Email: <?= $tecnico['email'] ?></strong> </li>
    </ul>

    <form method="post">
        <input type="hidden" name="id" value="<?= $tecnico['id'] ?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="tecnicos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
