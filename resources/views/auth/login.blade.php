<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Harano Biggopti</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: #f6fff8;
      color: #1b4332;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .login-container {
      background: #fff;
      padding: 40px 35px;
      border-radius: 16px;
      border: 1px solid #d8f3dc;
      box-shadow: 0 6px 20px rgba(0,0,0,0.06);
      width: 100%;
      max-width: 420px;
      text-align: center;
    }

    .login-container h1 {
      font-size: 26px;
      font-weight: 700;
      color: #2d6a4f;
      margin-bottom: 10px;
    }

    .login-container p {
      color: #495057;
      font-size: 15px;
      margin-bottom: 25px;
    }

    .form-group {
      text-align: left;
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      font-weight: 600;
      color: #2d6a4f;
    }

    .form-group input {
      width: 100%;
      padding: 12px 14px;
      border: 1px solid #d8f3dc;
      border-radius: 10px;
      font-size: 15px;
      transition: border 0.3s;
    }

    .form-group input:focus {
      border-color: #52b788;
      outline: none;
    }

    .btn-login {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 30px;
      background: #52b788;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s, box-shadow 0.3s;
      margin-top: 10px;
    }

    .btn-login:hover {
      background: #40916c;
      box-shadow: 0 4px 12px rgba(82,183,136,0.4);
    }

    .extra-links {
      margin-top: 18px;
      font-size: 14px;
    }

    .extra-links a {
      color: #2d6a4f;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }

    .extra-links a:hover {
      color: #1b4332;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 8px; /* space between checkbox and text */
        margin-bottom: 18px;
        font-size: 14px;
        color: #495057;
    }

    .remember input {
        transform: scale(1.1); /* slightly larger for visibility */
        cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h1>Welcome Back</h1>
    <p>Please login to continue</p>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email -->
      <div class="form-group">
        <label for="email">Email Address</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
          <span style="color: red; font-size: 13px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Password -->
      <div class="form-group">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @error('password')
          <span style="color: red; font-size: 13px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Remember Me -->
    <div class="remember">
        <input type="checkbox" id="remember_me" name="remember">
        <label for="remember_me">Remember Me</label>
    </div>

      <!-- Login Button -->
      <button type="submit" class="btn-login">Login</button>
    </form>

    <div class="extra-links">
      @if (Route::has('password.request'))
        <p><a href="{{ route('password.request') }}">Forgot Password?</a></p>
      @endif
      <p>Don’t have an account? <a href="{{ route('register') }}">Register</a></p>
    </div>
  </div>

</body>
</html>
