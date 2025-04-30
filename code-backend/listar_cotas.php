<?php
include 'db.php';

$query = "SELECT * FROM cotas ORDER BY numero ASC";
$result = mysqli_query($conn, $query);

$cotas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cotas[] = $row;
}

header('Content-Type: application/json');
echo json_encode($cotas);
?>
