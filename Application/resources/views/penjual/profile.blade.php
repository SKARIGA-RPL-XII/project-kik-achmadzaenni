<div class="w-full h-[86vh] rounded-xl">
    <div
        class="flex justify-between items-center border-t border-b border-[#54834E] text-xl font-semibold shadow-lg rounded-xl bg-white p-3 mb-4">
        <div class="">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </div>
    </div>
    <div class="flex flex-col md:flex-row h-[76vh] gap-4">
        <div
            class="w-full md:w-1/2 bg-white border border-[#54834E] rounded-xl p-8 flex flex-col justify-start items-center shadow-xl">
            <div class="w-full flex justify-start items-center mb-6">
                <div class="w-32 h-32 border rounded-full"></div>
                <div
                    class="relative top-6 right-6 bg-[#54834E] text-white p-2 rounded-full cursor-pointer hover:bg-[#2E973E]">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div class="flex items-start flex-col">
                    <div class="text-center text-lg font-medium">My Name</div>
                    <div class="text-center text-md font-normal">example@gmail.com</div>
                </div>
            </div>
            <div class="w-full text-gray-600 space-y-4 overflow-y-auto scrollbar">
                <div class="">
                    <label for="input-group-1" class="block mb-2 font-medium text-md">Phone</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <input type="text" id="input-group-1"
                            class="block w-full ps-9 pe-3 py-2 bg-gray-50 border border-[#54834E] text-md text-md rounded-xl focus:ring-brand focus:border-brand shadow-lg placeholder:text-md"
                            placeholder="Phone">
                    </div>
                </div>
                <div class="">
                    <label for="input-group-1" class="block mb-2 font-medium text-md">Sidik Jari</label>
                    <div class="flex flex-row items-center gap-3">
                        <i class="text-xl fa-brands fa-500px"></i>
                        <div class="w-full flex flex-row">
                            <input type="text"
                                class="w-full bg-linear-to-r from-[#2E973E]/30 to-[#2E973E]/10 text-black p-2 rounded-l-xl"
                                placeholder="Jumlah Terdaftar 3">
                            <button type="button"
                                class="bg-[#2E973E]/70 text-white px-4 py-2 shadow-lg rounded-r-xl hover:bg-[#2E973E]/80">Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="">
                    <label for="input-group-1" class="block mb-2 font-medium text-md">Address</label>
                    <textarea class="border border-[#54834E] bg-gray-50 w-full p-2 rounded-xl shadow-lg" name="address" id="address"
                        cols="" rows="5">adress</textarea>
                </div>
                <div class="flex flex-row gap-3">
                    <button type="button"
                        class="bg-[#2E973E]/80 text-white px-4 py-2 shadow-lg rounded-xl hover:bg-[#2E973E]/80">
                        Edit Profile
                    </button>
                    <button type="button"
                        class="bg-[#2E973E]/80 text-white px-4 py-2 shadow-lg rounded-xl hover:bg-[#2E973E]/80">
                        Change Password
                    </button>
                </div>
            </div>
        </div>
        <div
            class="hidden w-full md:w-1/2 bg-white rounded-xl flex flex-col items-center shadow-xl overflow-y-auto scrollbar">
            <div
                class="w-full border-t border-b border-[#54834E] rounded-xl shadow-lg flex justify-between items-center p-2">
                <h1 class="text-xl font-medium">Profile</h1>
                <div class="">
                    <button type="button"
                        class="bg-red-400 text-white px-4 py-2 shadow-lg rounded-lg hover:bg-red-500">Batal</button>
                    <button type="button"
                        class="bg-[#2E973E]/80 text-white px-4 py-2 shadow-lg rounded-lg hover:bg-[#2E973E]">Simpan</button>
                </div>
            </div>
            <div class="w-full border-b border-[#54834E] text-gray-600 space-y-4 p-4">
                <div class="space-y-2">
                    <label class="font-medium text-md">Nickname</label>
                    <input type="text"
                        class="border border-[#54834E] bg-gray-50 rounded-xl p-2 shadow-lg w-full mt-2"
                        placeholder="Nickname" />
                </div>
                <div class="">
                    <label class="font-medium text-md">Email</label>
                    <input type="email"
                        class="border border-[#54834E] bg-gray-50 rounded-xl p-2 shadow-lg w-full mt-2"
                        placeholder="Email">
                </div>
                <div class="flex flex-row gap-3">
                    <div class="w-full">
                        <label class="font-medium text-md">Negara</label>
                        <select name="negara" id="negara"
                            class="border border-[#54834E] bg-gray-50 rounded-xl p-2 shadow-lg w-full mt-2">
                            <option value="#">Pilih Negara</option>
                            <option value="indonesia">Indonesia</option>
                            <option value="malaysia">Malaysia</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label class="font-medium text-md">Provinsi</label>
                        <select name="province" id="province"
                            class="border border-[#54834E] bg-gray-50 rounded-xl p-2 shadow-lg w-full mt-2">
                            <option value="#">Pilih Provinsi</option>
                            <option value="jawa_barat">Jawa Barat</option>
                            <option value="jawa_tengah">Jawa Tengah</option>
                        </select>
                    </div>
                </div>
                <div class="w-full">
                    <label for="address" class="text-md font-medium">Address</label>
                    <textarea class="border border-[#54834E] bg-gray-50 rounded-xl p-2 shadow-lg w-full mt-2" name="address" id="address"
                        cols="30" rows="5">
                    </textarea>
                </div>
            </div>
        </div>
        <div class="hidden w-full md:w-1/2 bg-white rounded-xl flex flex-col items-center shadow-xl">
            <div
                class="w-full border-t border-b border-[#54834E] rounded-xl shadow-lg flex justify-between items-center p-2 mb-4">
                <h1 class="text-center text-xl font-medium">Edit Password</h1>
                <div class="">
                    <button type="button"
                        class="bg-red-400 text-white px-4 py-2 shadow-lg rounded-lg hover:bg-red-500">Batal</button>
                    <button type="button"
                        class="bg-[#2E973E]/80 text-white px-4 py-2 shadow-lg rounded-lg hover:bg-[#2E973E]">Simpan</button>
                </div>
            </div>
            <div class="w-full text-gray-600 space-y-4 p-4">
                <div class="">
                    <label for="input-group-1" class="block mb-2 font-medium text-md">Password Lama</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input type="text" id="input-group-1"
                            class="block w-full ps-9 pe-3 py-2 bg-gray-50 border border-[#54834E] text-md text-md rounded-xl focus:ring-brand focus:border-brand shadow-lg placeholder:text-md"
                            placeholder="Password Lama">
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row gap-3">
                    <div class="w-full">
                        <label for="input-group-1" class="block mb-2 font-medium text-md">New Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="text" id="input-group-1"
                                class="block w-full ps-9 pe-3 py-2 bg-gray-50 border border-[#54834E] text-md text-md rounded-xl focus:ring-brand focus:border-brand shadow-lg placeholder:text-md"
                                placeholder="Password Lama">
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="input-group-1" class="block mb-2 font-medium text-md">Confirm New Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="text" id="input-group-1"
                                class="block w-full ps-9 pe-3 py-2 bg-gray-50 border border-[#54834E] text-md text-md rounded-xl focus:ring-brand focus:border-brand shadow-lg placeholder:text-md"
                                placeholder="Password Lama">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 bg-white rounded-xl flex flex-col flex-1 items-center shadow-xl">
            <div
                class="w-full border-t border-b border-[#54834E] rounded-xl shadow-lg flex justify-between items-center p-2 mb-4">
                <h1 class="text-center text-xl font-medium">Sidik Jari</h1>
                <div class="">
                    <button type="button"
                        class="bg-red-400 text-white px-4 py-2 shadow-lg rounded-lg hover:bg-red-500">Batal</button>
                    <button type="button"
                        class="bg-[#2E973E]/80 text-white px-4 py-2 shadow-lg rounded-lg hover:bg-[#2E973E]">Simpan</button>
                </div>
            </div>
            <div class="w-full flex flex-col flex-1 text-gray-600 space-y-4 p-4">
                <h2 class="text-md font-medium">Daftar sidik jari</h2>
                <div class="space-y-2 overflow-y-auto scrollbar max-h-[40vh]">
                    <div
                        class="w-full flex justify-between items-center border-[#54834E] border-t border-b rounded-xl p-2">
                        <div class="flex flex-row gap-4">
                            <i class="text-xl fa-brands fa-500px"></i>
                            <h3 class="text-md font-medium">Sidik jari 1</h3>
                        </div>
                        <button type="button" class="text-red-400 hover:text-red-500"><i
                                class="fa fa-trash"></i></button>
                    </div>
                    <div
                        class="w-full flex justify-between items-center border-[#54834E] border-t border-b rounded-xl p-2">
                        <div class="flex flex-row gap-4">
                            <i class="text-xl fa-brands fa-500px"></i>
                            <h3 class="text-md font-medium">Sidik jari 1</h3>
                        </div>
                        <button type="button" class="text-red-400 hover:text-red-500"><i
                                class="fa fa-trash"></i></button>
                    </div>
                    <div
                        class="w-full flex justify-between items-center border-[#54834E] border-t border-b rounded-xl p-2">
                        <div class="flex flex-row gap-4">
                            <i class="text-xl fa-brands fa-500px"></i>
                            <h3 class="text-md font-medium">Sidik jari 1</h3>
                        </div>
                        <button type="button" class="text-red-400 hover:text-red-500"><i
                                class="fa fa-trash"></i></button>
                    </div>
                    <div
                        class="w-full flex justify-between items-center border-[#54834E] border-t border-b rounded-xl p-2">
                        <div class="flex flex-row gap-4">
                            <i class="text-xl fa-brands fa-500px"></i>
                            <h3 class="text-md font-medium">Sidik jari 1</h3>
                        </div>
                        <button type="button" class="text-red-400 hover:text-red-500"><i
                                class="fa fa-trash"></i></button>
                    </div>
                    <div
                        class="w-full flex justify-between items-center border-[#54834E] border-t border-b rounded-xl p-2">
                        <div class="flex flex-row gap-4">
                            <i class="text-xl fa-brands fa-500px"></i>
                            <h3 class="text-md font-medium">Sidik jari 1</h3>
                        </div>
                        <button type="button" class="text-red-400 hover:text-red-500"><i
                                class="fa fa-trash"></i></button>
                    </div>
                    <div
                        class="w-full flex justify-between items-center border-[#54834E] border-t border-b rounded-xl p-2">
                        <div class="flex flex-row gap-4">
                            <i class="text-xl fa-brands fa-500px"></i>
                            <h3 class="text-md font-medium">Sidik jari 1</h3>
                        </div>
                        <button type="button" class="text-red-400 hover:text-red-500"><i
                                class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="w-full flex justify-around items-end mt-auto pt-4">
                    <button type="button"
                        class="bg-[#2E973E]/80 px-4 py-2 rounded-xl shadow-lg text-white hover:bg-[#2E973E]">Verifikasi
                        sidik jari</button>
                    <button type="button"
                        class="bg-[#2E973E]/80 px-4 py-2 rounded-xl shadow-lg text-white hover:bg-[#2E973E]">Tambah
                        sidik jari</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#negara').select2({
            placeholder: "Pilih Negara",
            allowClear: true
        });
        $('#province').select2({
            placeholder: "Pilih Provinsi",
            allowClear: true
        });
    });
</script>
