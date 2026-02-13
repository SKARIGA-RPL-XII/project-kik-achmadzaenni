<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">
    @include('component.v_importcss')
    @vite('resources/css/app.css')
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="overflow-x-hidden antialiased text-gray-800">
    <div class="w-full min-h-screen flex justify-center items-center relative bg-gray-50">
        <div class="absolute top-6 left-6 md:top-8 md:left-8 z-20">
            <img src="{{ asset('image/logo.png') }}" alt="Logo"
                class="w-12 h-12 md:w-16 md:h-16 drop-shadow-md hover:scale-105 transition-transform" />
        </div>
        @if (request()->routeIs('loginForm') || request()->is('loginForm'))
            <div class="w-full absolute top-0 flex justify-center items-center z-0 overflow-hidden">
                <div
                    class="auth-bg-animate bg-gradient-to-b from-[#424E41] to-[#54834E] h-48 md:h-80 w-full rounded-b-[40%] md:rounded-b-[50%] shadow-xl transition-all duration-1000 ease-out transform opacity-0 -translate-y-full scale-110">
                </div>
            </div>
        @elseif (request()->routeIs('otpForm') || request()->is('otpForm'))
        @else
            <div class="w-full absolute bottom-0 flex justify-center items-center z-0 overflow-hidden">
                <div
                    class="auth-bg-animate bg-gradient-to-t from-[#424E41] to-[#54834E] h-40 md:h-96 w-full rounded-t-[40%] md:rounded-t-[50%] shadow-xl transition-all duration-1000 ease-out transform opacity-0 translate-y-full scale-110">
                </div>
            </div>
        @endif

        <main class="w-full relative z-10">
            <?= $content ?>
        </main>
    </div>
    @include('component.v_importjs')

    <script>
        $(document).ready(function() {
            const notyf = new Notyf({
                duration: 3000,
                position: {
                    x: 'right',
                    y: 'top'
                },
                ripple: true,
            });

            const bg = $('.auth-bg-animate');
            if (bg.length) {
                setTimeout(function() {
                    bg.removeClass('opacity-0 translate-y-full -translate-y-full scale-110');
                }, 100);
            }

            $('form[data-ajax-submit]').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const btn = form.find('button[type=submit]');
                const btnText = btn.text();
                const originalContent = btn.html();

                if (btn.length) {
                    btn.prop('disabled', true)
                        .addClass('opacity-80 cursor-not-allowed')
                        .html('<i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Memproses...');
                }
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method') || 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name=_token]').val(),
                        'Accept': 'application/json'
                    },
                    success: function(data) {
                        if (data.msg) {
                            notyf.success(data.msg);
                        }

                        if (data.redirect) {
                            setTimeout(() => {
                                window.location.href = data.redirect;
                            }, 1000);
                        }
                    },
                    error: function(xhr) {
                        const data = xhr.responseJSON;

                        if (data && data.errors) {
                            $.each(data.errors, function(key, messages) {
                                $.each(messages, function(_, msg) {
                                    notyf.error(msg);
                                });
                            });
                        } else if (data && data.msg) {
                            notyf.error(data.msg);
                        } else {
                            notyf.error('Terjadi kesalahan pada server. Silakan coba lagi.');
                        }
                    },
                    complete: function() {
                        if (btn.length) {
                            btn.prop('disabled', false)
                                .removeClass('opacity-80 cursor-not-allowed')
                                .html(originalContent);
                        }
                    }
                });
            });
            $('#togglePassword').on('click', function() {
                const passwordInput = $('#password');
                const icon = $(this).find('i');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);

                if (type === 'text') {
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
            $('#resendBtn').on('click', function(e) {
                e.preventDefault();
                const btn = $(this);
                const originalText = btn.text();

                btn.prop('disabled', true).text('Mengirim...');

                const url = btn.data('url');
                const method = btn.data('method');

                $.ajax({
                    url: url,
                    method: method,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name=_token]').val(),
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        if (res.msg) notyf.success(res.msg);
                    },
                    error: function(xhr) {
                        const res = xhr.responseJSON;
                        if (res && res.msg) notyf.error(res.msg);
                        else notyf.error('Gagal mengirim ulang.');
                    },
                    complete: function() {
                        btn.prop('disabled', false).text(originalText);
                    }
                });
            });
        });
    </script>
</body>

</html>
