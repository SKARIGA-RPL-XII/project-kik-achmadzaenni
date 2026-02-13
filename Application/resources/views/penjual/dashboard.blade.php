<div class="w-full min-h-[86vh] flex flex-col gap-6 p-1">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-gradient-to-r from-[#1b5e20] to-[#2E973E] rounded-3xl p-6 text-white shadow-xl relative overflow-hidden flex flex-col sm:flex-row justify-between items-center gap-6">
             <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-4 translate-y-4">
                <i class="fa-solid fa-wallet text-9xl"></i>
            </div>
            <div class="relative z-10 text-center sm:text-left">
                <p class="text-green-100 text-sm font-medium mb-1 flex items-center gap-2 justify-center sm:justify-start">
                    <i class="fa-solid fa-wallet"></i> Dompet Penjual
                </p>
                <h1 class="text-4xl font-bold tracking-tight mb-2">
                    <span class="text-2xl font-normal opacity-80">Rp</span><?= number_format($data->balance ?? 0, 0, ',', '.') ?>
                </h1>
                <p class="text-xs text-green-100 bg-white/20 px-2 py-1 rounded-lg inline-block">
                    <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> +5% dari bulan lalu
                </p>
            </div>
            <div class="relative z-10 flex gap-3 w-full sm:w-auto">
                <button type="button" id="btnTopupOpen" class="flex-1 sm:flex-none flex items-center justify-center gap-2 bg-white/10 hover:bg-white text-white hover:text-[#2E973E] border border-white/20 backdrop-blur-sm px-5 py-3 rounded-2xl font-semibold transition-all shadow-sm">
                    <i class="fa-solid fa-plus"></i> Top Up
                </button>
                <button type="button" id="btnWithdrawOpen" class="flex-1 sm:flex-none flex items-center justify-center gap-2 bg-white text-[#2E973E] hover:bg-green-50 px-5 py-3 rounded-2xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-money-bill-transfer"></i> Tarik Dana
                </button>
            </div>
        </div>

        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm flex flex-col justify-center relative overflow-hidden">
            <div class="absolute right-4 top-4 text-green-500/10">
                <i class="fa-solid fa-cash-register text-8xl"></i>
            </div>
            
            <div class="relative z-10">
                <p class="text-gray-500 text-sm font-medium mb-2">Pendapatan Hari Ini</p>
                <h2 class="text-3xl font-bold text-gray-800">
                    Rp <?= number_format($income_today ?? 0, 0, ',', '.') ?>
                </h2>
                <div class="mt-4 flex items-center gap-2">
                    <span class="bg-green-100 text-[#2E973E] text-xs font-bold px-2 py-1 rounded-lg">
                        <?= $orders_today ?? 0 ?> Pesanan
                    </span>
                    <span class="text-xs text-gray-400">Perlu diproses</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex-1 flex flex-col lg:flex-row gap-6">
        <div class="w-full lg:w-2/3 flex flex-col">
            <div class="bg-white border border-gray-100 rounded-3xl shadow-sm p-6 flex-1 flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Analisis Penjualan</h3>
                        <p class="text-xs text-gray-400">Grafik pemasukan 7 hari terakhir</p>
                    </div>
                    <select class="bg-gray-50 border-none text-xs font-bold text-gray-600 rounded-xl py-2 px-4 cursor-pointer hover:bg-gray-100 transition-colors focus:ring-0">
                        <option>7 Hari</option>
                        <option>1 Bulan</option>
                        <option>1 Tahun</option>
                    </select>
                </div>
                <div class="relative flex-1 w-full min-h-[250px] rounded-2xl flex items-center justify-center">
                    <canvas id="salesChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>
        <div class="w-full lg:w-1/3 flex flex-col">
            <div class="bg-white border border-gray-100 rounded-3xl shadow-sm flex flex-col h-full overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/30 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Transaksi Masuk</h3>
                    <a href="{{ route('penjual_transaction')}}" class="text-xs font-bold text-[#2E973E] hover:underline">Lihat Semua</a>
                </div>
                <div class="flex-1 p-4 overflow-y-auto custom-scrollbar space-y-3">
                    <div class="group flex items-center justify-between p-3 rounded-2xl border border-gray-100 hover:border-green-200 hover:bg-green-50/30 transition-all cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-basket-shopping text-sm"></i>
                            </div>
                            <div class="flex flex-col">
                                <h4 class="text-sm font-bold text-gray-800 line-clamp-1">Kopi Susu Aren (2x)</h4>
                                <span class="text-[10px] text-gray-400">Pembeli: Budi Santoso</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-[#2E973E]">+ Rp 36.000</p>
                            <span class="text-[9px] text-gray-400">10:42 WIB</span>
                        </div>
                    </div>
                    <div class="group flex items-center justify-between p-3 rounded-2xl border border-gray-100 hover:border-green-200 hover:bg-green-50/30 transition-all cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-basket-shopping text-sm"></i>
                            </div>
                            <div class="flex flex-col">
                                <h4 class="text-sm font-bold text-gray-800 line-clamp-1">Roti Bakar Keju</h4>
                                <span class="text-[10px] text-gray-400">Pembeli: Siti Aminah</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-[#2E973E]">+ Rp 25.000</p>
                            <span class="text-[9px] text-gray-400">09:15 WIB</span>
                        </div>
                    </div>
                    <div class="group flex items-center justify-between p-3 rounded-2xl border border-gray-100 hover:border-green-200 hover:bg-green-50/30 transition-all cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-green-100 text-[#2E973E] flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-plus text-sm"></i>
                            </div>
                            <div class="flex flex-col">
                                <h4 class="text-sm font-bold text-gray-800">Top Up Saldo</h4>
                                <span class="text-[10px] text-gray-400">Deposit Sistem</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-[#2E973E]">+ Rp 500.000</p>
                            <span class="text-[9px] text-gray-400">Kemarin</span>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-t border-gray-100 bg-gray-50 text-center">
                    <p class="text-xs text-gray-400">Menampilkan 5 transaksi terakhir</p>
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
