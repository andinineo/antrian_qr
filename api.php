<?php
// api.php?action=current
include 'config.php';
$action = $_GET['action'] ?? '';

header('Content-Type: application/json');

if ($action === 'current') {
    $res = mysqli_query($conn, "SELECT * FROM queue WHERE status='dipanggil' ORDER BY id_queue DESC LIMIT 1");
    $row = mysqli_fetch_assoc($res);
    echo json_encode($row ? $row : []);
    exit;
}
echo json_encode(['error' => 'no action']);