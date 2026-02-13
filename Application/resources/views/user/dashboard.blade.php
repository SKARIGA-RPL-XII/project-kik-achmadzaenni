<div class="w-full h-auto md:h-[86vh] flex flex-col gap-4 p-1 relative">
    <div
        class="w-full h-auto min-h-[25%] bg-gradient-to-r from-[#1b5e20] to-[#2E973E] shadow-xl rounded-3xl p-6 relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-16 -mt-16 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/5 rounded-full -ml-10 -mb-10 pointer-events-none"></div>
        <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-4 translate-y-4">
            <i class="fa-solid fa-coins text-white text-9xl"></i>
        </div>
        <div class="relative z-10 flex flex-col items-center md:items-start text-white">
            <span class="text-green-100 text-sm font-medium mb-1">Total Saldo Anda</span>
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight">
                <span id="saldo-display"
                    class="text-2xl align-top mr-1 font-medium opacity-80">Rp</span><?= number_format($totalSaldo->balance ?? 0, 0, ',', '.') ?>
            </h1>
        </div>
        <div class="relative z-10 flex flex-row gap-4">
            <button type="button" id="btnTopupOpen"
                class="group flex flex-col md:flex-row items-center justify-center bg-white/10 hover:bg-white text-white hover:text-[#2E973E] backdrop-blur-sm border border-white/20 transition-all duration-300 px-5 py-3 rounded-2xl shadow-lg gap-3 min-w-[120px]">
                <div class="bg-white/20 group-hover:bg-[#2E973E]/10 p-2 rounded-full transition-colors">
                    <i class="fa-solid fa-arrow-up text-lg"></i>
                </div>
                <span class="font-semibold text-sm md:text-base">Top Up</span>
            </button>
            <button type="button" id="btnWithdrawOpen"
                class="group flex flex-col md:flex-row items-center justify-center bg-white/10 hover:bg-red-50 text-white hover:text-red-500 backdrop-blur-sm border border-white/20 transition-all duration-300 px-5 py-3 rounded-2xl shadow-lg gap-3 min-w-[120px]">
                <div class="bg-white/20 group-hover:bg-red-100 p-2 rounded-full transition-colors">
                    <i class="fa-solid fa-arrow-down text-lg"></i>
                </div>
                <span class="font-semibold text-sm md:text-base">Tarik</span>
            </button>
        </div>
    </div>
    <div class="flex-1 w-full flex flex-col md:flex-row gap-4 overflow-hidden">
        <div class="w-full md:w-2/3 bg-white rounded-3xl shadow-sm border border-gray-100 flex flex-col p-5">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Analisis Transaksi</h2>
                    <p class="text-xs text-gray-400">Overview keuangan Anda</p>
                </div>
                <div class="relative">
                    <select name="timeframe" id="timeframe"
                        class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 text-xs font-semibold rounded-xl py-2 pl-3 pr-8 focus:outline-none focus:ring-2 focus:ring-[#2E973E] cursor-pointer">
                        <option value="7days">7 Hari Terakhir</option>
                        <option value="1month">1 Bulan</option>
                        <option value="3months">3 Bulan</option>
                    </select>
                    <i
                        class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-[10px] text-gray-500 pointer-events-none"></i>
                </div>
            </div>
            <div class="flex-1 relative w-full h-full min-h-[200px]">
                <canvas id="lineChart" class="w-full h-full"></canvas>
            </div>
        </div>
        <div
            class="w-full md:w-1/3 bg-white rounded-3xl shadow-sm border border-gray-100 flex flex-col overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-white sticky top-0 z-10">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Riwayat</h2>
                    <p class="text-xs text-gray-400">Transaksi terbaru</p>
                </div>
                <a href="{{ route('user_history') }}"
                    class="w-8 h-8 rounded-full bg-gray-50 hover:bg-gray-100 flex items-center justify-center transition-colors text-gray-500">
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </a>
            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar p-3 space-y-2 scrollbar">
                <div
                    class="group flex items-center justify-between p-3 rounded-2xl hover:bg-green-50/50 border border-transparent hover:border-green-100 transition-all cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-green-100 text-[#2E973E] flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-plus text-sm"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-sm font-bold text-gray-800">Top Up Saldo</h3>
                            <span class="text-[10px] text-gray-400 font-medium">Hari ini, 10:00</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-[#2E973E]">+ Rp 20.000</p>
                        <span
                            class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded text-center">Sukses</span>
                    </div>
                </div>

                <div
                    class="group flex items-center justify-between p-3 rounded-2xl hover:bg-red-50/50 border border-transparent hover:border-red-100 transition-all cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-red-100 text-red-500 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-sm font-bold text-gray-800">Transfer Keluar</h3>
                            <span class="text-[10px] text-gray-400 font-medium">Kemarin, 14:30</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-red-500">- Rp 50.000.000</p>
                        <span
                            class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded text-center">Sukses</span>
                    </div>
                </div>

                <div
                    class="group flex items-center justify-between p-3 rounded-2xl hover:bg-green-50/50 border border-transparent hover:border-green-100 transition-all cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-green-100 text-[#2E973E] flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-plus text-sm"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-sm font-bold text-gray-800">Top Up Saldo</h3>
                            <span class="text-[10px] text-gray-400 font-medium">12 Jan 2024</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-[#2E973E]">+ Rp 100.000</p>
                        <span
                            class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded text-center">Sukses</span>
                    </div>
                </div>

                <div
                    class="group flex items-center justify-between p-3 rounded-2xl hover:bg-gray-50 border border-transparent hover:border-gray-200 transition-all cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-bag-shopping text-sm"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-sm font-bold text-gray-800">Pembayaran</h3>
                            <span class="text-[10px] text-gray-400 font-medium">10 Jan 2024</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-800">- Rp 15.000</p>
                        <span
                            class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.5 rounded text-center">Sukses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="transactionModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
    class="hidden fixed inset-0 z-[60] flex items-center justify-center bg-gray-900/60 backdrop-blur-sm transition-opacity p-4">
    <div
        class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-all scale-100">
        <div class="flex justify-between items-center p-5 border-b border-gray-100 bg-gray-50">
            <div>
                <h3 id="modalTransTitle" class="text-xl font-bold text-gray-800">Top Up Saldo</h3>
                <p id="modalTransDesc" class="text-xs text-gray-500">Masukkan nominal yang diinginkan</p>
            </div>
            <button type="button"
                class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center transition-all">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
        <div class="p-6">
            <form id="formTransaction">
                <div class="mb-4">
                    <label for="amount" class="block mb-2 text-sm font-medium text-gray-700">Nominal (Rp)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <span class="text-gray-500 font-bold">Rp</span>
                        </div>
                        <input type="number" id="transAmount" name="amount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-xl focus:ring-[#2E973E] focus:border-[#2E973E] block w-full pl-10 p-3 font-bold placeholder-gray-300"
                            placeholder="0" required min="10000">
                    </div>
                    <p class="mt-2 text-xs text-red-500 hidden" id="errorMsg">Nominal tidak valid</p>
                </div>
                <div class="mb-6">
                    <p class="text-xs text-gray-400 mb-2 font-medium">Nominal Cepat</p>
                    <div class="flex flex-wrap gap-2">
                        <button type="button"
                            class="quick-amount px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg border border-transparent hover:bg-green-50 hover:text-green-700 hover:border-green-200 transition-all"
                            data-value="20000">20rb</button>
                        <button type="button"
                            class="quick-amount px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg border border-transparent hover:bg-green-50 hover:text-green-700 hover:border-green-200 transition-all"
                            data-value="50000">50rb</button>
                        <button type="button"
                            class="quick-amount px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg border border-transparent hover:bg-green-50 hover:text-green-700 hover:border-green-200 transition-all"
                            data-value="100000">100rb</button>
                        <button type="button"
                            class="quick-amount px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-100 rounded-lg border border-transparent hover:bg-green-50 hover:text-green-700 hover:border-green-200 transition-all"
                            data-value="200000">200rb</button>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button type="button"
                        class="close-modal flex-1 py-3 px-5 text-sm font-medium text-gray-600 bg-white rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-gray-900 transition-all">
                        Batal
                    </button>
                    <button type="submit" id="btnSubmitTrans"
                        class="flex-1 py-3 px-5 text-sm font-bold text-white bg-[#2E973E] hover:bg-[#1b5e20] rounded-xl shadow-lg shadow-green-500/30 transition-all flex items-center justify-center gap-2">
                        <span>Lanjutkan</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
