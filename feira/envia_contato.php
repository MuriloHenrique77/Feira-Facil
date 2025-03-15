<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Validação simples (você pode adicionar mais validações conforme necessário)
    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        // Enviar email ou salvar no banco de dados
        $to = "marcotulio.martins.140@gmail.com"; // Substitua pelo seu email
        $subject = "Mensagem de Contato de $nome";
        $body = "Nome: $nome\nEmail: $email\n\nMensagem:\n$mensagem";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Erro ao enviar a mensagem. Tente novamente.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
