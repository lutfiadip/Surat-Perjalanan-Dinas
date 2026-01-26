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
            <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-600 text-xs">
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
                <div style="margin-top: 3px;">
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="block w-full rounded-md border-0 py-2.5 px-3 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-[#1C6DD0] sm:text-sm sm:leading-6">
                </div>
            </div>

            <div class="flex items-center justify-between" style="margin-top: 10px;">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-[#1C6DD0] focus:ring-[#1C6DD0]">
                    <label for="remember" class="ml-2 block text-sm text-slate-900">Ingat Saya</label>
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