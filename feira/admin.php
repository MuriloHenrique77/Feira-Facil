<?php
session_start();
if (!isset($_SESSION['produtor_id']) || !$_SESSION['is_master']) {
    header("Location: login.php");
    exit();
}
include 'db.php';

// Busca todos os produtores
$query = "SELECT * FROM produtores";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Feira de Produtores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "template/header.php"; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Administração</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="editar_produtor.php">
                    <div class="mb-3">
                        <label for="produtor" class="form-label">Selecione o Produtor</label>
                        <select class="form-select" id="produtor" name="produtor_id" required>
                            <?php while($produtor = mysqli_fetch_assoc($result)): ?>
                                <option value="<?php echo $produtor['id']; ?>"><?php echo $produtor['nome']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Editar Produtor</button>
                </form>
            </div>
        </div>
    </div>
    <?php include "template/footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
