<?php
include "template/header.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtor 1 - Feira de Produtores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-img {
            width: 100%;
            height: auto;
            transition: transform 0.3s;
        }

        .product-img:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Feira de Produtores</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Barracas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-5">
        <h1 class="text-center mb-4">Produtor 1</h1>
        <div class="text-center mb-4">
            <img src="img/produtor2.jpg" class="img-fluid" alt="Produtor 1">
            <p>Descrição do Produtor 1 e suas práticas.</p>
        </div>

        <h2>Produtos</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Produto 1 -->
            <div class="col">
                <div class="card h-100">
                    <img src="img/produto1.1.jpg" class="product-img" alt="Produto 1">
                    <div class="card-body">
                        <h5 class="card-title">Produto 1</h5>
                        <p class="card-text">Descrição do Produto 1.</p>
                        <p class="card-text"><strong>Preço: R$ 10,00</strong></p>
                    </div>
                </div>
            </div>
            <!-- Produto 2 -->
            <div class="col">
                <div class="card h-100">
                    <img src="img/produto1.2.jpg" class="product-img" alt="Produto 2">
                    <div class="card-body">
                        <h5 class="card-title">Produto 2</h5>
                        <p class="card-text">Descrição do Produto 2.</p>
                        <p class="card-text"><strong>Preço: R$ 20,00</strong></p>
                    </div>
                </div>
            </div>
            <!-- Produto 3 -->
            <div class="col">
                <div class="card h-100">
                    <img src="img/produto1.3.jpg" class="product-img" alt="Produto 3">
                    <div class="card-body">
                        <h5 class="card-title">Produto 3</h5>
                        <p class="card-text">Descrição do Produto 3.</p>
                        <p class="card-text"><strong>Preço: R$ 15,00</strong></p>
                    </div>
                </div>
            </div>
            <!-- Adicione mais produtos conforme necessário -->
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <p class="text-center">© 2024 Feira de Produtores - Todos os direitos reservados</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include "template/footer.php"; ?>