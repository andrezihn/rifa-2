<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$cotas = $data['cotas']; // array de números

$reservadas = [];
$indisponiveis = [];

foreach ($cotas as $numero) {
    // Verifica se está disponível
    $check = mysqli_query($conn, "SELECT status FROM cotas WHERE numero=$numero");
    $row = mysqli_fetch_assoc($check);

    if ($row && $row['status'] === 'disponível') {
        // Reserva a cota
        mysqli_query($conn, "UPDATE cotas SET status='reservada' WHERE numero=$numero");
        $reservadas[] = $numero;
    } else {
        $indisponiveis[] = $numero;
    }
}

echo json_encode([
    'success' => true,
    'reservadas' => $reservadas,
    'indisponiveis' => $indisponiveis
]);
?>
