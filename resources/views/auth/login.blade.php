<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - SPD Sistem Perjalanan Dinas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
</head>

<body
    class="bg-[#FFF8F3] font-sans antialiased text-slate-900 h-screen flex items-center justify-center relative overflow-hidden"
    style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <!-- Background Gradients -->
    <div class="absolute -top-40 -right-40 -z-10 h-[500px] w-[500px] rounded-full bg-[#A3E4DB]/60 blur-3xl filter">
    </div>
    <div class="absolute top-20 -left-20 -z-10 h-[300px] w-[300px] rounded-full bg-[#FED1EF]/60 blur-3xl filter"></div>
    <div
        class="absolute bottom-0 right-0 -z-10 h-[600px] w-[600px] translate-y-1/2 rounded-full bg-[#1C6DD0]/20 blur-3xl filter">
    </div>

    <div class="w-full max-w-sm bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/50"
        style="max-width: 350px; width: 100%; padding: 25px; margin: auto;">
        <div class="text-center" style="margin-bottom: 25px;">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Masuk SPD</h1>
            <p class="mt-2 text-xs text-slate-500">Silakan login untuk mengakses sistem</p>
        </div>

        @if(session('error'))
            <div class="mb-4 p-3 rounded-xl bg-red-100 border border-red-400 text-red-700 text-sm font-medium text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div>
                <label for="username" class="block text-sm font-medium leading-6 text-slate-900">Username</label>
                <div style="margin-top: 3px;">
                    <input id="username" name="username" type="text" required autocomplete="username"
                        class="block w-full rounded-md border-0 py-2.5 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-[#1C6DD0] sm:text-sm sm:leading-6">
                </div>
            </div>

            <div style="margin-top: 10px;">
                <label for="password" class="block text-sm font-medium leading-6 text-slate-900">Password</label>
                <div class="relative" style="margin-top: 3px;">
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="block w-full rounded-md border-0 py-2.5 px-3 pr-10 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-[#1C6DD0] sm:text-sm sm:leading-6">
                    <button type="button" onclick="togglePassword()"
                        style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; padding: 0; cursor: pointer; z-index: 10;"
                        class="text-gray-500 hover:text-[#1C6DD0] focus:outline-none">
                        {{-- Eye Slash (Closed Eye) - Default Visible (Password Hidden) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5" id="eye-slash-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                        {{-- Eye (Open Eye) - Default Hidden (Password Visible) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 hidden" id="eye-icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <script>
                function togglePassword() {
                    const passwordInput = document.getElementById('password');
                    const eyeIcon = document.getElementById('eye-icon');
                    const eyeSlashIcon = document.getElementById('eye-slash-icon');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeSlashIcon.classList.add('hidden');
                        eyeIcon.classList.remove('hidden');
                    } else {
                        passwordInput.type = 'password';
                        eyeSlashIcon.classList.remove('hidden');
                        eyeIcon.classList.add('hidden');
                    }
                }
            </script>

            <div class="flex items-center justify-between" style="margin-top: 10px;">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-[#1C6DD0] focus:ring-[#1C6DD0]">
                    <label for="remember" class="ml-2 block text-sm text-slate-900" style="margin-left: 5px;">Ingat
                        Saya</label>
                </div>
            </div>


            <div style="margin-top: 20px;">
                <button type="submit"
                    class="flex w-full justify-center rounded-xl bg-[#1C6DD0] px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-[#1653a1] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1C6DD0] transition-colors">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</body>

</html>