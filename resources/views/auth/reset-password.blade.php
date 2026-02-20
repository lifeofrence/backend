<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Abuja International Hotels</title>
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
            <p class="text-zinc-500 uppercase text-[10px] tracking-[0.2em] mt-2">New Password Setup</p>
        </div>

        <div class="glass p-8 rounded-2xl shadow-2xl">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-lg text-xs">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-500">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required
                        class="w-full px-4 py-3 rounded-xl focus:ring-0">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-500">New Password</label>
                    <input type="password" name="password" required autofocus
                        class="w-full px-4 py-3 rounded-xl focus:ring-0">
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase tracking-widest text-zinc-500">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 rounded-xl focus:ring-0">
                </div>

                <button type="submit"
                    class="btn-primary w-full py-4 rounded-xl text-white font-bold tracking-[0.2em] shadow-lg shadow-[#DC833D]/20">
                    UPDATE PASSWORD
                </button>
            </form>
        </div>
    </div>
</body>

</html>