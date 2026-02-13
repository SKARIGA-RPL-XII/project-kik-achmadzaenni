<div class="flex justify-center items-center z-10 w-full px-4 py-8">
    <form method="POST" action="{{ route('otpProcess') }}" data-ajax-submit
        class="w-full max-w-md bg-white/95 backdrop-blur-sm p-8 md:p-10 rounded-3xl flex flex-col gap-8 shadow-2xl border border-white/20 relative overflow-hidden text-center">
        
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#54834E] to-[#88c47e]"></div>
        
        @csrf

        <div class="space-y-2">
            <div class="w-16 h-16 bg-green-50 text-[#54834E] rounded-full flex items-center justify-center mx-auto mb-4 border border-green-100 shadow-sm">
                <i class="fa-solid fa-shield-halved text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Verifikasi OTP</h1>
            <p class="text-gray-500 text-sm max-w-xs mx-auto">
                Kode 6 digit telah dikirim ke email Anda. Silakan masukkan kode tersebut di bawah ini.
            </p>
        </div>

        <div class="flex justify-center gap-2 sm:gap-3">
            @for ($i = 0; $i < 6; $i++)
                <input type="text" maxlength="1" inputmode="numeric" autocomplete="one-time-code"
                    class="otp-input w-11 h-12 sm:w-14 sm:h-14 text-center text-2xl font-bold text-gray-700 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#54834E] focus:border-[#54834E] focus:bg-white transition-all shadow-sm placeholder-gray-300"
                    placeholder="•">
            @endfor
        </div>
        
        <input type="hidden" name="otp" id="otp">

        <button type="submit"
            class="w-full bg-gradient-to-r from-[#54834E] to-[#40663a] hover:from-[#40663a] hover:to-[#2e4d29] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-green-900/20 hover:shadow-green-900/40 transform active:scale-[0.98] transition-all duration-200">
            Verifikasi
        </button>

        <div class="pt-6 border-t border-gray-100">
            <p class="text-sm text-gray-500 mb-3">Tidak menerima kode?</p>
            
            <button type="button" id="resendBtn" 
                data-url="{{ route('otpResend') }}" 
                data-method="POST"
                class="text-sm font-bold text-[#54834E] hover:text-[#2E973E] hover:underline transition-colors disabled:opacity-50 disabled:cursor-not-allowed disabled:no-underline">
                Kirim Ulang Kode
            </button>
            
            <p id="timerDisplay" class="text-xs text-gray-400 mt-2 hidden flex items-center justify-center gap-1">
                <i class="fa-regular fa-clock"></i> Tunggu <span id="countdown" class="font-bold text-gray-600">300</span> detik lagi
            </p>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = document.querySelectorAll('.otp-input');
        const otpHidden = document.getElementById('otp');
        const resendBtn = document.getElementById('resendBtn');
        const timerDisplay = document.getElementById('timerDisplay');
        const countdownSpan = document.getElementById('countdown');
        const form = document.querySelector('form');

        inputs[0].focus();

        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                input.value = input.value.replace(/[^0-9]/g, '');

                if (input.value) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    } 
                }
                updateOtp();
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
                
                if (pastedData) {
                    pastedData.split('').forEach((char, i) => {
                        if (inputs[i]) inputs[i].value = char;
                    });
                    updateOtp();
                    const nextIndex = Math.min(pastedData.length, inputs.length - 1);
                    inputs[nextIndex].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace') {
                    if (!input.value && index > 0) {
                        inputs[index - 1].focus();
                    } else {
                        input.value = '';
                    }
                    updateOtp();
                } else if (e.key === 'ArrowLeft' && index > 0) {
                    inputs[index - 1].focus();
                } else if (e.key === 'ArrowRight' && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
            
            input.addEventListener('focus', () => input.select());
        });

        function updateOtp() {
            otpHidden.value = Array.from(inputs).map(input => input.value).join('');
        }


        const RESEND_TIMEOUT = 300;

        function initializeResendButton() {
            const lastResendTime = localStorage.getItem('lastOtpResendTime');
            
            if (lastResendTime) {
                const now = Date.now();
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
            resendBtn.classList.add('opacity-50', 'cursor-not-allowed');
            timerDisplay.classList.remove('hidden');
            
            let remaining = seconds;
            countdownSpan.textContent = formatTime(remaining);

            const timer = setInterval(() => {
                remaining--;
                countdownSpan.textContent = formatTime(remaining);

                if (remaining <= 0) {
                    clearInterval(timer);
                    enableResendButton();
                    localStorage.removeItem('lastOtpResendTime');
                }
            }, 1000);
        }

        function formatTime(seconds) {
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            return `${m}:${s < 10 ? '0' : ''}${s}`;
        }

        function enableResendButton() {
            resendBtn.disabled = false;
            resendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            timerDisplay.classList.add('hidden');
        }
        $('#resendBtn').on('click', function() {
            localStorage.setItem('lastOtpResendTime', Date.now().toString());
            startCountdown(RESEND_TIMEOUT);
        });
        initializeResendButton();
    });
</script>