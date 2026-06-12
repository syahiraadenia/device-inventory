<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NetBox Inventory')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root { --primary-color: #3b82f6; --bg-color: #f8fafc; --sidebar-bg: #ffffff; }
        
        body { 
            background-color: var(--bg-color); 
            font-family: 'Inter', sans-serif; 
            color: #334155; 
            font-size: 0.95rem;
        }

        /* Sidebar Modern */
        .sidebar { 
            position: fixed; top: 0; bottom: 0; left: 0; z-index: 100; 
            width: 260px; background-color: var(--sidebar-bg); 
            border-right: 1px solid #e2e8f0; 
            padding: 20px;
        }

        .brand { 
            font-size: 1.1rem; font-weight: 700; color: #1e293b; 
            margin-bottom: 2rem; padding-left: 10px;
        }

        .menu-label { 
            font-size: 0.7rem; font-weight: 700; color: #94a3b8; 
            text-transform: uppercase; letter-spacing: 0.05em; 
            margin-top: 1.5rem; margin-bottom: 0.5rem; padding-left: 10px;
        }

        .nav-link { 
            color: #64748b !important; padding: 10px 12px; 
            border-radius: 8px; font-weight: 500; transition: all 0.2s;
            display: flex; align-items: center;
        }

        .nav-link:hover { background-color: #f1f5f9; color: #0f172a !important; }
        
        .nav-link.active { 
            background-color: var(--primary-color); color: #ffffff !important; 
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .main-content { margin-left: 260px; padding: 40px; }

        /* Card Modern */
        .card { border-radius: 12px; border: 1px solid #e2e8f0; }
        .btn-primary { background-color: var(--primary-color); border-radius: 8px; border: none; padding: 10px 20px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand"><i class="bi bi-box-seam text-primary me-2"></i>NETBOX INV</div>
        
        <div class="nav flex-column">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>

            <div class="menu-label">Equipment</div>
            <a href="{{ route('devices.index') }}" class="nav-link {{ Request::is('devices*') ? 'active' : '' }}"><i class="bi bi-hdd-network me-2"></i> Devices</a>
            <a href="{{ route('device-roles.index') }}" class="nav-link {{ Request::is('device-roles*') ? 'active' : '' }}"><i class="bi bi-tags me-2"></i> Device Roles</a>
            <a href="{{ route('platforms.index') }}" class="nav-link {{ Request::is('platforms*') ? 'active' : '' }}"><i class="bi bi-cpu me-2"></i> Platforms</a>

            <div class="menu-label">Organization</div>
            <a href="{{ route('sites.index') }}" class="nav-link {{ Request::is('sites*') ? 'active' : '' }}"><i class="bi bi-building me-2"></i> Sites</a>

            <div class="menu-label">Device Types</div>
            <a href="{{ route('manufacturers.index') }}" class="nav-link {{ Request::is('manufacturers*') ? 'active' : '' }}"><i class="bi bi-gear me-2"></i> Manufacturers</a>
            <a href="{{ route('device-types.index') }}" class="nav-link {{ Request::is('device-types*') ? 'active' : '' }}"><i class="bi bi-layers me-2"></i> Device Types</a>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>