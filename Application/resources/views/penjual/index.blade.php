<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">
    @vite('resources/css/app.css')
    <title><?= $title ?></title>
</head>
<body>
    <div class="w-full min-h-screen">
        <div class="flex justify-between gap-3">
            @include('penjual.template.sidebar')
            <div class="w-full flex-col">
                @include('penjual.template.header')
                <div class="p-4">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>