<div class="flex justify-center items-center z-10 w-full px-4 py-8">
    <form method="POST" action="{{ route('registerProcess') }}" data-ajax-submit class="w-full max-w-lg bg-white/95 backdrop-blur-sm p-8 md:p-10 rounded-3xl flex flex-col gap-5 shadow-2xl border border-white/20 relative overflow-hidden">
        @csrf
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#54834E] to-[#88c47e]"></div>
        <div class="text-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h1>
            <p class="text-gray-500 text-sm mt-2">Bergabunglah dengan kami sekarang</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="w-full">
                <label for="usernm" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Nickname</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-[#54834E] transition-colors">
                        <i class="fa-regular fa-user"></i>
                    </span>
                    <input type="text" name="usernm" id="usernm" placeholder="Nama Panggilan" value="{{ old('usernm') }}"
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#54834E]/50 focus:border-[#54834E] transition-all shadow-sm @error('usernm') border-red-500 @enderror" required>
                </div>
                @error('usernm') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
            </div>
            <div class="w-full">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Email</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-[#54834E] transition-colors">
                        <i class="fa-regular fa-envelope"></i>
                    </span>
                    <input type="email" name="email" id="email" placeholder="contoh@email.com" value="{{ old('email') }}"
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#54834E]/50 focus:border-[#54834E] transition-all shadow-sm @error('email') border-red-500 @enderror" required>
                </div>
                @error('email') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="grid grid-cols-1 gap-5">
            <div class="w-full">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Password</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-[#54834E] transition-colors">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" name="password" id="password" placeholder="Buat password kuat"
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#54834E]/50 focus:border-[#54834E] transition-all shadow-sm @error('password') border-red-500 @enderror" required>
                </div>
                @error('password') <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p> @enderror
            </div>
            <div class="w-full">
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Konfirmasi Password</label>
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-[#54834E] transition-colors">
                        <i class="fa-solid fa-check-double"></i>
                    </span>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password"
                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#54834E]/50 focus:border-[#54834E] transition-all shadow-sm @error('password_confirmation') border-red-500 @enderror" required>
                </div>
            </div>
        </div>
        <button type="submit"
            class="w-full mt-4 bg-gradient-to-r from-[#54834E] to-[#40663a] hover:from-[#40663a] hover:to-[#2e4d29] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-green-900/20 hover:shadow-green-900/40 transform active:scale-[0.98] transition-all duration-200">
            Daftar Sekarang
        </button>
        <div class="text-center mt-2">
            <p class="text-sm text-gray-600">Sudah memiliki akun? 
                <a href="{{ route('loginForm') }}" class="font-bold text-[#54834E] hover:text-[#2E973E] transition-colors hover:underline">
                    Login Here
                </a>
            </p>
        </div>
    </form>
</div>