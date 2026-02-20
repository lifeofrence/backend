<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }} - Abuja International Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d0d0d;
            color: #e5e5e5;
        }

        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-link:hover {
            background: rgba(220, 131, 61, 0.1);
            color: #DC833D;
        }

        .sidebar-link.active {
            background: #DC833D;
            color: white;
        }

        .btn-primary {
            background: #DC833D;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #b06931;
            transform: translateY(-1px);
        }

        .card {
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 12px;
        }

        input,
        textarea,
        select {
            background: #262626 !important;
            border: 1px solid #333 !important;
            color: white !important;
        }

        input:focus {
            border-color: #DC833D !important;
            ring-color: #DC833D !important;
        }
    </style>
</head>

<body>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 glass border-r border-white/10 hidden md:flex flex-col">
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}">
                    <h1 class="text-xl font-bold tracking-wider text-[#DC833D]">HOTEL ADMIN</h1>
                </a>
                <p class="text-xs text-zinc-500 uppercase mt-1">Abuja International</p>
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                @hasanyrole('Super Admin|Admin|Leadership Manager|Viewer')
                <a href="{{ route('admin.leadership.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg sidebar-link {{ request()->routeIs('admin.leadership.*') ? 'active' : '' }}">
                    Leadership
                </a>
                @endhasanyrole

                @hasanyrole('Super Admin|Admin|Corporate Actions Manager|Viewer')
                <a href="{{ route('admin.corporate-actions.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg sidebar-link {{ request()->routeIs('admin.corporate-actions.*') ? 'active' : '' }}">
                    Corporate Actions
                </a>
                @endhasanyrole

                @hasanyrole('Super Admin|Admin|Financial Reports Manager|Viewer')
                <a href="{{ route('admin.financial-reports.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg sidebar-link {{ request()->routeIs('admin.financial-reports.*') ? 'active' : '' }}">
                    Financial Reports
                </a>
                @endhasanyrole

                @hasanyrole('Super Admin|Admin|Gallery Manager|Viewer')
                <a href="{{ route('admin.gallery.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                    Gallery
                </a>
                @endhasanyrole

                @role('Super Admin')
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    Manage Users
                </a>
                @endrole
            </nav>

            <div class="p-4 border-t border-white/10">
                <div class="flex items-center space-x-3 px-4 py-2">
                    <div class="w-8 h-8 rounded-full bg-[#DC833D] flex items-center justify-center font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-[10px] text-zinc-500 hover:text-white transition-colors uppercase cursor-pointer">
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header
                class="h-16 glass flex items-center justify-between px-8 border-b border-white/10 sticky top-0 z-30">
                <h2 class="text-lg font-medium text-white">{{ $title ?? 'Dashboard' }}</h2>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-zinc-400">{{ now()->format('D, M d, Y') }}</span>
                </div>
            </header>

            <div class="p-8">
                @if(session('success'))
                    <div
                        class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-lg text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>