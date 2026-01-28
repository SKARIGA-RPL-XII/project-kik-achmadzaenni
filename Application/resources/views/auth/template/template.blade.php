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
    <div class="w-full min-h-screen flex justify-center items-center">
        <div class="top-0 left-5 absolute flex flex-col justify-center items-center">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="w-16 h-16 mb-4 z-5" />
        </div>
        @if (request()->routeIs('loginForm') || request()->is('loginForm'))
            <div class="w-full absolute top-0 flex justify-center items-center z-0">
                <div
                    class="auth-bg-animate bg-[#424E41]/70 h-40 md:h-60 w-full rounded-b-[50%] transition-all duration-700 ease-in-out transform opacity-0 -translate-y-8 scale-95">
                </div>
            </div>
        @elseif (request()->routeIs('otpForm') || request()->is('otpForm'))
        @else
            <div class="w-full absolute bottom-0 flex justify-center items-center z-0">
                <div
                    class="auth-bg-animate bg-[#424E41]/90 h-30 md:h-70 w-full rounded-t-[50%] transition-all duration-700 ease-in-out transform opacity-0 translate-y-8 scale-95">
                </div>
            </div>
        @endif
        <?= $content ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bg = document.querySelector('.auth-bg-animate');
            if (!bg) return;
            requestAnimationFrame(function() {
                bg.classList.remove('opacity-0', 'translate-y-8', '-translate-y-8', 'scale-95');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form[data-ajax-submit]').forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    form.querySelectorAll('.ajax-error, .ajax-success').forEach(el => el
                    .remove());

                    const formData = new FormData(form);
                    const btn = form.querySelector('button[type=submit]');
                    if (btn) {
                        btn.disabled = true;
                        btn.innerText = 'Loading...';
                    }

                    try {
                        const res = await fetch(form.action, {
                            method: form.method || 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const data = await res.json();

                        if (res.ok) {
                            if (data.msg) {
                                form.insertAdjacentHTML('afterbegin', `
                            <div class="ajax-success mb-4 text-green-600 text-sm">
                                ${data.msg}
                            </div>
                        `);
                            }

                            if (data.redirect) {
                                setTimeout(() => {
                                    window.location.href = data.redirect;
                                }, 800);
                            }
                        }
                        else {
                            showErrors(form, data);
                        }

                    } catch (err) {
                        form.insertAdjacentHTML('afterbegin', `
                    <div class="ajax-error mb-4 text-red-600 text-sm">
                        Terjadi kesalahan server
                    </div>
                `);
                    } finally {
                        if (btn) {
                            btn.disabled = false;
                            btn.innerText = 'Submit';
                        }
                    }
                });

            });

            function showErrors(form, data) {
                if (data.errors) {
                    Object.values(data.errors).forEach(messages => {
                        messages.forEach(msg => {
                            form.insertAdjacentHTML('afterbegin', `
                        <div class="ajax-error mb-2 text-red-600 text-sm">${msg}</div>
                    `);
                        });
                    });
                } else if (data.msg) {
                    form.insertAdjacentHTML('afterbegin', `
                <div class="ajax-error mb-4 text-red-600 text-sm">${data.msg}</div>
            `);
                }
            }
        });
    </script>
</body>

</html>
