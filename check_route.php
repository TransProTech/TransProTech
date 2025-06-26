<?php
require_once __DIR__ . '/db.php';

$start = $conn->real_escape_string($_POST['start']);
$end   = $conn->real_escape_string($_POST['end']);
$mode  = ucfirst($conn->real_escape_string($_POST['mode']));

if ($mode === 'Tricycle') {
    $result = $conn->query(
        "SELECT COUNT(*) as total FROM routes
         WHERE fromLocation='$start' AND toLocation='$end' AND transportType='Tricycle'"
    )->fetch_assoc();

    $available = $result['total'] > 0;
} else {
    $available = true;
}

echo json_encode(['available' => $available]);
?>
