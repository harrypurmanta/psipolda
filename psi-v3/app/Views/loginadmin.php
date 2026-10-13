<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Administrator | Bagian Psikologi Polda Sumsel</title>
  <link rel="icon" href="<?= base_url() ?>/images/bg/favicon.ico" type="image/x-icon">

  <!-- Google Fonts: Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=fallback" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Bootstrap 4 & AdminLTE -->
  <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">

  <style>
    :root {
      --primary-color: #1f4e38;
      --primary-dark: #143526;
      --primary-light: #2c6e50;
      --accent-gold: #c69214;
      --accent-gold-hover: #db9f18;
      --card-bg: rgba(16, 26, 20, 0.88);
      --card-border: rgba(255, 255, 255, 0.12);
      --text-muted: #9eb1a6;
      --input-bg: rgba(255, 255, 255, 0.08);
      --input-border: rgba(255, 255, 255, 0.16);
      --input-focus: rgba(44, 110, 80, 0.4);
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      min-height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: #0f1c15;
      background-image: 
        radial-gradient(circle at 15% 20%, rgba(44, 110, 80, 0.45) 0%, transparent 40%),
        radial-gradient(circle at 85% 80%, rgba(198, 146, 20, 0.25) 0%, transparent 40%),
        linear-gradient(135deg, rgba(8, 15, 11, 0.92) 0%, rgba(15, 28, 21, 0.94) 100%),
        url('<?= base_url() ?>/images/bg/bglogin.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      padding: 1.5rem 1rem;
      position: relative;
      overflow-x: hidden;
      overflow-y: auto;
    }

    /* Ambient animated subtle aura */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: radial-gradient(circle at 50% 50%, rgba(31, 78, 56, 0.2) 0%, transparent 70%);
      pointer-events: none;
      z-index: 0;
    }

    .admin-login-wrapper {
      position: relative;
      z-index: 1;
      width: 100%;
      max-width: 410px;
      margin: auto 0;
    }

    /* Glassmorphism Card */
    .admin-card {
      background: var(--card-bg);
      backdrop-filter: blur(24px);
      -webkit-backdrop-filter: blur(24px);
      border: 1px solid var(--card-border);
      border-radius: 18px;
      box-shadow: 
        0 20px 40px -15px rgba(0, 0, 0, 0.6),
        0 0 0 1px rgba(255, 255, 255, 0.05),
        inset 0 1px 0 rgba(255, 255, 255, 0.15);
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Top decorative gradient bar */
    .admin-card-header-bar {
      height: 4px;
      background: linear-gradient(90deg, #1f4e38, #c69214, #2c6e50);
      width: 100%;
    }

    .admin-card-body {
      padding: 1.6rem 1.6rem 1.35rem 1.6rem;
    }

    @media (max-width: 480px) {
      .admin-card-body {
        padding: 1.35rem 1.15rem 1.15rem 1.15rem;
      }
    }

    /* Logo & Branding */
    .brand-header {
      text-align: center;
      margin-bottom: 1.1rem;
    }

    .logo-container {
      width: 62px;
      height: 62px;
      margin: 0 auto 0.6rem;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.06);
      border: 2px solid rgba(198, 146, 20, 0.5);
      padding: 3px;
      box-shadow: 
        0 0 18px rgba(198, 146, 20, 0.25),
        inset 0 0 10px rgba(0, 0, 0, 0.4);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .logo-container:hover {
      transform: scale(1.05);
      box-shadow: 0 0 25px rgba(198, 146, 20, 0.45);
    }

    .logo-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .admin-badge {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      padding: 0.25rem 0.75rem;
      font-size: 0.68rem;
      font-weight: 700;
      letter-spacing: 0.07em;
      text-transform: uppercase;
      color: #ffd875;
      background: rgba(198, 146, 20, 0.15);
      border: 1px solid rgba(198, 146, 20, 0.35);
      border-radius: 999px;
      margin-bottom: 0.5rem;
    }

    .brand-title {
      color: #ffffff;
      font-weight: 800;
      font-size: 1.15rem;
      letter-spacing: -0.01em;
      margin-bottom: 0.15rem;
      line-height: 1.25;
    }

    .brand-subtitle {
      color: var(--text-muted);
      font-size: 0.8rem;
      font-weight: 500;
      margin-bottom: 0;
      letter-spacing: 0.01em;
    }

    /* Form Fields */
    .form-group-custom {
      margin-bottom: 1rem;
    }

    .form-label-custom {
      display: block;
      color: #d1ded7;
      font-size: 0.8rem;
      font-weight: 600;
      letter-spacing: 0.02em;
      margin-bottom: 0.45rem;
    }

    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-icon-left {
      position: absolute;
      left: 1rem;
      color: #7d9688;
      font-size: 0.95rem;
      pointer-events: none;
      z-index: 2;
      transition: color 0.2s ease;
    }

    .custom-input {
      width: 100%;
      height: 48px;
      padding: 0.65rem 1rem 0.65rem 2.75rem;
      background: var(--input-bg);
      border: 1px solid var(--input-border);
      border-radius: 12px;
      color: #ffffff !important;
      font-size: 0.925rem;
      font-weight: 500;
      transition: all 0.25s ease;
      outline: none;
    }

    .custom-input.with-toggle {
      padding-right: 2.75rem;
    }

    .custom-input::placeholder {
      color: #637b6f;
      font-size: 0.875rem;
    }

    .custom-input:focus {
      background: rgba(255, 255, 255, 0.12);
      border-color: #3b9169;
      box-shadow: 0 0 0 3.5px var(--input-focus);
    }

    .input-wrapper:focus-within .input-icon-left {
      color: #55c490;
    }

    /* Password Toggle */
    .password-toggle-btn {
      position: absolute;
      right: 0.75rem;
      background: transparent;
      border: none;
      color: #7d9688;
      font-size: 0.95rem;
      padding: 0.5rem;
      cursor: pointer;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: color 0.2s ease;
    }

    .password-toggle-btn:hover {
      color: #ffffff;
    }

    .password-toggle-btn:focus {
      outline: none;
    }

    /* Caps Lock Warning */
    .caps-warning {
      display: none;
      align-items: center;
      gap: 0.35rem;
      color: #ffc107;
      font-size: 0.75rem;
      font-weight: 600;
      margin-top: 0.35rem;
    }

    /* Custom Alert */
    .alert-custom-danger {
      background: rgba(220, 53, 69, 0.18);
      border: 1px solid rgba(220, 53, 69, 0.4);
      color: #ff99a4;
      border-radius: 12px;
      padding: 0.75rem 1rem;
      font-size: 0.85rem;
      font-weight: 500;
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.6rem;
      animation: shakeX 0.4s ease-in-out;
    }

    @keyframes shakeX {
      0%, 100% { transform: translateX(0); }
      20%, 60% { transform: translateX(-6px); }
      40%, 80% { transform: translateX(6px); }
    }

    /* Buttons */
    .btn-login {
      width: 100%;
      height: 48px;
      background: linear-gradient(135deg, #245e43 0%, #17422e 100%);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 12px;
      color: #ffffff;
      font-size: 0.95rem;
      font-weight: 700;
      letter-spacing: 0.02em;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      box-shadow: 0 4px 14px rgba(23, 66, 46, 0.4);
      margin-top: 0.5rem;
    }

    .btn-login:hover {
      background: linear-gradient(135deg, #2d7353 0%, #1e533b 100%);
      transform: translateY(-1.5px);
      box-shadow: 0 6px 20px rgba(23, 66, 46, 0.6);
      color: #ffffff;
    }

    .btn-login:active {
      transform: translateY(0);
      box-shadow: 0 2px 8px rgba(23, 66, 46, 0.4);
    }

    .btn-login:disabled {
      opacity: 0.7;
      cursor: not-allowed;
      transform: none !important;
    }

    /* Secondary Navigation Links */
    .secondary-links {
      margin-top: 1.25rem;
      padding-top: 1rem;
      border-top: 1px solid rgba(255, 255, 255, 0.08);
      display: flex;
      flex-direction: column;
      gap: 0.6rem;
      align-items: center;
      text-align: center;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      color: var(--text-muted);
      font-size: 0.825rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s ease;
    }

    .back-link:hover {
      color: #e0ece4;
      text-decoration: none;
      transform: translateX(-2px);
    }

    .register-link {
      font-size: 0.8rem;
      color: #a3b8ad;
      text-decoration: none;
    }

    .register-link a {
      color: #e0a96d;
      font-weight: 600;
      text-decoration: none;
      transition: color 0.2s;
    }

    .register-link a:hover {
      color: #ffd875;
      text-decoration: underline;
    }

    /* Footer Copyright */
    .admin-footer {
      text-align: center;
      margin-top: 1rem;
      color: rgba(255, 255, 255, 0.45);
      font-size: 0.75rem;
      font-weight: 500;
      line-height: 1.4;
    }

    .spinner-border-sm {
      display: none;
    }
  </style>
</head>
<body>

  <div class="admin-login-wrapper">
    <div class="admin-card">
      <div class="admin-card-header-bar"></div>

      <div class="admin-card-body">
        
        <!-- Header / Logo -->
        <div class="brand-header">
          <div class="logo-container">
            <img src="<?= base_url() ?>/images/bg/logopsi.jpg" alt="Logo Psikologi Polri">
          </div>
          <div>
            <span class="admin-badge">
              <i class="fas fa-shield-alt"></i> Area Administrator
            </span>
          </div>
          <h1 class="brand-title">Bagian Psikologi</h1>
          <p class="brand-subtitle">Biro SDM Polda Sumatera Selatan</p>
        </div>

        <!-- Flash Message Alert -->
        <?php if (session()->getFlashdata('error')) : ?>
          <div class="alert-custom-danger" role="alert">
            <i class="fas fa-exclamation-circle fa-lg"></i>
            <div><?= esc(session()->getFlashdata('error')) ?></div>
          </div>
        <?php endif; ?>

        <!-- Form Login Admin -->
        <form id="formAdminLogin" action="<?= base_url() ?>/belakang/checklogin" method="post" autocomplete="off">
          <?= csrf_field() ?>

          <!-- Input Username -->
          <div class="form-group-custom">
            <label for="adminUsername" class="form-label-custom">Username</label>
            <div class="input-wrapper">
              <i class="fas fa-user-shield input-icon-left"></i>
              <input 
                type="text" 
                id="adminUsername" 
                name="username" 
                class="custom-input" 
                placeholder="Masukkan username admin" 
                required 
                autofocus
                autocomplete="username"
              >
            </div>
          </div>

          <!-- Input Password -->
          <div class="form-group-custom">
            <label for="adminPassword" class="form-label-custom">Password</label>
            <div class="input-wrapper">
              <i class="fas fa-lock input-icon-left"></i>
              <input 
                type="password" 
                id="adminPassword" 
                name="password" 
                class="custom-input with-toggle" 
                placeholder="Masukkan password" 
                required
                autocomplete="current-password"
              >
              <button 
                type="button" 
                id="togglePasswordBtn" 
                class="password-toggle-btn" 
                title="Tampilkan / Sembunyikan Password"
                aria-label="Tampilkan / Sembunyikan Password"
              >
                <i class="fas fa-eye" id="togglePasswordIcon"></i>
              </button>
            </div>
            <!-- Caps Lock Alert -->
            <div id="capsLockWarning" class="caps-warning">
              <i class="fas fa-exclamation-triangle"></i> Peringatan: Caps Lock aktif
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" id="btnSubmit" class="btn-login">
            <span class="spinner-border spinner-border-sm" id="btnSpinner" role="status" aria-hidden="true"></span>
            <i class="fas fa-sign-in-alt" id="btnIcon"></i>
            <span id="btnText">Masuk ke Panel</span>
          </button>

          <!-- Links -->
          <div class="secondary-links">
            <a href="<?= base_url() ?>" class="back-link">
              <i class="fas fa-arrow-left"></i> Kembali ke Portal Peserta
            </a>
            <div class="register-link">
              Peserta baru belum punya akun? <a href="<?= base_url() ?>/login/register">Daftar di sini</a>
            </div>
          </div>

        </form>

      </div>
    </div>

    <!-- Footer Copyright -->
    <div class="admin-footer">
      <div>&copy; <?= date('Y') ?> Bagian Psikologi Biro SDM Polda Sumsel</div>
      <div style="font-size: 0.7rem; opacity: 0.7; margin-top: 2px;">Sistem CAT Psikologi Terpadu</div>
    </div>
  </div>

  <!-- jQuery & Bootstrap 4 -->
  <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    (function() {
      // Toggle Password Visibility
      var passInput = document.getElementById('adminPassword');
      var toggleBtn = document.getElementById('togglePasswordBtn');
      var toggleIcon = document.getElementById('togglePasswordIcon');
      var capsWarning = document.getElementById('capsLockWarning');
      var loginForm = document.getElementById('formAdminLogin');
      var btnSubmit = document.getElementById('btnSubmit');
      var btnSpinner = document.getElementById('btnSpinner');
      var btnIcon = document.getElementById('btnIcon');
      var btnText = document.getElementById('btnText');

      if (toggleBtn && passInput) {
        toggleBtn.addEventListener('click', function(e) {
          e.preventDefault();
          if (passInput.type === 'password') {
            passInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
          } else {
            passInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
          }
        });
      }

      // Caps Lock Detection
      if (passInput && capsWarning) {
        passInput.addEventListener('keyup', function(e) {
          if (e.getModifierState && e.getModifierState('CapsLock')) {
            capsWarning.style.display = 'flex';
          } else {
            capsWarning.style.display = 'none';
          }
        });
      }

      // Submit state
      if (loginForm && btnSubmit) {
        loginForm.addEventListener('submit', function() {
          btnSubmit.disabled = true;
          if (btnSpinner) btnSpinner.style.display = 'inline-block';
          if (btnIcon) btnIcon.style.display = 'none';
          if (btnText) btnText.textContent = 'Memverifikasi...';
        });
      }
    })();
  </script>
</body>
</html>