<div class="w-full min-h-[86vh] flex flex-col gap-6 p-1">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
        <div>
            <a href="javascript:history.back()" class="flex items-center gap-2 text-gray-500 hover:text-[#2E973E] transition-colors mb-2 text-sm font-medium">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Laporan Pemasukan Pajak</h1>
            <p class="text-sm text-gray-400 mt-1">Detail riwayat pemotongan pajak dari transaksi penjual</p>
        </div>
        
        <div class="flex gap-4">
            <div class="text-right hidden sm:block">
                <p class="text-xs text-gray-400 font-bold uppercase">Total Pajak (Bulan Ini)</p>
                <h2 class="text-2xl font-bold text-[#2E973E]">Rp 4.500.000</h2>
            </div>
            <div class="w-12 h-12 bg-green-50 text-[#2E973E] rounded-xl flex items-center justify-center text-xl">
                <i class="fa-solid fa-file-invoice-dollar"></i>
            </div>
        </div>
    </div>

    <div class="sticky top-0 z-20 bg-white/90 backdrop-blur-md p-4 rounded-2xl border border-gray-200 shadow-sm flex flex-row justify-between items-center gap-4">
        <div class="w-full md:w-1/3 relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                <i class="fa-solid fa-search"></i>
            </span>
            <input type="text" class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all" placeholder="Cari ID Transaksi / Nama Penjual...">
        </div>
        <div class="w-full md:w-auto flex items-center gap-2 overflow-x-auto no-scrollbar">
            <div class="relative">
                <button class="flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 hover:border-[#2E973E] hover:text-[#2E973E] transition-all">
                    <i class="fa-regular fa-calendar"></i>
                    <span class="hidden md:flex">Bulan Ini</span>
                    <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
                </button>
            </div>
            <button class="flex items-center gap-2 px-4 py-2.5 bg-[#2E973E] text-white rounded-xl text-sm font-bold shadow-lg shadow-green-200 hover:bg-[#1b5e20] transition-all transform hover:-translate-y-0.5">
                <i class="fa-solid fa-file-export"></i> <span class="hidden md:flex">Export Excel</span>
            </button>
        </div>
    </div>
    <div class="flex-1 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
        <div class="hidden md:grid grid-cols-12 gap-4 p-5 border-b border-gray-100 bg-gray-50/50 text-xs font-bold text-gray-500 uppercase tracking-wider">
            <div class="col-span-4">Detail Transaksi</div>
            <div class="col-span-3">Penjual / Merchant</div>
            <div class="col-span-3 text-right">Nilai Transaksi</div>
            <div class="col-span-2 text-right">Potongan Pajak</div>
        </div>

        <div class="flex-1 overflow-y-auto custom-scrollbar p-0">
            
            <div class="group grid grid-cols-1 md:grid-cols-12 gap-4 p-5 border-b border-gray-50 hover:bg-green-50/10 transition-colors items-center relative">
                <div class="md:col-span-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">#TRX-2024001</p>
                        <p class="text-xs text-gray-400 mt-0.5">12 Jan 2024 • 10:30 WIB</p>
                    </div>
                </div>

                <div class="md:col-span-3 mt-2 md:mt-0 pl-14 md:pl-0">
                    <p class="text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fa-solid fa-store text-gray-300"></i> Kantin Pak Budi
                    </p>
                    <span class="text-[10px] bg-gray-100 px-2 py-0.5 rounded text-gray-500 mt-1 inline-block">Makanan & Minuman</span>
                </div>

                <div class="md:col-span-3 text-left md:text-right mt-2 md:mt-0 pl-14 md:pl-0">
                    <p class="text-xs text-gray-400 mb-1 md:hidden">Total Belanja</p>
                    <p class="text-sm font-bold text-gray-800">Rp 25.000</p>
                </div>

                <div class="md:col-span-2 text-left md:text-right mt-2 md:mt-0 pl-14 md:pl-0">
                    <p class="text-xs text-gray-400 mb-1 md:hidden">Pajak (2%)</p>
                    <p class="text-sm font-bold text-[#2E973E]">+ Rp 500</p>
                </div>
            </div>

            <div class="group grid grid-cols-1 md:grid-cols-12 gap-4 p-5 border-b border-gray-50 hover:bg-green-50/10 transition-colors items-center relative">
                <div class="md:col-span-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">#TRX-2024002</p>
                        <p class="text-xs text-gray-400 mt-0.5">12 Jan 2024 • 11:15 WIB</p>
                    </div>
                </div>

                <div class="md:col-span-3 mt-2 md:mt-0 pl-14 md:pl-0">
                    <p class="text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fa-solid fa-store text-gray-300"></i> Koperasi Mhs
                    </p>
                    <span class="text-[10px] bg-gray-100 px-2 py-0.5 rounded text-gray-500 mt-1 inline-block">ATK</span>
                </div>

                <div class="md:col-span-3 text-left md:text-right mt-2 md:mt-0 pl-14 md:pl-0">
                    <p class="text-sm font-bold text-gray-800">Rp 60.000</p>
                </div>

                <div class="md:col-span-2 text-left md:text-right mt-2 md:mt-0 pl-14 md:pl-0">
                    <p class="text-sm font-bold text-[#2E973E]">+ Rp 1.200</p>
                </div>
            </div>

            <div class="group grid grid-cols-1 md:grid-cols-12 gap-4 p-5 border-b border-gray-50 hover:bg-green-50/10 transition-colors items-center relative">
                <div class="md:col-span-4 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">#TRX-2024003</p>
                        <p class="text-xs text-gray-400 mt-0.5">12 Jan 2024 • 13:00 WIB</p>
                    </div>
                </div>

                <div class="md:col-span-3 mt-2 md:mt-0 pl-14 md:pl-0">
                    <p class="text-sm font-medium text-gray-700 flex items-center gap-2">
                        <i class="fa-solid fa-store text-gray-300"></i> Ayam Geprek Juara
                    </p>
                    <span class="text-[10px] bg-gray-100 px-2 py-0.5 rounded text-gray-500 mt-1 inline-block">Makanan</span>
                </div>

                <div class="md:col-span-3 text-left md:text-right mt-2 md:mt-0 pl-14 md:pl-0">
                    <p class="text-sm font-bold text-gray-800">Rp 15.000</p>
                </div>

                <div class="md:col-span-2 text-left md:text-right mt-2 md:mt-0 pl-14 md:pl-0">
                    <p class="text-sm font-bold text-[#2E973E]">+ Rp 300</p>
                </div>
            </div>

        </div>

        <div class="p-4 border-t border-gray-100 bg-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-xs text-gray-500">Menampilkan 1-10 dari 128 data</p>
            <div class="flex gap-2">
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-400 hover:text-[#2E973E] hover:border-[#2E973E] transition-all disabled:opacity-50" disabled>
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#2E973E] text-white font-bold text-xs shadow-md">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-medium">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 text-xs font-medium">3</button>
                <span class="flex items-end px-1 text-gray-400">...</span>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 text-gray-400 hover:text-[#2E973E] hover:border-[#2E973E] transition-all">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>
    </div>
</div>