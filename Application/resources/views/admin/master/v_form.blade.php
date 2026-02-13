<div class="w-full min-h-[86vh] p-1 flex flex-col gap-6">
    <div
        class="flex flex-col md:flex-row justify-between items-start md:items-center bg-white rounded-2xl shadow-sm border border-gray-100 p-5 gap-4">
        <div>
            <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <?= $subtitle ?>
            </h1>
            <p class="text-xs text-gray-400 mt-1">Silakan lengkapi form berikut dengan data yang valid.</p>
        </div>
        <button type="button" onclick="history.back()"
            class="group flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors bg-gray-50 px-4 py-2 rounded-xl hover:bg-gray-100">
            <i class="fa-solid fa-arrow-left text-xs transition-transform group-hover:-translate-x-1"></i> Kembali
        </button>
    </div>
    <div class="bg-white border border-gray-100 rounded-3xl shadow-sm overflow-hidden">
        @if ($type === 'user')
            <form id="formData"
                action="{{ isset($data) ? route('admin_editformprocess', ['type' => $type, 'id' => $data->userid]) : route('admin_formaddprocess', ['type' => $type]) }}"
                method="POST" class="flex flex-col h-full">
                @csrf
                <div class="p-6 md:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="nickname"
                                class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Nickname</label>
                            <input type="text" name="usernm" id="nickname"
                                value="{{ isset($data) ? $data->usernm : '' }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                required placeholder="Masukkan nama pengguna">
                        </div>
                        <div class="group">
                            <label for="email"
                                class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Email Address</label>
                            <input type="email" name="email" id="email"
                                value="{{ isset($data) ? $data->email : '' }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                required placeholder="contoh@email.com">
                        </div>
                    </div>
                    @if (isset($data))
                        <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-100 flex items-start gap-3">
                            <i class="fa-solid fa-circle-info text-yellow-500 mt-0.5"></i>
                            <p class="text-xs text-yellow-700">Kosongkan password jika tidak ingin mengubahnya.</p>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="password"
                                class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Password</label>
                            <input type="password" name="pswd" id="password"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                {{ !isset($data) ? 'required' : '' }} placeholder="********">
                        </div>
                        <div class="group">
                            <label for="confirm_password"
                                class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Konfirmasi
                                Password</label>
                            <input type="password" name="pswd_confirmation" id="confirm_password"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                {{ !isset($data) ? 'required' : '' }} placeholder="Ulangi password">
                        </div>
                    </div>
                    <div class="group">
                        <label for="roleSelect" class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Role
                            Akses</label>
                        <select name="roleid" id="roleSelect"
                            data-selected="{{ isset($data) && $data->roleid ? $data->roleid : '' }}"
                            data-selected-text="{{ isset($data) && $data->rolenm ? $data->rolenm : '' }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm cursor-pointer"
                            required>
                        </select>
                    </div>
                    <div id="namatoko" class="hidden group transition-all duration-300">
                        <label for="storenm" class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Nama
                            Toko</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-store"></i>
                            </span>
                            <input type="text" name="storenm" id="storenm"
                                value="{{ isset($data) ? $data->storenm : '' }}"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                placeholder="Masukkan nama toko Anda">
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="history.back()"
                        class="px-6 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-200 transition-colors text-sm">
                        Batal
                    </button>
                    <button type="submit" id="btnSubmit"
                        class="px-8 py-2.5 rounded-xl bg-[#2E973E] text-white font-bold hover:bg-[#1b5e20] shadow-lg shadow-green-200 hover:shadow-green-300 transition-all transform active:scale-95 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        @elseif($type === 'menu')
            <form id="formData"
                action="{{ isset($data) ? route('admin_editformprocess', ['type' => $type, 'id' => $data->menuid]) : route('admin_formaddprocess', ['type' => $type]) }}"
                method="POST" class="flex flex-col h-full">
                @csrf
                <div class="p-6 md:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="group">
                            <label for="menunm" class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Nama
                                Menu</label>
                            <input type="text" name="menunm" id="menunm"
                                value="{{ isset($data) ? $data->menunm : '' }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                required placeholder="Contoh: Dashboard">
                        </div>
                        <div class="group">
                            <label for="submenu"
                                class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Parent Menu
                                (Opsional)</label>
                            <select name="parentid" id="submenu"
                                data-selected="{{ isset($data) && $data->parentid ? $data->parentid : '' }}"
                                data-selected-text="{{ isset($data) && $data->submenunm ? $data->submenunm : '' }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm cursor-pointer">
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="group md:col-span-2">
                            <label for="menulink"
                                class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Route Link</label>
                            <div class="relative">
                                <span
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-link"></i>
                                </span>
                                <input type="text" name="menulink" id="menulink"
                                    value="{{ isset($data) ? $data->menulink : '' }}"
                                    class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                    required placeholder="route_name">
                            </div>
                        </div>
                        <div class="group">
                            <label for="sequence"
                                class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Urutan</label>
                            <input type="number" name="sequence" id="sequence"
                                value="{{ isset($data) ? $data->sequence : '' }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm text-center"
                                required>
                        </div>
                    </div>
                    <div class="group">
                        <label for="menuicon" class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Icon
                            Class (FontAwesome)</label>
                        <div class="flex gap-4">
                            <div class="relative flex-1">
                                <span
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fa-solid fa-icons"></i>
                                </span>
                                <input type="text" name="menuicon" id="menuicon"
                                    value="{{ isset($data) ? $data->menuicon : '' }}"
                                    class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                    placeholder="fa-solid fa-home">
                            </div>
                            <div
                                class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-600 border border-gray-200">
                                <i class="{{ isset($data) ? $data->menuicon : 'fa-solid fa-question' }} text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                    <button type="button" onclick="history.back()"
                        class="px-6 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-200 transition-colors text-sm">
                        Batal
                    </button>
                    <button type="submit" id="btnSubmit"
                        class="px-8 py-2.5 rounded-xl bg-[#2E973E] text-white font-bold hover:bg-[#1b5e20] shadow-lg shadow-green-200 hover:shadow-green-300 transition-all transform active:scale-95 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-save"></i> Simpan Menu
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
