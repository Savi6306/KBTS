<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Agent Panel</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ===========================
           Modern Gradient Navbar
        ============================ */
        .agent-nav {
            background: linear-gradient(90deg, #1d2671, #c33764);
            padding: 12px 0;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.18);
        }

        .agent-nav .navbar-brand {
            font-size: 22px;
            font-weight: 700;
        }

        .agent-nav .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            padding: 8px 14px !important;
            margin-right: 10px;
            border-radius: 6px;
            transition: 0.3s ease;
        }

        .agent-nav .nav-link.active,
        .agent-nav .nav-link:hover {
            background: rgba(255,255,255,0.25);
            color: #fff !important;
        }

        /* Right Profile Box */
        .agent-profile-name {
            color: #fff;
            font-weight: 600;
            margin-right: 6px;
        }

        .dropdown-menu {
            border-radius: 10px;
            padding: 8px 0;
        }

        body {
            background: #f5f7fc;
        }

    </style>

</head>
<body>

    {{-- ==================== NAVBAR ======================= --}}
    <nav class="navbar navbar-expand-lg agent-nav">
        <div class="container">

            {{-- Logo --}}
            <a class="navbar-brand text-white" href="{{ route('agent.dashboard') }}">
                KBTS Agent
            </a>

            {{-- Mobile Menu Button --}}
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#agentNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Collapsible Menu --}}
            <div class="collapse navbar-collapse" id="agentNavbar">

                {{-- LEFT MENU --}}
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}"
                           href="{{ route('agent.dashboard') }}">
                           <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('agent.tickets.*') ? 'active' : '' }}"
                           href="{{ route('agent.tickets.index') }}">
                           <i class="bi bi-ticket-perforated-fill me-1"></i> Tickets
                        </a>
                    </li>

                </ul>

                {{-- RIGHT MENU (Profile Dropdown) --}}
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                           href="#" id="agentDropdown" role="button"
                           data-bs-toggle="dropdown">

                            {{-- Avatar --}}
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&size=32&background=c33764&color=ffffff"
                                 class="rounded-circle me-2" width="32" height="32">

                            <span class="agent-profile-name">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow">

                            <li>
                                <a class="dropdown-item" href="{{ route('agent.profile.edit') }}">
                                    <i class="bi bi-person-circle me-2"></i> Profile
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger fw-semibold">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>

                        </ul>

                    </li>
                </ul>

            </div>

        </div>
    </nav>


     {{-- ==================== MAIN PAGE CONTENT ======================= --}}
    <div class="container py-4">

        {{-- FLASH MESSAGES --}}
        @if (session('success'))
            <div class="alert alert-success mb-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mb-3">
                {{ session('error') }}
            </div>
        @endif

        {{-- PAGE CONTENT --}}
        @yield('content')

    </div>



    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
