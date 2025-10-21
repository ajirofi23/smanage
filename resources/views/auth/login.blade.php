<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - AICC SHE Portal</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <style>
    /* ========== ANIMASI MASUK/KELUAR ========== */
    body {
      opacity: 0;
      transform: translateY(10px);
      transition: opacity 0.6s ease, transform 0.6s ease;
      background: #f9fafb;
    }
    body.loaded { opacity: 1; transform: translateY(0); }
    body.fade-out { opacity: 0; transform: translateY(-10px); }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

    /* ========== DESKTOP LAYOUT ========== */
    @media (min-width: 768px) {
      .container {
        display: flex;
        min-height: 100vh;
        width: 100%;
      }

      .motto-section {
        flex: 1;
        background: linear-gradient(135deg, #1a365d 0%, #2d4a6f 50%, #364e68 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        color: white;
      }

      .pattern {
        position: absolute;
        border-radius: 50%;
        opacity: 0.08;
        animation: float 20s infinite ease-in-out;
      }
      .pattern-1 { width: 300px; height: 300px; background: #ff6b35; top: -80px; left: -80px; }
      .pattern-2 { width: 200px; height: 200px; background: #fff; bottom: -50px; right: -50px; animation-delay: 5s; }
      .pattern-3 { width: 150px; height: 150px; background: #ff6b35; top: 50%; right: 10%; animation-delay: 10s; }

      @keyframes float {
        0%,100% { transform: translate(0,0) scale(1); }
        33% { transform: translate(30px,-30px) scale(1.1); }
        66% { transform: translate(-20px,20px) scale(0.9); }
      }

      .motto-content {
        z-index: 1;
        text-align: center;
        max-width: 500px;
        padding: 2rem;
        animation: fadeInUp 1s ease both;
      }

      .motto-icon { font-size: 4rem; color: #ff6b35; margin-bottom: 1.5rem; }
      .motto-title { font-size: 2.5rem; font-weight: 700; margin-bottom: 0.75rem; text-shadow: 1px 1px 3px rgba(0,0,0,0.25); }
      .motto-subtitle { font-size: 1.1rem; color: #e0e7ff; line-height: 1.6; margin-bottom: 1.5rem; }
      .motto-tagline {
        display: inline-block;
        padding: 0.8rem 1.5rem;
        border-radius: 999px;
        background: rgba(255,255,255,0.08);
        color: #ffb08a;
        border: 1px solid rgba(255,255,255,0.1);
        font-weight: 600;
      }

      .login-section {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem;
        background: #fff;
        position: relative;
      }

      .corner-decoration {
        position: absolute;
        width: 90px;
        height: 90px;
        border: 3px solid #ff6b35;
        opacity: 0.18;
      }
      .corner-top-right { top: 18px; right: 18px; border-left: none; border-bottom: none; }
      .corner-bottom-left { bottom: 18px; left: 18px; border-right: none; border-top: none; }

      .login-container {
        width: 100%;
        max-width: 420px;
        padding: 2.5rem 2rem;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 20px 40px rgba(31,41,55,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      .login-container:hover {
        transform: translateY(-3px);
        box-shadow: 0 25px 45px rgba(31,41,55,0.12);
      }

      .login-header { text-align: center; margin-bottom: 1.5rem; }
      .login-logo { font-weight: 700; font-size: 1.6rem; color: #111827; }
      .login-logo .highlight {
        background: linear-gradient(135deg,#ff6b35 0%,#ff8c61 100%);
        color: #fff;
        padding: 0 10px;
        border-radius: 8px;
      }
    }

    /* ========== MOBILE LAYOUT ========== */
    @media (max-width: 767px) {
      body {
        background: linear-gradient(135deg, #1a365d 0%, #364e68 100%);
        overflow-x: hidden;
      }

      .container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
      }

      .motto-section { display: none !important; }

      .login-container {
        width: 100%;
        max-width: 360px;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(255,255,255,0.2);
        box-shadow: 0 20px 45px rgba(0,0,0,0.2);
        animation: zoomIn 0.6s ease both;
      }

      .login-header { text-align: center; margin-bottom: 1rem; }
      .login-logo { font-size: 1.4rem; font-weight: 700; color: #111827; }
      .login-logo .highlight {
        background: linear-gradient(135deg,#ff6b35 0%,#ff8c61 100%);
        color: #fff;
        padding: 0 10px;
        border-radius: 8px;
      }
    }

    /* ========== FORM STYLING ========== */
    h2 {
      font-size: 1.1rem;
      color: #333;
      text-align: center;
      margin: 15px 0 25px;
      font-weight: 600;
    }

    .alert-modern {
      padding: 0.9rem;
      border-radius: 12px;
      background: #fff5f5;
      border: 1px solid #fed7d7;
      color: #dc2626;
      display: flex;
      gap: 0.6rem;
      align-items: flex-start;
      margin-bottom: 15px;
      font-size: 0.9rem;
    }

    .input-group { margin-bottom: 1.2rem; }
    .input-group label {
      display: block;
      font-size: 0.9rem;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
    }

    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      font-size: 1rem;
    }

    input[type="email"],
    input[type="password"],
    input[type="text"] {
      width: 100%;
      padding: 0.75rem 42px 0.75rem 42px;
      border-radius: 12px;
      border: 2px solid #e5e7eb;
      background: #fafafa;
      font-size: 0.95rem;
      transition: all 0.2s ease;
    }

    input:focus {
      outline: none;
      border-color: #ff6b35;
      background: #fff;
      box-shadow: 0 0 0 4px rgba(255,107,53,0.1);
    }

    .password-toggle {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #9ca3af;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .password-toggle:hover {
      background: rgba(255,107,53,0.1);
      color: #ff6b35;
    }

    .password-toggle.visible {
      background: rgba(255,107,53,0.15);
      color: #ff6b35;
    }

    .character {
      width: 20px;
      height: 20px;
    }

    .eyes-normal, .eyes-peek, .eyes-blink, .mouth-smile, .mouth-tongue, .eyebrows, .cheeks {
      transition: opacity 0.3s ease;
    }

    /* Default state: eyes normal, mouth smile, eyebrows normal, cheeks visible */
    .password-toggle .eyes-normal,
    .password-toggle .mouth-smile,
    .password-toggle .eyebrows,
    .password-toggle .cheeks {
      opacity: 1;
    }

    .password-toggle .eyes-peek,
    .password-toggle .eyes-blink,
    .password-toggle .mouth-tongue {
      opacity: 0;
    }

    /* Visible password: eyes peek, mouth smile, eyebrows raised, cheeks blush more */
    .password-toggle.visible .eyes-normal {
      opacity: 0;
    }

    .password-toggle.visible .eyes-peek {
      opacity: 1;
    }

    .password-toggle.visible .mouth-smile {
      opacity: 1;
    }

    .password-toggle.visible .eyebrows {
      opacity: 0.7;
      transform: translateY(-0.5px);
    }

    .password-toggle.visible .cheeks {
      opacity: 0.6;
    }

    /* Error state: eyes blink, mouth tongue, eyebrows furrowed, cheeks red */
    .password-toggle.error .eyes-normal,
    .password-toggle.error .eyes-peek,
    .password-toggle.error .mouth-smile,
    .password-toggle.error .eyebrows {
      opacity: 0;
    }

    .password-toggle.error .eyes-blink,
    .password-toggle.error .mouth-tongue {
      opacity: 1;
    }

    .password-toggle.error .cheeks {
      opacity: 0.8;
      fill: #ff6b35;
    }

    /* Error + visible: same as error */
    .password-toggle.error.visible .eyes-normal,
    .password-toggle.error.visible .eyes-peek,
    .password-toggle.error.visible .mouth-smile,
    .password-toggle.error.visible .eyebrows {
      opacity: 0;
    }

    .password-toggle.error.visible .eyes-blink,
    .password-toggle.error.visible .mouth-tongue {
      opacity: 1;
    }

    .password-toggle.error.visible .cheeks {
      opacity: 0.8;
      fill: #ff6b35;
    }

    .submit-button {
      width: 100%;
      padding: 0.85rem;
      border: none;
      border-radius: 12px;
      background: linear-gradient(135deg,#ff6b35 0%,#ff8c61 100%);
      color: #fff;
      font-weight: 700;
      font-size: 1rem;
      cursor: pointer;
      box-shadow: 0 8px 25px rgba(255,107,53,0.3);
      transition: all 0.3s ease;
    }

    .submit-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 30px rgba(255,107,53,0.4);
    }

    .extra-links {
      margin-top: 15px;
      text-align: center;
      font-size: 0.9rem;
    }

    .extra-links a {
      color: #ff6b35;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }

    .extra-links a:hover { color: #ff8c61; }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes zoomIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="motto-section">
      <div class="pattern pattern-1"></div>
      <div class="pattern pattern-2"></div>
      <div class="pattern pattern-3"></div>
      <div class="motto-content">
        <div class="motto-icon"><i class="fas fa-shield-alt"></i></div>
        <div class="motto-title">Safety First, Always</div>
        <div class="motto-subtitle">Komitmen kami untuk menciptakan lingkungan kerja yang aman dan sehat bagi seluruh tim.</div>
        <div class="motto-tagline"><i class="fas fa-heart"></i> Your Safety, Our Priority</div>
      </div>
    </div>

    <div class="login-section">
      <div class="corner-decoration corner-top-right"></div>
      <div class="corner-decoration corner-bottom-left"></div>

      <div class="login-container">
        <div class="login-header">
          <div class="login-logo"><span class="highlight">AICC</span> SHE</div>
        </div>

        <h2>Portal Dashboard Login</h2>

        @if ($errors->any())
        <div class="alert-modern">
          <div class="icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
          <div>
            <strong>Login Gagal</strong>
            <div>{{ $errors->first() }}</div>
          </div>
        </div>
        @endif

        <form class="animate__animated animate__fadeInUp" action="{{ route('login') }}" method="POST" id="loginForm" novalidate>
          @csrf
          <div class="input-group">
            <label for="email">Email</label>
            <div class="input-wrapper">
              <i class="fas fa-envelope input-icon"></i>
              <input type="email" id="email" name="email" placeholder="Masukkan Email Anda" required autocomplete="email">
            </div>
          </div>

          <div class="input-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
              <i class="fas fa-lock input-icon"></i>
              <input type="password" id="password" name="password" placeholder="Masukkan Password" required autocomplete="current-password">
              <span class="password-toggle @if ($errors->any()) error @endif" id="pwToggle" title="Lihat password">
                <svg class="character" viewBox="0 0 24 24">
                  <!-- Face outline -->
                  <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="1.5" />

                  <!-- Eyebrows -->
                  <g class="eyebrows">
                    <path d="M6 8 Q8 7 10 8" stroke="currentColor" stroke-width="1" fill="none" stroke-linecap="round" />
                    <path d="M14 8 Q16 7 18 8" stroke="currentColor" stroke-width="1" fill="none" stroke-linecap="round" />
                  </g>

                  <!-- Eyes normal -->
                  <g class="eyes-normal">
                    <circle cx="8" cy="10" r="2.5" fill="currentColor" />
                    <circle cx="16" cy="10" r="2.5" fill="currentColor" />
                    <!-- Eye highlights -->
                    <circle cx="7.5" cy="9" r="0.5" fill="white" opacity="0.8" />
                    <circle cx="15.5" cy="9" r="0.5" fill="white" opacity="0.8" />
                  </g>

                  <!-- Eyes peek -->
                  <g class="eyes-peek">
                    <ellipse cx="8" cy="10" rx="2.5" ry="0.8" fill="currentColor" />
                    <ellipse cx="16" cy="10" rx="2.5" ry="0.8" fill="currentColor" />
                  </g>

                  <!-- Eyes blink -->
                  <g class="eyes-blink">
                    <ellipse cx="8" cy="10" rx="2.5" ry="0.2" fill="currentColor" />
                    <ellipse cx="16" cy="10" rx="2.5" ry="0.2" fill="currentColor" />
                  </g>

                  <!-- Nose -->
                  <ellipse cx="12" cy="12" rx="0.5" ry="0.8" fill="currentColor" opacity="0.6" />

                  <!-- Mouth smile -->
                  <g class="mouth-smile">
                    <path d="M8 15 Q12 17.5 16 15" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" />
                  </g>

                  <!-- Mouth tongue -->
                  <g class="mouth-tongue">
                    <path d="M8 15 Q12 17.5 16 15" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" />
                    <ellipse cx="12" cy="16.5" rx="1.2" ry="2" fill="#ff6b35" />
                    <ellipse cx="12" cy="17" rx="0.8" ry="1.2" fill="#ffb08a" />
                  </g>

                  <!-- Cheeks (blush) -->
                  <g class="cheeks">
                    <circle cx="6" cy="13" r="1.5" fill="#ffb08a" opacity="0.4" />
                    <circle cx="18" cy="13" r="1.5" fill="#ffb08a" opacity="0.4" />
                  </g>
                </svg>
              </span>
            </div>
          </div>

          <button type="submit" class="submit-button"><i class="fas fa-sign-in-alt"></i> Login</button>
        </form>

        <div class="extra-links">
          <a href="#"><i class="fas fa-key"></i> Lupa Password?</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Toggle Password Visibility
    document.getElementById('pwToggle').addEventListener('click', function(e) {
      e.preventDefault();
      const pw = document.getElementById('password');
      if (pw.type === 'password') {
        pw.type = 'text';
        this.classList.add('visible');
        // Remove error state when toggling to allow normal animation
        this.classList.remove('error');
      } else {
        pw.type = 'password';
        this.classList.remove('visible');
        // Re-add error state if there were errors (for persistent error display)
        if (document.querySelector('.alert-modern')) {
          this.classList.add('error');
        }
      }
    });

    // Page Load Animation
    window.addEventListener("load", () => {
      document.body.classList.add("loaded");
    });

    // Smooth Page Transition
    document.querySelectorAll("a").forEach(link => {
      if (link.getAttribute("target") === "_blank" || link.href.includes('#')) return;
      link.addEventListener("click", e => {
        e.preventDefault();
        document.body.classList.add("fade-out");
        setTimeout(() => window.location = link.href, 400);
      });
    });
  </script>
</body>
</html>
