<div class="w-full min-h-[86vh] p-1">
    <div class="flex flex-col md:flex-row justify-between items-center bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-6 gap-4">   
        <div>
            <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <?= $subtitle ?>
            </h1>
            <p class="text-xs text-gray-400 mt-1">Kelola data <?= strtolower($subtitle) ?> sistem</p>
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto">
            <a href="{{ route('admin_form_add', $type)}}"
                class="flex items-center gap-2 bg-[#2E973E] hover:bg-[#1b5e20] text-white px-5 py-2 rounded-xl text-sm font-bold shadow-lg shadow-green-100 transition-all transform hover:-translate-y-0.5 whitespace-nowrap">
                <i class="fa-solid fa-plus"></i> Tambah
            </a>
        </div>
    </div>
    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden">
        <div class="p-5 overflow-x-auto">
            <table id="datatables" class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                        <th class="px-4 py-4 bg-gray-50/50 rounded-tl-xl">No</th>
                        <th class="px-4 py-4 bg-gray-50/50">Menu</th>
                        <th class="px-4 py-4 bg-gray-50/50">Sub Menu</th>
                        <th class="px-4 py-4 bg-gray-50/50">Link</th>
                        <th class="px-4 py-4 bg-gray-50/50">Icon</th>
                        <th class="px-4 py-4 bg-gray-50/50">Urutan</th>
                        <th class="px-4 py-4 bg-gray-50/50">Role</th>
                        <th class="px-4 py-4 bg-gray-50/50 rounded-tr-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    </tbody>
            </table>
        </div>
    </div>
</div>