<div class="flex justify-center items-center">
    <form method="POST" action="{{ route('otpProcess') }}" data-ajax-submit
        class="w-full max-w-md border-2 border-[#54834E] bg-white p-8 rounded-3xl
               flex flex-col gap-6 shadow-lg">
        @csrf

        <div class="text-center">
            <h1 class="text-2xl font-semibold">OTP Verification</h1>
            <p class="text-gray-600 mt-1">
                Masukkan 6 digit kode OTP yang dikirim ke email Anda
            </p>
        </div>

        <div class="flex justify-center gap-3">
            @for ($i = 0; $i < 6; $i++)
                <input type="text" maxlength="1" inputmode="numeric"
                    class="otp-input w-12 h-12 md:w-14 md:h-14
                           text-center text-xl font-semibold
                           border-2 border-[#54834E]
                           rounded-xl shadow
                           focus:outline-none focus:ring-2 focus:ring-[#54834E]">
            @endfor
        </div>
        <input type="hidden" name="otp" id="otp">
        <button type="submit"
            class="w-full bg-[#54834E] text-white py-2 rounded-lg shadow
                   hover:bg-[#2E973E] transition cursor-pointer">
            Verify OTP
        </button>

        <div class="flex flex-col gap-3 pt-4 border-t border-gray-200">
            <button type="button" id="resendBtn"
                class="hover:text-blue-600 cursor-pointer disabled:cursor-not-allowed">
                Kirim Ulang Email
            </button>
            <p id="timerDisplay" class="text-center text-sm text-gray-600 hidden">
                Tunggu <span id="countdown">300</span> detik sebelum mengirim ulang
            </p>
        </div>
    </form>
</div>
<script>
    const inputs = document.querySelectorAll('.otp-input');
    const otpHidden = document.getElementById('otp');
    const resendBtn = document.getElementById('resendBtn');
    const timerDisplay = document.getElementById('timerDisplay');
    const countdownSpan = document.getElementById('countdown');

    let resendTimeout;
    const RESEND_TIMEOUT = 300; // 5 menit dalam detik

    // Cek localStorage untuk waktu terakhir resend
    function initializeResendButton() {
        const lastResendTime = localStorage.getItem('lastOtpResendTime');
        const now = Date.now();

        if (lastResendTime) {
            const timeDiff = Math.floor((now - parseInt(lastResendTime)) / 1000);
            const remainingTime = RESEND_TIMEOUT - timeDiff;

            if (remainingTime > 0) {
                startCountdown(remainingTime);
            } else {
                enableResendButton();
            }
        } else {
            enableResendButton();
        }
    }

    function startCountdown(seconds) {
        resendBtn.disabled = true;
        timerDisplay.classList.remove('hidden');
        let remaining = seconds;

        const timer = setInterval(() => {
            remaining--;
            countdownSpan.textContent = remaining;

            if (remaining <= 0) {
                clearInterval(timer);
                enableResendButton();
            }
        }, 1000);
    }

    function enableResendButton() {
        resendBtn.disabled = false;
        timerDisplay.classList.add('hidden');
    }

    // Event listener untuk tombol resend
    resendBtn.addEventListener('click', async (e) => {
        e.preventDefault();

        try {
            const response = await fetch('{{ route('otpResend') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            if (response.ok) {
                localStorage.setItem('lastOtpResendTime', Date.now().toString());
                startCountdown(RESEND_TIMEOUT);
                const {
                    toast
                } = window.sonner;
                toast.success('OTP telah dikirim ulang ke email Anda', {
                    duration: 4000,
                    position: 'top-right',
                });
            } else {
                const {
                    toast
                } = window.sonner;
                toast.error('Gagal mengirim ulang OTP. Silakan coba lagi.', {
                    duration: 4000,
                    position: 'top-right',
                });
            }
        } catch (error) {
            console.error('Error:', error);
            const {
                toast
            } = window.sonner;
            toast.error('Terjadi kesalahan. Silakan coba lagi.', {
                duration: 4000,
                position: 'top-right',
            });
        }
    });

    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            if (input.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
            updateOtp();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
    });

    function updateOtp() {
        otpHidden.value = Array.from(inputs)
            .map(input => input.value)
            .join('');
    }

    initializeResendButton();
</script>
