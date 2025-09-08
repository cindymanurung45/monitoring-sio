<?php
include "koneksi.php"; // Pastikan ini menghubungkan ke database dengan MySQLi

// Ambil dan sanitasi input
$a = trim($_REQUEST['t1']); // user
$b = trim($_REQUEST['t2']); // password

// Validasi input
if(empty($a) || empty($b)) {
    echo "<script>alert('Harap Jangan Kosongkan Data..!!');javascript:history.go(-1)</script>";
    exit;
}

// Cek apakah user sudah ada
$stmt = $conn->prepare("SELECT * FROM akun WHERE user = ?");
$stmt->bind_param("s", $a);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    // User sudah ada, langsung redirect ke menu.php
    header("Location: beranda.php");
    exit;
} else {
    // User belum ada, lakukan insert
    $stmt = $conn->prepare("INSERT INTO akun (user, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $a, $b);
    $hasil = $stmt->execute();

    if($hasil) {
        // Insert sukses, redirect ke menu.php
        header("Location: beranda.php");
        exit;
    } else {
        // Insert gagal, tampilkan alert dan kembali
        echo "<script>alert('Data Anda Gagal di Input..!!');javascript:history.go(-1)</script>";
        exit;
    }
}

$stmt->close();
$conn->close();
?>
