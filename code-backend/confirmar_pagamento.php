<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$nome = mysqli_real_escape_string($conn, $data['nome']);
$telefone = mysqli_real_escape_string($conn, $data['telefone']);
$cotas = $data['cotas']; // array de números

$confirmadas = [];
$falharam = [];

foreach ($cotas as $numero) {
    // Verifica se a cota está reservada
    $check = mysqli_query($conn, "SELECT status FROM cotas WHERE numero=$numero");
    $row = mysqli_fetch_assoc($check);

    if ($row && $row['status'] === 'reservada') {
        // Confirma a compra
        mysqli_query($conn, "UPDATE cotas 
            SET status='comprada', comprador_nome='$nome', comprador_telefone='$telefone' 
            WHERE numero=$numero");
        $confirmadas[] = $numero;
    } else {
        $falharam[] = $numero;
    }
}

echo json_encode([
    'success' => true,
    'confirmadas' => $confirmadas,
    'falharam' => $falharam
]);
?>
