<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Harano Biggopti</title>
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

    .register-container {
      background: #fff;
      padding: 40px 35px;
      border-radius: 16px;
      border: 1px solid #d8f3dc;
      box-shadow: 0 6px 20px rgba(0,0,0,0.06);
      width: 100%;
      max-width: 480px;
      text-align: center;
    }

    .register-container h1 {
      font-size: 26px;
      font-weight: 700;
      color: #2d6a4f;
      margin-bottom: 10px;
    }

    .register-container p {
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

    .btn-register {
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

    .btn-register:hover {
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
  </style>
</head>
<body>

  <div class="register-container">
    <h1>Create Account</h1>
    <p>Join Harano Biggopti and be part of the community</p>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div class="form-group">
        <label for="name">Full Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
          <span style="color: red; font-size: 13px;">{{ $message }}</span>
        @enderror
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="email">Email Address</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
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

      <!-- Confirm Password -->
      <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
      </div>

      <!-- Register Button -->
      <button type="submit" class="btn-register">Register</button>
    </form>

    <div class="extra-links">
      <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
  </div>

</body>
</html>
