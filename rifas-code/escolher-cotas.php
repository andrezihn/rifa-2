<!-- escolher-cotas.php -->
<?php
include "backend/db.php";

// ID da campanha atual (pode vir por GET futuramente)
$campanha_id = 1;

$query = "SELECT * FROM cotas WHERE campanha_id = $campanha_id ORDER BY numero ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Escolha sua Cota</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(60px, 1fr)); gap: 10px; max-width: 600px; margin: auto; }
    .cota { padding: 10px; border-radius: 8px; text-align: center; cursor: pointer; font-weight: bold; }
    .disponivel { background: #d4edda; color: #155724; }
    .reservada { background: #fff3cd; color: #856404; pointer-events: none; }
    .comprada { background: #f8d7da; color: #721c24; pointer-events: none; }
    .selecionada { border: 2px solid #000; }
  </style>
</head>
<body>
  <h2 style="text-align:center">Escolha suas cotas</h2>
  <form action="pagamento.html" method="POST" onsubmit="return validarEnvio()">
    <div class="grid" id="cotas-container">
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="cota <?= $row['status'] ?>" data-numero="<?= $row['numero'] ?>">
          <?= $row['numero'] ?>
        </div>
      <?php endwhile; ?>
    </div>
    <input type="hidden" name="cotasSelecionadas" id="cotasSelecionadas">
    <br>
    <div style="text-align:center">
      <button type="submit">Reservar e Pagar</button>
    </div>
  </form>

  <script>
    const cotas = document.querySelectorAll('.cota.disponivel');
    const selecionadas = [];

    cotas.forEach(cota => {
      cota.addEventListener('click', () => {
        const num = cota.dataset.numero;
        if (selecionadas.includes(num)) {
          selecionadas.splice(selecionadas.indexOf(num), 1);
          cota.classList.remove('selecionada');
        } else {
          selecionadas.push(num);
          cota.classList.add('selecionada');
        }
        document.getElementById('cotasSelecionadas').value = selecionadas.join(',');
      });
    });

    function validarEnvio() {
      if (selecionadas.length === 0) {
        alert("Selecione pelo menos uma cota!");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
