<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Secure Voice Access</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    :root {
      --bg-dark: #0b101a;
      --card-bg: rgba(23, 32, 48, 0.7);
      --neon-blue: #00f3ff;
      --neon-green: #00ff9d;
      --neon-red: #ff2a6d;
      --text-main: #e0e6ed;
    }

    body {
      background-color: var(--bg-dark);
      background-image: 
        radial-gradient(circle at 10% 20%, rgba(0, 243, 255, 0.1) 0%, transparent 20%),
        radial-gradient(circle at 90% 80%, rgba(255, 42, 109, 0.1) 0%, transparent 20%);
      min-height: 100vh;
      color: var(--text-main);
      font-family: 'Poppins', sans-serif;
      display: flex;
      align-items: center;
    }

    /* PERUBAHAN DISINI: Menambahkan warna neon blue ke h5 */
    h2, h5 {
      font-family: 'Orbitron', sans-serif;
      letter-spacing: 1px;
      color: var(--neon-blue); /* Warna biru ditambahkan disini */
    }

    /* Modern Glass Cards */
    .card {
      background: var(--card-bg);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 40px 0 rgba(0, 243, 255, 0.15);
      border-color: rgba(0, 243, 255, 0.3);
    }

    /* Input Styling */
    .form-control {
      background: rgba(0, 0, 0, 0.3);
      border: 1px solid rgba(255, 255, 255, 0.1);
      color: #fff;
      border-radius: 10px;
      padding: 12px;
    }
    .form-control:focus {
      background: rgba(0, 0, 0, 0.5);
      color: #fff;
      box-shadow: 0 0 15px rgba(0, 243, 255, 0.2);
      border-color: var(--neon-blue);
    }

    /* Buttons */
    .btn-custom-outline {
      border: 1px solid var(--neon-blue);
      color: var(--neon-blue);
      border-radius: 10px;
      transition: all 0.3s;
      font-family: 'Orbitron', sans-serif;
      font-size: 0.9rem;
    }
    .btn-custom-outline:hover {
      background: var(--neon-blue);
      color: #000;
      box-shadow: 0 0 20px var(--neon-blue);
    }

    /* Mic Button */
    .mic-btn-wrapper {
      position: relative;
      display: inline-block;
    }
    
    .btn-mic {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: linear-gradient(145deg, #1e2a3b, #151e2b);
      border: 2px solid var(--neon-blue);
      color: var(--neon-blue);
      font-size: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s;
      box-shadow: 0 0 15px rgba(0, 243, 255, 0.2);
    }

    .btn-mic:hover {
      transform: scale(1.05);
      background: var(--neon-blue);
      color: #000;
      box-shadow: 0 0 30px rgba(0, 243, 255, 0.6);
      cursor: pointer;
    }

    .btn-mic:active {
      transform: scale(0.95);
    }

    /* Door Status Display */
    .status-container {
      position: relative;
      width: 100%;
      height: 180px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .status-box {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-family: 'Orbitron', sans-serif;
      font-weight: bold;
      font-size: 1rem;
      border: 4px solid #333;
      background: #1a1a1a;
      color: #555;
      transition: all 0.5s ease;
      position: relative;
      z-index: 2;
    }

    .status-box i {
      font-size: 2.5rem;
      margin-bottom: 10px;
      display: block;
    }

    /* Status States */
    .status-open {
      border-color: var(--neon-green);
      color: var(--neon-green);
      background: rgba(0, 255, 157, 0.05);
      box-shadow: 0 0 50px rgba(0, 255, 157, 0.3), inset 0 0 20px rgba(0, 255, 157, 0.1);
      text-shadow: 0 0 10px var(--neon-green);
    }

    .status-close {
      border-color: var(--neon-red);
      color: var(--neon-red);
      background: rgba(255, 42, 109, 0.05);
      box-shadow: 0 0 50px rgba(255, 42, 109, 0.3), inset 0 0 20px rgba(255, 42, 109, 0.1);
      text-shadow: 0 0 10px var(--neon-red);
    }

    /* Indicator Lamp */
    .indicator {
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #444;
      margin-right: 12px;
      transition: all 0.3s;
    }
    .indicator.green { background: var(--neon-green); box-shadow: 0 0 15px var(--neon-green); }
    .indicator.red { background: var(--neon-red); box-shadow: 0 0 15px var(--neon-red); }

    /* List styling */
    #voiceList .list-group-item {
      border-bottom: 1px solid rgba(255,255,255,0.1) !important;
      padding: 12px 0;
      font-size: 0.95rem;
    }
    #voiceList .list-group-item i {
      color: var(--neon-blue);
      margin-right: 10px;
    }

  </style>
</head>

<body>

<div class="container py-5">
  
  <div class="text-center mb-5">
    <h2 class="fw-bold">
      <i class="fas fa-fingerprint me-2"></i> SECURITY ACCESS
    </h2>
    <p class="text-secondary">Voice Biometric System v2.0</p>
  </div>

  <div class="row g-4 justify-content-center">

    <div class="col-lg-4 col-md-6">
      <div class="card h-100 p-4">
        <h5 class="mb-4 text-center border-bottom pb-3" style="border-color: rgba(255,255,255,0.1) !important;">
          <i class="fas fa-user-plus me-2"></i>Database
        </h5>

        <div class="mb-3">
          <label class="small text-secondary mb-1">REGISTER NEW ID</label>
          <input type="text" class="form-control" id="voiceName" placeholder="Masukkan nama...">
        </div>

        <button class="btn btn-custom-outline w-100 py-2 mb-4" onclick="registerVoice()">
          <i class="fas fa-save me-2"></i> SIMPAN SUARA
        </button>

        <div class="mt-auto">
          <h6 class="small text-secondary text-uppercase ls-1">Terdaftar:</h6>
          <ul class="list-group list-group-flush" id="voiceList">
            </ul>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6">
      <div class="card h-100 p-4 text-center d-flex flex-column justify-content-center align-items-center">
        <h5 class="mb-4 text-center" style="border-color: rgba(255,255,255,0.1) !important;">
          <i class="fas fa-microphone-lines me-2"></i>Scanner
        </h5>

        <div class="mic-btn-wrapper mb-4">
          <button class="btn-mic" onclick="startVoice()">
            <i class="fas fa-microphone"></i>
          </button>
        </div>
        
        <p class="small text-secondary">Tap microphone to identify</p>

        <div class="mt-3 p-3 rounded d-flex align-items-center justify-content-center" 
             style="background: rgba(0,0,0,0.2); width: 100%;">
          <div id="lamp" class="indicator"></div>
          <span id="lampText" class="small fw-bold">System Standby</span>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-12">
      <div class="card h-100 p-4">
        <h5 class="mb-4 text-center border-bottom pb-3" style="border-color: rgba(255,255,255,0.1) !important;">
          <i class="fas fa-dungeon me-2"></i>Gate Status
        </h5>

        <div class="status-container">
          <div id="doorStatus" class="status-box">
            <i class="fas fa-lock"></i>
            <div>LOCKED</div>
          </div>
        </div>
        
        <div class="text-center mt-3">
          <small class="text-secondary">Secure Entry Point</small>
        </div>
      </div>
    </div>

  </div>
  
  <footer class="text-center mt-5 text-secondary small">
    &copy; 2024 SecureCorp Systems. All rights reserved.
  </footer>
</div>

<script>
  let registeredVoices = [];

  function registerVoice() {
    const name = document.getElementById("voiceName").value;

    if (!name) {
      Swal.fire({
        icon: 'warning',
        title: 'Oops!',
        text: 'Nama suara belum diisi',
        background: '#1e2a3b',
        color: '#fff'
      });
      return;
    }

    registeredVoices.push(name);

    const li = document.createElement("li");
    li.className = "list-group-item bg-transparent text-white border-0 ps-0";
    li.innerHTML = '<i class="fas fa-waveform"></i> ' + name; 

    document.getElementById("voiceList").appendChild(li);
    document.getElementById("voiceName").value = "";

    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: 'Suara berhasil didaftarkan ke database',
      background: '#1e2a3b',
      color: '#fff',
      confirmButtonColor: '#00f3ff'
    });
  }

  function startVoice() {
    if (registeredVoices.length === 0) {
      Swal.fire({
        icon: 'error',
        title: 'Akses Ditolak',
        text: 'Belum ada suara terdaftar di sistem',
        background: '#1e2a3b',
        color: '#fff'
      });
      return;
    }

    Swal.fire({
      title: "Mendengarkan...",
      text: "Menganalisis pola suara...",
      background: '#1e2a3b',
      color: '#fff',
      timer: 1500,
      showConfirmButton: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    setTimeout(() => {
      const match = Math.random() > 0.5;

      const door = document.getElementById("doorStatus");
      const lamp = document.getElementById("lamp");
      const lampText = document.getElementById("lampText");

      if (match) {
        door.classList.add("status-open");
        door.classList.remove("status-close");
        door.innerHTML = '<i class="fas fa-lock-open"></i><div>UNLOCKED</div>';

        lamp.className = "indicator green";
        lampText.innerText = "Authorized - Access Granted";
        lampText.style.color = "var(--neon-green)";

        Swal.fire({
            icon: 'success',
            title: 'Akses Diterima',
            text: 'Pintu terbuka',
            background: '#1e2a3b',
            color: '#fff',
            confirmButtonColor: '#00ff9d'
        });
      } else {
        door.classList.add("status-close");
        door.classList.remove("status-open");
        door.innerHTML = '<i class="fas fa-lock"></i><div>LOCKED</div>';

        lamp.className = "indicator red";
        lampText.innerText = "Unauthorized - Access Denied";
        lampText.style.color = "var(--neon-red)";

        Swal.fire({
            icon: 'error',
            title: 'Akses Ditolak',
            text: 'Suara tidak dikenali',
            background: '#1e2a3b',
            color: '#fff',
            confirmButtonColor: '#ff2a6d'
        });
      }
    }, 1600);
  }
</script>

</body>
</html>