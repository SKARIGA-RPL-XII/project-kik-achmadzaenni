<div class="w-full min-h-[86vh] p-1 flex flex-col gap-6">

    <div
        class="flex flex-col md:flex-row justify-between items-start md:items-center bg-white rounded-2xl shadow-sm border border-gray-100 p-5 gap-4">
        <div>
            <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                <?= $subtitle ?>
            </h1>
            <p class="text-xs text-gray-400 mt-1">Pastikan data produk yang diinput sudah benar.</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" onclick="history.back()"
                class="px-5 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-100 transition-colors text-sm border border-gray-200 bg-white">
                Batal
            </button>
            <button type="submit" form="formData" id="btnSubmit"
                class="px-6 py-2.5 rounded-xl bg-[#2E973E] text-white font-bold hover:bg-[#1b5e20] shadow-lg shadow-green-200 transition-all transform active:scale-95 text-sm flex items-center gap-2">
                <i class="fa-solid fa-check"></i> Simpan
            </button>
        </div>
    </div>
    <form id="formData"
        action="{{ isset($data) ? route('penjual_formeditprocess', ['id' => $data->brgid]) : route('penjual_formaddprocess') }}"
        method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6 h-full">
        @csrf
        <div class="w-full lg:w-1/3">
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm h-full flex flex-col">
                <h3 class="text-sm font-bold text-gray-700 mb-4">Foto Produk</h3>
                <div
                    class="relative flex-1 min-h-[300px] bg-gray-50 border-2 border-dashed border-gray-300 rounded-2xl flex flex-col justify-center items-center group hover:border-[#2E973E] transition-all overflow-hidden">
                    <img id="imagePreview"
                        src="{{ isset($data) && $data->exfilenm ? asset('uploads/' . $data->exfilenm) : '' }}"
                        class="{{ isset($data) && $data->exfilenm ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover z-10"
                        alt="Preview">
                    <div
                        class="z-0 flex flex-col items-center justify-center text-gray-400 group-hover:text-[#2E973E] transition-colors p-4 text-center">
                        <div class="w-16 h-16 bg-white rounded-full shadow-sm flex items-center justify-center mb-3">
                            <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>
                        </div>
                        <p class="text-sm font-semibold">Klik atau Drag foto ke sini</p>
                        <p class="text-xs mt-1 text-gray-400">Format: JPG, PNG (Max 2MB)</p>
                    </div>
                    <input type="file" name="fileid" id="fileid"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20"
                        {{ !isset($data) ? 'required' : '' }} onchange="previewFile(this)">
                </div>
            </div>
        </div>
        <div class="w-full lg:w-2/3">
            <div class="bg-white p-6 md:p-8 rounded-3xl border border-gray-100 shadow-sm space-y-6">
                <h3 class="text-sm font-bold text-gray-700 border-b border-gray-100 pb-3 mb-2">Informasi Utama</h3>
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Nama Produk</label>
                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-tag"></i>
                        </span>
                        <input type="text" name="brgnm" id="brgnm"
                            value="{{ isset($data) ? $data->brgnm : '' }}"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                            required placeholder="Contoh: Kopi Susu Gula Aren">
                    </div>
                </div>
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Barcode / SKU</label>
                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-barcode"></i>
                        </span>
                        <input type="number" name="barcode" id="barcode"
                            value="{{ isset($data) ? $data->barcode : '' }}"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                            required placeholder="Scan atau ketik kode">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Harga Jual</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 font-bold">
                                Rp
                            </span>
                            <input type="number" name="price" id="price"
                                value="{{ isset($data) ? $data->price : '' }}"
                                class="w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                required placeholder="0">
                        </div>
                    </div>
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Stok Awal (Qty)</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </span>
                            <input type="number" name="qty" id="qty"
                                value="{{ isset($data) ? $data->qty : '' }}"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                                required placeholder="0">
                        </div>
                    </div>
                </div>
                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Tanggal Kadaluarsa</label>
                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-regular fa-calendar"></i>
                        </span>
                        <input type="date" name="expired" id="expired"
                            value="{{ isset($data) ? $data->expired : '' }}"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#2E973E] focus:bg-white transition-all shadow-sm"
                            required>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function previewFile(input) {
        const file = input.files[0];
        const preview = document.getElementById('imagePreview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }
</script>
