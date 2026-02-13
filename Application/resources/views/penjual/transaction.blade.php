<div class="w-full h-auto md:h-[86vh] flex flex-col gap-6 p-1">
    <div
        class="flex flex-col md:flex-row justify-between items-start md:items-center bg-white p-6 rounded-3xl border border-gray-100 shadow-sm gap-4">
        <div>
            <a href="javascript:history.back()"
                class="flex items-center gap-2 text-gray-500 hover:text-[#2E973E] transition-colors mb-2 text-sm font-medium">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                Riwayat Penjualan
            </h1>
            <p class="text-sm text-gray-400 mt-1">Daftar semua transaksi yang terjadi di tokomu</p>
        </div>
        <div class="flex items-center gap-4 bg-green-50 px-5 py-3 rounded-2xl border border-green-100">
            <div
                class="w-10 h-10 bg-[#2E973E] text-white rounded-full flex items-center justify-center shadow-lg shadow-green-200">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <div>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Total Bulan Ini</p>
                <h2 class="text-xl font-bold text-gray-800">Rp 12.500.000</h2>
            </div>
        </div>
    </div>
    <div
        class="sticky top-0 z-20 bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-gray-200 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4 transition-all">
        <div class="w-full md:w-1/3 relative group">
            <span
                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#2E973E]">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input type="text"
                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm placeholder:text-gray-400"
                placeholder="Cari pembeli atau produk...">
        </div>
        <div class="w-full md:w-auto flex items-center gap-2 overflow-x-auto no-scrollbar pb-1 md:pb-0">
            <button
                class="px-4 py-2 rounded-xl bg-[#2E973E] text-white text-xs font-bold shadow-md shadow-green-200 whitespace-nowrap transition-transform active:scale-95">
                Semua
            </button>
            <button
                class="px-4 py-2 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-[#2E973E] hover:border-[#2E973E] text-xs font-bold transition-all whitespace-nowrap">
                <i class="fa-solid fa-check-circle mr-1"></i> Sukses
            </button>
            <button
                class="px-4 py-2 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-yellow-500 hover:border-yellow-400 text-xs font-bold transition-all whitespace-nowrap">
                <i class="fa-solid fa-clock mr-1"></i> Pending
            </button>

            <div class="h-6 w-[1px] bg-gray-200 mx-1"></div> <button
                class="px-3 py-2 rounded-xl bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 transition-all"
                title="Export Data">
                <i class="fa-solid fa-download"></i>
            </button>
        </div>
    </div>
    <div class="flex-1 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
        <div
            class="hidden md:grid grid-cols-12 gap-4 p-5 border-b border-gray-100 bg-gray-50/50 text-xs font-bold text-gray-500 uppercase tracking-wider">
            <div class="col-span-5">Detail Produk</div>
            <div class="col-span-3">Pembeli</div>
            <div class="col-span-2 text-right">Total Harga</div>
            <div class="col-span-2 text-center">Status</div>
        </div>
        <div class="flex-1 overflow-y-auto p-0 scrollbar">
            <div
                class="group grid grid-cols-1 md:grid-cols-12 gap-4 p-5 border-b border-gray-50 hover:bg-green-50/10 transition-colors items-center relative">
                <div class="md:col-span-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden shrink-0 border border-gray-200">
                        <img src="https://placehold.co/100x100?text=Kopi" alt="Produk"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 group-hover:text-[#2E973E] transition-colors">Kopi
                            Susu Aren (2x)</h4>
                        <p class="text-xs text-gray-400 mt-0.5">INV-2024001 • 12 Jan 2024, 10:42</p>
                    </div>
                </div>
                <div class="md:col-span-3 mt-2 md:mt-0 pl-16 md:pl-0">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-bold">
                            BS</div>
                        <span class="text-sm font-medium text-gray-700">Budi Santoso</span>
                    </div>
                </div>
                <div class="md:col-span-2 text-left md:text-right mt-2 md:mt-0 pl-16 md:pl-0">
                    <p class="text-xs text-gray-400 mb-1 md:hidden">Total</p>
                    <p class="text-sm font-bold text-[#2E973E]">+ Rp 36.000</p>
                </div>

                <div class="md:col-span-2 text-left md:text-center mt-2 md:mt-0 pl-16 md:pl-0">
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Lunas
                    </span>
                </div>
            </div>
            <div
                class="group grid grid-cols-1 md:grid-cols-12 gap-4 p-5 border-b border-gray-50 hover:bg-green-50/10 transition-colors items-center relative">
                <div class="md:col-span-5 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden shrink-0 border border-gray-200">
                        <img src="https://placehold.co/100x100?text=Roti" alt="Produk"
                            class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 group-hover:text-[#2E973E] transition-colors">Roti
                            Bakar Keju</h4>
                        <p class="text-xs text-gray-400 mt-0.5">INV-2024002 • 12 Jan 2024, 09:15</p>
                    </div>
                </div>
                <div class="md:col-span-3 mt-2 md:mt-0 pl-16 md:pl-0">
                    <div class="flex items-center gap-2">
                        <div
                            class="w-6 h-6 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-[10px] font-bold">
                            SA</div>
                        <span class="text-sm font-medium text-gray-700">Siti Aminah</span>
                    </div>
                </div>
                <div class="md:col-span-2 text-left md:text-right mt-2 md:mt-0 pl-16 md:pl-0">
                    <p class="text-sm font-bold text-[#2E973E]">+ Rp 25.000</p>
                </div>
                <div class="md:col-span-2 text-left md:text-center mt-2 md:mt-0 pl-16 md:pl-0">
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Lunas
                    </span>
                </div>
            </div>
            <div
                class="group grid grid-cols-1 md:grid-cols-12 gap-4 p-5 border-b border-gray-50 hover:bg-green-50/10 transition-colors items-center relative bg-yellow-50/10">
                <div class="md:col-span-5 flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-yellow-50 text-yellow-600 flex items-center justify-center shrink-0 border border-yellow-100">
                        <i class="fa-solid fa-wallet text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-800">Top Up Saldo</h4>
                        <p class="text-xs text-gray-400 mt-0.5">DEPOSIT-001 • Kemarin</p>
                    </div>
                </div>
                <div class="md:col-span-3 mt-2 md:mt-0 pl-16 md:pl-0">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-500 italic">Deposit Sistem</span>
                    </div>
                </div>
                <div class="md:col-span-2 text-left md:text-right mt-2 md:mt-0 pl-16 md:pl-0">
                    <p class="text-sm font-bold text-gray-800">+ Rp 500.000</p>
                </div>
                <div class="md:col-span-2 text-left md:text-center mt-2 md:mt-0 pl-16 md:pl-0">
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                        <i class="fa-solid fa-check text-[10px]"></i> Selesai
                    </span>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50 flex justify-between items-center">
            <span class="text-xs text-gray-500 hidden sm:inline">Hal 1 dari 5</span>
            <div class="flex gap-2">
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-400 hover:text-[#2E973E] hover:border-[#2E973E] transition-all disabled:opacity-50"
                    disabled>
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#2E973E] text-white font-bold text-xs shadow-md">1</button>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-medium">2</button>
                <button
                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-400 hover:text-[#2E973E] hover:border-[#2E973E] transition-all">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>
    </div>
</div>
