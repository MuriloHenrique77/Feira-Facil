<?php
session_start();
include 'db.php'; // Arquivo que faz a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha
    $descricao = $_POST['descricao'];
    $imagem = '';

    // Upload da imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem_nome = basename($_FILES['imagem']['name']);
        $imagem_destino = "uploads/" . $imagem_nome;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_destino)) {
            $imagem = $imagem_destino;
        } else {
            $erro = "Desculpe, houve um erro ao enviar sua imagem.";
        }
    }

    if (!isset($erro)) {
        $query = "INSERT INTO produtores (nome, email, senha, descricao, imagem) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $nome, $email, $senha, $descricao, $imagem);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $erro = "Erro ao registrar. Tente novamente.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar - Feira dos Produtores Rurais</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f1e4; /* Fundo bege */
        }

        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        h2 {
            color: #4A8C4A; /* Cor verde gourmet */
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .form-control, .form-control-file {
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #4A8C4A;
            box-shadow: 0 0 5px rgba(74, 140, 74, 0.5);
        }

        .btn-primary {
            background-color: #4A8C4A;
            border-color: #4A8C4A;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #3a6f3a;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
            border-radius: 8px;
        }

        .caixa {
        background-color: #ffffef !important;
    }    
    </style>
</head>
<body>
    <div class="container">
        <h2 class="my-4 text-center">Registrar</h2>
        <?php if (isset($erro)): ?>
            <div class="alert alert-danger"><?php echo $erro; ?></div>
        <?php endif; ?>
        <form method="post" action="registro.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control caixa" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control caixa" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control caixa" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control caixa" id="descricao" name="descricao" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem">
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include "template/footer.php"; ?>
