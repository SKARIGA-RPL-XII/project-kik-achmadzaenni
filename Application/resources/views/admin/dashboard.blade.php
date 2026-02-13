<div class="w-full min-h-[86vh] flex flex-col gap-6 p-1">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <div
            class="lg:col-span-2 bg-gradient-to-br from-[#0f391b] to-[#2E973E] rounded-3xl p-6 text-white shadow-xl relative overflow-hidden flex flex-col justify-between">
            <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-4 translate-y-4">
                <i class="fa-solid fa-building-columns text-9xl"></i>
            </div>

            <div class="relative z-10">
                <div class="flex justify-between items-start">
                    <div>
                        <p
                            class="text-green-100 text-xs font-bold uppercase tracking-widest mb-1 flex items-center gap-2">
                            <i class="fa-solid fa-vault"></i> Kas Sistem (Pajak)
                        </p>
                        <h1 class="text-4xl font-bold tracking-tight">
                            <span
                                class="text-2xl font-normal opacity-70">Rp</span><?= number_format($data->balance ?? 0, 0, ',', '.') ?>
                        </h1>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-2 rounded-xl border border-white/10">
                        <i class="fa-solid fa-shield-halved text-2xl text-green-200"></i>
                    </div>
                </div>
            </div>

            <div class="relative z-10 mt-6 flex gap-3">
                <button type="button" id="btnTopupOpen"
                    class="flex-1 flex items-center justify-center gap-2 bg-white text-[#0f391b] hover:bg-green-50 px-4 py-2.5 rounded-xl font-bold text-sm shadow-lg transition-all transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-plus"></i> Inject Dana
                </button>
                <button type="button" id="btnWithdrawOpen"
                    class="flex-1 flex items-center justify-center gap-2 bg-[#0f391b]/30 hover:bg-[#0f391b]/50 text-white border border-white/20 backdrop-blur-sm px-4 py-2.5 rounded-xl font-semibold text-sm transition-all">
                    <i class="fa-solid fa-money-bill-transfer"></i> Tarik Kas
                </button>
            </div>
        </div>

        <div
            class="bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-shop"></i>
            </div>
            <div>
                <p class="text-gray-400 text-xs font-bold uppercase">Mitra Penjual</p>
                <h3 class="text-2xl font-bold text-gray-800">128</h3>
                <p class="text-xs text-green-500 font-medium flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> +3 Baru
                </p>
            </div>
        </div>

        <div
            class="bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-percent"></i>
            </div>
            <div>
                <p class="text-gray-400 text-xs font-bold uppercase">Pajak Hari Ini</p>
                <h3 class="text-2xl font-bold text-gray-800">Rp 450rb</h3>
                <p class="text-xs text-gray-400 font-medium">Dari 50 Transaksi</p>
            </div>
        </div>
    </div>

    <div class="flex-1 flex flex-col lg:flex-row gap-6">

        <div class="w-full lg:w-2/3 flex flex-col">
            <div class="bg-white border border-gray-100 rounded-3xl shadow-sm p-6 flex-1 flex flex-col">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-chart-pie text-[#2E973E]"></i> Statistik Pendapatan Pajak
                        </h3>
                        <p class="text-xs text-gray-400">Monitoring fee transaksi dari seluruh penjual</p>
                    </div>

                    <div class="flex bg-gray-50 p-1 rounded-xl">
                        <button
                            class="px-3 py-1.5 rounded-lg text-xs font-bold bg-white text-[#2E973E] shadow-sm">Mingguan</button>
                        <button
                            class="px-3 py-1.5 rounded-lg text-xs font-bold text-gray-500 hover:text-gray-700">Bulanan</button>
                    </div>
                </div>

                <div class="relative flex-1 w-full min-h-[280px] rounded-2xl flex items-center justify-center">
                    <canvas id="adminRevenueChart" class="w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/3 flex flex-col">
            <div class="bg-white border border-gray-100 rounded-3xl shadow-sm flex flex-col h-full overflow-hidden">

                <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-base font-bold text-gray-800">Pemasukan Pajak Terbaru</h3>
                    <p class="text-[10px] text-gray-400">Real-time update dari transaksi penjual</p>
                </div>

                <div class="flex-1 p-4 overflow-y-auto custom-scrollbar space-y-3">

                    <div
                        class="flex items-center justify-between p-3 rounded-2xl border border-gray-100 bg-white hover:border-[#2E973E]/30 transition-all">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-green-50 text-[#2E973E] flex items-center justify-center text-sm font-bold border border-green-100">
                                KP
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-gray-700">Kantin Pak Budi</span>
                                <span class="text-[10px] text-gray-400">Trx #INV-001 • Penjualan</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-[#2E973E]">+ Rp 500</p>
                            <span class="text-[9px] bg-gray-100 px-1.5 rounded text-gray-500">Tax 2%</span>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 rounded-2xl border border-gray-100 bg-white hover:border-[#2E973E]/30 transition-all">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold border border-blue-100">
                                KM
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-gray-700">Koperasi Mahasiswa</span>
                                <span class="text-[10px] text-gray-400">Trx #INV-002 • Penjualan</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-[#2E973E]">+ Rp 1.200</p>
                            <span class="text-[9px] bg-gray-100 px-1.5 rounded text-gray-500">Tax 2%</span>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 rounded-2xl border border-gray-100 bg-yellow-50/30 hover:border-yellow-200 transition-all">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                <i class="fa-solid fa-bolt text-sm"></i>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-gray-700">System Inject</span>
                                <span class="text-[10px] text-gray-400">Penambahan Modal</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-bold text-gray-800">+ Rp 1.000.000</p>
                            <span class="text-[9px] bg-yellow-100 text-yellow-700 px-1.5 rounded">Top Up</span>
                        </div>
                    </div>

                </div>

                <a href="{{ route('admin_taxinvoicedetail') }}"
                    class="p-3 bg-gray-50 text-center text-xs font-bold text-[#2E973E] hover:bg-gray-100 transition-colors border-t border-gray-100">
                    Lihat Semua Riwayat Pajak <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
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
