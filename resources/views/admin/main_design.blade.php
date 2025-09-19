<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Harano Biggopti - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f9f9f9;
      color: #333;
    }
    .sidebar {
      background: #fff;
      border-right: 1px solid #e0e0e0;
      padding: 20px;
    }
    .sidebar h2 {
      font-size: 20px;
      font-weight: 600;
      margin-bottom: 30px;
      color: #2e7d32;
    }
    .sidebar a {
      color: #444;
      text-decoration: none;
      display: block;
      padding: 10px 15px;
      margin: 6px 0;
      border-radius: 6px;
      transition: background 0.2s;
    }
    .sidebar a:hover, .sidebar a.active {
      background: #e8f5e9;
      color: #2e7d32;
    }
    .submenu a {
      padding-left: 35px;
      font-size: 14px;
      color: #555;
    }
    .dashboard-card {
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 20px;
      background: #fff;
      text-align: center;
      transition: transform 0.2s;
    }
    .dashboard-card:hover {
      transform: translateY(-3px);
    }
    .dashboard-card h2 {
      font-size: 28px;
      margin: 10px 0;
      color: #2e7d32;
    }
    .dashboard-card h5 {
      font-size: 16px;
      color: #666;
    }
    .topbar {
      background: #fff;
      border-bottom: 1px solid #e0e0e0;
      padding: 12px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    /* Modal */
    .stylish-modal {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    overflow: hidden;
    animation: fadeUp 0.4s ease;
}

.stylish-header {
    background: linear-gradient(135deg, #2e7d32, #43a047);
    padding: 1rem;
}

.info-box {
    background: #fff;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    transition: transform 0.2s;
}
.info-box:hover {
    transform: translateY(-3px);
}

.preview-img-small {
    width: 60px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
    margin: 3px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    transition: transform 0.2s;
}
.preview-img-small:hover {
    transform: scale(1.1);
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Harano Biggopti</h2>

        <a href="{{ route('index') }}" class="active"><i class="fa fa-home me-2"></i> Home</a>

        <!-- Report Dropdown -->
        <a data-bs-toggle="collapse" href="#reportMenu" role="button" aria-expanded="false" aria-controls="reportMenu">
            <i class="fa fa-file-alt me-2"></i> Report <i class="fa fa-chevron-down float-end"></i>
        </a>
        <div class="collapse submenu" id="reportMenu">
            <a href="{{ route('admin.post.add_post') }}">➤ Add Post</a>
            <a href="{{ route('admin.post.view_post') }}">➤ View Post</a>
        </div>

        <!-- Categories Dropdown -->
        <a data-bs-toggle="collapse" href="#categoryMenu" role="button" aria-expanded="false" aria-controls="categoryMenu">
            <i class="fa fa-list me-2"></i> Categories <i class="fa fa-chevron-down float-end"></i>
        </a>
        <div class="collapse submenu" id="categoryMenu">
            <a href="{{ route('admin.category.add_category') }}">➤ Add Category</a>
            <a href="{{ route('admin.category.view_category') }}">➤ View Categories</a>
        </div>

        <!-- Users -->
        <a href="#"><i class="fa fa-users me-2"></i> Users</a>
    </div>
    <!-- Main Content -->
    <div class="flex-grow-1">
      <!-- Topbar -->
      <div class="topbar">
        <span>Dashboard</span>
        <div class="list-inline-item logout">
        <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-sign-out-alt me-1"></i> {{ __('Log Out') }}
                </button>
            </form>
        </div>
      </div>

      <!-- Dashboard Cards -->
      <div class="container-fluid p-4">
        <div class="row g-4">
          <div class="col-md-3 col-sm-6">
            <div class="dashboard-card">
              <h5>Lost Items</h5>
              <h2>120</h2>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="dashboard-card">
              <h5>Found Items</h5>
              <h2>95</h2>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="dashboard-card">
              <h5>Returned</h5>
              <h2>48</h2>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="dashboard-card">
              <h5>Pending</h5>
              <h2>32</h2>
            </div>
          </div>
          <section>
            @yield('add_category')
            @yield('view_category')
            @yield('update_category')
            @yield('add_post')
            @yield('view_post')
            @yield('update_post')
        </section>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
