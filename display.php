<?php
// display.php
include 'config.php';
$res = mysqli_query($conn, "SELECT * FROM queue WHERE status='dipanggil' ORDER BY id_queue DESC LIMIT 1");
$row = mysqli_fetch_assoc($res);
$no = $row ? $row['no_antrian'] : null;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Display Antrian</title>
<link rel="stylesheet" href="assets/css/style.css">
<meta http-equiv="refresh" content="3"> <!-- refresh setiap 3 detik -->
</head>
<body class="display">
  <div class="center">
    <h1>Nomor yang sedang dipanggil</h1>
    <?php if ($no): ?>
      <div class="big-no"><?php echo $no; ?></div>
    <?php else: ?>
      <div class="big-no">-</div>
      <p>Belum ada panggilan</p>
    <?php endif; ?>
  </div>
</body>
</html>