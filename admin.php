<?php
// admin.php
include 'config.php';

// sederhana: tidak ada login di contoh ini (untuk produksi, tambahkan auth)
$action = $_GET['action'] ?? null;

if ($action === 'call') {
    // ambil antrian menunggu paling kecil
    $r = mysqli_query($conn, "SELECT * FROM queue WHERE status='menunggu' ORDER BY no_antrian ASC LIMIT 1");
    $row = mysqli_fetch_assoc($r);
    if ($row) {
        $id = $row['id_queue'];
        mysqli_query($conn, "UPDATE queue SET status='dipanggil' WHERE id_queue=$id");
    }
    header("Location: admin.php");
    exit;
}

if ($action === 'finish' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "UPDATE queue SET status='selesai' WHERE id_queue=$id");
    header("Location: admin.php");
    exit;
}

if ($action === 'reset') {
    // reset hanya hari ini: ubah status semua jadi 'selesai' atau hapus
    mysqli_query($conn, "DELETE FROM queue WHERE DATE(created_at)=CURDATE()");
    header("Location: admin.php");
    exit;
}

// ambil yang dipanggil saat ini (terbaru)
$callingRes = mysqli_query($conn, "SELECT * FROM queue WHERE status='dipanggil' ORDER BY id_queue DESC LIMIT 1");
$calling = mysqli_fetch_assoc($callingRes);

// ambil list menunggu
$waitingRes = mysqli_query($conn, "SELECT * FROM queue WHERE status='menunggu' ORDER BY no_antrian ASC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Panel - Antrian</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
  <h1>Admin Panel</h1>

  <div class="panel">
    <h3>Sedang Dipanggil</h3>
    <?php if ($calling): ?>
      <p class="no big"><?php echo $calling['no_antrian']; ?></p>
      <a href="admin.php?action=finish&id=<?php echo $calling['id_queue']; ?>">Selesai</a>
    <?php else: ?>
      <p>Tidak ada nomor sedang dipanggil</p>
    <?php endif; ?>

    <div class="controls">
      <a href="admin.php?action=call" class="btn">Panggil Berikutnya</a>
      <a href="admin.php?action=reset" class="btn danger" onclick="return confirm('Reset antrian hari ini?')">Reset Hari Ini</a>
    </div>
  </div>

  <div class="panel">
    <h3>Daftar Menunggu</h3>
    <table>
      <tr><th>No</th><th>Nama</th><th>Status</th></tr>
      <?php while($w = mysqli_fetch_assoc($waitingRes)): ?>
      <tr>
        <td><?php echo $w['no_antrian']; ?></td>
        <td><?php echo htmlspecialchars($w['nama']); ?></td>
        <td><?php echo $w['status']; ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>

  <p><a href="display.php" target="_blank">Buka Display</a> | <a href="index.php">Halaman Pengguna</a></p>
</div>
</body>
</html>