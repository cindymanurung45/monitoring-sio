<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Halaman Administrator - Sawit Hijau</title>
    <link rel="stylesheet" href="../css/admin.css" />
    <style>
        body {
            background: #e6f2e6; /* hijau muda */
            font: 12px Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #container {
            width: 1255px;
            margin: 0 auto;
        }

        #header {
            background: url('https://storage.googleapis.com/a1aa/image/c43739bb-d08f-4a3d-c014-9884f0cc90c7.jpg') no-repeat center center;
            height: 100px;
            background-size: cover;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: relative;
        }

        /* Tambahkan overlay hijau transparan di header agar lebih hijau */
        #header::after {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(34, 139, 34, 0.5); /* hijau gelap transparan */
            z-index: 0;
        }

        #header h1 {
            position: relative;
            z-index: 1;
            font-family: "Agency FB", sans-serif;
            font-weight: bold;
            font-size: 48px;
            color: #d4f1be; /* hijau muda cerah */
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 50, 0, 0.7);
        }

        #content {
            background: #f0fff0; /* hijau sangat muda */
            min-height: 300px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(34, 139, 34, 0.2);
            color: #2f4f2f; /* hijau gelap */
            font-size: 16px;
        }

        #footer {
            background: #2e7d32; /* hijau daun */
            height: 55px;
            text-align: center;
            color: #c8e6c9; /* hijau muda */
            padding-top: 15px;
            font-family: "Arial", sans-serif;
            font-size: 14px;
        }

        #menu {
            background: #388e3c; /* hijau sedang */
            height: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            font-family: "Arial", sans-serif;
        }

        #menu ul {
            margin: 0;
            padding: 0;
            display: flex;
            list-style: none;
        }

        #menu ul li {
            margin: 0 10px;
        }

        #menu ul li a {
            display: block;
            padding: 8px 15px;
            text-decoration: none;
            color: #e8f5e9; /* hijau sangat muda */
            transition: background 0.3s, color 0.3s;
            border-radius: 4px;
        }

        #menu ul li a:hover {
            background: #a5d6a7; /* hijau muda */
            color: #1b5e20; /* hijau gelap */
        }

        .title {
            font-family: "Agency FB", sans-serif;
            font-weight: bold;
            font-size: 48px;
            color: #33691e; /* hijau gelap */
            text-align: center;
            margin: 20px 0;
            text-shadow: 1px 1px 2px rgba(0, 50, 0, 0.7);
            animation: fadeIn 2s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .subtitle {
            font-family: "Times New Roman", Times, serif;
            font-size: 16px;
            color: #2e7d32;
            text-align: center;
        }

        .style1 {
            font-family: "Agency FB", sans-serif;
            font-weight: bold;
            font-size: 48px;
            color: #4caf50; /* hijau cerah */
            text-align: center;
            margin: 20px 0;
            text-shadow: 2px 2px 4px rgba(0, 50, 0, 0.7);
            animation: fadeIn 2s;
        }
    </style>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1 class="style1">MONITORING<br></h1>
        </div>

        <div id="menu">
            <ul class="left">
                <li><a href="">Beranda</a></li>
                <li><a href="menu.php">Perizinan</a></li>
                <li><a href="ispo.php">ISPO</a></li>
                <li><a href="rspo.php">RSPO</a></li>
                <li><a href="smk3.php">SMK3</a></li>
            </ul>
            <ul class="right">
                <li><a href="loginout.php">Keluar</a></li>
            </ul>
        </div>

        <div id="content">
            <p>Selamat datang di Platform Monitoring. Pantau dan kelola kebun sawit Anda dengan mudah dan ramah lingkungan.</p>
        </div>

        <div id="footer">
            <p>2025 SIO - Inovasi Kebun Sawit. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
