<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">
    @vite('resources/css/app.css')
    <title>Forbidden</title>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <div class="flex justify-center">
                <dotlottie-wc src="https://lottie.host/2d1fb64f-2b38-40b0-a72d-08a934f4c96f/EtSQurNuiB.lottie"
                    style="width: 220px; height: 220px" autoplay loop>
                </dotlottie-wc>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mt-4">
                Akses Ditolak
            </h1>
            <p class="text-gray-600 mt-2 text-sm">
                Anda tidak memiliki akses ke
                <span class="font-semibold text-red-600">
                    {{ request()->path() }}
                </span>.
                Silakan kembali ke halaman yang tersedia.
            </p>
        </div>
        <div class="mt-6 w-full flex justify-center items-center gap-3">
            <a href="/"
                class="w-full text-white bg-success hover:bg-success-strong focus:ring-4 focus:ring-success-medium
                       shadow-lg font-medium rounded-base text-sm px-5 py-2.5 transition-all scale-100 hover:scale-102">
                Dashboard
            </a>
            <a href="javascript:history.back()"
                class="w-full text-white bg-success hover:bg-success-strong focus:ring-4 focus:ring-success-medium
                       shadow-lg font-medium rounded-base text-sm px-5 py-2.5 transition-all scale-100 hover:scale-102">
                Kembali
            </a>
        </div>
        </div>
    </div>
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.11/dist/dotlottie-wc.js" type="module"></script>
</body>
</html>
