<?php
include "template/header.php";
session_start();
include 'db.php'; // Arquivo que faz a conexão com o banco de dados

$admin_email = 'admin@feira.com';
$admin_senha = 'senhaadm';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($email === $admin_email && $senha === $admin_senha) {
        $_SESSION['produtor_id'] = 'admin';
        $_SESSION['is_master'] = true;
        header("Location: admin.php");
        exit();
    }

    $query = "SELECT * FROM produtores WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $produtor = mysqli_fetch_assoc($result);

    if ($produtor && password_verify($senha, $produtor['senha'])) {
        $_SESSION['produtor_id'] = $produtor['id'];
        $_SESSION['is_master'] = $produtor['is_master']; 
        if ($produtor['is_master']) {
            header("Location: admin.php");
        } else {
            header("Location: editar.php");
        }
        exit();
    } else {
        $erro = "E-mail ou senha incorretos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Feira dos Produtores Rurais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Entrar</button>
        </form>
    </div>
</body>
</html>

