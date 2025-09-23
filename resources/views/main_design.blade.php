<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Harano Biggopti</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
    }

    /* Header */
    header {
      background: #fff;
      border-bottom: 1px solid #d8f3dc;
      padding: 15px 8%;
      position: sticky;
      top: 0;
      z-index: 1000;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      font-size: 24px;
      font-weight: 700;
      color: #2d6a4f;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    nav ul li a {
      text-decoration: none;
      color: #2d6a4f;
      font-weight: 500;
      transition: 0.3s;
    }

    nav ul li a:hover {
      color: #1b4332;
    }

    /* Hero Section with Unique Banner */
    .hero {
      position: relative;
      background: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
        url('https://images.unsplash.com/photo-1524592094714-0f0654e20314?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
      min-height: 80vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 40px 20px;
      color: #fff;
    }

    .hero-content {
      max-width: 700px;
      z-index: 2;
    }

    .hero-content h2 {
      font-size: 44px;
      font-weight: 700;
      margin-bottom: 15px;
      color: #d8f3dc;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.5);
    }

    .hero-content p {
      font-size: 18px;
      margin-bottom: 25px;
      color: #f1faee;
    }

    .hero-content button {
      padding: 12px 28px;
      border: none;
      border-radius: 30px;
      background: #52b788;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
      box-shadow: 0 4px 12px rgba(82, 183, 136, 0.4);
    }

    .hero-content button:hover {
      background: #40916c;
    }

    /* Cards Section */
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 25px;
      padding: 60px 10%;
    }

    .card {
      background: #fff;
      padding: 25px;
      border-radius: 14px;
      border: 1px solid #d8f3dc;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(82, 183, 136, 0.2);
    }

    .card h3 {
      margin-bottom: 12px;
      color: #2d6a4f;
      font-size: 20px;
    }

    .card p {
      font-size: 15px;
      color: #495057;
    }
    .cards a.card {
        text-decoration: none; /* removes underline */
        color: inherit; /* ensures text color matches card */
        display: block; /* ensures the whole card is clickable */
    }

    /* Call to Action */
    .cta {
      background: #d8f3dc;
      text-align: center;
      padding: 60px 20px;
    }

    .cta h2 {
      margin-bottom: 15px;
      font-size: 28px;
      color: #1b4332;
    }

    .cta p {
      margin-bottom: 20px;
      color: #2d6a4f;
      font-size: 16px;
    }

    .cta button {
      background: #2d6a4f;
      color: #fff;
      padding: 12px 25px;
      border-radius: 30px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: 0.3s;
    }

    .cta button:hover {
      background: #1b4332;
    }

    /* Footer */
    footer {
      background: #fff;
      border-top: 1px solid #d8f3dc;
      color: #2d6a4f;
      padding: 15px;
      text-align: center;
      font-size: 14px;
    }

    /* Smooth Scroll */
    html {
      scroll-behavior: smooth;
    }

  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <h1>Harano Biggopti</h1>
    <nav>
      <ul>
        <li><a href="{{ route('index') }}">Home</a></li>
        @auth
            <li><a href="{{ route('post.all_posts') }}">All Posts</a></li>
        @else
            <li><a href="{{ route('login') }}">All Posts</a></li>
        @endauth

        <li><a href="#">Report</a></li>
        <li><a href="#">Contact</a></li>

        @if (Auth::check())
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        @else
        <li><a href="{{ route('login') }}">Log In</a></li>
        <li><a href="{{ route('register') }}">Sign Up</a></li>
        @endif
        
      </ul>
    </nav>
  </header>

  <section>
    @yield('index')
    @yield('post.all_posts')
    @yield('post.view_post_details')
  </section>


  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Harano Biggopti. All Rights Reserved.</p>
  </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
