<div class="w-full min-h-[86vh] bg-gray-50 rounded-xl p-2 md:p-6 font-sans">

    <div class="flex justify-between items-center bg-white border border-gray-100 shadow-sm rounded-2xl p-4 mb-6">
        <a href="javascript:history.back()"
            class="group flex items-center gap-3 text-gray-500 hover:text-[#54834E] transition-all font-medium">
            <div
                class="w-10 h-10 rounded-full bg-gray-50 group-hover:bg-[#54834E]/10 flex items-center justify-center transition-colors">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </div>
            <span>Kembali</span>
        </a>
        <h1 class="text-xl font-bold text-gray-800 tracking-tight hidden md:block">Pengaturan Akun</h1>
    </div>
    <div class="flex flex-col lg:flex-row gap-6 items-start relative">
        <div id="card-main"
            class="w-full bg-white border border-gray-100 rounded-3xl shadow-xl transition-all duration-500 ease-in-out flex flex-col relative overflow-hidden group">
            <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-[#1b5e20] to-[#4caf50]">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 20px 20px;">
                </div>
            </div>

            <div class="relative flex flex-col items-center mt-12 mb-6 px-6">
                <div class="relative">
                    <div class="w-36 h-36 rounded-full border-[6px] border-white shadow-2xl overflow-hidden bg-white">
                        <img src="{{ asset('uploads/default-avatar.png') }}"
                            class="w-full h-full object-cover transform hover:scale-110 transition-transform duration-500"
                            alt="photo profile">
                    </div>
                    <label
                        class="absolute bottom-2 right-2 bg-[#2E973E] text-white p-2.5 rounded-full shadow-lg cursor-pointer hover:bg-[#1b5e20] border-4 border-white transition-all hover:scale-110 active:scale-95">
                        <i class="fa-solid fa-camera w-4 h-4 flex justify-center items-center"></i>
                        <input type="file" id="upload-image-input" accept="image/*" class="hidden">
                    </label>
                </div>

                <h2 class="mt-4 text-2xl font-extrabold text-gray-800 tracking-tight text-center" id="disp-name">
                    <?= $usernm ?></h2>
                <div
                    class="flex items-center gap-2 mt-1 text-gray-500 text-sm font-medium bg-gray-100 px-3 py-1 rounded-full">
                    <i class="fa-regular fa-envelope"></i>
                    <span id="disp-email"><?= $user->email ?></span>
                </div>
            </div>
            <div class="w-full text-gray-600 space-y-4 overflow-y-auto scrollbar">
                @if ($user->roleid == 2)
                    <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Nama Toko</p>
                        <div class="flex items-center gap-3 text-gray-700 font-medium">
                            <i class="fa-solid fa-store text-[#54834E]"></i>
                            <span><?= $user->storenm ?></span>
                        </div>
                    </div>
                @endif
                <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Nomor Telepon</p>
                    <div class="flex items-center gap-3 text-gray-700 font-medium">
                        <i class="fa-solid fa-phone text-[#54834E]"></i>
                        <span><?= $user->phone ?></span>
                    </div>
                </div>
                <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-1">Alamat</p>
                    <div class="flex items-start gap-3 text-gray-700 font-medium">
                        <i class="fa-solid fa-map-location-dot text-[#54834E] mt-1"></i>
                        <span class="line-clamp-3"><?= $user->address ?></span>
                    </div>
                </div>
                <div
                    class="relative overflow-hidden rounded-2xl bg-[#2E973E] text-white p-5 shadow-lg shadow-green-200">
                    <div class="relative z-10 flex justify-between items-center">
                        <div>
                            <p class="text-green-100 text-xs font-medium mb-1">Keamanan Biometrik</p>
                            <h3 class="text-xl font-bold">3 Sidik Jari</h3>
                        </div>
                        <button id="btn-finger" type="button"
                            class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-xs font-bold transition-colors">
                            Kelola
                        </button>
                    </div>
                    <i class="fa-brands fa-500px absolute -bottom-4 -right-4 text-8xl text-white/10 rotate-12"></i>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                    <button id="btn-edit-profile" type="button"
                        class="group flex items-center justify-center gap-2 py-3.5 rounded-xl bg-[#2E973E] text-white font-semibold hover:bg-[#2E973E]/80 transition-all shadow-md active:scale-95">
                        <i class="fa-solid fa-user-pen group-hover:-translate-y-0.5 transition-transform"></i>
                        <span>Edit Profil</span>
                    </button>
                    <button id="btn-ganti-password" type="button"
                        class="group flex items-center justify-center gap-2 py-3.5 rounded-xl bg-white border-2 border-gray-200 text-gray-700 font-semibold hover:border-gray-300 hover:bg-gray-50 transition-all active:scale-95">
                        <i
                            class="fa-solid fa-key group-hover:-translate-y-0.5 transition-transform text-gray-400 group-hover:text-gray-600"></i>
                        <span>Sandi</span>
                    </button>
                </div>
            </div>
        </div>
        <form
            action="@if ($user->roleid == 1) {{ route('admin_profileprocess') }}
        @elseif($user->roleid == 2) {{ route('penjual_profileprocess') }}
        @elseif($user->roleid == 3) {{ route('user_profileprocess') }} @endif"
            id="card-profile" method="POST" data-ajax-submit
            class="bg-white w-full md:w-1/2 rounded-3xl shadow-xl border border-gray-100 overflow-hidden hidden section-card h-full flex flex-col">
            @csrf
            <div class="flex justify-between items-center p-6 border-b border-gray-100 bg-gray-50/50">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Edit Profil</h3>
                    <p class="text-xs text-gray-500 mt-1">Perbarui informasi pribadi Anda</p>
                </div>
                <button type="button"
                    class="btn-cancel w-8 h-8 rounded-full bg-gray-200 hover:bg-red-100 text-gray-500 hover:text-red-500 flex items-center justify-center transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-6 space-y-5 flex-1 overflow-y-auto custom-scrollbar">

                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Nickname</label>
                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-regular fa-user"></i>
                        </span>
                        <input type="text" name="usernm" value="<?= $user->usernm ?>" placeholder="Nama Panggilan"
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#54834E] focus:bg-white focus:border-transparent transition-all shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">No. Telepon</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-phone"></i>
                            </span>
                            <input type="text" name="phone" value="<?= $user->phone ?>" placeholder="08..."
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#54834E] focus:bg-white focus:border-transparent transition-all shadow-sm">
                        </div>
                    </div>
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Email</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input type="email" name="email" value="<?= $user->email ?>"
                                placeholder="nama@email.com"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#54834E] focus:bg-white focus:border-transparent transition-all shadow-sm">
                        </div>
                    </div>
                </div>

                <div class="group">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Alamat Lengkap</label>
                    <div class="relative">
                        <span class="absolute top-3 left-0 pl-3 flex items-start pointer-events-none text-gray-400">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </span>
                        <textarea name="address" rows="4" placeholder="Masukkan alamat lengkap..."
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#54834E] focus:bg-white focus:border-transparent transition-all shadow-sm resize-none"><?= $user->address ?></textarea>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="button"
                    class="btn-cancel px-5 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-200 transition-colors text-sm">
                    Batal
                </button>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-[#2E973E] text-white font-bold hover:bg-[#1b5e20] shadow-lg shadow-green-200 hover:shadow-green-300 transition-all transform active:scale-95 text-sm">
                    Simpan Perubahan
                </button>
            </div>
        </form>
        <form
            action="@if ($user->roleid == 1) {{ route('admin_profileprocess') }}
        @elseif($user->roleid == 2) {{ route('penjual_profileprocess') }}
        @elseif($user->roleid == 3) {{ route('user_profileprocess') }} @endif"
            id="card-password" method="POST" data-ajax-submit
            class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden hidden section-card h-full flex flex-col w-full md:w-1/2">
            @csrf

            <div class="flex justify-between items-center p-6 border-b border-gray-100 bg-gray-50/50">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Keamanan</h3>
                    <p class="text-xs text-gray-500 mt-1">Update kata sandi akun</p>
                </div>
                <button type="button"
                    class="btn-cancel w-8 h-8 rounded-full bg-gray-200 hover:bg-red-100 text-gray-500 hover:text-red-500 flex items-center justify-center transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-6 space-y-6 flex-1 overflow-y-auto">

                <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-100/50">
                    <div class="group">
                        <label class="block text-xs font-bold text-yellow-700 uppercase mb-2 ml-1">Password
                            Lama</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-yellow-500">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="old_pswd" placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-3 bg-white border border-yellow-200 rounded-xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-all shadow-sm">
                        </div>
                        <p class="text-[10px] text-yellow-600 mt-1.5 ml-1">
                            <i class="fa-solid fa-circle-info mr-1"></i> Masukkan password saat ini untuk verifikasi.
                        </p>
                    </div>
                </div>
                <hr class="border-dashed border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Password Baru</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-key"></i>
                            </span>
                            <input type="password" name="new_pswd" placeholder="Min. 8 Karakter"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#54834E] focus:bg-white focus:border-transparent transition-all shadow-sm">
                        </div>
                    </div>
                    <div class="group">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Konfirmasi
                            Password</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-check-double"></i>
                            </span>
                            <input type="password" name="confirm_pswd" placeholder="Ulangi Password Baru"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 font-medium focus:outline-none focus:ring-2 focus:ring-[#54834E] focus:bg-white focus:border-transparent transition-all shadow-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <button type="button"
                    class="btn-cancel px-5 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-200 transition-colors text-sm">
                    Batal
                </button>
                <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-[#2E973E] text-white font-bold hover:bg-[#1b5e20] shadow-lg shadow-green-200 hover:shadow-green-300 transition-all transform active:scale-95 text-sm">
                    Update Password
                </button>
            </div>
        </form>
        <form
            action="@if ($user->roleid == 1) {{ route('admin_profileprocess') }}
    @elseif($user->roleid == 2) {{ route('penjual_profileprocess') }}
    @elseif($user->roleid == 3) {{ route('user_profileprocess') }} @endif"
            id="card-finger" method="POST" data-ajax-submit
            class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden hidden section-card h-full flex flex-col w-full md:w-1/2">
            @csrf
            <div class="flex justify-between items-center p-6 border-b border-gray-100 bg-gray-50/50">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Sidik Jari</h3>
                    <p class="text-xs text-gray-500 mt-1">Kelola akses biometrik akun</p>
                </div>
                <button type="button"
                    class="btn-cancel w-8 h-8 rounded-full bg-gray-200 hover:bg-red-100 text-gray-500 hover:text-red-500 flex items-center justify-center transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-6 flex-1 overflow-y-auto custom-scrollbar flex flex-col">
                <div class="flex justify-between items-end mb-4">
                    <h4 class="text-sm font-bold text-gray-700">Daftar Jari Terdaftar</h4>
                    <span class="text-[10px] bg-green-100 text-[#2E973E] px-2 py-1 rounded-full font-bold">
                        Status Perangkat: <span id="deviceStatus">Mengecek...</span>
                    </span>
                </div>

                <div class="space-y-3" id="fingerList">
                    @if ($user->webAuthnCredentials->count() > 0)
                        @foreach ($user->webAuthnCredentials as $credential)
                            <div id="finger-row-{{ $credential->id }}"
                                class="group flex justify-between items-center p-4 border border-gray-100 rounded-2xl bg-white hover:border-[#2E973E]/50 hover:shadow-md transition-all cursor-default relative overflow-hidden">
                                <div
                                    class="absolute left-0 top-0 bottom-0 w-1 bg-[#2E973E] opacity-0 group-hover:opacity-100 transition-opacity">
                                </div>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-[#2E973E]/5 text-[#2E973E] flex items-center justify-center">
                                        <i class="fa-brands fa-500px text-2xl"></i>
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-bold text-gray-800">Passkey ID:
                                            {{ substr($credential->id, 0, 8) }}...</h5>
                                        <p class="text-xs text-gray-400 flex items-center gap-1">
                                            <i class="fa-regular fa-clock text-[10px]"></i> Terdaftar:
                                            {{ $credential->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <button type="button" onclick="deleteFinger('{{ $credential->id }}')"
                                    class="w-9 h-9 flex items-center justify-center text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div
                            class="text-center py-8 text-gray-400 text-sm bg-gray-50 rounded-xl border border-dashed border-gray-200">
                            <i class="fa-solid fa-fingerprint text-2xl mb-2 opacity-50"></i>
                            <p>Belum ada sidik jari yang didaftarkan.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div
                class="p-6 bg-gray-50 border-t border-gray-100 flex flex-col-reverse sm:flex-row justify-between gap-3">
                <button type="button" id="btnVerify"
                    class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-5 py-3 bg-white border border-gray-200 text-gray-600 hover:text-[#2E973E] hover:border-[#2E973E] rounded-xl font-bold shadow-sm hover:shadow transition-all text-sm group">
                    <i class="fa-solid fa-fingerprint group-hover:scale-110 transition-transform"></i>
                    Test Verifikasi
                </button>

                <button type="button" id="btnAddFinger"
                    class="group relative flex items-center justify-center bg-[#2E973E] hover:bg-[#1b5e20] text-white transition-all duration-300 font-bold rounded-xl text-sm px-5 py-3 shadow-lg shadow-green-200 hover:shadow-green-300 focus:outline-none shrink-0">
                    <span class="mr-2">Tambah Jari</span>
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
        </form>
    </div>
</div>
        <div id="crop-modal" class="fixed inset-0 z-[9999] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/75 transition-opacity backdrop-blur-sm"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
            
            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:w-full sm:max-w-lg flex flex-col">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start w-full">
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-bold leading-6 text-gray-900 border-b pb-2 mb-4" id="modal-title">Sesuaikan Foto</h3>
                            <div class="img-container relative h-[350px] w-full bg-black/5 rounded-lg overflow-hidden flex items-center justify-center">
                                <img id="image-to-crop" class="block max-w-full max-h-full">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2 relative z-50 border-t border-gray-100">
                    <button type="button" id="btn-crop-done" class="inline-flex w-full justify-center rounded-xl bg-[#2E973E] px-5 py-2.5 text-sm font-bold text-white shadow-lg hover:bg-[#1b5e20] hover:shadow-green-200 transition-all sm:ml-3 sm:w-auto active:scale-95">
                        Potong & Simpan
                    </button>
                    <button type="button" id="btn-crop-cancel" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-5 py-2.5 text-sm font-bold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto active:scale-95">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputImage = document.getElementById('upload-image-input');
        const cropModal = document.getElementById('crop-modal');
        const imageElement = document.getElementById('image-to-crop');
        const profilePreview = document.getElementById('profile-preview');
        const profileForm = document.getElementById('card-profile');

        let cropper = null;
        let croppedBlob = null;

        inputImage.addEventListener('change', function(e) {
            const files = e.target.files;
            if (files && files.length > 0) {
                const file = files[0];
                if (!file.type.startsWith('image/')) {
                    alert('Harap pilih file gambar.');
                    return;
                }

                cropModal.classList.remove('hidden');

                const reader = new FileReader();
                reader.onload = function(evt) {
                    imageElement.src = evt.target.result;

                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(imageElement, {
                        aspectRatio: 1,
                        viewMode: 1,
                        dragMode: 'move',
                        autoCropArea: 0.9,
                        restore: false,
                        guides: true,
                        center: true,
                        highlight: false,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: false,
                    });
                };
                reader.readAsDataURL(file);
                inputImage.value = '';
            }
        });

        document.getElementById('btn-crop-cancel').addEventListener('click', function() {
            cropModal.classList.add('hidden');
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        });

        document.getElementById('btn-crop-done').addEventListener('click', function() {
            console.log("Tombol Crop Ditekan");

            if (cropper) {
                cropper.getCroppedCanvas({
                    width: 500,
                    height: 500,
                }).toBlob((blob) => {
                    croppedBlob = blob;
                    
                    const url = URL.createObjectURL(blob);
                    profilePreview.src = url;

                    cropModal.classList.add('hidden');

                    $('#card-main').removeClass('md:w-full').addClass('md:w-1/2');
                    $('#card-profile').removeClass('hidden').hide().fadeIn(200);
                    
                }, 'image/jpeg', 0.9);
            } else {
                console.error("Cropper belum siap");
            }
        });

        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = document.getElementById('btn-save-profile');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';

            const formData = new FormData(profileForm);
            if (croppedBlob) {
                formData.append('image', croppedBlob, 'profile.jpg');
            }

            $.ajax({
                url: profileForm.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
                    notyf.success(response.msg || 'Berhasil disimpan');
                    croppedBlob = null;
                },
                error: function(xhr) {
                    const notyf = new Notyf({ duration: 3000, position: { x: 'right', y: 'top' } });
                    notyf.error('Terjadi kesalahan');
                },
                complete: function() {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const {
            startRegistration,
            startAuthentication,
            browserSupportsWebAuthn
        } = SimpleWebAuthnBrowser;
        const statusSpan = document.getElementById('deviceStatus');

        if (browserSupportsWebAuthn()) {
            if (statusSpan) {
                statusSpan.innerText = "Siap Digunakan"; 
                statusSpan.parentElement.classList.replace('bg-green-100', 'bg-blue-100');
                statusSpan.parentElement.classList.replace('text-[#2E973E]', 'text-blue-600');
            }
        } else {
            if (statusSpan) {
                statusSpan.innerText = "Tidak Support";
                statusSpan.parentElement.classList.replace('bg-green-100', 'bg-red-100');
                statusSpan.parentElement.classList.replace('text-[#2E973E]', 'text-red-600');
                document.getElementById('btnAddFinger').disabled = true;
            }
            return;
        }

        const notyf = new Notyf({
            duration: 2000,
            position: {
                x: 'right',
                y: 'top'
            },
            ripple: true
        });

        const btnAdd = document.getElementById('btnAddFinger');
        if (btnAdd) {
            btnAdd.addEventListener('click', async () => {
                const originalContent = btnAdd.innerHTML;
                btnAdd.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Scan...';
                btnAdd.disabled = true;

                try {
                    const resp = await fetch('{{ route('webauthn_register_options') }}');
                    const options = await resp.json();

                    const attResp = await startRegistration(options);

                    const verificationResp = await fetch('{{ route('webauthn_register') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(attResp),
                    });

                    const verificationJSON = await verificationResp.json();

                    if (verificationResp.ok) {
                        notyf.success(verificationJSON.msg);
                        setTimeout(() => location.reload(), 1000);
                    } else {
                        notyf.error(verificationJSON.msg || 'Gagal menyimpan');
                    }
                } catch (error) {
                    console.error(error);
                    if (error.name === 'NotAllowedError') {
                        notyf.error('Scan dibatalkan oleh user');
                    } else {
                        notyf.error('Gagal: ' + error.message);
                    }
                } finally {
                    btnAdd.innerHTML = originalContent;
                    btnAdd.disabled = false;
                }
            });
        }

        const btnVerify = document.getElementById('btnVerify');
        if (btnVerify) {
            btnVerify.addEventListener('click', async () => {
                const originalContent = btnVerify.innerHTML;
                btnVerify.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Cek...';
                btnVerify.disabled = true;

                try {
                    const resp = await fetch('{{ route('webauthn_login_options') }}');
                    const options = await resp.json();

                    const asseResp = await startAuthentication(options);

                    const verificationResp = await fetch('{{ route('webauthn_login') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(asseResp),
                    });

                    const verificationJSON = await verificationResp.json();

                    if (verificationResp.ok) {
                        notyf.success(verificationJSON.msg);
                    } else {
                        notyf.error(verificationJSON.msg || 'Verifikasi Gagal');
                    }
                } catch (error) {
                    console.error(error);
                    notyf.error('Verifikasi dibatalkan / Gagal.');
                } finally {
                    btnVerify.innerHTML = originalContent;
                    btnVerify.disabled = false;
                }
            });
        }
    });

    async function deleteFinger(id) {
        if (!confirm('Hapus akses sidik jari ini?')) return;

        try {
            const resp = await fetch(`/webauthn/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (resp.ok) {
                const row = document.getElementById(`finger-row-${id}`);
                if (row) row.remove();

                new Notyf().success('Data dihapus');
            } else {
                new Notyf().error('Gagal menghapus');
            }
        } catch (e) {
            new Notyf().error('Terjadi kesalahan server');
        }
    }
</script>
