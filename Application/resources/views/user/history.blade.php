<div class="w-full h-auto md:h-[86vh] flex flex-col gap-3 md:gap-4 p-1 pb-24 md:pb-0">
    <div
        class="sticky top-0 z-10 w-full bg-white/95 backdrop-blur-sm rounded-3xl shadow-sm border border-gray-100 p-3 md:p-4 flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4 transition-all">
        <div class="w-full md:w-1/2 relative group">
            <span
                class="absolute inset-y-0 left-0 pl-3 md:pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#2E973E] transition-colors">
                <i class="fa-solid fa-search text-sm md:text-base"></i>
            </span>
            <input type="text"
                class="w-full pl-9 md:pl-11 pr-4 py-2 md:py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all placeholder:text-xs md:placeholder:text-sm"
                placeholder="Cari transaksi...">
        </div>
        <div
            class="w-full md:w-auto flex items-center gap-2 overflow-x-auto pb-1 md:pb-0 hide-scrollbar mask-gradient-right">
            <button type="button" onclick="history.back()"
                class="md:hidden flex-shrink-0 w-8 h-8 flex items-center justify-center bg-gray-100 rounded-lg text-gray-600 active:scale-95">
                <i class="fa-solid fa-arrow-left text-xs"></i>
            </button>

            <button
                class="flex-shrink-0 px-3 md:px-4 py-1.5 md:py-2 rounded-xl bg-[#2E973E] text-white text-[10px] md:text-xs font-bold shadow-md shadow-green-200 transition-transform active:scale-95 whitespace-nowrap">
                Semua
            </button>
            <button
                class="flex-shrink-0 px-3 md:px-4 py-1.5 md:py-2 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-[#2E973E] hover:border-[#2E973E] text-[10px] md:text-xs font-bold transition-all whitespace-nowrap active:bg-gray-50">
                <i class="fa-solid fa-arrow-down mr-1"></i> Masuk
            </button>
            <button
                class="flex-shrink-0 px-3 md:px-4 py-1.5 md:py-2 rounded-xl bg-white border border-gray-200 text-gray-600 hover:text-red-500 hover:border-red-400 text-[10px] md:text-xs font-bold transition-all whitespace-nowrap active:bg-gray-50">
                <i class="fa-solid fa-arrow-up mr-1"></i> Keluar
            </button>

            <div
                class="flex-shrink-0 relative inline-flex items-center justify-center w-8 h-8 md:w-9 md:h-9 rounded-xl bg-gray-50 hover:bg-blue-50 text-gray-500 hover:text-blue-600 transition-colors cursor-pointer border border-transparent hover:border-blue-200">
                <i class="fa-regular fa-calendar text-sm md:text-base"></i>
                <input type="date" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                    title="Filter Tanggal" onchange="console.log(this.value)">
            </div>
            <button type="button" onclick="history.back()"
                class="hidden md:flex group items-center gap-0 hover:gap-2 bg-gray-50 hover:bg-gray-100 text-gray-500 hover:text-gray-800 p-2.5 rounded-xl transition-all duration-300 ease-in-out ml-auto">
                <i
                    class="fa-solid fa-arrow-left text-sm transition-transform duration-500 group-hover:-translate-x-1"></i>
                <span
                    class="max-w-0 overflow-hidden opacity-0 group-hover:max-w-[100px] group-hover:opacity-100 whitespace-nowrap text-sm font-medium transition-all duration-500 ease-in-out">Kembali</span>
            </button>
        </div>
    </div>
    <div
        class="flex-1 w-full bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col min-h-[400px]">
        <div class="flex-1 overflow-y-auto p-3 md:p-6 space-y-5 scrollbar">
            <div>
                <h3 class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 md:mb-3 ml-1">
                    Hari Ini</h3>
                <div class="space-y-2 md:space-y-3">

                    <div
                        class="group flex items-center justify-between p-3 md:p-4 rounded-2xl bg-white border border-gray-100 hover:border-green-200 hover:bg-green-50/30 transition-all cursor-pointer shadow-sm hover:shadow-md active:scale-[0.99]">
                        <div class="flex items-center gap-3 md:gap-4 overflow-hidden">
                            <div
                                class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-green-100 text-[#2E973E] flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-plus text-sm md:text-lg"></i>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <h4
                                    class="text-sm font-bold text-gray-800 group-hover:text-[#2E973E] transition-colors truncate">
                                    Top Up Saldo
                                </h4>
                                <span class="text-[10px] md:text-xs text-gray-400 truncate">Via Bank BCA • 10:45
                                    WIB</span>
                            </div>
                        </div>
                        <div class="text-right shrink-0 pl-2">
                            <p class="text-sm font-bold text-[#2E973E] whitespace-nowrap">+ Rp 100.000</p>
                            <span
                                class="inline-flex items-center gap-1 text-[9px] md:text-[10px] font-medium text-green-600 bg-green-100 px-1.5 py-0.5 rounded-full mt-1">
                                <i class="fa-solid fa-check-circle text-[8px] md:text-[9px]"></i> Sukses
                            </span>
                        </div>
                    </div>
                    <div
                        class="group flex items-center justify-between p-3 md:p-4 rounded-2xl bg-white border border-gray-100 hover:border-gray-300 hover:bg-gray-50 transition-all cursor-pointer shadow-sm hover:shadow-md active:scale-[0.99]">
                        <div class="flex items-center gap-3 md:gap-4 overflow-hidden">
                            <div
                                class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-bag-shopping text-sm md:text-lg"></i>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <h4 class="text-sm font-bold text-gray-800 truncate">Pembayaran QRIS</h4>
                                <span class="text-[10px] md:text-xs text-gray-400 truncate">Kantin Sehat • 08:30
                                    WIB</span>
                            </div>
                        </div>
                        <div class="text-right shrink-0 pl-2">
                            <p class="text-sm font-bold text-gray-800 whitespace-nowrap">- Rp 15.000</p>
                            <span
                                class="inline-flex items-center gap-1 text-[9px] md:text-[10px] font-medium text-green-600 bg-green-100 px-1.5 py-0.5 rounded-full mt-1">
                                <i class="fa-solid fa-check-circle text-[8px] md:text-[9px]"></i> Sukses
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="text-[10px] md:text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 md:mb-3 ml-1">
                    Kemarin</h3>
                <div class="space-y-2 md:space-y-3">
                    <div
                        class="group flex items-center justify-between p-3 md:p-4 rounded-2xl bg-white border border-gray-100 hover:border-red-200 hover:bg-red-50/30 transition-all cursor-pointer shadow-sm hover:shadow-md active:scale-[0.99]">
                        <div class="flex items-center gap-3 md:gap-4 overflow-hidden">
                            <div
                                class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-red-100 text-red-500 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-arrow-right-from-bracket text-sm md:text-lg"></i>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <h4
                                    class="text-sm font-bold text-gray-800 group-hover:text-red-500 transition-colors truncate">
                                    Transfer Keluar
                                </h4>
                                <span class="text-[10px] md:text-xs text-gray-400 truncate">Ke: Ahmad Fulan • 14:30
                                    WIB</span>
                            </div>
                        </div>
                        <div class="text-right shrink-0 pl-2">
                            <p class="text-sm font-bold text-red-500 whitespace-nowrap">- Rp 50.000</p>
                            <span
                                class="inline-flex items-center gap-1 text-[9px] md:text-[10px] font-medium text-green-600 bg-green-100 px-1.5 py-0.5 rounded-full mt-1">
                                <i class="fa-solid fa-check-circle text-[8px] md:text-[9px]"></i> Sukses
                            </span>
                        </div>
                    </div>
                    <div
                        class="group flex items-center justify-between p-3 md:p-4 rounded-2xl bg-white border border-gray-100 hover:border-yellow-200 hover:bg-yellow-50/30 transition-all cursor-pointer shadow-sm hover:shadow-md active:scale-[0.99]">
                        <div class="flex items-center gap-3 md:gap-4 overflow-hidden">
                            <div
                                class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-clock-rotate-left text-sm md:text-lg"></i>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <h4
                                    class="text-sm font-bold text-gray-800 group-hover:text-yellow-600 transition-colors truncate">
                                    Top Up (Menunggu)
                                </h4>
                                <span class="text-[10px] md:text-xs text-gray-400 truncate">Virtual Account • 10:00
                                    WIB</span>
                            </div>
                        </div>
                        <div class="text-right shrink-0 pl-2">
                            <p class="text-sm font-bold text-gray-400 whitespace-nowrap">Rp 500.000</p>
                            <span
                                class="inline-flex items-center gap-1 text-[9px] md:text-[10px] font-medium text-yellow-700 bg-yellow-100 px-1.5 py-0.5 rounded-full mt-1">
                                <i class="fa-regular fa-clock text-[8px] md:text-[9px]"></i> Pending
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-gray-100 flex justify-center bg-gray-50/50">
            <button
                class="text-xs font-bold text-gray-500 hover:text-[#2E973E] flex items-center gap-2 transition-colors active:scale-95">
                Muat Lebih Banyak <i class="fa-solid fa-chevron-down"></i>
            </button>
        </div>
    </div>
</div>
