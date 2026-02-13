<div class="w-full h-[86vh] bg-gray-50 rounded-xl flex flex-col overflow-hidden">
    <div class="w-full flex justify-between items-center bg-white px-6 py-4 border-b border-brand-subtle shadow-sm z-10">
        <h1 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            Keranjang Belanja
        </h1>
        <button type="button" onclick="history.back()"
            class="group flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors bg-gray-50 px-4 py-2 rounded-xl hover:bg-gray-100">
            <i class="fa-solid fa-arrow-left text-xs transition-transform group-hover:-translate-x-1"></i> <span class="hidden md:flex">Kembali</span>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto p-4 md:p-6 scrollbar">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-4">
                @if(isset($items) && count($items) > 0)
                    @foreach($items as $item)
                        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex gap-4 transition hover:shadow-md">
                            <div class="w-24 h-24 shrink-0 bg-gray-100 rounded-lg overflow-hidden">
                                <img src="{{ asset('uploads/' . ($item->exfilenm ?? 'apple-watch.png')) }}" 
                                     alt="{{ $item->brgnm }}" 
                                     class="w-full h-full object-cover"
                                     onerror="this.src='https://placehold.co/100'">
                            </div>
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <h3 class="font-semibold text-gray-800 text-lg line-clamp-1">{{ $item->brgnm }}</h3>
                                        <button class="text-gray-400 hover:text-red-500 transition btn-delete-cart" data-id="{{ $item->cartid }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">@ Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>

                                <div class="flex justify-between items-end mt-2">
                                    <span class="font-bold text-brand-strong text-lg">
                                        Rp <span id="item-total-{{ $item->cartid}}">{{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                                    </span>

                                    <div class="flex items-center border border-gray-200 rounded-lg bg-gray-50">
                                        <button type="button" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-gray-200 rounded-l-lg transition btn-update-qty" data-id="{{ $item->cartid }}" data-action="minus">-</button> 
                                        <input type="text" id="qty-input-{{ $item->cartid }}" value="{{ $item->qty }}"
                                            class="w-10 text-center bg-transparent text-sm font-semibold focus:outline-none"
                                            readonly>
                                        <button type="button" class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-gray-200 rounded-r-lg transition btn-update-qty" data-id="{{ $item->cartid }}" data-action="plus">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex flex-col items-center justify-center h-64 text-gray-500">
                        <i class="fa-solid fa-basket-shopping text-6xl mb-4 text-gray-300"></i>
                        <p class="text-lg font-medium">Keranjang Anda kosong</p>
                        <a href="{{ route('user_belanja') }}" class="mt-4 text-green-600 font-bold hover:underline">Mulai Belanja</a>
                    </div>
                @endif
            </div>
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-lg sticky top-0">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>
                    <div class="space-y-3 text-sm text-gray-600 border-b border-gray-100 pb-4">
                        <div class="flex justify-between">
                            <span>Subtotal ({{ count($items ?? []) }} Item)</span>
                            <span>Rp <span id="summary-subtotal">{{ number_format($total ?? 0, 0, ',', '.') }}</span></span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Pajak (10%)</span>
                            <span>Rp <span id="summary-pajak">{{ number_format($pajak ?? 0, 0, ',', '.') }}</span></span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center py-4">
                        <span class="font-semibold text-gray-800">Total Tagihan</span>
                        <span class="text-xl font-bold text-success-strong">
                            Rp <span id="summary-grand-total">{{ number_format($Tagihan ?? 0, 0, ',', '.') }}</span>
                        </span>
                    </div>
                    <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-md hover:shadow-lg transition-all transform hover:-translate-y-0.5 duration-200 flex justify-center items-center gap-2 {{ (isset($cartItems) && count($cartItems) > 0) ? '' : 'opacity-50 cursor-not-allowed' }}" {{ (isset($cartItems) && count($cartItems) > 0) ? '' : 'disabled' }}>
                        Checkout Sekarang
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-3">
                        <i class="fa-solid fa-lock"></i> Pembayaran Aman & Terpercaya
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>