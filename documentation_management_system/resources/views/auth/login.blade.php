<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User Login</title>
  <link
    rel="stylesheet"
    href="https://use.fontawesome.com/releases/v6.5.0/css/all.css"
  />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: url('{{ asset('images/login.png') }}') no-repeat center center / cover;
      height: 100vh;
      position: relative;
      overflow: hidden;
    }

    .logo-icon {
      width: 28px;
      height: 28px;
    }

    .overlay-gradient {
      position: absolute;
      width: 100%;
      height: 100%;
      background: linear-gradient(to right, rgba(0, 0, 0, 0.65) 35%, rgba(0, 0, 0, 0.2) 100%);
      z-index: 1;
    }

    .login-wrapper {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      justify-content: center;
      height: 100%;
      padding-left: 80px;
      max-width: 500px;
      color: white;
    }

    .company-logo {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 40px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .company-logo i {
      font-size: 24px;
      color: #00bfff;
    }

    .login-title {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 40px;
    }

    .login-form {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(12px);
      padding: 30px;
      border-radius: 16px;
      width: 100%;
      color: white;
    }

    .form-group {
      position: relative;
      margin-bottom: 25px;
    }

    .form-group input {
      width: 100%;
      padding: 14px 45px 14px 16px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      font-size: 14px;
      outline: none;
    }

    .form-group input::placeholder {
      color: #ccc;
    }

    .form-group i {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #ccc;
      cursor: pointer;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      margin-bottom: 20px;
    }

    .form-actions a {
      color: #00bfff;
      text-decoration: none;
    }

    .btn-login {
      background-color: #00bfff;
      color: white;
      border: none;
      width: 100%;
      padding: 14px;
      border-radius: 30px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn-login:hover {
      background-color: #0099cc;
    }

    .bottom-text {
      font-size: 13px;
      margin-top: 20px;
      color: #ccc;
    }

    .bottom-text a {
      color: #00bfff;
      text-decoration: none;
      font-weight: 500;
    }

    .footer {
      position: absolute;
      bottom: 20px;
      left: 80px;
      font-size: 13px;
      color: #ccc;
      z-index: 3;
    }
  </style>
</head>
<body>
  @if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        {{ $errors->first() }}
    </div>
@endif

  <div class="overlay-gradient"></div>

  <div class="login-wrapper">
    <div class="company-logo">
      <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414
              5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
      SmartDocs
    </div>

    <div class="login-title"> Hey, <br />
        Welcome Back.</div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

      <div class="form-group">
        <input type="email" name="email" placeholder="Email" required />
        <i class="fas fa-envelope"></i>
      </div>

      <div class="form-group">
        <input type="password" name="password" id="password" placeholder="Password" required />
        <i class="fas fa-eye" id="togglePassword" onclick="togglePassword()"></i>
      </div>

      <div class="form-actions">
        <a href="{{ route('password.request') }}">Forgot password?</a>
      </div>

      <button type="submit" class="btn-login">Login</button>

      <div class="bottom-text">
        New user? <a href="{{ route('register') }}">Create a free account</a>
      </div>
      <div class="bottom-text">
        Organize the reports? <a href="{{ route('editor.login') }}">Login as editor</a>
      </div>
    </form>
  </div>

  <div class="footer">
    © 2025, Smart Docs
  </div>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById("password");
      const icon = document.getElementById("togglePassword");

      if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
  </script>
</body>
</html>