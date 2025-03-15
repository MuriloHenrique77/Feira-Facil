<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Feira de Produtores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/contato.css">
</head>
<body class="body">
    <?php include "template/header.php"; ?>
    
    <div class="container mt-5">
        <h1 class="text-center mb-4 text">Contato</h1>
        <div class="contact-form">
            <h2 class="text-center text">Envie uma Mensagem</h2>
            <form action="envia_contato.php" method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control caixa" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control caixa" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control caixa" id="mensagem" name="mensagem" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100 verdao">Enviar</button>
            </form>
        </div>
    </div>
    <br> <br> 

    <?php include "template/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
