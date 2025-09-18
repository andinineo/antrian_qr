<?php
// index.php
include 'config.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama'] ?: '');
    // ambil nomor terbesar hari ini
    $res = mysqli_query($conn, "SELECT MAX(no_antrian) as last FROM queue WHERE DATE(created_at)=CURDATE()");
    $row = mysqli_fetch_assoc($res);
    $last = $row['last'] ? intval($row['last']) : 0;
    $new_no = $last + 1;
    mysqli_query($conn, "INSERT INTO queue (no_antrian, nama, status, created_at) VALUES ($new_no, '$nama', 'menunggu', NOW())");
    $message = "Nomor antrian Anda: $new_no";
    // redirect supaya refresh form tidak mengirim ulang
    header("Location: index.php?no=$new_no");
    exit;
}
$picked = isset($_GET['no']) ? intval($_GET['no']) : null;
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ambil Nomor Antrian</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Antrian Online</h1>
    <form method="post" action="index.php">
      <label>Nama (opsional)</label>
      <input type="text" name="nama" placeholder="Nama Anda">
      <button type="submit">Ambil Nomor</button>
    </form>

    <?php if ($picked): ?>
      <div class="card">
        <h2>Nomor Antrian Anda</h2>
        <p class="no"><?php echo $picked; ?></p>
        <p>Kami menyarankan menunggu sampai nomor Anda dipanggil.</p>
        <p>Scan QR untuk bukti (opsional):</p>
        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo urlencode('Nomor:'.$picked); ?>" alt="QR">
      </div>
    <?php endif; ?>

    <hr>
    <p>Lihat <a href="display.php" target="_blank">monitor antrian</a> atau <a href="admin.php">admin panel</a></p>
  </div>
<script src="assets/js/script.js"></script>
</body>
</html>