<div class="w-full h-[86vh] flex flex-col gap-6 p-1 pb-20">
    <div class="sticky top-0 z-10 w-full">
        <div
            class="w-full flex flex-row justify-between items-center bg-white/95 backdrop-blur-md border border-[#54834E]/20 shadow-lg rounded-2xl p-3 gap-3 transition-all">
            <form class="flex-1 w-full relative group">
                <div class="relative w-full">
                    <span
                        class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#54834E] transition-colors">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" id="simple-search"
                        class="w-full pl-11 pr-12 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm font-medium focus:outline-none focus:ring-2 focus:ring-[#54834E] focus:bg-white transition-all shadow-inner placeholder:text-gray-400"
                        placeholder="Cari barang keinginanmu..." required />

                    <button type="submit" class="absolute inset-y-0 right-2 flex items-center">
                        <div
                            class="bg-[#54834E] hover:bg-[#1b5e20] text-white w-9 h-9 rounded-lg flex items-center justify-center transition-all shadow-md active:scale-95">
                            <i class="fa-solid fa-arrow-right text-sm"></i>
                        </div>
                    </button>
                </div>
            </form>
            <a href="{{ route('user_keranjang') }}"
                class="group relative flex items-center bg-success-soft border border-success-subtle text-fg-success-strong hover:bg-white hover:shadow-md hover:border-success-medium transition-all duration-300 font-medium rounded-xl text-sm p-3 focus:outline-none shrink-0">
                <span
                    class="max-w-0 overflow-hidden opacity-0 whitespace-nowrap transition-all duration-500 ease-in-out group-hover:max-w-[100px] group-hover:opacity-100 group-hover:mr-2">
                    Keranjang
                </span>
                <i class="fa-solid fa-bag-shopping text-lg"></i>
                <div id="card-badge"
                    class="absolute -top-1 -end-1 inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold text-white bg-red-500 border-2 border-white rounded-full shadow-sm animate-pulse">
                    {{ $data ?? 0 }}
                </div>
            </a>
        </div>
    </div>
    <div class="w-full mx-auto max-w-6xl grid grid-cols-1 md:grid-cols-3 gap-6 justify-items-center items-start">
        @if (isset($datas) && $datas->count())
            @foreach ($datas as $data)
                <div class="w-full group">
                    <div
                        class="w-full max-w-sm bg-neutral-primary-soft p-6 border border-default rounded-base shadow-lg transition-all duration-300 scale-100 hover:scale-102">
                        <div class="relative w-full overflow-hidden">
                            <img class="rounded-base mb-6"
                                src="{{ asset('uploads/' . ($data->exfilenm ?? 'apple-watch.png')) }}"
                                alt="<?= $data->filenm ?>" />
                            <div
                                class="absolute top-3 left-3 bg-white/90 backdrop-blur text-xs font-bold px-2 py-1 rounded-lg shadow-sm border border-gray-100 text-gray-700">
                                Stok: <?= $data->qty ?>
                            </div>
                            <button type="button" 
                                    class="btn-add-cart absolute bottom-3 right-3 bg-white text-[#2E973E] w-10 h-10 rounded-full shadow-lg flex items-center justify-center translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 hover:bg-[#2E973E] hover:text-white z-10 hover:scale-110 active:scale-90"
                                    data-id="{{ $data->brgid }}">
                                <i class="fa-solid fa-plus text-lg icon-plus"></i>
                            </button>
                        </div>
                        <div>
                            <a href="#">
                                <h5
                                    class="text-xl text-heading break-words line-clamp-1 min-h-[3.2rem] font-semibold tracking-tight">
                                    <?= $data->brgnm ?></h5>
                            </a>
                            <div class="flex justify-between items-center mb-6">
                                <div
                                    class="inline-flex items-center bg-brand-softer border border-brand-subtle text-fg-brand-strong text-xs font-medium px-1.5 py-0.5 rounded-sm cursor-pointer overflow-hidden">
                                    <i
                                        class="fa-solid fa-location-dot transition-all duration-500 ease-in-out opacity-100 max-w-[20px] group-hover:max-w-0 group-hover:opacity-0 group-hover:overflow-hidden"></i>
                                    <span
                                        class="whitespace-nowrap overflow-hidden opacity-0 max-w-0 transition-all duration-500 ease-in-out group-hover:max-w-[200px] group-hover:opacity-100">
                                        <?= $data->storenm ?>
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-6">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400 font-medium">Harga</span>
                                    <span class="text-lg font-extrabold text-success-strong">
                                        <span
                                            class="text-xs align-top mr-0.5">Rp</span><?= number_format($data->price, 0, ', ', '.') ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="font-bold text-xl">Tidak ada produk</div>
        @endif
    </div>
</div>
