<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - Abuja International Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.9)), url('/images/hero-img.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            color: #e5e5e5;
        }

        .glass {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-primary {
            background: #DC833D;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #b06931;
            transform: translateY(-1px);
        }
    </style>
</head>

<body class="flex items-center justify-center p-6 bg-black">
    <div class="w-full max-w-lg">
        <div class="glass p-12 rounded-3xl shadow-2xl text-center">
            <div class="mb-8 flex justify-center">
                <div
                    class="w-24 h-24 rounded-full bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m0-8v6m-5 2h10a2 2 0 002-2v-4a2 2 0 00-2-2H7a2 2 0 00-2 2v4a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            <h1 class="text-6xl font-black tracking-tighter text-white mb-4">403</h1>
            <h2 class="text-2xl font-bold text-[#DC833D] mb-4 uppercase tracking-widest">Access Restricted</h2>
            <p class="text-zinc-500 mb-10 leading-relaxed text-sm">
                Deeply sorry, but you do not have the required security clearances to view this page. If you believe
                this is an error, please contact the System Administrator.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('admin.dashboard') }}"
                    class="btn-primary px-8 py-4 rounded-xl text-white font-bold tracking-[0.2em] text-xs shadow-lg shadow-[#DC833D]/20">
                    RETURN TO DASHBOARD
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-4 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-zinc-400 font-bold tracking-[0.2em] text-xs transition-all">
                        SIGN OUT
                        </a>
                </form>
            </div>
        </div>

        <p class="text-center mt-12 text-zinc-600 text-[10px] uppercase tracking-widest font-medium">
            &copy; Abuja International Hotels LTD. Security Systems
        </p>
    </div>
</body>

</html>