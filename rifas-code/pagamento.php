<!-- pagamento.php -->
<?php
// Captura as cotas selecionadas da etapa anterior
$cotas = isset($_POST['cotasSelecionadas']) ? $_POST['cotasSelecionadas'] : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Pagamento</title>
  <link rel="stylesheet" href="style.css">
  <style>
    form { max-width: 500px; margin: auto; display: flex; flex-direction: column; gap: 10px; }
    input, textarea, button { padding: 10px; border-radius: 6px; border: 1px solid #ccc; }
  </style>
</head>
<body>
  <h2 style="text-align:center">Finalize sua compra</h2>
  <form action="backend/salvar_compra.php" method="POST" enctype="multipart/form-data" onsubmit="return validarForm()">
    <label>Cotas escolhidas:</label>
    <input type="text" name="cotas" value="<?= htmlspecialchars($cotas) ?>" readonly>

    <label>Nome completo:</label>
    <input type="text" name="nome" required>

    <label>Telefone (WhatsApp):</label>
    <input type="tel" name="telefone" required placeholder="(DDD
