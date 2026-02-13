<div class="flex justify-center items-center z-10 w-full px-4">
    <form action="{{ route('loginProcess') }}" method="POST" data-ajax-submit
        class="w-full max-w-md bg-white/95 backdrop-blur-sm p-8 md:p-10 rounded-3xl flex flex-col gap-6 shadow-2xl border border-white/20 relative overflow-hidden">
        @csrf
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#54834E] to-[#88c47e]"></div>
        <div class="text-center mb-2">
            <h1 class="text-3xl font-bold text-gray-800">Selamat Datang</h1>
            <p class="text-gray-500 text-sm mt-2">Masuk untuk melanjutkan akses aplikasi</p>
        </div>
        <div class="w-full">
            <label for="usernm" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Nickname / Email</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-[#54834E] transition-colors">
                    <i class="fa-regular fa-user"></i>
                </span>
                <input type="text" name="usernm" id="usernm" placeholder="Masukkan nickname atau email" value="{{ old('usernm') }}"
                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#54834E]/50 focus:border-[#54834E] transition-all shadow-sm @error('usernm') border-red-500 focus:ring-red-200 @enderror" required>
            </div>
            @error('usernm')
                <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="w-full">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2 ml-1">Password</label>
            <div class="relative group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400 group-focus-within:text-[#54834E] transition-colors">
                    <i class="fa-solid fa-lock"></i>
                </span>
                
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="w-full pl-11 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#54834E]/50 focus:border-[#54834E] transition-all shadow-sm @error('password') border-red-500 focus:ring-red-200 @enderror" required>
                
                <button type="button" id="togglePassword" 
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-[#54834E] focus:outline-none cursor-pointer transition-colors"
                    tabindex="-1">
                    <i class="fa-regular fa-eye text-lg"></i>
                </button>
            </div>
            @error('password')
                <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <label class="flex items-center space-x-2 cursor-pointer group">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded text-[#54834E] focus:ring-[#54834E] border-gray-300 cursor-pointer">
                <span class="text-sm text-gray-600 group-hover:text-[#54834E] transition-colors">Ingat Saya</span>
            </label>
        </div>
        <button type="submit"
            class="w-full bg-gradient-to-r from-[#54834E] to-[#40663a] hover:from-[#40663a] hover:to-[#2e4d29] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-green-900/20 hover:shadow-green-900/40 transform active:scale-[0.98] transition-all duration-200">
            Masuk Sekarang
        </button>
        <div class="text-center mt-2">
            <p class="text-sm text-gray-600">Belum memiliki akun? 
                <a href="{{ route('registerForm') }}" class="font-bold text-[#54834E] hover:text-[#2E973E] transition-colors hover:underline">
                    Daftar Here
                </a>
            </p>
        </div>
    </form>
</div>