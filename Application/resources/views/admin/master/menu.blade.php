<div class="w-full h-[86vh] bg-gray-50 rounded-xl">
    <div
        class="flex justify-between items-center border-t border-b border-[#54834E] text-xl font-semibold shadow-lg rounded-xl bg-white p-3 mb-4">
        Master Menu
    </div>
    <div class="flex h-[76vh] justify-center items-center shadow-lg rounded-xl">
        <div class="w-full flex flex-col justify-center flex-1 mb-auto items-center space-y-3">
            <div class="w-full flex justify-between items-center">
                <input type="search" class="border rounded-lg shadow-lg p-2" placeholder="Search...">
                <div class="">
                    <label for="">Entries for page</label>
                    <select name="status" id="status" class="border p-2 rounded-lg shadow-lg">
                        <option value="all">All Status</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                </select>
            </div>
            </div>
            <table class="w-full bg-white border border-gray-200 rounded-xl shadow-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Budi</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Developer</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aktif</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Ani</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Designer</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aktif</td>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-between items-center w-full px-3 py-2">
                <div>
                    Showing 1 to 2 of 2 entries
                </div>
                <div class="flex flex-row items-center">
                    <button class="px-3 py-1 border border-[#54834E] text-[#54834E] transition-all scale-100 hover:scale-102 hover:bg-gray-100 rounded-l-lg"><i class="fa-solid fa-angles-left"></i></button>
                    <button class="px-3 py-1 border border-[#54834E] text-[#54834E] transition-all scale-100 hover:scale-102 hover:bg-gray-100"><i class="fa-solid fa-angle-left"></i></button>
                    <button class="px-3 py-1 border border-[#54834E] text-[#54834E] transition-all scale-100 hover:scale-102 hover:bg-gray-100">1</button>
                    <button class="px-3 py-1 border border-[#54834E] text-[#54834E] transition-all scale-100 hover:scale-102 hover:bg-gray-100">2</button>
                    <button class="px-3 py-1 border border-[#54834E] text-[#54834E] transition-all scale-100 hover:scale-102 hover:bg-gray-100"><i class="fa-solid fa-angle-right"></i></button>
                    <button class="px-3 py-1 border border-[#54834E] text-[#54834E] transition-all scale-100 hover:scale-102 hover:bg-gray-100 rounded-r-lg"><i class="fa-solid fa-angles-right"></i></button>
                </div>
            </div>
        </div>

    </div>
</div>
