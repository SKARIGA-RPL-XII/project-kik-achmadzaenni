<div class="w-full h-auto md:h-[86vh] p-1 pb-20 md:pb-0">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-white rounded-[2rem] shadow-sm border border-gray-100 p-5 mb-4 md:mb-6 gap-4">
        <div class="w-full md:w-auto">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800 flex items-center gap-2">
                <?= $subtitle ?>
            </h1>
            <p class="text-xs md:text-sm text-gray-400 mt-1">Kelola data <?= strtolower($subtitle) ?> sistem</p>
        </div>
        
        <div class="flex items-center gap-3 w-full md:w-auto">
            <a href="{{ route('penjual_add_form') }}"
                class="flex items-center justify-center gap-2 bg-[#2E973E] hover:bg-[#1b5e20] text-white px-5 py-2.5 md:py-2 rounded-xl text-sm font-bold shadow-lg shadow-green-100 transition-all transform hover:-translate-y-0.5 whitespace-nowrap w-full md:w-auto active:scale-95">
                <i class="fa-solid fa-plus"></i> Tambah Data
            </a>
        </div>
    </div>

    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden flex flex-col h-[500px] md:h-auto">
        <div class="flex-1 overflow-auto scrollbar">
            <table id="datatables" class="w-full text-left border-collapse relative">
                <thead class="sticky top-0 z-10">
                    <tr class="text-xs font-bold text-gray-500 uppercase tracking-wider bg-gray-50 border-b border-gray-100 shadow-sm">
                        <th class="px-4 py-4 rounded-tl-xl whitespace-nowrap w-12 text-center">No</th>
                        <th class="px-4 py-4 whitespace-nowrap">Photo</th>
                        <th class="px-4 py-4 whitespace-nowrap">Nama Produk</th>
                        <th class="px-4 py-4 whitespace-nowrap">Harga</th>
                        <th class="px-4 py-4 whitespace-nowrap">Produk Code</th>
                        <th class="px-4 py-4 whitespace-nowrap">Expired</th>
                        <th class="px-4 py-4 whitespace-nowrap">Barang masuk</th>
                        <th class="px-4 py-4 whitespace-nowrap text-center">Qty</th>
                        <th class="px-4 py-4 rounded-tr-xl whitespace-nowrap text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-gray-700">
                    </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50/50 text-xs text-gray-400 text-center md:text-left">
            Geser ke samping untuk melihat detail lengkap <i class="fa-solid fa-arrow-right md:hidden ml-1"></i>
        </div>
    </div>
</div>