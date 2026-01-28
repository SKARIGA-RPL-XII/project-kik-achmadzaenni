<div class="flex justify-center items-center z-5">
    <form action="{{ route('loginProcess') }}" method="POST" data-ajax-submit
        class="border-3 border-[#54834E] bg-white items-center p-6 md:p-8 rounded-2xl flex flex-col space-y-8">
        @csrf
        <div class="text-center">
            <h1 class="text-2xl font-semibold">Login</h1>
            <h3 class="text-lg font-medium">Silahkan masuk untuk mengakses aplikasi</h3>
        </div>
        <div class="w-full relative">
            <div class="relative">
                <div class="flex flex-col">
                    <label for="nickname">Nickname/Email</label>
                    <input type="text"
                        class="border-2 border-[#54834E] rounded-lg p-1 shadow-xl @error('nickname') border-red-500 @enderror"
                        name="nickname" id="nickname" placeholder="Nickname atau Email" value="{{ old('nickname') }}"
                        required>
                    @error('nickname')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="w-full relative">
            <div class="relative">
                <div class="flex flex-col">
                    <label for="password">Password</label>
                    <input type="password"
                        class="border-2 border-[#54834E] rounded-lg p-1 shadow-xl @error('password') border-red-500 @enderror"
                        name="password" id="password" placeholder="Password" required>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="w-full relative">
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm">Remember Me</label>
            </div>
        </div>
        <button type="submit"
            class="w-full bg-[#54834E] text-white py-2 mt-2 rounded-lg shadow-xl hover:bg-[#2E973E]">Login</button>
        <h4 class="w-full text-sm text-gray-600">Belum punya akun? <a href="{{ route('registerForm') }}"
                class="cursor-pointer text-[#1638E2]">Daftar
                disini</a></h4>
    </form>
</div>
