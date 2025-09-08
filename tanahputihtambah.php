<?php
include "koneksi.php";

$errors = [];
$success = "";

function hitungStatus($masa_berlaku) {
    if (empty($masa_berlaku)) {
        return "Peringatan";
    }
    $today = new DateTime();
    $expire_date = new DateTime($masa_berlaku);
    $diff = $expire_date->diff($today);
    $days_diff = (int)$diff->format('%r%a'); // negatif jika masa_berlaku di masa depan

    if ($days_diff < 0) {
        return "Aktif";
    } elseif ($days_diff <= 90) {
        return "Peringatan";
    } else {
        return "Expired";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis_izin = trim($_POST['jenis_izin']);
    $no_izin = trim($_POST['no_izin']);
    $masa_berlaku = trim($_POST['masa_berlaku']);
    $ket = trim($_POST['ket']);

    // Validasi
    if (empty($jenis_izin)) {
        $errors[] = "Jenis izin wajib diisi.";
    }
    if (!empty($masa_berlaku)) {
        $d = DateTime::createFromFormat('Y-m-d', $masa_berlaku);
        if (!($d && $d->format('Y-m-d') === $masa_berlaku)) {
            $errors[] = "Format masa berlaku harus yyyy-mm-dd.";
        }
    } else {
        $masa_berlaku = null;
    }

    // Handle upload dokumen (opsional)
    $dok = null;
    if (isset($_FILES['dok']) && $_FILES['dok']['error'] !== UPLOAD_ERR_NO_FILE) {
        $allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
        if ($_FILES['dok']['error'] === UPLOAD_ERR_OK) {
            if (in_array($_FILES['dok']['type'], $allowed_types)) {
                $upload_dir = 'uploads/';
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $filename = time() . '_' . basename($_FILES['dok']['name']);
                $target_file = $upload_dir . $filename;
                if (move_uploaded_file($_FILES['dok']['tmp_name'], $target_file)) {
                    $dok = $filename;
                } else {
                    $errors[] = "Gagal mengupload dokumen.";
                }
            } else {
                $errors[] = "Tipe file dokumen harus PDF, JPG, atau PNG.";
            }
        } else {
            $errors[] = "Error upload dokumen.";
        }
    }

    if (empty($errors)) {
        $status = hitungStatus($masa_berlaku);

        $stmt = $conn->prepare("INSERT INTO izin4 (jenis_izin, no_izin, masa_berlaku, ket, status, dok) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $jenis_izin, $no_izin, $masa_berlaku, $ket, $status, $dok);

        if ($stmt->execute()) {
            $success = "Data izin berhasil ditambahkan dengan status <strong>$status</strong>.";
            // Kosongkan form
            $jenis_izin = $no_izin = $masa_berlaku = $ket = "";
            $dok = null;
        } else {
            $errors[] = "Gagal menyimpan data: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Data Izin PKS TANAH PUTIH</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 30px auto;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #155724;
            text-align: center;
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        form input[type="text"],
        form input[type="date"],
        form textarea {
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        form textarea {
            resize: vertical;
            height: 80px;
        }
        form button {
            margin-top: 20px;
            background-color: #155724;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        form button:hover {
            background-color: #0b3d1a;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .back-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            text-decoration: none;
            color: #155724;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Tambah Data Izin PKS TANAH PUTIH</h2>

    <?php if (!empty($errors)) : ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $e) : ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success) : ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post" action="" enctype="multipart/form-data">
        <label for="jenis_izin">Jenis Izin SIO / Nama Peralatan *</label>
        <input type="text" id="jenis_izin" name="jenis_izin" required value="<?= htmlspecialchars($jenis_izin ?? '') ?>" />

        <label for="no_izin">No. Izin</label>
        <input type="text" id="no_izin" name="no_izin" value="<?= htmlspecialchars($no_izin ?? '') ?>" />

        <label for="masa_berlaku">Masa Berlaku (format yyyy-mm-dd)</label>
        <input type="date" id="masa_berlaku" name="masa_berlaku" value="<?= htmlspecialchars($masa_berlaku ?? '') ?>" />

        <label for="ket">Keterangan</label>
        <textarea id="ket" name="ket"><?= htmlspecialchars($ket ?? '') ?></textarea>

        <label for="dok">Upload Dokumen (PDF, JPG, PNG) - opsional</label>
        <input type="file" id="dok" name="dok" accept=".pdf,image/jpeg,image/png" />

        <button type="submit">Simpan</button>
    </form>

    <a href="tanahputih_pks.php" class="back-link">&larr; Kembali ke Daftar Izin</a>
</body>
</html>
