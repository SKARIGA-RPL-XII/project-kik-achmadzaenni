<div class="w-full flex justify-center items-center px-4 py-8 z-5">
    <form method="POST" action="{{ route('registerProcess') }}" data-ajax-submit
        class="w-full max-w-md md:max-w-lg border-3 border-[#54834E] bg-white p-6 md:p-8 rounded-3xl flex flex-col space-y-6 shadow-sm">
        @csrf
        <div class="text-center">
            <h1 class="text-2xl font-semibold">Registrasi</h1>
            <h3 class="text-lg font-medium">Silahkan daftar untuk menggunakan dalam aplikasi</h3>
        </div>
        <div class="w-full relative">
            <div class="relative">
                <div class="flex flex-col">
                    <label for="nickname">Nickname</label>
                    <input type="text"
                        class="border-2 border-[#54834E] rounded-lg p-1 shadow-xl @error('nickname') border-red-500 @enderror"
                        name="nickname" id="nickname" placeholder="Nickname" value="{{ old('nickname') }}" required>
                    @error('nickname')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="w-full relative">
            <div class="relative">
                <div class="flex flex-col">
                    <label for="email">Email</label>
                    <input type="text"
                        class="border-2 border-[#54834E] rounded-lg p-1 shadow-xl @error('email') border-red-500 @enderror"
                        name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="w-full flex flex-col md:flex-row items-start md:items-center gap-3">
            <div class="w-full md:w-1/2 relative">
                <div class="relative">
                    <div class="flex flex-col">
                        <label for="password">Password</label>
                        <input type="password"
                            class="w-full border-2 border-[#54834E] rounded-lg p-2 shadow-sm @error('password') border-red-500 @enderror"
                            name="password" id="password" placeholder="Password" required>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/2 relative">
                <div class="relative">
                    <div class="flex flex-col">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password"
                            class="w-full border-2 border-[#54834E] rounded-lg p-2 shadow-sm @error('password_confirmation') border-red-500 @enderror"
                            name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"
                            required>
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <button type="submit"
            class="w-full bg-[#54834E] text-white rounded-lg shadow p-2 hover:bg-[#2E973E]">Registrasi</button>
        <h4 class="text-sm text-gray-600">Sudah punya akun? <a href="{{ route('loginForm') }}"
                class="cursor-pointer text-[#1638E2]">Login disini</a></h4>
    </form>
</div>
