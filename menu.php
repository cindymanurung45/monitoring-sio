<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Halaman Administrator</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Agency+FB&display=swap"
    rel="stylesheet"
  />
  <style>
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .fade-in {
      animation: fadeIn 2s ease forwards;
    }
    .font-agencyfb {
      font-family: "Agency FB", sans-serif;
    }
    .text-gradient {
      background: linear-gradient(90deg, #ff7e05, #ffb347, #ff7e05);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-fill-color: transparent;
    }
    .text-shadow {
      text-shadow:
        2px 2px 6px rgba(255, 126, 5, 0.8),
        0 0 15px rgba(255, 179, 71, 0.9);
    }
  </style>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-b from-green-900 via-green-700 to-green-500">
  <div
    class="max-w-[1255px] w-full mx-auto flex flex-col min-h-screen bg-green-900 bg-opacity-80 rounded-3xl shadow-xl overflow-hidden"
  >
    <header class="relative h-28 sm:h-32 md:h-36 lg:h-40 xl:h-44 2xl:h-48 overflow-hidden rounded-b-3xl shadow-lg">
      <img
        alt="Pemandangan kebun sawit hijau subur dengan barisan pohon sawit rapi di bawah langit biru cerah dengan awan putih"
        class="absolute inset-0 w-full h-full object-cover object-center brightness-75"
        height="192"
        src="https://storage.googleapis.com/a1aa/image/2e4ea074-3a60-40c7-5439-f20ed0e8950b.jpg"
        width="1255"
      />
      <div
        class="absolute top-4 left-4 bg-black bg-opacity-60 text-white rounded-md px-4 py-2 font-semibold text-sm sm:text-base z-20 select-none"
      >
  
      </div>
      <h1
        class="fade-in font-agencyfb text-gradient text-shadow text-center pt-10 select-none z-10 relative text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl"
      >
        Surat Izin Operasi
      </h1>
    </header>

    <nav
      class="bg-green-800 bg-opacity-90 flex flex-col items-center gap-6 sm:gap-8 py-6 px-4 sm:px-8 rounded-b-3xl shadow-md"
    >
      <a
        href="sio_pks.php"
        class="relative inline-block w-full max-w-xs text-center px-10 py-3 text-lg sm:text-xl font-semibold text-white rounded-full bg-gradient-to-br from-green-500 to-green-700 shadow-lg shadow-green-700/80 overflow-hidden transition-all duration-300 ease-in-out hover:from-green-700 hover:to-green-500 hover:shadow-green-900/90"
      >
        SIO PKS
        <span
          class="absolute top-1/2 left-1/2 w-0 h-0 bg-white bg-opacity-30 rounded-full transform -translate-x-1/2 -translate-y-1/2 transition-all duration-400 ease-out group-hover:w-[200%] group-hover:h-[500%]"
        ></span>
      </a>
      <a
        href="sio_kebun.php"
        class="relative inline-block w-full max-w-xs text-center px-10 py-3 text-lg sm:text-xl font-semibold text-white rounded-full bg-gradient-to-br from-green-500 to-green-700 shadow-lg shadow-green-700/80 overflow-hidden transition-all duration-300 ease-in-out hover:from-green-700 hover:to-green-500 hover:shadow-green-900/90"
      >
        SIO KEBUN
        <span
          class="absolute top-1/2 left-1/2 w-0 h-0 bg-white bg-opacity-30 rounded-full transform -translate-x-1/2 -translate-y-1/2 transition-all duration-400 ease-out group-hover:w-[200%] group-hover:h-[500%]"
        ></span>
      </a>
    </nav>

    <main
      class="flex-grow rounded-xl shadow-lg p-6 sm:p-10 mt-8 mb-8 max-w-full relative overflow-hidden bg-green-800 bg-opacity-90"
    >
      <img
        alt="Pemandangan kebun sawit hijau subur dengan barisan pohon sawit rapi di bawah langit biru cerah dengan awan putih"
        class="absolute inset-0 w-full h-full object-cover object-center opacity-30 rounded-xl pointer-events-none select-none"
        height="600"
        src="https://storage.googleapis.com/a1aa/image/2e4ea074-3a60-40c7-5439-f20ed0e8950b.jpg"
        width="1255"
      />
      <div class="relative z-10 text-white text-center">
        <h2 class="text-3xl sm:text-4xl font-bold mb-4 drop-shadow-lg">
          Selamat datang di Halaman Administrator SIO PKS
        </h2>
        <p class="text-lg sm:text-xl max-w-3xl mx-auto drop-shadow-md">
          Kelola data dan informasi terkait SIO dengan mudah dan efisien melalui
          menu di atas.
        </p>
      </div>
    </main>

    <footer
      class="bg-green-900 bg-opacity-90 h-14 sm:h-16 flex items-center justify-center text-green-200 text-sm sm:text-base rounded-t-xl select-none"
    >
      <p>2025 SIO - Inovasi Kebun Sawit. Semua hak dilindungi.</p>
    </footer>
  </div>
</body>
</html>