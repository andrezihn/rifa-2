<?php
include 'db.php';

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$cotas = $_POST['cotas'];
$host_whatsapp = $_POST['host_whatsapp'];
$data = date('Y-m-d H:i:s');

// Upload do comprovante
$upload_dir = '../uploads/';
$nome_arquivo = uniqid() . '-' . $_FILES['comprovante']['name'];
$caminho_arquivo = $upload_dir . basename($nome_arquivo);
move_uploaded_file($_FILES['comprovante']['tmp_name'], $caminho_arquivo);

// Marca as cotas como reservadas no banco
$cotas_array = explode(',', $cotas);
foreach ($cotas_array as $numero) {
  $numero = (int)$numero;
  $query = "UPDATE cotas SET status = 'reservada', comprador_nome = '$nome', comprador_telefone = '$telefone' WHERE numero = $numero";
  mysqli_query($conn, $query);
}

// Redireciona para WhatsApp com mensagem pronta
$msg = urlencode("Olá, sou $nome.\nEscolhi as cotas: $cotas\nSegue comprovante: (enviado pelo site)");
header("Location: https://wa.me/$host_whatsapp?text=$msg");
exit;
