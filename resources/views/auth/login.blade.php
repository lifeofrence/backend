<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abuja International Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url('/images/hero-img.jpg');
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

        input {
            background: #1a1a1a !important;
            border: 1px solid #333 !important;
            color: white !important;
        }

        input:focus {
            border-color: #DC833D !important;
            outline: none;
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

<body class="min-h-screen flex items-center justify-center p-6 bg-black">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold tracking-tighter text-[#DC833D]">Abuja International Hotels</h1>
            <p class="text-zinc-500 uppercase text-[10px] tracking-[0.2em] mt-2">Portal </p>
        </div>

        <div class="glass p-8 rounded-2xl shadow-2xl">
            <!-- <p class="text-sm text-zinc-400 mb-8 leading-relaxed">
                Forgot your password? No problem. Just let us know your email address and we will email you a password
                reset link.
            </p> -->

            @if(session('status'))
                <div
                    class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-lg text-xs font-medium">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-lg text-xs">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-500">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-xl focus:ring-0">
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-500">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-[10px] text-[#DC833D] hover:underline uppercase tracking-widest font-bold">Forgot?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 rounded-xl focus:ring-0 pr-12">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-500 hover:text-[#DC833D] transition-colors focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" id="eye-icon" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <script>
                    function togglePassword() {
                        const passwordInput = document.getElementById('password');
                        const eyeIcon = document.getElementById('eye-icon');

                        if (passwordInput.type === 'password') {
                            passwordInput.type = 'text';
                            eyeIcon.innerHTML = `
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            `;
                        } else {
                            passwordInput.type = 'password';
                            eyeIcon.innerHTML = `
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            `;
                        }
                    }
                </script>

                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-zinc-800 text-[#DC833D] focus:ring-[#DC833D] bg-zinc-900">
                        <span class="ms-3 text-xs text-zinc-400">Keep me signed in</span>
                    </label>
                </div>

                <button type="submit"
                    class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-[0.2em] shadow-lg shadow-[#DC833D]/20">
                    ACCESS DASHBOARD
                </button>
            </form>


        </div>
    </div>
</body>

</html>