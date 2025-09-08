<?php
include "koneksi.php";

$edit_id = isset($_GET['edit_id']) ? intval($_GET['edit_id']) : 0;
$error = "";
$success = "";

// Fungsi status dan warna
function getStatusAndColor($masa_berlaku) {
    $today = new DateTime();
    $expire_date = new DateTime($masa_berlaku);
    $interval = $expire_date->diff($today);
    $days_diff = (int)$interval->format('%r%a');

    if ($days_diff < 0) {
        return ['status' => 'Aktif', 'color' => 'green'];
    } elseif ($days_diff <= 90) {
        return ['status' => 'Peringatan', 'color' => 'orange'];
    } else {
        return ['status' => 'Expired', 'color' => 'red'];
    }
}

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id_post = intval($_POST['edit_id']);
    $jenis_izin = trim($_POST['jenis_izin']);
    $no_izin = trim($_POST['no_izin']);
    $masa_berlaku = trim($_POST['masa_berlaku']);
    $ket = trim($_POST['ket']);

    $upload_dok = "";
    if (isset($_FILES['dok']) && $_FILES['dok']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['dok']['tmp_name'];
        $file_name = basename($_FILES['dok']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];

        if (in_array($file_ext, $allowed_ext)) {
            $new_file_name = uniqid('dok_') . '.' . $file_ext;
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            if (move_uploaded_file($file_tmp, $upload_dir . $new_file_name)) {
                $upload_dok = $new_file_name;
            } else {
                $error = "Gagal mengupload file dokumen.";
            }
        } else {
            $error = "Format file dokumen tidak diperbolehkan.";
        }
    }

    if (!$error) {
        if ($upload_dok) {
            $sql = "UPDATE izin10 SET jenis_izin=?, no_izin=?, masa_berlaku=?, ket=?, dok=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssssi", $jenis_izin, $no_izin, $masa_berlaku, $ket, $upload_dok, $id_post);
        } else {
            $sql = "UPDATE izin10 SET jenis_izin=?, no_izin=?, masa_berlaku=?, ket=? WHERE id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssi", $jenis_izin, $no_izin, $masa_berlaku, $ket, $id_post);
        }
        if (mysqli_stmt_execute($stmt)) {
            $success = "Data berhasil diperbarui.";
            $edit_id = 0; // reset edit form setelah update
        } else {
            $error = "Gagal memperbarui data: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}

// Ambil data untuk form edit jika ada edit_id
$edit_data = null;
if ($edit_id > 0) {
    $sql = "SELECT * FROM izin10 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $edit_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $edit_data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// Ambil semua data izin untuk tabel
$query = "SELECT * FROM izin10 ORDER BY id ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Izin PKS SEI INTAN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f8f9fa;
        }
        h2 {
            color: #155724;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 2000px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #999;
            padding: 7px 12px;
            text-align: left;
            vertical-align: middle;
        }
        th {
            background-color: #155724;
            color: white;
        }
        .status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            display: inline-block;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        .green {
            background-color: #28a745;
        }
        .orange {
            background-color: #ffc107;
            color: #212529;
            animation: blink 1s infinite;
        }
        .red {
            background-color: #dc3545;
            animation: blink 1s infinite;
        }
        .btn-edit {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            transition: background-color 0.3s;
        }
        .btn-edit:hover {
            background-color: #0056b3;
        }
        form {
            max-width: 700px;
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
        }
        textarea {
            resize: vertical;
        }
        input[type="file"] {
            margin-top: 5px;
        }
        .btn-submit {
            margin-top: 20px;
            background-color: #155724;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #0b3d1a;
        }
        .message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 4px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .dok-link {
            margin-top: 5px;
            display: block;
        }
		.btn-tambah {
    background-color: #28a745; /* Warna hijau */
    color: white;
    padding: 8px 16px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    position: fixed; /* Agar tombol selalu di pojok layar */
    top: 20px;       /* Jarak dari atas layar */
    right: 20px;     /* Jarak dari kanan layar */
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    transition: background-color 0.3s;
    z-index: 1000; /* Supaya tombol berada di atas elemen lain */
}

.btn-tambah:hover {
    background-color: #218838; /* Warna hijau lebih gelap saat hover */
}

    </style>
</head>
	<body>
    <div class="header-container">
        <h2>Daftar Izin PKS SEI INTAN</h2>
        <a href="seiintantambah.php" class="btn-tambah">Tambah</a>
    </div>

    <!-- Tabel dan konten lain di bawah -->
</body>


    <?php if ($edit_id > 0 && $edit_data): ?>
        <h3>Edit Data Izin</h3>

        <?php if ($error): ?>
            <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="message success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form action="?edit_id=<?= $edit_id ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" value="<?= $edit_id ?>" />

            <label for="jenis_izin">Jenis Izin</label>
            <input type="text" id="jenis_izin" name="jenis_izin" required value="<?= htmlspecialchars($edit_data['jenis_izin']) ?>" />

            <label for="no_izin">No Izin</label>
            <input type="text" id="no_izin" name="no_izin" value="<?= htmlspecialchars($edit_data['no_izin']) ?>" />

            <label for="masa_berlaku">Masa Berlaku</label>
            <input type="date" id="masa_berlaku" name="masa_berlaku" required value="<?= htmlspecialchars($edit_data['masa_berlaku']) ?>" />

            <label for="ket">Keterangan</label>
            <textarea id="ket" name="ket" rows="3"><?= htmlspecialchars($edit_data['ket']) ?></textarea>

            <label for="dok">Dokumen (upload baru untuk ganti dokumen lama)</label>
            <input type="file" id="dok" name="dok" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" />
            <?php if ($edit_data['dok']): ?>
                <a href="uploads/<?= htmlspecialchars($edit_data['dok']) ?>" target="_blank" class="dok-link">Dokumen saat ini: Lihat</a>
            <?php else: ?>
                <div>Tidak ada dokumen</div>
            <?php endif; ?>

            <button type="submit" class="btn-submit">Update</button>
        </form>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Jenis Izin</th>
                <th>No Izin</th>
                <th>Masa Berlaku</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : 
                $status_color = getStatusAndColor($row['masa_berlaku']);
                $status = $status_color['status'];
                $color_class = $status_color['color'];
            ?>
            <tr>
                <td><?= htmlspecialchars($row['jenis_izin']) ?></td>
                <td><?= htmlspecialchars($row['no_izin']) ?></td>
                <td><?= htmlspecialchars($row['masa_berlaku']) ?></td>
                <td><?= htmlspecialchars($row['ket']) ?></td>
                <td><span class="status <?= $color_class ?>"><?= $status ?></span></td>
                <td>
                    <?php if ($row['dok']) : ?>
                        <a href="uploads/<?= htmlspecialchars($row['dok']) ?>" target="_blank">Lihat</a>
                    <?php else : ?>
                        Tidak ada
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?edit_id=<?= $row['id'] ?>" class="btn-edit" title="Edit Data">✏️ Edit</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
