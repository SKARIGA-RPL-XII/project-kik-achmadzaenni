<div class="w-full h-[86vh]">
    <div class="w-full h-[30%] border border-[#54834E] flex justify-center items-center shadow-lg rounded-xl mb-3">
        <div class="w-full flex justify-between items-center border-b rounded-xl p-4">
            <h1 class="text-md font-medium">Rp.<span class="text-3xl font-bold">500.000</span></h1>
            <div class="flex flex-row text-white gap-6">
                <div
                    class="flex flex-row bg-[#2E973E]/60 hover:bg-[#2E973E]/70 transition-all scale-100 hover:scale-102 px-4 py-2 rounded-xl shadow-lg gap-2">
                    <i class="text-3xl font-semibold fa-regular fa-circle-up"></i>
                    <h2 class="text-xl font-semibold">Top Up</h2>
                </div>
                <div
                    class="flex flex-row bg-red-400 hover:bg-red-500 px-4 py-2 transition-all scale-100 hover:scale-102 rounded-xl shadow-lg gap-2">
                    <i class="text-3xl font-semibold fa-regular fa-circle-down"></i>
                    <h2 class="text-xl font-semibold">Tarik Dana</h2>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="w-full h-[68%] flex flex-col md:flex-row gap-3">
        <div class="w-full border border-[#54834E] shadow-lg rounded-xl">
            <div class="w-full flex justify-between items-center p-3 rounded-xl border-b border-[#54834E]">
                <h1 class="text-xl font-semibold">Transaction <span class="text-[#54834E]">Chart</span></h1>
                <select name="timeframe" id="timeframe" class="bg-[#2E973E]/50 rounded-xl p-2">
                    <option value="7days">Last 7 Days</option>
                    <option value="1month">Last 1 Month</option>
                    <option value="3months">Last 3 Months</option>
                    <option value="6months">Last 6 Months</option>
                    <option value="1year">Last 1 Year</option>
                </select>
            </div>
        </div>
        <div class="w-full md:w-2/4 border border-[#54834E] shadow-lg rounded-xl">
            <div class="w-full flex justify-between items-center border-b border-[#54834E] p-3 rounded-xl mb-3">
                <h1 class="text-xl font-semibold">Lihat <span class="text-[#54834E]">Trafik</span></h1>
                <div class="bg-[#EFEA62] px-3 p-2 rounded-full">
                    <i class="text-[#54834E] text-xl fa-regular fa-circle-up"></i>
                    <i class="text-red-400 text-xl fa-regular fa-circle-down"></i>
                </div>
            </div>
            <div class="w-full h-[78%] space-y-2 p-3 overflow-y-auto scrollbar">
                <div
                    class="w-full flex flex-row justify-between items-center bg-linear-to-r from-[#2E973E]/30 to-[#2E973E]/10 transition-all scale-100 hover:scale-102 shadow-lg rounded-2xl p-1 gap-3">
                    <div class="w-full flex flex-row items-center">
                        <i class="text-[#54834E] text-3xl fa-regular fa-circle-up"></i>
                        <div class="">
                            <h2 class="text-sm font-medium">Top Up</h2>
                            <p class="text-sm font-medium">Rp.<span class="text-lg font-semibold">20.000</span></p>
                        </div>
                    </div>
                    <div class="">
                        <i class="text-[#54834E] fa-solid fa-arrow-right"></i>
                    </div>
                </div>
                <div
                    class="w-full flex flex-row justify-between items-center bg-linear-to-r from-red-400/30 to-red-400/10 transition-all scale-100 hover:scale-102 shadow-lg rounded-2xl p-1 gap-3">
                    <div class="w-full flex flex-row items-center">
                        <i class="text-red-500 text-3xl fa-regular fa-circle-down"></i>
                        <div class="">
                            <h2 class="text-sm font-medium">Transfer</h2>
                            <p class="text-sm font-medium">Rp.<span class="text-lg font-semibold">50.000</span></p>
                        </div>
                    </div>
                    <div class="">
                        <i class="text-red-500 fa-solid fa-arrow-right"></i>
                    </div>
                </div>
                <div
                    class="w-full flex flex-row justify-between items-center bg-linear-to-r from-[#2E973E]/30 to-[#2E973E]/10 transition-all scale-100 hover:scale-102 shadow-lg rounded-2xl p-1 gap-3">
                    <div class="w-full flex flex-row items-center">
                        <i class="text-[#54834E] text-3xl fa-regular fa-circle-up"></i>
                        <div class="">
                            <h2 class="text-sm font-medium">Top Up</h2>
                            <p class="text-sm font-medium">Rp.<span class="text-lg font-semibold">20.000</span></p>
                        </div>
                    </div>
                    <div class="">
                        <i class="text-[#54834E] fa-solid fa-arrow-right"></i>
                    </div>
                </div>
                <div
                    class="w-full flex flex-row justify-between items-center bg-linear-to-r from-red-400/30 to-red-400/10 transition-all scale-100 hover:scale-102 shadow-lg rounded-2xl p-1 gap-3">
                    <div class="w-full flex flex-row items-center">
                        <i class="text-red-500 text-3xl fa-regular fa-circle-down"></i>
                        <div class="">
                            <h2 class="text-sm font-medium">Transfer</h2>
                            <p class="text-sm font-medium">Rp.<span class="text-lg font-semibold">50.000</span></p>
                        </div>
                    </div>
                    <div class="">
                        <i class="text-red-500 fa-solid fa-arrow-right"></i>
                    </div>
                </div>
                <div
                    class="w-full flex flex-row justify-between items-center bg-linear-to-r from-[#2E973E]/30 to-[#2E973E]/10 transition-all scale-100 hover:scale-102 shadow-lg rounded-2xl p-1 gap-3">
                    <div class="w-full flex flex-row items-center">
                        <i class="text-[#54834E] text-3xl fa-regular fa-circle-up"></i>
                        <div class="">
                            <h2 class="text-sm font-medium">Top Up</h2>
                            <p class="text-sm font-medium">Rp.<span class="text-lg font-semibold">20.000</span></p>
                        </div>
                    </div>
                    <div class="">
                        <i class="text-[#54834E] fa-solid fa-arrow-right"></i>
                    </div>
                </div>
                <div
                    class="w-full flex flex-row justify-between items-center bg-linear-to-r from-red-400/30 to-red-400/10 transition-all scale-100 hover:scale-102 shadow-lg rounded-2xl p-1 gap-3">
                    <div class="w-full flex flex-row items-center">
                        <i class="text-red-500 text-3xl fa-regular fa-circle-down"></i>
                        <div class="">
                            <h2 class="text-sm font-medium">Transfer</h2>
                            <p class="text-sm font-medium">Rp.<span class="text-lg font-semibold">50.000</span></p>
                        </div>
                    </div>
                    <div class="">
                        <i class="text-red-500 fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
