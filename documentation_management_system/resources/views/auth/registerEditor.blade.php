<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register as Editor</title>
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
      background: url('{{ asset('images/registration.png') }}') no-repeat center center / cover;
      height: 100vh;
      position: relative;
      overflow: hidden;
    }

    .logo-icon {
      width: 28px;
      height: 28px;
    }

    .company-logo {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 40px;
      display: flex;
      align-items: center;
      gap: 10px;
      color: white;
    }

    .company-logo i {
      font-size: 24px;
      color: #00bfff;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.5);
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: 1;
    }

    .page-wrapper {
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

    .logo {
      color: #fff;
      font-size: 26px;
      font-weight: medium;
      margin-bottom: 20px;
    }

    .form-wrapper {
      backdrop-filter: blur(12px);
      padding: 30px;
    }

    .register-title {
      font-size: 38px;
      margin-bottom: 30px;
      font-weight: 600;
      color: #fff;
    }

    .form-group {
      margin-bottom: 20px;
      position: relative;
    }

    .form-group input {
      width: 144%;
      padding: 20px;
      border: none;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.15);
      color: white;
      font-size: 14px;
      outline: none;
    }

    .form-group input::placeholder {
      color: #ccc;
    }

    .form-group .icon {
      position: absolute;
      right: -126px;
      top: 50%;
      transform: translateY(-50%);
      color: #ccc;
      font-size: 16px;
    }

    .form-group .icon-eye {
      cursor: pointer;
    }

    .btn {
      background-color: #00bfff;
      color: white;
      border: none;
      padding: 16px;
      width: 144%;
      border-radius: 30px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #009fe3;
    }

    .login-link {
      margin-top: 20px;
      font-size: 14px;
      color: #fff;
      text-align: center;
      width: 144%;
    }

    .login-link a {
      color: #00bfff;
      text-decoration: none;
      font-weight: 500;
    }

    .footer {
      position: absolute;
      bottom: 20px;
      left: 40px;
      font-size: 13px;
      color: #ccc;
      z-index: 3;
    }

    .footer i {
      margin-right: 6px;
    }
  </style>
</head>
<body>
  <div class="overlay"></div>

  <div class="page-wrapper">
    <div class="company-logo">
      <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414
              5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
      SmartDocs
    </div>

    <div class="form-wrapper">
      <div class="register-title">Access as Editor</div>

      <form method="POST" action="{{ route('editor.register') }}">
        @csrf

        <div class="form-group">
          <input type="text" name="first_name" placeholder="First Name" required />
          <i class="fas fa-user icon"></i>
        </div>

        <div class="form-group">
          <input type="text" name="last_name" placeholder="Last Name" required />
          <i class="fas fa-user icon"></i>
        </div>

        <div class="form-group">
          <input type="email" name="email" placeholder="Email" required />
          <i class="fas fa-envelope icon"></i>
        </div>

        <div class="form-group">
          <input type="password" name="password" id="password" placeholder="Password" required />
          <i class="fas fa-eye icon icon-eye" id="togglePassword" onclick="togglePassword()"></i>
        </div>

        <div class="form-group">
          <input type="password" name="password_confirmation" id="confirmPassword" placeholder="Confirm Password" required />
          <i class="fas fa-eye icon icon-eye" id="toggleConfirmPassword" onclick="toggleConfirmPassword()"></i>
        </div>

        <button type="submit" class="btn">Register</button>
      </form>

      <div class="login-link">
        Already have an account? <a href="{{ route('editor.login') }}">Login</a>
      </div>
      <div class="login-link">
        Want to explore an articles? <a href="{{ route('register') }}">Register as user</a>
      </div>
    </div>

    <div class="footer">
      <i class="far fa-copyright"></i> 2025, Smart Docs
    </div>
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

    function toggleConfirmPassword() {
      const passwordField = document.getElementById("confirmPassword");
      const icon = document.getElementById("toggleConfirmPassword");

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
